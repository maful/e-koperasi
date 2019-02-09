<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreMember;
use App\Http\Requests\UpdateMember;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMember $request)
    {
        $member = new Member;
        $member->nik = $request->nik;
        $member->nama = $request->nama;
        $member->email = $request->email;
        $member->no_hp = $request->no_hp;
        $member->jenkel = $request->jenkel;
        $member->agama = $request->agama;
        $member->pekerjaan = $request->pekerjaan;
        $member->tempat_lahir = $request->tempat_lahir;
        $member->tanggal_lahir = $request->tanggal_lahir;
        $member->alamat = $request->alamat;
        $member->save();

        return redirect('members')->with('success', 'Data Anggota berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('members.show', ['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', ['member' => $member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMember $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->nik = $request->nik;
        $member->nama = $request->nama;
        $member->email = $request->email;
        $member->no_hp = $request->no_hp;
        $member->jenkel = $request->jenkel;
        $member->agama = $request->agama;
        $member->pekerjaan = $request->pekerjaan;
        $member->tempat_lahir = $request->tempat_lahir;
        $member->tanggal_lahir = $request->tanggal_lahir;
        $member->alamat = $request->alamat;
        $member->save();

        return redirect('members')->with('success', 'Data Anggota berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect('members')->with('success', 'Data Anggota berhasil dihapus.');
    }

    public function jsonMembers()
    {
        $members = Member::orderBy('id', 'desc')->get();
        return DataTables::of($members)
            ->addIndexColumn()
            ->addColumn('action', function($member) {
                return view('members.datatables.action', compact('member'))->render();
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
}
