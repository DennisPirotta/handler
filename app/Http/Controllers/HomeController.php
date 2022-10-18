<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $cash = 0;
        foreach (Transaction::all()->where('user_id', auth()->id()) as $transaction) {
            if ($transaction->payed) {
                $cash += $transaction->price;
            }
        }
        return view('home', [
            'latest' => Transaction::with('user')->latest()->take(5)->get(),
            'cash' => $cash
        ]);
    }

    public function welcome(): Factory|View|Application
    {
        return view('welcome');
    }
}
