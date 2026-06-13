<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $customers = Customer::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                      ->orWhere('phone', 'ILIKE', "%{$search}%")
                      ->orWhere('address', 'ILIKE', "%{$search}%")
                      ->orWhere('customer_type', 'ILIKE', "%{$search}%")
                      ->orWhere('interested_vehicle', 'ILIKE', "%{$search}%")
                      ->orWhere('preferred_payment', 'ILIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers', 'search'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'customer_type' => 'required',
            'interested_vehicle' => 'nullable',
            'budget' => 'nullable|numeric',
            'preferred_payment' => 'nullable',
            'note' => 'nullable'
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer registered successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'customer_type' => 'required',
            'interested_vehicle' => 'nullable',
            'budget' => 'nullable|numeric',
            'preferred_payment' => 'nullable',
            'note' => 'nullable'
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}