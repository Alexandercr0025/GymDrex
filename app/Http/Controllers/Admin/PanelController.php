<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Membership;
use App\Models\Panel;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $panel = Panel::first();
        $membership = Membership::all();
        $coach = Coach::first();

        // dd(public_path("img\Admin\principal.webp"));
        return view('Admin.panel.index', compact('panel', 'membership', 'coach'));
    }

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
    public function show(Panel $panel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panel $panel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Panel $panel)
    {
        // actualizar datos de la empresa
        // dd($request, $panel);
        $data = $request-> validate([
            'nombre' => 'required|string',
            'slogan' => 'required|string',
            'descripcion' => 'required|string',
            'email' => 'required|email',
            'celular' => 'required|numeric|digits:9',
        ]);

        $panel->update($data);

        // dd($data, $panel);

        return to_route('dashboard')->with('success', 'Datos actualizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panel $panel)
    {
        //
    }
}
