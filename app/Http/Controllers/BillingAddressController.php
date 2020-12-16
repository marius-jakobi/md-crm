<?php

namespace App\Http\Controllers;

use App\Models\BillingAddress;
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

        $rules = [
            'name' => 'required|string|between:3,128',
            'street' => 'required_without:po_box',
            'po_box' => 'required_without:street',
            'zip' => 'required|regex:/[0-9]{5}/',
            'city' => 'required|string|between:3,128',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $billingAddress = new BillingAddress($request->only(['name', 'street', 'po_box', 'zip', 'city']));
        $billingAddress->customer_id = $id;
        $billingAddress->save();

        return redirect(route('customer.show', ['id' => $id]))
            ->with('success', 'Die Rechnungsadresse wurde angelegt.');
    }
}
