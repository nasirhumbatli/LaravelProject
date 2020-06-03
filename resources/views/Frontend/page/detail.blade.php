@extends('frontend.layout')
@section('content')

<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">{{$page->page_title}}</h1>
    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="/images/pages/{{$page->page_file}}" alt="image">

            <hr>

            <!-- Date/Time -->
            <p>Yayınlanma Tarixi: {{$page->created_at->format('d-m-Y h:i')}}</p>

            <hr>

            <p>{!!$page->page_content!!}</p>
            <hr>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Ən son Əlavə Edilənlər</h5>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($pageList as $list)
                        <li class="list-group-item"><a
                                href="{{route('page.Detail',$list->page_slug)}}">{{$list->page_title}}</a></li>

                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>

@endsection
@section('css')@endsection
@section('js')@endsection