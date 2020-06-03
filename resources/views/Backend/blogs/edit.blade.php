@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Blog Redaktə</h3>
        </div>
        <div class="box-body">
            <form action="{{route('blog.update',$blogs->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @isset($blogs->blog_file)
                <div class="form-group">
                    <label>Yüklü Şəkil</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <img width="100" src="/images/blogs/{{$blogs->blog_file}}" alt="image">
                        </div>
                    </div>
                </div>
                @endisset
                <div class="form-group">
                    <label>Şəkil Seç</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="file" name="blog_file" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Başlıq</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" value="{{$blogs->blog_title}}" name="blog_title">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" value="{{$blogs->blog_slug}}" name="blog_slug">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Məzmun</label>

                            <textarea name="blog_content" class="ckeditor"
                                class="form-control">{{$blogs->blog_content}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Status</label>

                            <select name="blog_status" class="form-control">
                                <option {{$blogs->blog_status=="1" ? "selected" : ""}} value="1">Aktiv</option>
                                <option {{$blogs->blog_status=="0" ? "selected" : ""}} value="0">Deaktiv</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_file" value="{{$blogs->blog_file}}">
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