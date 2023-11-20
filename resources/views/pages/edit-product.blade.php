@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('product.store-edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $product->name }}" required>
            <label for="name">Name</label>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="{{ $product->price }}" required>
            <label for="price">Price</label>
            @error('price')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Stock" value="{{ $product->stock }}" required>
            <label for="stock">Stock</label>
            @error('stock')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" id="description" style="height: 200px" required>{{ $product->description }}</textarea>
            <label for="description">Description</label>
            @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Save</button>
    </form>
</div>
@endsection
