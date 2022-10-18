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
use Illuminate\Routing\Redirector;

class TransactionController extends Controller
{
    public function index(): Factory|View|Application
    {

        $transactions = Transaction::with('customer')->filter(request(['customer', 'payed']))->get();
        $sorted = $transactions->groupBy(function ($item) {
            return Carbon::parse($item->date)->format('d-M-Y');
        })->sortKeysUsing(static function ($a, $b) {
            $ta = Carbon::parse($a)->timestamp;
            $tb = Carbon::parse($b)->timestamp;
            return $tb - $ta;
        });
        return view('transactions.index', [
            'users' => User::all(),
            'transactionsByDate' => $sorted,
            'customers' => Customer::all()
        ]);
    }

    public function show(Transaction $transaction): Factory|View|Application
    {
        return view('transactions.show', [
            'transaction' => $transaction
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_id' => 'numeric',
            'price' => ['required', 'numeric'],
            'type' => 'required',
            'date' => 'required'
        ]);
        if ($request['payed'] === '1') {
            $data['payed'] = true;
        }
        if (isset($request['note'])){
            $data['note'] = $request['note'];
        }
        $data['user_id'] = auth()->id();
        Transaction::create($data);
        return back();
    }

    public function payed(Transaction $transaction): RedirectResponse
    {
        $transaction->update([
            'payed' => true
        ]);
        return back();
    }

    public function update(Transaction $transaction, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_id' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'type' => 'required',
            'date' => 'required'
        ]);
        if (isset($request['payed'])) {
            $data['payed'] = true;
        }
        if (isset($request['note'])){
            $data['note'] = $request['note'];
        }
        $data['user_id'] = auth()->id();
        $transaction->update($data);
        return back();
    }

    public function destroy(Transaction $transaction): Redirector|Application|RedirectResponse
    {
        $transaction->delete();
        return redirect('/transactions');
    }

}
