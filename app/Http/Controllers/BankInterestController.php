<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Saving;
use App\Models\BankInterest;
use Illuminate\Http\Request;
use App\Models\SavingHistory;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BankInterestController extends Controller
{
    public function index()
    {
        return view('bankinterests.index');
    }

    public function calculate($member_id)
    {
        $member = Member::findOrFail($member_id);

        return view('bankinterests.calculate', compact('member'));
    }

    public function check_interest()
    {
        $interest_rate = 6;
        $anggota_id = Input::get('anggota_id');
        $month = Input::get('month');
        $year = Input::get('year');
        $periode = month_id($month) . ' ' . $year;

        // validation of months and years
        $time_now = \Carbon\Carbon::createFromDate(date("Y"), date("m"));
        $time_input = \Carbon\Carbon::createFromDate($year, $month);
        $greater_than_periode = false;
        if ($time_input->greaterThan($time_now)) {
            $greater_than_periode = true;
        }

        // check whether the savings interest has been added
        $count_interest = BankInterest::whereAnggotaId($anggota_id)
                                        ->where('bulan', $month)
                                        ->where('tahun', $year)
                                        ->count();

        $lowest_balance = SavingHistory::whereAnggotaId($anggota_id)
                                        ->whereMonth('tanggal', $month)
                                        ->whereYear('tanggal', $year)
                                        ->min('saldo');
        $days_in_month = \Carbon\Carbon::createFromDate($year, $month)->daysInMonth;
        $day_of_year = \Carbon\Carbon::createFromDate($year)->format('L') + 365;
        $calculate_interest = ($lowest_balance*($interest_rate/100)*$days_in_month)/$day_of_year;
        $format_calculate_interest = number_format($calculate_interest, 0, '', '');

        $view = view('bankinterests.check_interest', compact('anggota_id', 'interest_rate', 'format_calculate_interest', 'lowest_balance', 'periode', 'count_interest', 'greater_than_periode', 'month', 'year'))->render();

        return response()->json([
            'html'=> $view,
        ]);
    }

    public function store(Request $request)
    {
        $status = false;

        try {
            DB::beginTransaction();
            // Insert into bank interest
            $interest = new BankInterest;
            $interest->anggota_id = $request->anggota_id;
            $interest->bulan = $request->month;
            $interest->tahun = $request->year;
            $interest->saldo_terendah = $request->lowest_balance;
            $interest->suku_bunga = $request->interest_rate;
            $interest->nominal_bunga = $request->calculate_interest;
            $interest->save();

            // Add to balance
            $saving = Saving::whereAnggotaId($request->anggota_id)->first();
            $saving->saldo = ($saving->saldo + $request->calculate_interest);
            $saving->save();

            // Insert into history saving
            $latest_saving = Saving::whereAnggotaId($request->anggota_id)->first();

            $saving_history = new SavingHistory;
            $saving_history->anggota_id = $request->anggota_id;
            $saving_history->tanggal = \Carbon\Carbon::today()->toDateString();
            $saving_history->keterangan = 'bunga';
            $saving_history->kredit = $request->calculate_interest;
            $saving_history->saldo = $latest_saving->saldo;
            $saving_history->save();

            DB::commit();
            $status = true;
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return response()->json([
            'status' => $status,
            'url' => url("/bankinterests/calculate/" . $request->anggota_id),
        ]);
    }

    public function jsonMembers()
    {
        $members = Member::orderBy('id', 'desc')->get();
        return DataTables::of($members)
            ->addIndexColumn()
            ->addColumn('action', function($member) {
                return view('bankinterests.datatables.action', compact('member'))->render();
            })
            ->addColumn('saldo', function($member) {
                if ($member->balance) {
                    return format_rupiah($member->balance->saldo);
                } else {
                    return '0';
                }
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function jsonHistoryInterests($id)
    {
        $interests = BankInterest::where('anggota_id', $id)->orderBy('id', 'desc')->get();
        return DataTables::of($interests)
            ->addIndexColumn()
            ->addColumn('periode', function($interest) {
                return month_id($interest->bulan) . ' ' . $interest->tahun;
            })
            ->editColumn('nominal_bunga', function($interest) {
                return format_rupiah($interest->nominal_bunga);
            })
            ->editColumn('saldo_terendah', function($interest) {
                return format_rupiah($interest->saldo_terendah);
            })
            ->toJson();
    }
}
