<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavingHistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mutations = SavingHistory::whereDate('created_at', \Carbon\Carbon::today())
                                    ->take(5)
                                    ->latest()
                                    ->get();

        return view('home', compact('mutations'));
    }
}
