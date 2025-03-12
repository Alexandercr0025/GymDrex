<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Customer;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $customers = Customer::paginate(10);
        // $customers = Customer::orderBy('id', 'desc')->paginate(10);
        $customers=Customer::all();

        $dni = $request->input('dni');
        if($dni){
            $customers = Customer::where('dni', 'LIKE',"%{$dni}%")->paginate(10);
        }else{
            $customers = Customer::paginate(10);
        }
        $customers->appends(['dni' => $dni]);

        return view('Admin.customer.index', compact('customers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $memberships = Membership::all();
        $coach = Coach::first();

        return view('Admin.customer.create', compact('memberships', 'coach'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->membresia);
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|digits:8|unique:customers,dni',
            'fecha_nacimiento' => 'required|date|before:today',
            'email' => 'required|email|max:255|unique:customers,email',
            'celular' => 'required|digits:9|unique:customers,celular',
        ]);
        do {
            $codigo = strtoupper(Str::random(7)); // Genera 7 caracteres aleatorios en mayúscula
        } while (Customer::where('codigo', $codigo)->exists()); // Asegura que sea único

        // Agregar el código generado a los datos
        $data['codigo'] = $codigo;

        // fechas menbresia
        $membership = Membership::find($request->membresia);
        $meses = $membership->meses;

        $fecha_fin = now()->addMonths($meses);
        $data['fecha_inicio'] = now();
        $data['fecha_fin'] = $fecha_fin;

        // fechas coach
        if ($request->coach) {
            $coach = Coach::find($request->coach);

            $fecha_fin = now()->addMonths(1);
            $data['fecha_inicio_coach'] = now();
            $data['fecha_fin_coach'] = $fecha_fin;
        }

        // agregar datos
        $customer = Customer::create($data);
        // dd($customer);

        return to_route('customer.index')->with('success', 'Cliente registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        return view('Admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        return view('Admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|digits:8|unique:customers,dni,'.$request->route('customer')->id,
            'fecha_nacimiento' => 'required|date|before:today',
            'email' => 'required|email|max:255|unique:customers,email,'.$request->route('customer')->id,
            'celular' => 'required|digits:9|unique:customers,celular,'.$request->route('customer')->id,
        ]);

        $customer->update($data);

        return to_route('customer.index')->with('success', 'Cliente actualizado exitosamente');

    }

    public function membership(Customer $customer)
    {
        $memberships = Membership::all();
        $coach = Coach::first();

        return view('Admin.customer.editMembership', compact('customer', 'coach', 'memberships'));
    }

    public function membershipUpdate(Request $request, Customer $customer)
    {
        // dd($request);
        // fechas menbresia
        $membership = Membership::find($request->membresia);
        $meses = $membership->meses;

        $data = [];

        if (!$customer->fecha_inicio) {
            $data['fecha_inicio'] = now();
        }

        if ($customer->fecha_fin) {
            if (Carbon::parse($customer->fecha_fin)->greaterThan(now())) {
                $fecha_fin = Carbon::parse($customer->fecha_fin)->addMonths($meses);
                $data['fecha_fin'] = $fecha_fin;
            }else{
                $fecha_fin = now()->addMonths($meses);
                $data['fecha_fin'] = $fecha_fin;
            }
        }else{
            $fecha_fin = now()->addMonths($meses);
            $data['fecha_fin'] = $fecha_fin;
        }

        // fechas coach
        if ($request->coach) {
            if (!$customer->fecha_inicio_coach) {
                $data['fecha_inicio_coach'] = now();
            }

            if ($customer->fecha_fin_coach) {
                if (Carbon::parse($customer->fecha_fin_coach)->greaterThan(now())) {
                    $fecha_fin_coach = Carbon::parse($customer->fecha_fin_coach)->addMonths(1);
                    $data['fecha_fin_coach'] = $fecha_fin_coach;
                }else{
                    $fecha_fin_coach = now()->addMonths(1);
                    $data['fecha_fin_coach'] = $fecha_fin_coach;
                }
            }else{
                $fecha_fin_coach = now()->addMonths(1);
                $data['fecha_fin_coach'] = $fecha_fin_coach;
            }
        }

        // agregar datos
        // dd($data, $customer);
        $customer->update($data);
        // dd($customer);

        return to_route('customer.index')->with('success', 'Membresia actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();

        return to_route('customer.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
