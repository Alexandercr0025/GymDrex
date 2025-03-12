<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentPaypalController extends Controller
{
    //
    private $clientId;
    private $secret;

    private $baseURL = 'https://api-m.paypal.com';
    // private $baseURL = 'https://api-m.sandbox.paypal.com';

    public function __construct()
    {
        $this->baseURL =
            config('app')['env'] == 'local' ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com';
        $this->clientId =
            config('app')['paypal_id'];
        $this->secret =
            config('app')['paypal_secret'];
    }

    public function paypal(Customer $customer)
    {
        // dd($customer);
        $memberships = Membership::all();
        $coach = Coach::first();
        return view('Client.pay', compact('memberships', 'coach', 'customer'));
    }

    public function paypalProcessOrder(string $order)
    {
        // dd($order);
        $accessToken = $this->getAccessToken();

        // dd($accessToken);
        $response = Http::acceptJson()->withToken($accessToken)->withHeaders([
            'Content-Type' => 'application/json'
        ])->post($this->baseURL . "/v2/checkout/orders/$order/capture", [
            'application_context' => [
                'return_url' => 'http://127.0.0.1:8000',
                'cancel_url' => 'http://127.0.0.1:8000',
            ]
        ])->json();

        return $response;
    }

    private function getAccessToken()
    {
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->withBasicAuth($this->clientId, $this->secret)
            ->post($this->baseURL . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials'
            ])->json();
        return $response['access_token'];
    }

    // funcion de actuar
    public function processSuccessOrder(Customer $customer, $orderPayPalId, Membership $membership, Coach $coach) //tambien el cliente
    {
        // dd($customer->id, $membership, $coach);
        // dd(gettype($customer), $customer);
        // dd($orderPayPalId);
        $response = $this->paypalProcessOrder($orderPayPalId);

        // dd($response['status']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // success paypal

            // crear datos en la tabla transacciones
            Transaction::create([
                'customer_id' => $customer->id,
                'estado' => $response['status'],
                'membership_id' => $membership->id,
                'coach_id' => $coach->id,
            ]);

            // calculo de fechas
            $hoy = Carbon::now();

            if (!is_null($customer->fecha_fin) && Carbon::parse($customer->fecha_fin)->greaterThan($hoy)) {
                // Tiene membresia
                $fechaInicio = $customer->fecha_inicio;
                $fechaFin = Carbon::parse($customer->fecha_fin)->addMonths($membership->meses)->format('Y-m-d');
            } else {
                // No tiene membresia o ya expiro
                $fechaInicio = $hoy->format('Y-m-d');
                $fechaFin = $hoy->copy()->addMonths($membership->meses)->format('Y-m-d');
            }

            // Actualizar datos del cliente
            $customer->update([
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ]);

            if ($coach->id) {
                if (!is_null($customer->fecha_fin_coach) && Carbon::parse($customer->fecha_fin_coach)->greaterThan($hoy)) {
                    // Tiene coach
                    $fechaInicioCoach = $customer->fecha_inicio_coach; // No cambiar
                    $fechaFinCoach = Carbon::parse($customer->fecha_fin_coach)->addMonth()->format('Y-m-d');
                    // dd('tiene coach', $fechaFinCoach, $fechaInicioCoach);
                } else {
                    // No tiene coach o ya expiro
                    $fechaInicioCoach = $hoy->format('Y-m-d');
                    $fechaFinCoach = $hoy->copy()->addMonth()->format('Y-m-d');
                    // dd('no tiene coach', $fechaFinCoach, $fechaInicioCoach);
                }

                $customer->update([
                    'fecha_inicio_coach' => $fechaInicioCoach,
                    'fecha_fin_coach' => $fechaFinCoach,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pago procesado correctamente',
                'redirect' => route('principal'),
            ]);
            // return to_route('principal')->with('success', 'Registro existoso');
            // <YourModel>::<SomeCustomMethod>($response['id'], json_encode($response),
            // $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
        } else if (isset($response['status'])) {
            // error paypal

            // return back()->with('error', 'Tenemos problemas al procesar su pago, vuelva a intentar');
            // return $this->errorResponse("", 202, "A problem has occurred with your order, the status is "
            // . $response['status'] . " and the ID is " . $response['id']);
            return response()->json([
                'success' => false,
                'message' => 'Problemas al procesar el pago',
            ]);
        }
    }
}
