<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Saving;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDeposit;
use App\Models\SavingHistory;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deposits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::orderBy('nama', 'asc')->get();

        return view('deposits.create', ['members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeposit $request)
    {
        DB::transaction(function () use ($request) {
            // Insert into deposit
            $deposit = new Deposit;
            $deposit->anggota_id = $request->anggota;
            $deposit->jumlah = $request->jumlah;
            $deposit->keterangan = $request->keterangan;
            $deposit->save();

            // Create or Update Saving
            $check_balance = Saving::whereAnggotaId($request->anggota)->first();
            if ($check_balance) {
                $balance = Saving::whereAnggotaId($request->anggota)->first();
                $balance->saldo = ($balance->saldo + $request->jumlah);
                $balance->save();
            } else {
                $balance = new Saving;
                $balance->anggota_id = $request->anggota;
                $balance->saldo = $request->jumlah;
                $balance->save();
            }

            // Insert into history saving
            $last_balance = Saving::whereAnggotaId($request->anggota)->first();

            $saving_history = new SavingHistory;
            $saving_history->anggota_id = $request->anggota;
            $saving_history->tanggal = \Carbon\Carbon::today()->toDateString();
            $saving_history->keterangan = 'setoran';
            $saving_history->kredit = $request->jumlah;
            $saving_history->saldo = $last_balance->saldo;
            $saving_history->save();

        });

        return redirect()->route('deposits.index')->with('success', 'Data Setoran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deposit = Deposit::findOrFail($id);
        return view('deposits.show', ['deposit' => $deposit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }

    public function jsonDeposits()
    {
        $deposits = Deposit::orderBy('id', 'desc')->get();
        return DataTables::of($deposits)
            ->addIndexColumn()
            ->addColumn('action', function($deposit) {
                return view('deposits.datatables.action', compact('deposit'))->render();
            })
            ->addColumn('anggota', function($deposit) {
                return $deposit->member->nama;
            })
            ->addColumn('tanggal', function($deposit) {
                return $deposit->created_at->format('d F Y H:i');
            })
            ->addColumn('jumlah', function($deposit) {
                return format_rupiah($deposit->jumlah);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
