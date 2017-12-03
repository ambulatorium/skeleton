<?php

namespace App\Http\Controllers\Polyclinics;

use App\Http\Controllers\Controller;
use App\Models\Polyclinic\Polyclinic;
use App\Models\Appointment\Appointment;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-polyclinics|add-polyclinics|edit-polyclinics|delete-polyclinics']);
    }

    public function index()
    {
        $polyclinics = Polyclinic::get();
        
        return view('polyclinics.index', compact('polyclinics'));
    }

    public function create()
    {
        return view('polyclinics.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|min:10',
            'location' => 'required|min:5',
            'service_description' => 'required|min:20'
        ]);

        Polyclinic::create($request->all());

        flash('Successful! The new polyclinic created')->important();

        return redirect('/polyclinics');
    }

    public function show(Polyclinic $polyclinic)
    {
        return view('polyclinics.show', [
            'polyclinic' => $polyclinic
        ]);
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
