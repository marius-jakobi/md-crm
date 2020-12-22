<?php

namespace App\Http\Controllers;

use App\Models\CustomerContact;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerContactController extends Controller
{
    public function create(string $id) {
        $this->authorize('create', CustomerContact::class);

        $shippingAddresses = ShippingAddress::where('customer_id', '=', $id)->get();

        return view('customers.contacts.create', ['id' => $id, 'shippingAddresses' => $shippingAddresses]);
    }

    public function store(Request $request, string $id)
    {
        $this->authorize('create', CustomerContact::class);

        $validator = Validator::make($request->input(), CustomerContact::validationRules());

        if ($validator->fails()) {
            return redirect()
                ->route('customers.contacts.create', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new CustomerContact($request->only(['name', 'phone', 'email', 'mobile', 'position', 'division', 'shipping_address_id']));
        $contact->customer_id = $id;
        $contact->save();

        return redirect()
            ->route('customer.show', ['id' => $id])
            ->with('success', 'Der Kontakt wurde angelegt.');
    }
}
