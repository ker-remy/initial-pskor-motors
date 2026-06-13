@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Edit Customer</h3>
        <p class="text-muted mb-0">Update buyer or potential customer information.</p>
    </div>

    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<form action="{{ route('customers.update', $customer->id) }}" method="POST" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <h5 class="fw-bold mb-3">Customer Information</h5>

    @include('customers.form')

    <div class="d-flex gap-2 mt-3">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Update Customer
        </button>

        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </div>
</form>
@endsection