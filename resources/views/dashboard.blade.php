@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="text-muted mb-0">Overview of inventory, customers, staff, and sales performance.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('cars.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Register Vehicle
        </a>

        <a href="{{ route('customers.create') }}" class="btn btn-outline-primary">
            <i class="bi bi-person-plus"></i> Register Customer
        </a>

        <a href="{{ route('sales.create') }}" class="btn btn-outline-dark">
            <i class="bi bi-receipt"></i> Record Sale
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('cars.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Vehicles</small>
                        <h3 class="fw-bold mb-0">{{ $totalCars }}</h3>
                    </div>
                    <i class="bi bi-car-front fs-2 text-primary"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="{{ route('cars.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Available Vehicles</small>
                        <h3 class="fw-bold mb-0">{{ $availableCars }}</h3>
                    </div>
                    <i class="bi bi-check-circle fs-2 text-success"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="{{ route('sales.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Sold Vehicles</small>
                        <h3 class="fw-bold mb-0">{{ $soldCars }}</h3>
                    </div>
                    <i class="bi bi-bag-check fs-2 text-danger"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="{{ route('cars.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Reserved Vehicles</small>
                        <h3 class="fw-bold mb-0">{{ $reservedCars }}</h3>
                    </div>
                    <i class="bi bi-bookmark-check fs-2 text-warning"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6">
        <a href="{{ route('customers.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Customers</small>
                        <h3 class="fw-bold mb-0">{{ $totalCustomers }}</h3>
                    </div>
                    <i class="bi bi-people fs-2 text-info"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6">
        <a href="{{ route('staff.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Staff</small>
                        <h3 class="fw-bold mb-0">{{ $totalStaff }}</h3>
                    </div>
                    <i class="bi bi-person-workspace fs-2 text-secondary"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-12">
        <a href="{{ route('sales.index') }}" class="text-decoration-none text-reset">
            <div class="card shadow-sm p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Revenue</small>
                        <h3 class="fw-bold mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <i class="bi bi-cash-stack fs-2 text-success"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-5">
        <div class="card shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Vehicle Status</h5>
                <small class="text-muted">Inventory overview</small>
            </div>

            <canvas id="vehicleStatusChart"></canvas>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Recent Sales</h5>
                    <a href="{{ route('sales.index') }}" class="small text-decoration-none">View All</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Sale No.</th>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentSales as $sale)
                            <tr>
                                <td class="fw-bold">{{ $sale->sale_number }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->car->brand }} {{ $sale->car->model }}</td>
                                <td class="fw-bold">${{ number_format($sale->total_price, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No recent sales found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Monthly Revenue</h5>
                <small class="text-muted">Sales performance by month</small>
            </div>

            <canvas id="revenueChart" height="85"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('vehicleStatusChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Available', 'Sold', 'Reserved'],
        datasets: [{
            data: [{{ $availableCars }}, {{ $soldCars }}, {{ $reservedCars }}],
            backgroundColor: ['#198754', '#dc3545', '#ffc107'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

const revenueCtx = document.getElementById('revenueChart');

new Chart(revenueCtx, {
    type: 'bar',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Revenue ($)',
            data: @json($revenues),
            backgroundColor: '#0d6efd',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection