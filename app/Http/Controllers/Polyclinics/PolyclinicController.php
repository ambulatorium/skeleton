<?php

namespace App\Http\Controllers\Polyclinics;

use App\Http\Controllers\Controller;
use App\Models\Polyclinic\Polyclinic;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-polyclinics|add-polyclinics|edit-polyclinics|delete-polyclinics']);
    }

    public function index()
    {
        return view('polyclinics.index', [
            'polyclinics' => Polyclinic::paginate(10),
        ]);
    }

    public function create()
    {
        return view('polyclinics.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'                => 'required|min:10',
            'location'            => 'required|min:5',
            'service_description' => 'required|min:20',
        ]);

        Polyclinic::create($request->all());

        flash('Successful! The new polyclinic created')->success();

        return redirect('/polyclinics');
    }

    public function show(Polyclinic $polyclinic)
    {
        return view('polyclinics.show', [
            'polyclinic' => $polyclinic,
        ]);
    }

    public function edit(Polyclinic $polyclinic)
    {
        return view('polyclinics.edit')->with('polyclinic', $polyclinic);
    }

    public function update(Request $request, Polyclinic $polyclinic)
    {
        $this->validate(request(), [
            'name'                => 'required|min:10',
            'location'            => 'required|min:5',
            'service_description' => 'required|min:20',
        ]);

        $polyclinic->fill($request->all());
        $polyclinic->save();

        flash('Successful! The polyclinic updated')->success();

        return redirect('/polyclinics/'.$polyclinic->id);
    }

    public function destroy(Polyclinic $polyclinic)
    {
        $relationships = $this->checkRelationships($polyclinic, [
            'doctor' => 'doctor',
        ]);

        if (empty($relationships)) {
            $polyclinic->delete();

            flash('Successful! The polyclinic deleted')->success();
        } else {
            flash('Warning! Deletion of '.$polyclinic->name.' not allowed.')->warning();
        }

        return redirect('/polyclinics');
    }
}
