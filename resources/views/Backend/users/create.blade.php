@extends('backend.layout')

@section('content')
<section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Yeni User</h3>
        </div>
        <div class="box-body">
            <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
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
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>İstifadəçi (Email)</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Şifrə</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Status</label>

                            <select name="user_status" class="form-control">
                                <option value="1">Aktiv</option>
                                <option value="0">Deaktiv</option>
                            </select>
                        </div>
                    </div>
                </div>

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