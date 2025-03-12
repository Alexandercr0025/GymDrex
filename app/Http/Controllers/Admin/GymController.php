<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\Panel;
use Illuminate\Http\Request;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $panels=Panel::all();

        $ciudad = $request->input('ciudad');
        if($ciudad){
            $gyms = Gym::where('ciudad', 'LIKE',"%{$ciudad}%")->simplePaginate(4);
        }else{
            $gyms = Gym::simplePaginate(4);
        }
        $gyms->appends(['ciudad' => $ciudad]);

        return view('Client.gym', compact('gyms', 'panels', 'ciudad'));
    }
    // public function index()
    // {
    //     //
    //     $panels=Panel::all();
    //     $gyms = Gym::all();
    //     $ciudad = '';

    //     return view('Client.gym', compact('gyms', 'panels', 'ciudad'));
    // }

    // public function shearch(Request $request)
    // {
    //     // dd($request->ciudad);
    //     $ciudad = $request->ciudad;
    //     $gyms = Gym::where('ciudad', 'LIKE',"%{$ciudad}%")->get();
    //     $panels=Panel::all();

    //     return view('Client.gym', compact('gyms', 'panels', 'ciudad'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gym $gym)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gym $gym)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gym $gym)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym)
    {
        //
    }
}
