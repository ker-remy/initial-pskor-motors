<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'Available')->count();
        $soldCars = Car::where('status', 'Sold')->count();
        $reservedCars = Car::where('status', 'Reserved')->count();

        $totalCustomers = Customer::count();
        $totalStaff = Staff::count();
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total_price');

        $recentSales = Sale::with(['car', 'customer', 'staff'])
            ->latest()
            ->take(5)
            ->get();

        $monthlyRevenue = Sale::select(
                DB::raw('EXTRACT(MONTH FROM sale_date) as month'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $revenues = [];

        foreach ($monthlyRevenue as $item) {
            $months[] = date('M', mktime(0, 0, 0, $item->month, 1));
            $revenues[] = $item->revenue;
        }

        return view('dashboard', compact(
            'totalCars',
            'availableCars',
            'soldCars',
            'reservedCars',
            'totalCustomers',
            'totalStaff',
            'totalSales',
            'totalRevenue',
            'recentSales',
            'months',
            'revenues'
        ));
    }
}