<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\SavingHistory;
use App\Models\Saving;

class MutationController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('nama', 'asc')->get();

        return view('mutations.index', ['members' => $members]);
    }

    public function check_mutations()
    {
        $anggota_id = Input::get('anggota_id');
        $savings_history = SavingHistory::whereAnggotaId($anggota_id)->orderBy('id', 'asc')->get();
        $total_credit = SavingHistory::whereAnggotaId($anggota_id)->sum('kredit');
        $total_debet = SavingHistory::whereAnggotaId($anggota_id)->sum('debet');
        $balance = Saving::whereAnggotaId($anggota_id)->first();

        $view = view('mutations.check_mutations', compact('savings_history', 'balance', 'total_credit', 'total_debet'))->render();

        return response()->json([
            'html'=> $view,
        ]);
    }
}
