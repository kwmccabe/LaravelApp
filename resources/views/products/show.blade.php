@extends('layout')
@php $CONF = config('constants'); @endphp

@section('title')
    @parent - Product '{{ $product->id }}'
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/products">Products</a></li>
    <li class="breadcrumb-item"><a href="/products/{{ $product->id }}">{{ $product->slug }}</a></li>
@endsection

@section('content')
<div id="item_show_panel" class="card">
    <div class="card-header">

<div class="row">
    <div class="col">
<h3 class="card-title text-nowrap">Product {{ $product->id }}</h3>
    </div>
    <div class="col text-end">
<a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary btn-sm" role="button">Edit Product...</a>
<a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm" role="button">X</a>
    </div>
</div>

    </div> <!-- end class="card-header" -->
    <div class="card-body">

{{-- COL-1 --}}
<div class="row mb-3">
<div class="col-12 col-sm-5 offset-sm-1">

    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Status</span><br/>
            <span class="fs-5">{{ ($product->status) ? $CONF['products']['status_options'][$product->status] : 'Not Set' }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Slug</span><br/>
            <span class="fs-5">{{ $product->slug }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">ISBN</span><br/>
            <span class="fs-5">{{ $product->isbn }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Publish Date</span><br/>
            <span class="fs-5">{{ ($product->publish_date) ? $product->publish_date : 'Not Set' }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Pages</span><br/>
            <span class="fs-5">{{ ($product->pages) ? $product->pages : 'Not Set' }}</span>
        </div>
    </div>

{{-- COL-2 --}}
</div>
<div class="col-0 col-sm-auto border-start border-secondary"></div>
<div class="col-12 col-sm-5">

    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Title</span><br/>
            <span class="fs-5">{{ ($product->title) ? $product->title : 'Not Set' }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Subtitle</span><br/>
            <span class="fs-5">{{ ($product->subtitle) ? $product->subtitle : 'Not Set' }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <span class="fs-6 fw-light mb-0">Description</span><br/>
            <span class="fs-5">{!! ($product->description) ? nl2br($product->description) : 'Not Set' !!}</span>
        </div>
    </div>

{{-- COL-END --}}
</div>
</div>

    </div> <!-- end class="card-body" -->
</div> <!-- end class="card" -->

@endsection
