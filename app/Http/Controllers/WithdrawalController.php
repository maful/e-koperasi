<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Saving;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\SavingHistory;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreWithdrawal;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('withdrawals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::orderBy('nama', 'asc')->get();

        return view('withdrawals.create', ['members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWithdrawal $request)
    {
        // Balance check
        // if the withdrawal amount is greater than the balance
        // cancel the withdrawal process
        $balance_check = Saving::whereAnggotaId($request->anggota)->first();
        if ($balance_check) {
            if ($request->jumlah > $balance_check->saldo) {
                return redirect()->route('withdrawals.create')->with('message', 'Saldo tidak mencukupi !');
            }
        } else {
            return redirect()->route('withdrawals.create')->with('message', 'Saldo tidak mencukupi !');
        }

        DB::transaction(function () use ($request) {

            // Insert into withdrawal
            $withdrawal = new Withdrawal;
            $withdrawal->anggota_id = $request->anggota;
            $withdrawal->jumlah = $request->jumlah;
            $withdrawal->keterangan = $request->keterangan;
            $withdrawal->save();

            // Reduce savings balance
            $saving = Saving::whereAnggotaId($request->anggota)->first();
            $saving->saldo = ($saving->saldo - $request->jumlah);
            $saving->save();

            // Insert into history saving
            $latest_saving = Saving::whereAnggotaId($request->anggota)->first();

            $saving_history = new SavingHistory;
            $saving_history->anggota_id = $request->anggota;
            $saving_history->tanggal = \Carbon\Carbon::today()->toDateString();
            $saving_history->keterangan = 'penarikan';
            $saving_history->debet = $request->jumlah;
            $saving_history->saldo = $latest_saving->saldo;
            $saving_history->save();

        });

        return redirect()->route('withdrawals.index')->with('success', 'Data Withdrawal berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        return view('withdrawals.show', ['withdrawal' => $withdrawal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }

    public function jsonWithdrawals()
    {
        $withdrawals = Withdrawal::orderBy('id', 'desc')->get();
        return DataTables::of($withdrawals)
            ->addIndexColumn()
            ->addColumn('action', function($withdrawal) {
                return view('withdrawals.datatables.action', compact('withdrawal'))->render();
            })
            ->addColumn('anggota', function($withdrawal) {
                return $withdrawal->member->nama;
            })
            ->addColumn('tanggal', function($withdrawal) {
                return $withdrawal->created_at->format('d F Y H:i');
            })
            ->editColumn('jumlah', function($withdrawal) {
                return format_rupiah($withdrawal->jumlah);
            })
            ->editColumn('biaya_administrasi', function($withdrawal) {
                return $withdrawal->biaya_administrasi == "" ? "-" : format_rupiah($withdrawal->biaya_administrasi);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
