@php
    use Carbon\Carbon;
    use App\Models\Customer;
@endphp
@extends('layouts.app')
@section('content')
    @vite(['resources/sass/dropdown.scss','resources/js/dropdown.js'])
    {{-- <x-toast :message="'Hello world! This is a toast message.'" :icon="'fa-info-circle'"></x-toast> --}}
    <div class="container shadow-sm p-3 bg-dark">

        <div class="accordion accordion-borderless" id="accordionFlushExampleX">


            <div class="accordion-item bg-darker">
                <h2 class="accordion-header" id="flush-headingOneX">
                    <button class="accordion-button text-white collapsed bg-darker" type="button"
                            data-mdb-toggle="collapse"
                            data-mdb-target="#flush-collapseOneX" aria-expanded="false"
                            aria-controls="flush-collapseOneX">
                        <i class="bi bi-sliders me-2"></i>
                        Filtri
                    </button>
                </h2>
                <div id="flush-collapseOneX" class="accordion-collapse collapse"
                     aria-labelledby="flush-headingOneX" data-mdb-parent="#accordionFlushExampleX">
                    <div class="accordion-body">

                        <form id="filter" role="search" class="d-flex row">
                            <div class="col-12 mb-3">
                                <div class="dropdown w-100">
                                    <div class="select bg-dark text-white">
                                        <span id="customer-selected"
                                              data-customer-id="{{ request('customer') }}">{{Customer::find((int)request('customer'))->name ?? 'Seleziona un cliente'}}</span>
                                        <i class="fa fa-chevron-left"></i>
                                    </div>
                                    <input type="hidden" name="customer">
                                    <ul class="dropdown-menu bg-dark text-white" id="customer-dropdown">
                                        @foreach($customers as $customer)
                                            <li value="{{ $customer->id }}">{{ $customer->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 mb-3 d-flex justify-content-center text-white">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="payed" id="payed_all" value=""
                                           @if (request('payed') === null)
                                               checked
                                            @endif
                                    />
                                    <label class="form-check-label" for="payed_all">Tutto</label>
                                </div>

                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="payed" id="payed_true"
                                           value='1'
                                           @if(request('payed') === '1')
                                               checked
                                            @endif
                                    />
                                    <label class="form-check-label" for="payed_true">Pagato</label>
                                </div>

                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="payed" id="payed_false"
                                           value='0'
                                           @if(request('payed') === '0')
                                               checked
                                            @endif
                                    />
                                    <label class="form-check-label" for="payed_false">Non Pagato</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-dark w-100" onclick="loadCustomer()">Cerca</button>
                            </div>
                        </form>
                        @if(request('customer') !== null || request('payed') !== null)
                            <hr class="hr">
                            <a class="btn btn-dark w-100" href="{{ route('transactions.index') }}">Resetta filtri</a>
                        @endif
                    </div>
                </div>
            </div>


            <div class="accordion-item bg-darker">
                <h2 class="accordion-header" id="flush-headingTwoX">
                    <button class="accordion-button text-white collapsed bg-darker" type="button"
                            data-mdb-toggle="collapse"
                            data-mdb-target="#flush-collapseTwoX" aria-expanded="false"
                            aria-controls="flush-collapseTwoX"
                    >
                        <i class="bi bi-plus-circle me-2"></i>
                        Aggiungi
                    </button>
                </h2>
                <div id="flush-collapseTwoX" class="accordion-collapse collapse"
                     aria-labelledby="flush-headingTwoX" data-mdb-parent="#accordionFlushExample2X">
                    <div class="accordion-body">
                        <form id="add" action="{{ route('transactions.store') }}" class="d-flex row" method="post">
                            @csrf

                            <div class="col-12 mb-3">
                                <div class="dropdown w-100">
                                    <div class="select bg-dark text-white">
                                        <span>Seleziona il tipo</span>
                                        <i class="fa fa-chevron-left"></i>
                                    </div>
                                    <input type="hidden" name="type">
                                    <ul id="type-dropdown" class="dropdown-menu bg-dark text-white">
                                        <li value="0">Accredito</li>
                                        <li value="0">Addebito</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="dropdown w-100">
                                    <div class="select bg-dark text-white">
                                        <span>Seleziona un cliente</span>
                                        <i class="fa fa-chevron-left"></i>
                                    </div>
                                    <input type="hidden" name="customer_id">
                                    <ul id="new-customer-dropdown" class="dropdown-menu bg-dark text-white">
                                        @foreach($customers as $customer)
                                            <li value="{{ $customer->id }}">{{ $customer->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <input type="number" id="price" name="price" value=""
                                           class="form-control bg-dark text-white"/>
                                    <label class="form-label text-white" for="price">Price</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="w-100">
                                    <input type="datetime-local" name="date" class="form-control bg-dark text-white"
                                           value="{{ Carbon::parse('now')->format('Y-m-d H:i') }}"/>
                                </label>
                            </div>

                            <div class="col-12 mb-3 d-flex justify-content-center text-white">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="payed" id="payed_true"
                                           value='1'/>
                                    <label class="form-check-label" for="payed_true">Pagato</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payed" id="payed_false"
                                           value='0' checked/>
                                    <label class="form-check-label" for="payed_false">Non Pagato</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark w-100">Salva</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($transactionsByDate->count() > 0)
            @foreach($transactionsByDate as $key => $transactions)
                <h6 class="mt-4 mb-2 text-opacity-25 text-white">
                    {{ Carbon::parse($key)->translatedFormat('d F Y') }}
                </h6>
                @if($transactions->count() > 1)
                    <div class="card bg-dark">
                        <ul class="list-group">
                            @foreach($transactions->reverse() as $transaction)
                                <li class="list-group-item p-3 text-white bg-darker"
                                    onclick='window.location.href = `{{ route('transactions.show',$transaction->id) }}`'>
                                    <x-transaction-card :transaction="$transaction" :islist="true"></x-transaction-card>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    @foreach($transactions as $transaction)
                        <div onclick="window.location.href = `{{ route('transactions.show',$transaction->id) }}`">
                            <x-transaction-card :transaction="$transaction"></x-transaction-card>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @else
            <h6 class="mt-4 mb-2 text-opacity-25 text-white text-center">
                Nessuna transazione trovata
            </h6>
        @endunless
    </div>
    <script>

        function loadCustomer() {
            $('input[name=customer]').val($('#customer-selected').attr('data-customer-id'))
            $('#filter').submit()
        }

        $('#customer-dropdown li').click(function (e) {
            $('#customer-selected').attr('data-customer-id', $(e.target).val())
        });

        $('#new-customer-dropdown li').click(function (e) {
            $('input[name=customer_id]').val($(e.target).val())
        });

        $('#type-dropdown li').click(function (e) {
            $('input[name=type]').val($(e.target).val())
        });

        $('#cash').click((e) => $(e.target).blur())
        $('#eye').click((e) => {
            let target = $(e.target)
            let input = $('#cash')
            if (target.hasClass('bi-eye')) {
                target.removeClass('bi-eye')
                target.addClass('bi-eye-slash')
                input.attr('type', 'password')
            } else {
                target.addClass('bi-eye')
                target.removeClass('bi-eye-slash')
                input.attr('type', 'text')
            }
        })
    </script>
@endsection

