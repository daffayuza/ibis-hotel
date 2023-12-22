<?php

namespace App\Http\Controllers;
use App\Models\Kamar;
use App\Models\Pelanggan;
use App\Models\Makanan;
use App\Models\Minuman;


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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $kamars = Kamar::latest()->paginate(3);
        $pelanggans = Pelanggan::latest()->paginate(3);
        $makanans = Makanan::latest()->paginate(3);
        $minumans = Minuman::latest()->paginate(3);
        return view('dashboard',['pelanggans'=>$pelanggans, 'kamars' => $kamars, 'makanans'=> $makanans, 'minumans'=> $minumans]); 
    }
}
