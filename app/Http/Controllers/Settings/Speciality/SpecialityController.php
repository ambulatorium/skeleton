<?php

namespace App\Http\Controllers\Settings\Speciality;

use Illuminate\Validation\Rule;
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
        return view('settings.speciality.index');
    }

    public function create()
    {
        return view('settings.speciality.create', ['speciality' => new Speciality]);
    }

    public function store()
    {
        Speciality::create(
            request()->validate([
                'name' => 'required|unique:specialities',
                'description' => 'required',
            ])
        );

        cache()->forget('specialities');

        flash('Successful! The new speciality created')->success();

        return redirect(route('specialities.index'));
    }

    public function show(Speciality $speciality)
    {
        return redirect(route('specialities.index'));
    }

    public function edit(Speciality $speciality)
    {
        return view('settings.speciality.edit', compact('speciality'));
    }

    public function update(Speciality $speciality)
    {
        $speciality->update(
            request()->validate([
                'name' => ['required', Rule::unique('specialities')->ignore($speciality->id)],
                'description' => 'required',
            ])
        );

        cache()->forget('specialities');

        flash('Successful! The speciality updated')->success();

        return redirect(route('specialities.index'));
    }

    public function destroy(Speciality $speciality)
    {
        $relationships = $this->checkRelationships($speciality, [
            'doctors' => 'doctors',
        ]);

        if (empty($relationships)) {
            $speciality->delete();

            cache()->forget('specialities');

            flash('Successful! The speciality deleted')->success();
        } else {
            flash('Warning! Deletion of '.$speciality->name.' not allowed.')->warning();
        }

        return redirect(route('specialities.index'));
    }
}
