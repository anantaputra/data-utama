@extends('layouts.app')

@section('content')
<div class="container py-4">
    <input class="form-control mb-4" type="search" placeholder="Search" aria-label="Search">

    <a href="{{ route('product.add') }}" class="w-100 btn btn-primary mb-4">Add Product</a>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
        @foreach ($products as $product)
        <div class="col">
          <div class="card shadow-sm">
            <a href="{{ route('product.view', ['id' => $product->id]) }}" style="text-decoration: none; color: black">
              <div class="card-body">
                  <h4>{{ $product->name }}</h4>
                  <p class="card-text">${{ number_format($product->price,0,0,'.') }}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="{{ route('product.view', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-secondary">View</a>
                      <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                      <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-secondary">Delete</a>
                    </div>
                    <small class="text-body-secondary">{{ $product->stock }} available</small>
                  </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {!! $products->links() !!}
    </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('input[type=search]').on('keyup', function() {
      var searchValue = $(this).val();
      search(searchValue)
    })
  })

  function search(search)
  {
      $.ajax({
        type: 'POST',
        url: '{{ route("product.search") }}',
        data: {
          _token: '{{ csrf_token() }}',
          search: search
        },
        success: function(response) {
          var element = ``
          $.each(response.data, function(index, value) {
            element += `<div class="col">
                          <div class="card shadow-sm">
                            <a href="/product/view/${value.id}" style="text-decoration: none; color: black">
                              <div class="card-body">
                                  <h4>${value.name}</h4>
                                  <p class="card-text">$${value.price}</p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                      <a href="/product/view/${value.id}" class="btn btn-sm btn-outline-secondary">View</a>
                                      <a href="/product/edit/${value.id}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                      <a href="/product/delete/${value.id}" class="btn btn-sm btn-outline-secondary">Delete</a>
                                    </div>
                                    <small class="text-body-secondary">${value.stock} available</small>
                                  </div>
                              </div>
                            </a>
                          </div>
                        </div>`
          })
          $('.row').html(``)
          $('.row').html(element)
        }
      })
  }
</script>
@endsection