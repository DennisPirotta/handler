<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('customers.index', [
            'customers' => Customer::where('created_by', auth()->id())->get()
        ]);
    }

    public function show(Customer $customer): Factory|View|Application
    {
        $debit = 0;
        foreach ($customer->transactions as $transaction){
            if (!$transaction->payed) {
                $debit += $transaction->price;
            }
        }
        return view('customers.show', [
            'customer' => $customer->load('transactions'),
            'debit' => $debit
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $data['created_by'] = auth()->id();
        Customer::create($data);
        return back();
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $customer->update($data);
        return back();
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect(route('customers.index'));
    }
}
