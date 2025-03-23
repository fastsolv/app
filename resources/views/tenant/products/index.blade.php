@extends( 
        ($theme =="white") ? 'tenant.layouts.white_theme':
     ( ($theme =="red") ? 'tenant.layouts.red_theme':
    (($theme =="green") ? 'tenant.layouts.green_theme':
    (($theme =="black") ? 'tenant.layouts.black_theme':
   ( ($theme =="blue") ?'tenant.layouts.blue_theme': 'tenant.layouts.yellow_theme' ))))
    )
@section('content')


@section('content')
 
<div class="section-header shadow-none ">
    <h1>{{ __('Products') }} </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Products') }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header ">
                 
                     @if($show_add_button)
                    <small id='main'>
                        <a href="{{ route('product.create') }}"
                            class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                    </small>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!count($products))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('No data found') }} !!</h2>
                            <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p>
                            <a href="{{ route('product.create') }}"
                                class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                        </div>
                        @else
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th> <a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('products',['name' => 'product_name' ,'order'=>$sort_order]) }}">{{ __('Product Name') }}
                                         <span> @if($sort_order =='asc') 
                                            <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                             @else
                                             <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                             @endif
                                        </span>
                                    </a></th>
                                    <th> <a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('products',['name' => 'product_description' ,'order'=>$sort_order]) }}">{{ __('Product Description') }} 
                                         <span> @if($sort_order =='asc') 
                                            <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                             @else
                                             <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                             @endif
                                        </span>
                                    </a></th>
                                    <th><a  class ="text-secondary text-decoration-none font-weight-bold" href="{{ route('products',['name' => 'status' ,'order'=>$sort_order]) }}">{{ __('Status') }} 
                                        <span> @if($sort_order =='asc') 
                                                <i  class=" fa fa-sort-alpha-up mt-1 float-right  "></i>
                                                    @else
                                                    <i  class=" mt-1 float-right   fa fa-sort-alpha-down  "></i>
                                                    @endif
                                        </span></a></th>
                                    @if($show_edit_button || $show_delete_button)
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>+
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="text-capitalize">{{$product->product_name}}</td>
                                    <td>{{$product->product_description}} </td>
                                     @if (($product->status) == true)
                                    <td class="text-success">{{ __('Active') }}</td>
                                      @else
                                    <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif

                                    @if($show_edit_button || $show_delete_button)
                                    <td class="justify-content-center form-inline">
                                        @if($show_edit_button)
                                        <a href="{{ route('product.edit', [$product->uuid]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a> @endif
                                         @if($show_delete_button)
                                        <form action="{{ route('product.destroy', [$product->uuid]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif

                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                        <br>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection