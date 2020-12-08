<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function list() {
        $customers = Customer::paginate(10);

        return view('customers.list', ['customers' => $customers]);
    }

    public function details(string $id) {
        $customer = Customer::findOrFail($id);

        return view('customers.details', ['customer' => $customer]);
    }
}
