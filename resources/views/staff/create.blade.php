@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Register Staff</h3>
        <p class="text-muted mb-0">Add a new employee or sales representative.</p>
    </div>

    <a href="{{ route('staff.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<form action="{{ route('staff.store') }}" method="POST" class="card p-4 shadow-sm">
    @csrf

    <h5 class="fw-bold mb-3">Staff Information</h5>

    @include('staff.form')

    <div class="d-flex gap-2 mt-3">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Save Staff
        </button>

        <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </div>
</form>
@endsection