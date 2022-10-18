@php use Carbon\Carbon; @endphp
@if($islist ?? null)
    <div class="d-flex align-items-center">
        @if($transaction->payed)
            <i class="bi bi-check-circle text-success fs-5 me-2"></i>
        @else
            <i class="bi bi-exclamation-triangle text-danger fs-5 me-2"></i>
        @endif
        <div class="row ps-1">
            <div class="col-12">{{ $transaction->customer->name }}</div>
            <small class="col-12 text-secondary"
                   style="font-size: 0.8rem">{{ Carbon::parse($transaction->date)->format('H:i') }}</small>
        </div>
        <div class="ms-auto float-end text-{{$transaction->type === 0 ? 'success' : 'danger'}}">
            {{$transaction->type === 0 ? '+' : '-' }} {{ $transaction->price}} <i class="bi bi-currency-euro"></i>
        </div>
    </div>

@else
    <div class="card text-white bg-darker">
        <div class="card-body d-flex align-items-center">
            @if($transaction->payed)
                <i class="bi bi-check-circle text-success fs-5 me-2"></i>
            @else
                <i class="bi bi-exclamation-triangle text-danger fs-5 me-2"></i>
            @endif
            <div class="row ps-1">
                <div class="col-12">{{ $transaction->customer->name }}</div>
                <small class="col-12 text-secondary"
                       style="font-size: 0.8rem">{{ Carbon::parse($transaction->date)->format('H:i') }}</small>
            </div>
            <div class="ms-auto float-end text-{{$transaction->type === 0 ? 'success' : 'danger'}}">
                {{$transaction->type === 0 ? '+' : '-'}} {{ $transaction->price}} <i class="bi bi-currency-euro"></i>
            </div>
        </div>
    </div>
@endif
