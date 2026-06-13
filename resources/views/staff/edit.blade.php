@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Edit Staff</h3>
        <p class="text-muted mb-0">Update employee information and position details.</p>
    </div>

    <a href="{{ route('staff.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<form action="{{ route('staff.update', $staff->id) }}" method="POST" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <h5 class="fw-bold mb-3">Staff Information</h5>

    @include('staff.form')

    <div class="d-flex gap-2 mt-3">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Update Staff
        </button>

        <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </div>
</form>
@endsection