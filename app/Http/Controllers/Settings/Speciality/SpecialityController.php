<?php

namespace App\Http\Controllers\Settings\Speciality;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Speciality\Speciality;

class SpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|administrator']);
    }

    public function index()
    {
        return view('settings.speciality.index', [
            'specialities' => Speciality::paginate(10),
        ]);
    }

    public function create()
    {
        return view('settings.speciality.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'        => 'required|string|min:3',
            'description' => 'required|string|max:60',
        ]);

        Speciality::create($request->all());

        flash('Successful! The new speciality created')->success();

        return redirect('/settings/specialities');
    }

    public function show($id)
    {
        //
    }

    public function edit(Speciality $speciality)
    {
        return view('settings.speciality.edit', compact('speciality'));
    }

    public function update(Request $request, Speciality $speciality)
    {
        $this->validate(request(), [
            'name'        => 'required|string|min:3',
            'description' => 'required|string|max:60',
        ]);

        $speciality->fill($request->all());
        $speciality->save();

        flash('Successful! The speciality updated')->success();

        return redirect('/settings/specialities');
    }

    public function destroy(Speciality $speciality)
    {
        $relationships = $this->checkRelationships($speciality, [
            'doctor' => 'doctor',
        ]);

        if (empty($relationships)) {
            $speciality->delete();

            flash('Successful! The speciality deleted')->success();
        } else {
            flash('Warning! Deletion of '.$speciality->name.' not allowed.')->warning();
        }

        return redirect('/settings/specialities');
    }
}
