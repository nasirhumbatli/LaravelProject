@extends('frontend.layout')
@section('content')

<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Bizimlə Əlaqə</h1>
    <hr>
    <!-- Content Row -->
    <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
            <h3>Əlaqə Formu</h3>
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endforeach
            @endif
            <form method="POST">
                @csrf
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Ad Soyad">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telefon:</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Mesaj:</label>
                        <textarea rows="10" cols="100" class="form-control" name="message"
                            style="resize:none"></textarea>
                    </div>
                </div>
                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary">Göndər</button>
            </form>

        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
            <h3>Ünvan Məlumatları</h3>
            {!! $adres !!}
            <br>
            {{$district}} / {{$city}}
            <br>
            {{$phone_faks}}
            <br>
            {{$phone}}
            <br>
            {{$mail}}

        </div>
    </div>


</div>

@endsection
@section('css')@endsection
@section('js')@endsection