@extends('layouts.app')

@section('content')
<div class="container py-4">
    <input class="form-control mb-4" type="search" placeholder="Search" aria-label="Search">

    <div class="row row-cols-1 g-3 mb-4">
        @foreach ($transactions as $transaction)
        <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
                <h4>{{ $transaction->reference_no }}</h4>
                <p>product: {{ $transaction->product_id }} / {{ $transaction->product->name }}</p>
                <p>product price: ${{ $transaction->price }}</p>
                <p>product quantity: {{ $transaction->quantity }}</p>
                <p>product payment Amount: ${{ $transaction->payment_amount }}</p>
            </div>
          </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {!! $transactions->links() !!}
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
        url: '{{ route("transaction.search") }}',
        data: {
          _token: '{{ csrf_token() }}',
          search: search
        },
        success: function(response) {
          var element = ``
          $.each(response.data, function(index, value) {
            element += `<div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h4>${value.reference_no}</h4>
                                    <p>product: ${value.product_id}</p>
                                    <p>product price: ${value.price}</p>
                                    <p>product quantity: ${value.quantity}</p>
                                    <p>product payment Amount: ${value.payment_amount}</p>
                                </div>
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