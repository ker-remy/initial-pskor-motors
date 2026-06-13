@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Customer Management</h3>
        <p class="text-muted mb-0">Manage buyers, potential customers, vehicle interests, budget, and payment preferences.</p>
    </div>

    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Register Customer
    </a>
</div>

<div class="card shadow-sm p-3 mb-4">
    <form method="GET" class="row g-2">
        <div class="col-md-10">
            <input type="text"
                   id="customerSearch"
                   name="search"
                   value="{{ $search }}"
                   class="form-control"
                   placeholder="Search name, phone, address, type, interested vehicle, or payment"
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
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Contact</th>
                        <th>Vehicle Interest</th>
                        <th>Budget</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $customer->name }}</div>
                            <small class="text-muted">Customer ID: #{{ $customer->id }}</small>
                        </td>

                        <td>
                            @if($customer->customer_type == 'VIP Customer')
                                <span class="badge bg-warning text-dark">VIP</span>
                            @elseif($customer->customer_type == 'Buyer')
                                <span class="badge bg-success">Buyer</span>
                            @elseif($customer->customer_type == 'Referral Customer')
                                <span class="badge bg-info">Referral</span>
                            @else
                                <span class="badge bg-secondary">Potential</span>
                            @endif
                        </td>

                        <td>
                            <div>
                                <i class="bi bi-telephone text-muted"></i>
                                {{ $customer->phone }}
                            </div>

                            <small class="text-muted">
                                {{ $customer->address }}
                            </small>
                        </td>

                        <td>
                            <div>{{ $customer->interested_vehicle ?? '-' }}</div>

                            <small class="text-muted">
                                {{ $customer->preferred_payment ?? '-' }}
                            </small>
                        </td>

                        <td>
                            <span class="fw-bold text-success">
                                ${{ number_format($customer->budget ?? 0, 2) }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('customers.destroy', $customer->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirmDelete(this)">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @if($customer->note)
                    <tr>
                        <td colspan="6" class="small text-muted">
                            <strong>Note:</strong> {{ $customer->note }}
                        </td>
                    </tr>
                    @endif

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2"></i>
                            No customers found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $customers->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

<script>
const customerSearch = document.getElementById('customerSearch');

if (customerSearch) {
    customerSearch.focus();
    customerSearch.setSelectionRange(customerSearch.value.length, customerSearch.value.length);
}
</script>
@endsection