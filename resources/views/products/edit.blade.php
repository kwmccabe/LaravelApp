@extends('layout')
@php $CONF = config('constants'); @endphp

@section('title')
    @parent - Edit Product - {{ $product->isbn }}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.show',$product->id) }}">{{ $product->slug }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.edit',$product->id) }}">Edit</a></li>
@endsection

@section('content')
<form action="{{ route('products.update',$product->id) }}" method="POST">
    @csrf
    @method('PUT')

<div id="item_edit_panel" class="card">
    <div class="card-header">

<div class="row">
    <div class="col">
<h3 class="card-title text-nowrap">Edit Product</h3>
    </div>
    <div class="col text-end">
<a href="{{ route('products.show',$product->id) }}" class="btn btn-outline-primary btn-sm" role="button">X</a>
    </div>
</div>

    </div> <!-- end class="card-header" -->
    <div class="card-body">

{{-- COL-1 --}}
<div class="row mb-3">
<div class="col-12 col-sm-5 offset-sm-1">

    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" class="form-select" aria-label="Product Status">
                @foreach ($CONF['products']['status_options'] as $option => $value)
                    <option value="{{ $option }}"{{ ($option == $product->status) ? ' selected' : '' }}>{{ $value }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Slug:</strong>
                <input type="text" name="slug" class="form-control" value="{{ $product->slug }}" placeholder="Slug">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>ISBN:</strong>
                <input type="text" name="isbn" class="form-control" value="{{ $product->isbn }}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Publish Date:</strong>
                <input type="date" name="publish_date" class="form-control" value="{{ $product->publish_date }}" >
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Pages:</strong>
                <input type="number" name="pages" class="form-control" value="{{ $product->pages }}">
            </div>
        </div>
    </div>

{{-- COL-2 --}}
</div>
<div class="col-0 col-sm-auto border-start border-secondary"></div>
<div class="col-12 col-sm-5">

    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" value="{{ $product->title }}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Subtitle:</strong>
                <input type="text" name="subtitle" class="form-control" value="{{ $product->subtitle }}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $product->description }}</textarea>
            </div>
        </div>
    </div>

{{-- COL-END --}}
</div>
</div>

<div class="row border-top mb-2">
    <div class="col-1 offset-1 mt-3">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    <div class="col-4 mt-3">
        <a href="{{ route('products.show',$product->id) }}" class="btn btn-outline-primary" role="button">Cancel</a>
    </div>
    <div class="col text-end mt-3">
        <a href="{{ route('products.destroy',$product->id) }}" class="btn btn-outline-danger" role="button" data-confirm-link="Delete Product? This action cannot be undone.">Delete Product</a>
    </div>
</div>

    </div> <!-- end class="card-body" -->
    <div class="card-footer">


<div class="row">
    <div class="col-12 col-sm-6 small">
{{ $product->isbn }}<br/>
{{ $product->name }}<br/>
    </div>
    <div class="col-12 col-sm-6 text-sm-end small">
Created : {{ $product->created_at }}<br/>
Updated : {{ $product->updated_at }}<br/>
    </div>
</div>

    </div> <!-- end class="card-footer" -->
</div> <!-- end class="card" -->
</form>
@endsection
