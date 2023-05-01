@extends('layout')
@php $CONF = config('constants'); @endphp

@section('title')
    @parent - Products
@endsection

@section('breadcrumb')
    @parent <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
@endsection

@section('content')
<form class="form-inline" action="/products/index_action" method="POST">
@csrf

<div id="item_list_panel" class="card">
    <div class="card-header">

<div class="row gx-2">
    {{-- date filter --}}
    <div class="col mb-2">
    </div>

    <div class="col text-end mb-2 ms-auto">
        <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm" role="button">New Product...</a>
    </div>
</div>
<div class="row">
    {{-- list filter --}}
    <div class="col-auto pe-0 mt-1 small">Filters :
        <i class="bi bi-funnel"></i>
    </div>
    <div class="col-auto ps-1 mb-2 small">
        <label for="status" class="visually-hidden">Product Status</label>
        <select id="status" name="status" class="form-select form-select-sm" onchange="window.location='?status='+this.value;">
            <option value="">Status - All</option>
        @foreach ($CONF['products']['status_options'] as $key => $val)
            <option value="{{ $key}}"{{
                (session('products_index.status') == $key) ? ' selected' : ''
                }}> Status - {{ $val }}</option>
        @endforeach
        </select>
    </div>
    {{-- pager --}}
    <div class="col-auto text-center text-sm-end mt-1 ms-auto">
    {!! $products->links() !!}
    </div>
</div>

    </div> <!-- end class="card-header" -->
    <div class="card-body">

<div class="table-responsive">
<table class="table table-sm table-hover table-striped">
<thead>
<tr class="text-secondary">
    <th><input type="checkbox" class="checkall" onclick="checkAll('resource_id',this.checked);" /></th>
    <th><span class="text-nowrap">
@if (session('products_index.sort') == 'status' && session('products_index.order') == 'asc')
    <a href="{{ route('products.index',['order' => 'desc']) }}">Status</a>
    <i class="bi bi-sort-down"></i>
@elseif (session('products_index.sort') == 'status')
    <a href="{{ route('products.index',['order' => 'asc']) }}">Status</a>
    <i class="bi bi-sort-up"></i>
@else
    <a href="{{ route('products.index',['sort' => 'status']) }}">Status</a>
@endif
        </span></th>
    <th><span class="text-nowrap">
@if (session('products_index.sort') == 'publish_date' && session('products_index.order') == 'asc')
    <a href="{{ route('products.index',['order' => 'desc']) }}">Publish Date</a>
    <i class="bi bi-sort-down"></i>
@elseif (session('products_index.sort') == 'publish_date')
    <a href="{{ route('products.index',['order' => 'asc']) }}">Publish Date</a>
    <i class="bi bi-sort-up"></i>
@else
    <a href="{{ route('products.index',['sort' => 'publish_date']) }}">Publish Date</a>
@endif
        </span></th>
    <th><span class="text-nowrap">
@if (session('products_index.sort') == 'isbn' && session('products_index.order') == 'asc')
    <a href="{{ route('products.index',['order' => 'desc']) }}">ISBN</a>
    <i class="bi bi-sort-down"></i>
@elseif (session('products_index.sort') == 'isbn')
    <a href="{{ route('products.index',['order' => 'asc']) }}">ISBN</a>
    <i class="bi bi-sort-up"></i>
@else
    <a href="{{ route('products.index',['sort' => 'isbn']) }}">ISBN</a>
@endif
        </span></th>
    <th><span class="text-nowrap">
@if (session('products_index.sort') == 'title' && session('products_index.order') == 'asc')
    <a href="{{ route('products.index',['order' => 'desc']) }}">Title</a>
    <i class="bi bi-sort-down"></i>
@elseif (session('products_index.sort') == 'title')
    <a href="{{ route('products.index',['order' => 'asc']) }}">Title</a>
    <i class="bi bi-sort-up"></i>
@else
    <a href="{{ route('products.index',['sort' => 'title']) }}">Title</a>
@endif
        </span></th>
    <th><span class="text-nowrap">Subtitle</span></th>
    <th><span class="text-nowrap">Description</span></th>
    <th></th>
</tr>
</thead>

<tbody class="table-group-divider">
@empty($products)
    <tr><td></td><td colspan="5">None</td></tr>
@endempty

@foreach ($products as $product)
<tr>
    <td>
        <input type="checkbox" name="product_id[]" value="{{ $product->id }}">
    </td>

    <td onclick="window.location='{{ route('products.show',$product->id) }}';">
        {{ $CONF['products']['status_options'][$product->status] }}
    </td>
    <td onclick="window.location='{{ route('products.show',$product->id) }}';">
        {{ $product->publish_date }}
    </td>
    <td onclick="window.location='{{ route('products.show',$product->id) }}';">
        {{ $product->isbn }}
    </td>
    <td onclick="window.location='{{ route('products.show',$product->id) }}';">
        {{ $product->title }}
    </td>
    <td onclick="window.location='{{ route('products.show',$product->id) }}';">
        {{ $product->subtitle }}
    </td>
    <td onclick="window.location='{{ route('products.show',$product->id) }}';">
        {{ str_word_count($product->description) }} Words
    </td>

    <td>
        <a href="{{ route('products.edit',$product->id) }}">edit</a>
    </td>

</tr>
@endforeach
</tbody>
</table>
</div>

    </div> <!-- end class="card-body" -->
    <div class="card-footer">

<div class="row">
    <div id="list-actions" class="col-auto">
        <select id="action" name="action" class="form-select form-select-sm">
            <option value="">Update Selected Products...</option>
            <option value="active">Set Status 'Active'</option>
            <option value="inactive">Set Status 'Inactive'</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div id="list-actions-apply" class="col-auto">
        <button type="submit" class="btn btn-sm btn-primary" role="button">Apply</button>
    </div>
    <div class="col-auto text-center text-sm-end mt-1 ms-auto">
        {!! $products->links() !!}
    </div>
</div>

    </div> <!-- end class="card-footer" -->
</div> <!-- end class="card" -->

</form>
@endsection

@push('debug')
<b>session()->all() :</b> {{ print_r(session()->all(),true) }}
@endpush
