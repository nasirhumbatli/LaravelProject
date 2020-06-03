@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User Redaktə</h3>
        </div>
        <div class="box-body">
            <form action="{{route('user.update',$users->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @isset($users->user_file)
                <div class="form-group">
                    <label>Yüklü Şəkil</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <img width="100" src="/images/users/{{$users->user_file}}" alt="image">
                        </div>
                    </div>
                </div>
                @endisset
                <div class="form-group">
                    <label>Şəkil Seç</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="file" name="user_file" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ad Soyad</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" value="{{$users->name}}" name="name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>İstifadəçi (Email)</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="email" class="form-control" value="{{$users->email}}" name="email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Şifrə</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="password" class="form-control" name="password">
                            <small>Şifrənizi dəyişdirmək istəmirsinizsə boş buraxın!</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Status</label>

                            <select name="user_status" class="form-control">
                                <option {{$users->user_status=="1" ? "selected" : ""}} value="1">Aktiv</option>
                                <option {{$users->user_status=="0" ? "selected" : ""}} value="0">Deaktiv</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_file" value="{{$users->user_file}}">
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