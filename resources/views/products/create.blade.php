@extends('layout')
@php $CONF = config('constants'); @endphp

@section('title')
    @parent - Create Product
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.create') }}">Create</a></li>
@endsection

@section('content')
<form action="{{ route('products.store') }}" method="POST">
    @csrf

<div id="item_edit_panel" class="card">
    <div class="card-header">

<div class="row">
    <div class="col">
<h3 class="card-title text-nowrap">Create Product</h3>
    </div>
    <div class="col text-end">
<a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm" role="button">X</a>
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
                    <option value="{{ $option }}"{{ ($option == old('status')) ? ' selected' : '' }}>{{ $value }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Slug:</strong>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Slug">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>ISBN:</strong>
                <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Publish Date:</strong>
                <input type="date" name="publish_date" class="form-control" value="{{ old('publish_date') }}" >
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Pages:</strong>
                <input type="number" name="pages" class="form-control" value="{{ old('pages') }}">
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
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <strong>Subtitle:</strong>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ old('description') }}</textarea>
            </div>
        </div>
    </div>

{{-- COL-END --}}
</div>
</div>

<div class="row border-top mb-2">
    <div class="col-1 offset-1 mt-3">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</div>

    </div> <!-- end class="card-body" -->
</div> <!-- end class="card" -->
</form>

@endsection

@push('debug')
<b>product_fake :</b> {{ print_r($product_fake,true) }}
@endpush
