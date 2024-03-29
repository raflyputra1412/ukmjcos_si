<?php

namespace App\Http\Controllers\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertemuan;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertemuan = Pertemuan::all();
        return view('pengurus.absensi_pertemuan.index', [
            'title' => 'Absensi & Pertemuan',
            'active' => 'absensi',
            'pertemuans' => $pertemuan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengurus.absensi_pertemuan.create', [
            'title' => 'Add Pertemuan',
            'active' => 'absensi',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'pekan' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'nama_kegiatan' => 'required',
        ];

        $validatedData = $request->validate($rules);
        Pertemuan::create($validatedData);

        $newPertemuan = Pertemuan::orderBy('id', 'DESC')->first();
        
        return redirect()->route('form.absensi', ['pertemuan'=> $newPertemuan->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pengurus.absensi_pertemuan.edit', [
            'title' => 'Edit Pertemuan',
            'active' => 'pertemuan',
            'pertemuans' => Pertemuan::where('id', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pertemuan $pertemuan ,$id)
    {
        $rules = [
            'pekan' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'nama_kegiatan' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $pertemuan::find($id)->update($validatedData);

        return redirect('/absensi')->with('success', 'Jadwal Berhasil di Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
