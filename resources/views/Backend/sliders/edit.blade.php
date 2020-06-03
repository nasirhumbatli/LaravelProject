@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Slider Redaktə</h3>
        </div>
        <div class="box-body">
            <form action="{{route('slider.update',$sliders->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @isset($sliders->slider_file)
                <div class="form-group">
                    <label>Yüklü Şəkil</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <img width="100" src="/images/sliders/{{$sliders->slider_file}}" alt="image">
                        </div>
                    </div>
                </div>
                @endisset
                <div class="form-group">
                    <label>Şəkil Seç</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="file" name="slider_file" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Başlıq</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" value="{{$sliders->slider_title}}"
                                name="slider_title">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" value="{{$sliders->slider_slug}}"
                                name="slider_slug">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Url</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" value="{{$sliders->slider_url}}" name="slider_url">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Məzmun</label>

                            <textarea name="slider_content" class="ckeditor"
                                class="form-control">{{$sliders->slider_content}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Status</label>

                            <select name="slider_status" class="form-control">
                                <option {{$sliders->slider_status=="1" ? "selected" : ""}} value="1">Aktiv</option>
                                <option {{$sliders->slider_status=="0" ? "selected" : ""}} value="0">Deaktiv</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_file" value="{{$sliders->slider_file}}">
                <div style="text-align: right" class="box-footer">
                    <button type="submit" class="btn btn-success">Yüklə</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection


@section('css')@endsection
@section('js')@endsection