@extends('layouts.app')
@section('content')
    <div class="container p-3 bg-dark">
        <div class="accordion accordion-borderless" id="accordionFlushExampleX">
            <div class="accordion-item bg-darker">
                <h2 class="accordion-header" id="flush-headingOneX">
                    <button class="accordion-button text-white collapsed bg-darker" type="button" data-mdb-toggle="collapse"
                            data-mdb-target="#flush-collapseOneX" aria-expanded="false"
                            aria-controls="flush-collapseOneX"
                    >
                        <i class="bi bi-plus-circle me-2"></i>
                        Aggiungi cliente
                    </button>
                </h2>
                <div id="flush-collapseOneX" class="accordion-collapse collapse"
                     aria-labelledby="flush-headingOneX" data-mdb-parent="#accordionFlushExampleX">
                    <div class="accordion-body">
                        <form action="{{ route('customers.store') }}" method="post">
                            @csrf
                            <div class="form-outline mb-3">
                                <input type="text" id="name" name="name" class="form-control bg-dark text-white" />
                                <label class="form-label text-white" for="name">Nome</label>
                            </div>
                            <button type="submit" class="btn text-white bg-dark w-100">Salva</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3 mb-2 justify-content-center">
            <button class="btn btn-dark me-3 bg-darker" onclick="sortBy('desc')"><i class="bi bi-arrow-down"></i></button>
            <button class="btn btn-dark bg-darker" onclick="sortBy('asc')"><i class="bi bi-arrow-up"></i></button>
        </div>
        <div id="customer-cards-container">
            @unless($customers->isNotEmpty())
                <div class="mt-4 mb-2 text-opacity-25 text-white text-center">
                    <div class="card text-white bg-darker">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-info-circle text-primary fs-5 me-2"></i>
                            <p class="m-0">Nessun cliente trovato</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-3">
                    @foreach($customers->reverse() as $customer)
                        <x-customer-card :customer="$customer"></x-customer-card>
                    @endforeach
                </div>

            @endunless
        </div>

    </div>
    <script>
        function sortBy(method = 'desc'){
            let customers = $('.customer-card')
            if (method === 'desc'){
                customers.sort((a,b)=>{
                    return parseInt($(b).find('.debit').text()) - parseInt($(a).find('.debit').text())
                }).appendTo($('#customer-cards-container'))
            }
            else if (method === 'asc'){
                customers.sort((a,b)=>{
                    return parseInt($(a).find('.debit').text()) - parseInt($(b).find('.debit').text())
                }).appendTo($('#customer-cards-container'))
            }
            else console.log(`Sort method not allowed [${method}]`)
        }
        $(()=>{
            sortBy('desc')
        })
    </script>
@endsection
