<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('welcome');
    }

    public function cyber()
    {
        $computers = Computer::orderBy('number', 'asc')->paginate('5');
        $checkinput = DB::table('cybercontrols')->where('user_id', Auth::user()->id)->where('status', 1)->first();
        // \dd($checkinput);
        return view('cyber.index', compact('computers', 'checkinput'));
    }

    public function select(Computer $computer)
    {
        return view('cyber.select', compact('computer'));
    }
}
