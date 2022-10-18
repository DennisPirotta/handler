@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
    {{-- <x-toast :message="'Hello world! This is a toast message.'" :icon="'fa-info-circle'"></x-toast> --}}
    <div class="container bg-dark p-4 mb-2">
        <div class="row">
            <div class="col-2 d-flex justify-content-start">
                <a href="javascript:history.back()">
                    <i class="bi bi-arrow-left text-white"></i>
                </a>
            </div>
            <div class="col-8 d-flex justify-content-center text-white">Dettagli</div>
            <div class="col-2"></div>
        </div>
    </div>
    <div class="container shadow-sm p-3 bg-dark">
        <h4 class="mt-4 mb-3 text-opacity-50 text-white">
            {{ $transaction->customer->name }}
        </h4>
        <h3 class="text-white mb-3">{{$transaction->type === 0 ? '+' : '-'}} {{ $transaction->price }} <i
                    class="bi bi-currency-euro"></i></h3>
        <div class="card bg-darker">
            <ul class="list-group">
                <li class="list-group-item p-3 text-white bg-darker">
                    <span class="text-secondary">Data</span>
                    <span class="float-end">{{ Carbon::parse($transaction->date)->translatedFormat('d F Y, H:i') }}</span>
                </li>
                <li class="list-group-item p-3 text-white bg-darker">
                    <span class="text-secondary">Stato</span>
                    <span class="float-end">{{ $transaction->payed === 1 ? 'Pagata' : 'Non Pagata' }}</span>
                </li>
                <li class="list-group-item p-3 text-white bg-darker">
                    <span class="text-secondary">Note</span>
                    <span class="float-end">{{ $transaction->note ?? '//'}}</span>
                </li>
            </ul>
        </div>
        <div class="d-flex">
            <button class="btn btn-black disabled mt-4 rounded-5 text-white bg-darker me-2"><i class="bi bi-pen fs-4"></i></button>
            <form action="{{ route('transactions.destroy',$transaction->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-black mt-4 rounded-5 text-white bg-darker me-2" onclick="return confirm('Eliminare la transazione?')"><i class="bi bi-trash fs-4"></i></button>
            </form>

            @if(!$transaction->payed)
                <form action="{{ route('transactions.payed',$transaction->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-black mt-4 rounded-5 text-white bg-darker" onclick="return confirm('La transazione è stata pagata?')"><i class="bi bi-check2-all fs-4"></i></button>
                </form>
            @endif
        </div>
    </div>
@endsection

