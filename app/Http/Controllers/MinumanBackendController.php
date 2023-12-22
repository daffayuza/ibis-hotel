<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minuman;

class MinumanBackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minuman = Minuman::latest()->paginate(5);
        return view('backend.minuman.index',['minumans'=>$minuman]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.minuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'nama_minuman' => 'required',
            'harga' => 'required',
        ]);

        minuman::create($validateData);
        return redirect('/minuman-backend')->with('pesan','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.minuman.edit',['minuman'=>Minuman::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData=$request->validate([
            'nama_minuman'=>'required',
            'harga' => 'required',
        ]);

        Minuman::where('id',$id)->update($validateData);
        return redirect('/minuman-backend')->with('pesan','Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Minuman::destroy($id);
        return redirect('/minuman-backend')->with('pesanHapus','Data Berhasil dihapus');
    }
}
