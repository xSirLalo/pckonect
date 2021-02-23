<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\CyberControl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CyberControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computers = Computer::orderBy('number', 'asc')->paginate('5');
        $checkstatus = DB::table('cybercontrols')->where('user_id', Auth::user()->id)->where('status', 1)->first();
        // \dd($checkinput);
        return view('cyber.index', compact('computers', 'checkstatus'));
    }

    public function store(Request $request)
    {
        $search = DB::table('cybercontrols')->where('user_id', $request->user_id)->where('status', 1)->first();
        $checkcontrol = DB::table('computers')->where('id', $request->computer_id)->where('control', 1)->first();
        if (!$search) {
            if ($checkcontrol) { // Checar si la computadora esta ocupada
                return redirect(route("cyber.index"))->with('danger', 'Computadora ocupada!');
            }else{
                // Registra inicio en bitácora
                CyberControl::create([
                    'user_id' => $request->user_id,
                    'computer_id' => $request->computer_id,
                    'status' => 1,
                // Inicia control computadora
                DB::table('computers')
                        ->where('id', $request->computer_id)
                        ->where('control', 0)
                        ->update(['control' => 1])
                ]);
                $socketCGI = config('app.perl_url').'?pc='.$request->number_computer.'&acc=1';
                // \dd($socketCGI);
                return redirect($socketCGI)->with('success', 'Welcome to the Black Mesa');
                // return redirect(route("cyber.index"))->with('success', 'Welcome to the Black Mesa');
            }
        }else{
        // Registra fin en bitácora
        DB::table('cybercontrols')
                ->where('user_id', $request->user_id)
                ->where('status', 1)
                ->update([
                    'status' => 2,
                    'updated_at' => Carbon::now()
                    ]);
        // Finaliza control computadora
        DB::table('computers')
                ->where('id', $request->computer_id)
                ->where('control', 1)
                ->update(['control' => 0]);
        $socketCGI = config('app.perl_url').'?pc='.$request->number_computer.'&acc=0';
        // \dd($socketCGI);
        return redirect($socketCGI)->with('success', 'Goodbye!');
        // return redirect(route("cyber.index"))->with('success', 'Goodbye!');
        }
    }

    public function select(Computer $computer)
    {
        return view('cyber.select', compact('computer'));
    }

    public function bitacora()
    {
        $cybercontrols = CyberControl::orderBy('id', 'desc')->paginate('5');
        return view('admin.bitacora.index', compact('cybercontrols'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CyberControl  $cyberControl
     * @return \Illuminate\Http\Response
     */
    public function show(CyberControl $cyberControl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CyberControl  $cyberControl
     * @return \Illuminate\Http\Response
     */
    public function edit(CyberControl $cyberControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CyberControl  $cyberControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CyberControl $cyberControl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CyberControl  $cyberControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(CyberControl $cyberControl)
    {
        //
    }
}
