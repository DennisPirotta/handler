@extends('layouts.app')
@section('content')
    <div class="container shadow-sm p-5 bg-dark justify-content-center text-center">
        <img class="mb-2" width="64" src="{{ asset('/images/avatar/bag.png') }}" alt="Avatar">
        <h2 class="text-white mb-4 text-center">{{ $customer->name }}</h2>

        <div class="mb-4 d-flex justify-content-center">
            <button class="btn btn-dark bg-darker ms-0 me-2" data-mdb-toggle="modal" data-mdb-target="#modify"><i
                        class="bi bi-pen fs-6"></i></button>

            <form action="{{ route('customers.destroy',$customer->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-dark bg-darker ms-0" onclick="return confirm('Conferma eliminazione utente [ {{ $customer->name }} ]')"><i
                            class="bi bi-trash3 fs-6"></i></button>
            </form>
        </div>

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
                @foreach($customer->transactions->take(5) as $transaction)
                    <li class="list-group-item p-3 text-white bg-darker">
                        <x-transaction-card :transaction="$transaction" :islist="true"></x-transaction-card>
                    </li>
                @endforeach
                <li class="list-group-item p-2 text-white text-center bg-darker">
                    <a class="text-primary fw-bold"
                       href="{{ route('transactions.index') }}?customer={{ $customer->id }}">Vedi Tutti</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="modal fade" id="modify" tabindex="-1" aria-labelledby="modifyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-darker">
                    <h5 class="modal-title text-white" id="modifyLabel">Modifica</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customers.update',$customer->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-outline form-white">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $customer->name }}"/>
                            <label class="form-label" for="name">Nome</label>
                        </div>
                    </div>
                    <div class="modal-footer border-darker">
                        <button type="submit" class="btn btn-dark bg-darker">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection