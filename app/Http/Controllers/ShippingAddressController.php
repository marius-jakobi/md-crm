<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingAddressController extends Controller
{
    public function create(string $id) {
        $this->authorize('create', ShippingAddress::class);

        return view('customers.addresses.shipping.create', ['id' => $id]);
    }

    public function store(Request $request, string $id) {
        $this->authorize('create', ShippingAddress::class);

        $rules = [
            'name' => 'required|string|between:3,128',
            'street' => 'required|string|between:3,128',
            'zip' => 'required|regex:/[0-9]{5}/',
            'city' => 'required|string|between:3,128',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return redirect(route('customers.addresses.shipping.create', ['id' => $id]))
                ->withErrors($validator)
                ->withInput();
        }

        $shippingAddress = new ShippingAddress($request->only(['name', 'street', 'zip', 'city']));
        $shippingAddress->customer_id = $id;
        $shippingAddress->save();

        return redirect(route('customer.show', ['id' => $id]))
            ->with('success', 'Die Lieferadresse wurde angelegt.');
    }

    public function edit(string $id, int $address_id) {
        $address = ShippingAddress::findOrFail($address_id);

        return view('customers.addresses.shipping.edit', ['address' => $address]);
    }

    public function update(Request $request, string $id, int $address_id) {
        $address = ShippingAddress::findOrFail($address_id);
        $this->authorize('update', $address);

        $input = $request->only(['name', 'street', 'po_box', 'zip', 'city']);

        $validator = Validator::make($input, ShippingAddress::validationRules());

        if ($validator->fails()) {
            return redirect(route('customers.addresses.shipping.edit', ['id' => $id, 'address_id' => $address_id]))
                ->withErrors($validator);
        }

        $address->update($input);
        $address->save();

        return redirect()->route('customer.show', ['id' => $id])
            ->with('success', 'Die Lieferadresse wurde geändert.');
    }
}
