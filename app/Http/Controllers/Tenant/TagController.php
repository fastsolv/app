<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant\Tag;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Logger;
use App\Helpers\Uuid;
use Illuminate\Support\Facades\Session;
use DB;

use App\Models\Tenant\Services\TagService;

class TagController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $tags = Tag::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $tags = Tag::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $tags = Tag::all();
            $sort_order = 'decs';
        }

       
        return view('tenant.tag.index',compact('tags','sort_order')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $tags = Tag::all();
        // Display tags
        return view(
            'tenant.tag.create',
            compact('tags')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required | unique:App\Models\Tenant\Tag,name',
                'tag_color' => 'required ',
                'text_color' => 'required ',
                             
              ]);
  
              if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
              } 
  
              $tagService = new TagService();
              $tagService->addTag($request);
            
              return redirect()->route('get_tags')
                  ->with('success', __('Tag created'));
  
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
          }
      
    }

    public function edit(Request $request, $uuid)
    {
        
        $tag = Tag::find($uuid);
        return view('tenant.tag.edit', compact('tag'));
    }

    public function update(Request $request, $uuid)
    {
        
        // Get the tag
        $tag = Tag::find($uuid);
        $validator = Validator::make($request->all(), [
            'name' => 'required | unique:App\Models\Tenant\Tag,name,'.$tag->uuid,
            'tag_color' => 'required',
            'text_color' => 'required ',                 
                              
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        // Update tag
        $tag->update($request->all());

        return redirect()->route('get_tags')
            ->with('success', __('Tag Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        
        // Delete tag
        $tag = Tag::find($uuid);
        $tag->delete();

        return redirect()->route('get_tags')
           ->with('success', __('Tag deleted'));
    }

    public function getTagsApi(Request $request)
    {
        $tags = DB::table('tags')->get()->toJson(JSON_PRETTY_PRINT);
        return response($tags, 200);
    }
}
