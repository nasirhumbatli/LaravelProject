<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pages;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = Pages::all()->sortBy('page_must');
        return view('backend.pages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strlen($request->page_slug)>3){

            $slug = Str::slug($request->page_slug);
        }else {
            $slug = Str::slug($request->page_title);
        }
        

        if($request->hasFile('page_file')){

            $request->validate([
                'page_title' => 'required',
                'page_content' => 'required',
                'page_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
                
            ]);

            $file_name = uniqid().'.'.$request->page_file->getClientOriginalExtension();
            $request->page_file->move(public_path('images/pages'),$file_name);
        }else {
            $file_name = null;
        }
        
        
        $pages = Pages::insert(
            [
                'page_title' => $request->page_title,
                'page_file' => $file_name,
                'page_slug' => $slug,
                'page_content' => $request->page_content,
                'page_status' => $request->page_status,
            ]
        );

        if($pages){
            return redirect(route('page.index'))->with('success','Əlavə Edildi');
        }
        return back()->with('error','Uğusuz Əməliyyat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = Pages::where('id',$id)->first();
        return view('backend.pages.edit')->with('pages',$pages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(strlen($request->page_slug)>3){

            $slug = Str::slug($request->page_slug);
        }else {
            $slug = Str::slug($request->page_title);
        }

        if($request->hasFile('page_file')){

            $request->validate([
                'page_title' => 'required',
                'page_content' => 'required',
                'page_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid().'.'.$request->page_file->getClientOriginalExtension();
            $request->page_file->move(public_path('images/pages'),$file_name);

            $page = Pages::where('id',$id)->update([
                'page_title' => $request->page_title,
                'page_content' => $request->page_content,
                'page_slug' => $slug,
                'page_file' => $file_name,
                'page_status' => $request->page_status,
            ]);

            if($page){
                $path = 'images/pages/'.$request->old_file;
                if(file_exists($path)){
                    @unlink(public_path($path));
                }

                return back()->with('success','Redaktə Edildi');
            }else {
                return back()->with('error','Uğursuz Əməliyyat');
            }
        }else {
            $request->validate([
                'page_title' => 'required',
                'page_content' => 'required'
            ]);
            $page = Pages::where('id',$id)->update([
                'page_title' => $request->page_title,
                'page_content' => $request->page_content,
                'page_slug' => $slug,
                'page_status' => $request->page_status,
            ]);

            if($page){
                return back()->with('success','Redaktə Edildi');
            }else {
                return back()->with('error','Uğursuz Əməliyyat');
            }
        }


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page=Pages::find(intval($id));
        if($page->delete()){
            @unlink(public_path('images/pages/'.$page->page_file));
            echo true;
        }
        echo false;
    }

    public function sortable()
    {
        foreach($_POST['item'] as $key => $value)
        {
            $pages = Pages::find(intval($value));
            $pages->page_must = intval($key);
            $pages->save();
        }

        echo true;
    }
}
