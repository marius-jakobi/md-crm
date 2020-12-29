<?php

namespace Unit\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Policies\CustomerContactPermission;
use App\Policies\CustomerPermission;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;
use Tests\TestHelpers;

class CustomerContactControllerTest extends TestCase
{
    public function testCreate()
    {
        $user = TestHelpers::createUserWithPermission(CustomerContactPermission::CREATE);
        $customer = Customer::factory()->create();

        $this->actingAs($user)
            ->get(route('customers.contacts.create', ['id' => $customer->id]))
            ->assertViewIs('customers.contacts.create')
            ->assertOk();

        $user->delete();
        $customer->delete();
    }

    public function testStore()
    {
        $user = TestHelpers::createUserWithPermission(CustomerContactPermission::CREATE);
        $customer = Customer::factory()->create();

        $contact = CustomerContact::factory()->make();

        $testData = [
            'name' => $contact->name,
            'phone' => $contact->phone,
            'email' => $contact->email,
        ];

        $route = route('customers.contacts.store', ['id' => $customer->id]);

        $this->actingAs($user)
            ->post($route, $testData)
            ->assertRedirect(route('customer.show', ['id' => $customer->id]));

        // test invalid request
        $this->actingAs($user)
            ->post($route, [])
            ->assertSessionHasErrors(['name', 'phone', 'email']);

        $user->delete();
        $customer->delete();
    }
}
