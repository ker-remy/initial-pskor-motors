@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Vehicle Profile</h3>
        <p class="text-muted mb-0">Detailed vehicle information and inventory record.</p>
    </div>

    <div>
        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit
        </a>

        <a href="{{ route('cars.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm p-3">
            @if($car->photo)
                <img src="{{ asset('storage/' . $car->photo) }}"
                     class="img-fluid rounded"
                     style="height:280px;object-fit:cover;">
            @else
                <div class="d-flex align-items-center justify-content-center rounded bg-light text-muted"
                     style="height:280px;">
                    <i class="bi bi-image fs-1"></i>
                </div>
            @endif

            <div class="mt-3">
                @if($car->status == 'Available')
                    <span class="badge bg-success">Available</span>
                @elseif($car->status == 'Sold')
                    <span class="badge bg-danger">Sold</span>
                @else
                    <span class="badge bg-warning text-dark">Reserved</span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm p-4">
            <h4 class="fw-bold mb-1">{{ $car->brand }} {{ $car->model }}</h4>
            <p class="text-muted mb-4">Year {{ $car->year }}</p>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <small class="text-muted">Color</small>
                    <div class="fw-bold">{{ $car->color ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Mileage</small>
                    <div class="fw-bold">
                        {{ $car->mileage ? number_format($car->mileage) . ' km' : '-' }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Transmission</small>
                    <div class="fw-bold">{{ $car->transmission ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Fuel Type</small>
                    <div class="fw-bold">{{ $car->fuel_type ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Body Type</small>
                    <div class="fw-bold">{{ $car->body_type ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Condition</small>
                    @if($car->condition)
                        <span class="badge bg-info">
                            {{ $car->condition }}
                        </span>
                    @else
                        -
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Engine Number</small>
                    <div class="fw-bold">{{ $car->engine_number ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Frame Number</small>
                    <div class="fw-bold">{{ $car->frame_number ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Price</small>
                    <div class="fw-bold fs-2 text-success">
                        ${{ number_format($car->price, 2) }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Registered Date</small>
                    <div class="fw-bold">{{ $car->created_at->format('d M Y') }}</div>
                </div>
                 
                <div class="col-md-6 mb-3">
                    <small class="text-muted">Last Updated</small>
                    <div class="fw-bold">
                        {{ $car->updated_at->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($car->remark)
<div class="card shadow-sm p-4 mt-4">
    <h5 class="fw-bold mb-3">
        Vehicle Remark
    </h5>

    <p class="mb-0">
        {{ $car->remark }}
    </p>
</div>
@endif
@endsection