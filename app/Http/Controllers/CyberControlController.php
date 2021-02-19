<?php

namespace App\Http\Controllers;

use App\Models\CyberControl;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        //
    }
    public function store(Request $request)
    {
        $search = DB::table('cybercontrols')->where('user_id', $request->user_id)->where('status', 1)->first();
        $checkpc = DB::table('computers')->where('number', $request->number_computer)->where('control', 1)->first();
        if (!$search) {
            if ($checkpc) { // Checar si la computadora esta ocupada
                return redirect(route("cyber"))->with('danger', 'Computadora ocupada!');
            }else{
                // Registra inicio en bitácora
                CyberControl::create([
                    'user_id' => $request->user_id,
                    'number_computer' => $request->number_computer,
                    'status' => 1,
                // Inicia control computadora
                DB::table('computers')
                        ->where('number', $request->number_computer)
                        ->where('control', 0)
                        ->update(['control' => 1])
                ]);
                return redirect(route("cyber"))->with('success', 'Welcome to the Black Mesa');
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
                ->where('number', $request->number_computer)
                ->where('control', 1)
                ->update(['control' => 0]);
        return redirect(route("cyber"))->with('success', 'Goodbye!');
        }
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
