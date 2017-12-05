<?php

namespace App\Http\Controllers\Counters;

use App\Http\Controllers\Controller;
use App\Models\Counter\Counter;
use Illuminate\Http\Request;


class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-counters|add-counters|edit-counters|delete-counters']);
    }

    public function index()
    {
        $counters = Counter::all();
        
        return view('counters.index', compact('counters'));
    }

    public function create()
    {
        return view('counters.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|min:2',
        ]);

        Counter::create($request->all());

        flash('Successful! The new counter created')->success();

        return redirect('/counters');
    }

    public function show(Counter $counter)
    {
        //
    }

    public function edit(Counter $counter)
    {
        //
    }

    public function update(Request $request, Counter $counter)
    {
        $counter->fill($request->all());
        $counter->save();

        flash('Successful! Counter updated')->success();

        return redirect('/counters');
    }

    public function destroy(Counter $counter)
    {
        //
    }
}
