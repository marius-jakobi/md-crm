<?php

namespace Unit\Http\Controllers;

use App\Models\Customer;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Policies\CustomerPermission;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;
use Tests\TestHelpers;

class CustomerControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = TestHelpers::createUserWithPermission(CustomerPermission::INDEX);

        $this->actingAs($user)
            ->get(route('customer.index'))
            ->assertViewIs('customers.index')
            ->assertOk();

        $user->delete();
    }

    public function testShow()
    {
        $user = TestHelpers::createUserWithPermission(CustomerPermission::VIEW);
        $customer = Customer::factory()->create();

        $this->actingAs($user)
            ->get(route('customer.show', ['id' => $customer->id]))
            ->assertOk()
            ->assertViewIs('customers.show');

        $user->delete();
        $customer->delete();
    }
}
