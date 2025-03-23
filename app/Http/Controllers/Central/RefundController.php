<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;
use Stripe;
use Session;
use Srmklive\PayPal\Services\ExpressCheckout;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Central\GatewayDetails;
use App\Models\Central\Invoice;
use App\Helpers\Logger;
use App\Models\Central\Services\OrderService;


use Illuminate\Http\Request;

class RefundController extends Controller
{
    /*
     * Function used to refund the amount back to costomers
     */
    public function refund($uuid){

      //Get the invoice that has to be refunded
      $invoice = Invoice::find($uuid);
      /*
       * service class that interact with the Order model.
       * refer app/Models/Services/OrderService.php
       */
      $orderService = new OrderService();

      try {
        /*
         * For the case of stripe transactions
         */
        if($invoice->gateway == 'stripe'){
          //Get the stripe key Gateway details table.
          $stripeKey = GatewayDetails::where('name', 'stripe_secret')->first();

          $stripe = new \Stripe\StripeClient(
              $stripeKey->value
          );
          $response = $stripe->refunds->create([
            'charge' => "$invoice->transaction_id",
          ]);

          //Check the response from $response
          if($response['status'] == "succeeded"){
            //Changing the subscription status and invoice status
            $orderService->refundOrder($invoice);

            return redirect()->back()
              ->with('success', __('Refund successfully completed'));
          } else {
            return redirect()->back()
              ->with('error', __('Refund could not be completed'));
          }

        /*
         * For the case of paypal transactions
         */
        } elseif ($invoice->gateway == 'paypal'){

          if( $invoice->test_mode == true )
          {
            //Test mode url
            $url = "https://api-3t.sandbox.paypal.com/nvp";
          } else {
            //Live mode url
            $url = "https://api-3t.paypal.com/nvp";
          }
           
          //Get paypal API credentials from Gateway details table
          $username = GatewayDetails::where('name', 'paypal_api_username')->first();
          $password = GatewayDetails::where('name', 'paypal_api_password')->first();
          $signature = GatewayDetails::where('name', 'paypal_api_signature')->first();

          $postfields = array();
          $postfields["VERSION"] = 95;
          $postfields["METHOD"] = "RefundTransaction";
          $postfields["BUTTONSOURCE"] = "Monitoring.Zone";
          $postfields["USER"] = "$username->value";
          $postfields["PWD"] = "$password->value";
          $postfields["SIGNATURE"] = "$signature->value";
          $postfields["TRANSACTIONID"] = "$invoice->transaction_id";
          $postfields["REFUNDTYPE"] = "Full";
          $postfields["AMT"] = "$invoice->amount";
          $postfields["CURRENCYCODE"] = "$invoice->currency";
      
          $ch = curl_init();
      
          curl_setopt($ch, CURLOPT_URL,"$url");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,
                  http_build_query($postfields));
          
          // Receive server response ...
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          
          //Get response.
          $server_output = curl_exec($ch);
          curl_close ($ch);
          
          $resultsarray2 = explode("&", $server_output);

          foreach( $resultsarray2 as $line )
          {
              $line = explode("=", $line);
              $resultsarray[$line[0]] = urldecode($line[1]);
          }
          //Check the response from $resultsarray
          if( strtoupper($resultsarray["ACK"]) == "SUCCESS" )
          {
            //Changing the subscription status and invoice status
            $orderService->refundOrder($invoice);

            return redirect()->back()
              ->with('success', __('Refund successfully completed'));

          } else {
            $error = $resultsarray['L_LONGMESSAGE0'];
            return redirect()->back()
              ->with('error', __("Refund could not be completed, $error"));
          }
        /*
         * For the case of mollie transactions
         */
        } elseif ($invoice->gateway == 'mollie'){

          $mollie = new \Mollie\Api\MollieApiClient();
          //Get mollie key from Gateway details table
          $mollieKey = GatewayDetails::where('name', 'mollie_key')->first();
          $mollie->setApiKey($mollieKey->value);

          $payment = $mollie->payments->get("$invoice->transaction_id");
          $refund = $payment->refund([
            "amount" => [
              "currency" => "USD",
              "value" => sprintf("%.2f", $invoice->amount) // You must send the correct number of decimals, thus we enforce the use of strings
            ]
          ]);

          //Check the response from $refund
          if ($refund->status == "refunded"){
            //Changing the subscription status and invoice status
            $orderService->refundOrder($invoice);

            return redirect()->back()
            ->with('success', __("Refund successfully completed"));
          } elseif ($refund->status == "failed") {
            return redirect()->back()
            ->with('error', __("Refund could not be completed"));

          /*
           * For the cases:-
           * queued - The refund is queued due to a lack of balance.
           * pending - The refund is ready to be sent to the bank.
           * processing - The refund is being processed. 
           */
          } else {
            //Changing the subscription status and invoice status
            $orderService->refundOrder($invoice);

            return redirect()->back()
            ->with('success', __("Refund is $refund->status"));
          }
          
        }

      } catch (\Exception $e) {
        Logger::error($e->getMessage());
          return redirect()
              ->back()
              ->withInput()
              ->with('error', __('Something went wrong'));
      }
      

    } 
}