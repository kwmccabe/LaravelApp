<!DOCTYPE html>
<html lang="en">
<head>
    <title>@section('title')LaravelApp @show</title>
@section('metas')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@show
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- link to laravelapp.css -->
@show

</head>
<body>

@section('header')
    <div id="header" class="container-fluid mt-2">
        <div class="card">
            <div class="card-header bg-primary">NAVBAR</div>
            <div class="card-body">
                <div class="row">
<div class="col-12 col-sm-8">
    <h6>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        @section('breadcrumb')<li class="breadcrumb-item"><a href="/">Home</a></li> @show
        </ol>
    </nav>
    </h6>
</div>

<div class="col-12 col-sm-4 text-sm-end">
    <h6>userinfo</h6>
</div>

                </div>
            </div> <!-- end class="card-body" -->
        </div> <!-- end class="card" -->
    </div>
@show

@section('messages')
    <div id="messages" class="container flashed-messages">
        <div class="row">
            <div class="col"> @include('flash_messages') </div>
        </div>
    </div>
@show

@section('main')
    <div id="main" class="container-fluid layout-1col mt-2">
        <div class="row">
            <div id="content" class="col">
                @yield('content')
            </div>
        </div>
    </div>
@show

@section('footer')
    <div id="footer" class="container-fluid mt-2">
    <div class="card-group">
        <div id="footer_left" class="card mb-0 bg-light">
            <div class="card-body">
                SITE LOGO
                <!-- img id="site_logo" src="logo.png" width="300" / -->
            </div>
        </div>
        <div id="footer_right" class="card mb-0 bg-light">
            <div class="card-body">
                SITE LINKS
            </div>
        </div>
    </div>
    </div>
@show

{{-- @push('debug') --}}
{{-- @pushIf(DEBUG, 'debug') --}}
<div id="debuginfo" class="mt-2"><pre>
DEBUG:
<b>request()->url() :</b> {{ print_r(request()->url(),true) }}
<b>request()->all() :</b> {{ print_r(request()->all(),true) }}
@stack('debug')
</pre></div>
{{-- <b>constants :</b> {{ print_r(config('constants'),true) }} --}}
{{-- <b>session()->all() :</b> {{ print_r(session()->all(),true) }} --}}


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- link to jquery ? -->
    <!-- link to laravelapp.js -->
@endpush
@stack('scripts')

</body>
</html>

