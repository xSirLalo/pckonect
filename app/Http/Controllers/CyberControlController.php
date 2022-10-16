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
	public function index()
	{
		$computers = Computer::orderBy('id', 'asc')->paginate('5');
		$checkstatus = DB::table('cybercontrols')->where('user_id', Auth::user()->id)->where('status', 1)->first();

		return view('cyber.index', compact('computers', 'checkstatus'));
	}

	public function store(Request $request)
	{
		$checkcontrol = DB::table('computers')->where('id', $request->computer_id)->where('control', 0)->first();
		$checkstatus = DB::table('cybercontrols')->where('user_id', $request->user_id)->where('status', 1)->first();

		if ($checkcontrol) { // Checa control computadora
			if ($checkstatus) { // Checa en bitacora si esta siendo ocupada
				return redirect(route('cyber.index'))->with('error', 'Computadora ocupada1!');
			} else {
				// Registra inicio en bitácora
				CyberControl::create([
					'user_id' => $request->user_id,
					'computer_id' => $request->computer_id,
					'status' => 1,
					// Inicia control computadora
					DB::table('computers')
						->where('id', $request->computer_id)
						->where('control', 0)
						->update(['control' => 1]),
				]);
				// Control SocketJava
				//$socketCGI = config('app.perl_url') . '?pc=' . $request->number_computer . '&acc=1';
				//return redirect($socketCGI)->with('success', 'Welcome to the Black Mesa');
				// Sin Control SocketJava
				return redirect(route('cyber.index'))->with('success', 'Welcome to the Black Mesa');
			}
		} else {
			if ($checkstatus) { // Checa en bitacora si esta siendo ocupada
				if ($checkstatus->computer_id == $request->computer_id) {
					// Registra fin en bitácora
					DB::table('cybercontrols')
						->where('user_id', $request->user_id)
						->where('status', 1)
						->update([
							'status' => 2,
							'updated_at' => Carbon::now(),
						]);
					// Finaliza control computadora
					DB::table('computers')
						->where('id', $request->computer_id)
						->where('control', 1)
						->update(['control' => 0]);
					// Control SocketJava
					//$socketCGI = config('app.perl_url') . '?pc=' . $request->number_computer . '&acc=0';
					//return redirect($socketCGI)->with('success', 'Goodbye!');
					// Sin Control SocketJava
					return redirect(route('cyber.index'))->with('success', 'Goodbye!');
				} else {
					return redirect(route('cyber.index'))->with('error', 'Computadora ocupada3!');
				}
			} else {
				return redirect(route('cyber.index'))->with('error', 'Computadora ocupada2!');
			}
		}
	}

	public function select(Computer $computer)
	{
		$checkstatus = CyberControl::where('computer_id', $computer->id)->where('status', 1)->where('user_id', Auth::id())->first();
		$checkcontrol = Computer::where('id', $computer->id)->where('control', 0)->first();
		if (!$checkcontrol) {
			$this->authorize('used', $checkstatus);
		}

		return view('cyber.select', compact('computer'));
	}

	public function bitacora()
	{
		$cybercontrols = CyberControl::orderBy('status', 'asc')->paginate('5');

		return view('admin.bitacora.index', compact('cybercontrols'));
	}
}
