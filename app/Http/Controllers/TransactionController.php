<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paginate(5);

        return view('pages.transaction', compact('transactions'));
    }

    public function search(Request $request)
    {
        $transactions = Transaction::where('reference_no', 'LIKE', '%' . $request->search . '%')->paginate(20);

        return response()->json($transactions);
    }

    public function reference($qty, $price, $amount)
    {
        $client = new Client();
        $response = $client->post('http://tes-skill.datautama.com/test-skill/api/v1/transactions', [
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => 'DATAUTAMA',
                'X-SIGNATURE' => Hash('sha256', 'POST:DATAUTAMA')
            ],
            'form_params' => [
                'quantity' => $qty,
                'price' => $price,
                'payment_amount' => $amount
            ]
        ]);

        $reference = json_decode($response->getbody())->data->reference_no;

        return $reference;
    }

    public function transaction(Request $request)
    {
        $product = Product::find($request->id);

        $quantity = $request->quantity;
        $price = $product->price;
        $amount = $quantity * $price;

        $reference = $this->reference($quantity, $price, $amount);

        $transaction = new Transaction();
        $transaction->product_id = $request->id;
        $transaction->reference_no = $reference;
        $transaction->price = $price;
        $transaction->quantity = $quantity;
        $transaction->payment_amount = $amount;
        $transaction->save();

        return response()->json([
            'code' => 200,
            'status' => 'ok'
        ], 200);
    }
}
