<?php

namespace App\Http\Controllers;

use App\Models\BillingAddress;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingAddressController extends Controller
{
    public function create(string $id) {
        $this->authorize('create', BillingAddress::class);

        return view('customers.addresses.billing.create', ['id' => $id]);
    }

    public function store(Request $request, string $id) {
        $this->authorize('create', BillingAddress::class);

        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->input(), BillingAddress::validationRules());

        if ($validator->fails()) {
            return redirect()
                ->route('customers.addresses.billing.create', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $billingAddress = new BillingAddress($request->only(['name', 'street', 'po_box', 'zip', 'city']));
        $billingAddress->customer_id = $customer->id;
        $billingAddress->save();

        return redirect(route('customer.show', ['id' => $id]))
            ->with('success', 'Die Rechnungsadresse wurde angelegt.');
    }

    public function edit(string $id, int $address_id) {
        $address = BillingAddress::findOrFail($address_id);

        return view('customers.addresses.billing.edit', ['address' => $address]);
    }

    public function update(Request $request, string $id, int $address_id) {
        $address = BillingAddress::findOrFail($address_id);
        $this->authorize('update', $address);

        $input = $request->only(['name', 'street', 'po_box', 'zip', 'city']);

        $validator = Validator::make($input, BillingAddress::validationRules());

        if ($validator->fails()) {
            return redirect()
                ->route('customers.addresses.billing.edit', ['id' => $id, 'address_id' => $address_id])
                ->withErrors($validator);
        }

        $address->update($input);
        $address->save();

        return redirect()->route('customer.show', ['id' => $id])
            ->with('success', 'Die Rechnungsadresse wurde geändert.');
    }
}
