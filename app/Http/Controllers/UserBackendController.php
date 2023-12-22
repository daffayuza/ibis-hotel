<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class UserBackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('backend.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('backend.user.create',['pelanggans'=>$pelanggans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'pelanggan_id' => 'required'
        ]);

        $pelanggan = Pelanggan::find($validateData['pelanggan_id']);

        if ($pelanggan) {
            $validateData['name'] = $pelanggan->nama_pelanggan;
            $validateData['password'] = Hash::make($validateData['password']);
            User::create($validateData);
            return redirect('/user-backend')->with('pesan', 'Data Berhasil disimpan');
        } else {
            // Handle jika pelanggan_id tidak ditemukan
            // Misalnya, tampilkan pesan error atau redirect ke halaman lain
        }
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
        $users = User::find($id);
        $pelanggans = Pelanggan::all();
        return view('backend.user.edit',['users'=>$users,'pelanggans'=>$pelanggans]);
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
    $validateData = $request->validate([
        'pelanggan_id' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $pelanggan = Pelanggan::find($validateData['pelanggan_id']);
    if ($pelanggan) {
        $user = User::find($id);
        if ($user) {
            $user->name = $pelanggan->nama_pelanggan;
            $user->email = $validateData['email'];
            $user->password = Hash::make($validateData['password']);
            $user->save();

            return redirect('/user-backend')->with('pesan', 'Data Berhasil diupdate');
        } else {
            // Handle jika user tidak ditemukan
            // Misalnya, tampilkan pesan error atau redirect ke halaman lain
        }
    } else {
        // Handle jika pelanggan tidak ditemukan
        // Misalnya, tampilkan pesan error atau redirect ke halaman lain
    }
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/user-backend')->with('pesanHapus','Data Berhasil dihapus');
    }
}
