<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Customer::class);

        $customers = Customer::paginate(10);

        return view('customers.index', ['customers' => $customers]);
    }

    public function show(string $id) {
        $customer = Customer::findOrFail($id);

        $this->authorize('view', $customer);

        return view('customers.show', ['customer' => $customer]);
    }
}
