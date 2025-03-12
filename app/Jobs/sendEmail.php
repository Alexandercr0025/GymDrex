<?php

namespace App\Jobs;

use App\Mail\UpdateCustomerEmail;
use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class sendEmail implements ShouldQueue
{
    use Queueable;

    public $customer;
    /**
     * Create a new job instance.
     */
    public function __construct(Customer $customer)
    {
        //
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        // dd ('hola');
        Mail::to($this->customer->email)->send(new UpdateCustomerEmail($this->customer));
    }
}
