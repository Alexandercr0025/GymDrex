<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\sendEmail;
use App\Mail\UpdateCustomerEmail;
use App\Models\Coach;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $panels=Panel::all();
        return view('Client.perfil', compact('panels'));
    }

    public function shearch(Request $request)
    {
        $panels=Panel::all();
        $request->validate([
            'type' => 'required|in:dni,codigo',
            'valor' => 'required|string'
        ]);

        $customer = Customer::where($request->type, $request->valor)->first();

        // dd($customer);
        if (!$customer) {
            return back()->withInput(['valor' => $request->valor, 'type' => $request->type])->with('error', 'Usted no está registrado.');
        }
        // dd($customer);

        return view('Client.show', compact('customer', 'panels'));
    }

    public function sendEmail(Customer $customer)
    {
        // Mail::to($customer->email)->send(new UpdateCustomerEmail($customer));
        // dd('azul');
        sendEmail::dispatch($customer);

        return back()->with('success', 'Se te envio un correo para actualizar tus datos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $panels=Panel::all();
        return view('Client.register', compact('panels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        $customer = Customer::create($data);
        // dd($customer);

        return to_route('perfil.paypal', compact('customer'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        // dd($customer);
        return view('Client.updateCustomer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
        // dd($request);
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|digits:8|unique:customers,dni,' . $customer->id,
            'fecha_nacimiento' => 'required|date|before:today',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'celular' => 'required|digits:9',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // dd('hola');
        if (isset($data['imagen'])) {
            Storage::disk('public_upload')->delete("upload/customer/".$customer->imagen);

            $data['imagen'] = $filename = time().'.'.$data['imagen']->extension();

            $request->file('imagen')->move(public_path('upload\customer'), $filename);

        }

        $customer->update($data);

        return back()->with('success', 'Se actualizo sus datos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
