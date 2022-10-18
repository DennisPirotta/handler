<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(): Factory|View|Application
    {

        $transactions = Transaction::with('customer')->filter(request(['customer','payed']))->get();
        $sorted = $transactions->groupBy(function($item){ return Carbon::parse($item->date)->format('d-M-Y'); })->sortKeysUsing(static function ($a,$b){
            $ta = Carbon::parse($a)->timestamp;
            $tb = Carbon::parse($b)->timestamp;
            return $tb - $ta;
        });
        return view('transactions.index',[
            'users' => User::all(),
            'transactionsByDate' => $sorted,
            'customers' => Customer::all()
        ]);
    }

    public function show(Transaction $transaction): Factory|View|Application
    {
        return view('transactions.show',[
            'transaction' => $transaction
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $payed = false;
        $data = $request->validate([
            'customer_id' => ['required','numeric'],
            'price' => ['required','numeric'],
            'type' => 'required',
            'date' => 'required'
        ]);
        if ($request['payed'] === '1'){
            $payed = true;
        }

        Transaction::create(array_merge($data,[
            'user_id' => auth()->id(),
            'payed' => (int)$payed
        ]));
        return back();
    }

    public function update(Transaction $transaction,Request $request): RedirectResponse
    {
        $payed = false;
        $data = $request->validate([
            'customer_id' => ['required','numeric'],
            'price' => ['required','numeric'],
            'type' => 'required',
            'date' => 'required'
        ]);
        if (isset($request['payed'])){
            $payed = true;
        }
        $transaction->update(array_merge($data,['payed' => $payed]));
        return back();
    }


    public function payed(Transaction $transaction): RedirectResponse
    {
        $transaction->update([
            'payed' => true
        ]);
        return back();
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect('/transactions');
    }

}
