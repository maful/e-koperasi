<?php

namespace App\Http\Controllers;

use App\Models\SavingHistory;
use Illuminate\Support\Facades\App;

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

    public function lang($locale)
    {
        App::setLocale($locale);
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
