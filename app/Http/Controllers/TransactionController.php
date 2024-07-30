<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Auth;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

                // Transformasi data untuk menambahkan informasi aula
                $transactions->transform(function ($transaction) {
                    $transaction->product = $transaction->aula; // Menambahkan informasi aula sebagai product
                    return $transaction;
                });
        // return $transactions;

        return view('guest.transaction', compact('transactions'));
    }
}
