@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form id="transactionForm">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $product->name }}" disabled>
            <label for="name">Name</label>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="{{ $product->price }}" disabled>
            <label for="price">Price</label>
            @error('price')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Stock" value="{{ $product->stock }}" disabled>
            <label for="stock">Stock</label>
            @error('stock')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" id="description" style="height: 200px" disabled>{{ $product->description }}</textarea>
            <label for="description">Description</label>
            @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="Quantity" value="1" required>
            <label for="quantity">Quantity</label>
            @error('quantity')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="button" class="btn btn-primary w-100 py-2" onclick="submitTransaction()">Transaction</button>
    </form>
</div>
@endsection

@section('js')
<script>
    function submitTransaction() {
        $.ajax({
            type: 'POST',
            url: '/api/transaction',
            data: {
                id: $('input[name=id]').val(),
                quantity: $('input[name=quantity]').val()
            },
            success: function(response) {
                if(response.code == 200) {
                    alert('Transaction is success')
                }
            }
        })
    }
</script>
@endsection