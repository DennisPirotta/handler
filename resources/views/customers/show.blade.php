@php
    use App\Models\Transaction;
    use Carbon\Carbon;
    $transactions = Transaction::latest()->where('customer_id',$customer->id)->where('user_id',auth()->id())->take(5)->get();
    $debit = 0;
    foreach ($transactions as $transaction) {
        if ($transaction->payed){
            $debit += $transaction->price;
        }
    }
@endphp
@extends('layouts.app')
@section('content')
    <div class="container shadow-sm p-5 bg-dark justify-content-center text-center">
        <img class="mb-2" width="64" src="{{ asset('/images/icons/bag.png') }}" alt="Avatar">
        <h2 class="text-white mb-4 text-center">{{ $customer->name }}</h2>

        <div class="card text-white text-start bg-darker">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-wallet2 text-success me-2 fs-3"></i>
                Debito
                <span class="ms-auto">
                    {{ $debit }} <i class="bi bi-currency-euro"></i>
                </span>
            </div>
        </div>

        <h6 class="mt-4 mb-2 text-opacity-25 text-white text-start">
            Transazioni recenti
        </h6>
        <div class="card text-start bg-darker">
            <ul class="list-group">
                @foreach($transactions as $transaction)
                    <li class="list-group-item p-3 text-white bg-darker">
                        <x-transaction-card :transaction="$transaction" :islist="true"></x-transaction-card>
                    </li>
                @endforeach
                <li class="list-group-item p-2 text-white text-center bg-darker">
                    <a class="text-primary fw-bold" href="{{ route('transactions.index') }}?customer={{ $customer->id }}">Vedi Tutti</a>
                </li>
            </ul>
        </div>
    </div>
@endsection