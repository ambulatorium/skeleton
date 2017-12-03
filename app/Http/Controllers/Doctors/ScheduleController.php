<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-schedules|add-schedules|edit-schedules|delete-schedules']);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'doctor_id' => 'required', 
            'day' => 'required',
            'from_time' => 'required',
            'to_time' => 'required' 
         ]);
 
         $checkData = Schedule::where([
             ['doctor_id', $request->get('doctor_id')],
             ['day', $request->get('day')]
         ]);
 
         // dd($checkData->first());
 
         if($checkData->first()) {

            flash('Warning! Schedule you selected is already exist')->warning();
             return redirect('/doctors/'.$request->get('doctor_id'));
         }
 
         Schedule::create($request->all());
 
         return redirect('/doctors/'.$request->get('doctor_id'))->with('flash_success', 'New schedule created.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
