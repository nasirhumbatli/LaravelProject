<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sliders;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['slider'] = Sliders::all()->sortBy('slider_must');
        return view('backend.sliders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'slider_title' => 'required',
            'slider_content' => 'required',
        ]);

        if (strlen($request->slider_url) > 3) {
            $request->validate([
                'slider_url' => 'active_url'
            ]);
            $slider_url = $request->slider_url;
        }else {
            $slider_url = null;

        }


        if (strlen($request->slider_slug) > 3) {

            $slug = Str::slug($request->slider_slug);
        } else {
            $slug = Str::slug($request->slider_title);
        }


        if ($request->hasFile('slider_file')) {

            $request->validate([
                'slider_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid() . '.' . $request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path('images/sliders'), $file_name);
        } else {
            $file_name = null;
        }


        $sliders = Sliders::insert(
            [
                'slider_title' => $request->slider_title,
                'slider_file' => $file_name,
                'slider_slug' => $slug,
                'slider_content' => $request->slider_content,
                'slider_status' => $request->slider_status,
                'slider_url' => $slider_url
            ]
        );

        if ($sliders) {
            return redirect(route('slider.index'))->with('success', 'Əlavə Edildi');
        }
        return back()->with('error', 'Uğusuz Əməliyyat');
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
        $sliders = Sliders::where('id', $id)->first();
        return view('backend.sliders.edit')->with('sliders', $sliders);
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
        if (strlen($request->slider_slug) > 3) {

            $slug = Str::slug($request->slider_slug);
        } else {
            $slug = Str::slug($request->slider_title);
        }

        if(strlen($request->slider_url)>3){
            $request->validate([
                'slider_url' => 'active_url'
            ]);
            $slider_url = $request->slider_url;
        }else {
            $slider_url = null;
        }

        if ($request->hasFile('slider_file')) {

            $request->validate([
                'slider_title' => 'required',
                'slider_content' => 'required',
                'slider_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name = uniqid() . '.' . $request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path('images/sliders'), $file_name);

            $slider = Sliders::where('id', $id)->update([
                'slider_title' => $request->slider_title,
                'slider_content' => $request->slider_content,
                'slider_slug' => $slug,
                'slider_file' => $file_name,
                'slider_status' => $request->slider_status,
                'slider_url' => $slider_url
            ]);

            if ($slider) {
                $path = 'images/sliders/' . $request->old_file;
                if (file_exists($path)) {
                    @unlink(public_path($path));
                }

                return back()->with('success', 'Redaktə Edildi');
            } else {
                return back()->with('error', 'Uğursuz Əməliyyat');
            }
        } else {
            $request->validate([
                'slider_title' => 'required',
                'slider_content' => 'required',
            ]);
            $slider = Sliders::where('id', $id)->update([
                'slider_title' => $request->slider_title,
                'slider_content' => $request->slider_content,
                'slider_slug' => $slug,
                'slider_status' => $request->slider_status,
                'slider_url' => $slider_url
            ]);

            if ($slider) {
                return back()->with('success', 'Redaktə Edildi');
            } else {
                return back()->with('error', 'Uğursuz Əməliyyat');
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
        $slider = Sliders::find(intval($id));
        if ($slider->delete()) {
            @unlink(public_path('images/sliders/' . $slider->slider_file));
            echo true;
        }
        echo false;
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sliders = Sliders::find(intval($value));
            $sliders->slider_must = intval($key);
            $sliders->save();
        }

        echo true;
    }
}
