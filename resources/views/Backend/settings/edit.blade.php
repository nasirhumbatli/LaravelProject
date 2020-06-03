@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Settings</h3>
        </div>
        <div class="box-body">
            <form action="{{route('settings.update',['id'=> $settings->id])}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Açıqlama</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" readonly name="settings_value"
                                value="{{$settings->settings_description}}">
                        </div>
                    </div>
                </div>

                @if($settings->settings_type=='file')
                <div class="form-group">
                    <label>Şəkil Seç</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="file" required name="settings_value" class="form-control">
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            @if($settings->settings_type=='text')
                            <label>Məzmun</label>

                            <input type="text" required value="{{$settings->settings_value}}" name="settings_value"
                                class="form-control">
                            @endif
                            @if($settings->settings_type=='textarea')
                            <label>Məzmun</label>

                            <textarea name="settings_value"
                                class="form-control">{{$settings->settings_value}}</textarea>
                            @endif
                            @if($settings->settings_type=='ckeditor')
                            <label>Məzmun</label>

                            <textarea name="settings_value" class="ckeditor"
                                class="form-control">{{$settings->settings_value}}</textarea>
                            @endif
                            @if($settings->settings_type=="file")
                            <img width="100" src="/images/settings/{{$settings->settings_value}}" alt="image">
                            @endif
                        </div>
                    </div>
                    @if($settings->settings_type=='file')
                    <input type="hidden" name="old_file" value="{{$settings->settings_value}}">
                    @endif
                    <div style="text-align: right" class="box-footer">
                        <button type="submit" class="btn btn-success">Redaktə edin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection


@section('css')@endsection
@section('js')@endsection