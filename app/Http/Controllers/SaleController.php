<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $sales = Sale::with(['car', 'customer', 'staff'])
            ->when($search, function ($query) use ($search) {
                $query->where('sale_number', 'ILIKE', "%{$search}%")
                    ->orWhere('payment_method', 'ILIKE', "%{$search}%")
                    ->orWhere('sale_date', 'ILIKE', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'ILIKE', "%{$search}%")
                          ->orWhere('phone', 'ILIKE', "%{$search}%");
                    })
                    ->orWhereHas('car', function ($q) use ($search) {
                        $q->where('brand', 'ILIKE', "%{$search}%")
                          ->orWhere('model', 'ILIKE', "%{$search}%")
                          ->orWhere('year', 'ILIKE', "%{$search}%");
                    })
                    ->orWhereHas('staff', function ($q) use ($search) {
                        $q->where('name', 'ILIKE', "%{$search}%")
                          ->orWhere('position', 'ILIKE', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('sales.index', compact('sales', 'search'));
    }

    public function create()
    {
        $cars = Car::where('status', 'Available')->get();
        $customers = Customer::all();
        $staff = Staff::all();

        return view('sales.create', compact('cars', 'customers', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required',
            'customer_id' => 'required',
            'staff_id' => 'required',
            'sale_date' => 'required|date',
            'total_price' => 'required|numeric',
            'payment_method' => 'required',
            'remarks' => 'nullable'
        ]);

        $saleNumber = 'SAL-' . date('Y') . '-' . str_pad(Sale::count() + 1, 4, '0', STR_PAD_LEFT);

        Sale::create([
            'sale_number' => $saleNumber,
            'car_id' => $request->car_id,
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'sale_date' => $request->sale_date,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'remarks' => $request->remarks
        ]);

        Car::where('id', $request->car_id)->update([
            'status' => 'Sold'
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
    }

    public function destroy(Sale $sale)
    {
        if ($sale->car) {
            $sale->car->update(['status' => 'Available']);
        }

        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}