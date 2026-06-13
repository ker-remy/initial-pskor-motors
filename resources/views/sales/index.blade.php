@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Sales Management</h3>
        <p class="text-muted mb-0">Track sales transactions, payment methods, customers, vehicles, and responsible staff.</p>
    </div>

    <a href="{{ route('sales.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Record Sale
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Total Sales Records</small>
            <h4 class="fw-bold mb-0">{{ $sales->total() }}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Records This Page</small>
            <h4 class="fw-bold mb-0">{{ $sales->count() }}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Current Page</small>
            <h4 class="fw-bold mb-0">{{ $sales->currentPage() }}</h4>
        </div>
    </div>
</div>

<div class="card shadow-sm p-3 mb-4">
    <form method="GET" class="row g-2">
        <div class="col-md-10">
            <input type="text"
                   id="saleSearch"
                   name="search"
                   value="{{ $search }}"
                   class="form-control"
                   placeholder="Search sale no, customer, vehicle, staff, payment method..."
                   onkeyup="autoSearch(this)"
                   autofocus>
        </div>

        <div class="col-md-2 d-grid">
            <button class="btn btn-dark">
                <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Sale No.</th>
                        <th>Vehicle</th>
                        <th>Customer</th>
                        <th>Staff</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th width="110">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $sale->sale_number }}</div>
                            <small class="text-muted">ID: #{{ $sale->id }}</small>
                        </td>

                        <td>
                            <div class="fw-bold">
                                {{ $sale->car->brand ?? 'N/A' }} {{ $sale->car->model ?? '' }}
                            </div>
                            <small class="text-muted">
                                {{ $sale->car->year ?? '-' }} · {{ $sale->car->fuel_type ?? '-' }}
                            </small>
                        </td>

                        <td>
                            <div class="fw-bold">{{ $sale->customer->name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $sale->customer->phone ?? '-' }}</small>
                        </td>

                        <td>{{ $sale->staff->name ?? 'N/A' }}</td>

                        <td>
                            <span class="badge bg-dark">
                                {{ $sale->payment_method ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ $sale->sale_date ? \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') : '-' }}
                        </td>

                        <td class="fw-bold text-success">
                            ${{ number_format($sale->total_price ?? 0, 2) }}
                        </td>

                        <td>
                            <form action="{{ route('sales.destroy', $sale->id) }}"
                                  method="POST"
                                  onsubmit="return confirmDelete(this)">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @if($sale->remarks)
                    <tr>
                        <td colspan="8" class="small text-muted">
                            <strong>Remarks:</strong> {{ $sale->remarks }}
                        </td>
                    </tr>
                    @endif

                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                            No sales records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

<script>
const saleSearch = document.getElementById('saleSearch');

if (saleSearch) {
    saleSearch.focus();
    saleSearch.setSelectionRange(saleSearch.value.length, saleSearch.value.length);
}
</script>
@endsection