@extends('layout')

@section('content')
<div class="container mt-5">
    <h2>Edit Product</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
