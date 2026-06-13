@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Vehicle Inventory</h3>
        <p class="text-muted mb-0">Manage vehicle stock records, pricing, status, and identification details.</p>
    </div>

    <a href="{{ route('cars.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> New Vehicle
    </a>
</div>

<div class="card shadow-sm p-3 mb-4">
    <form method="GET" class="row g-2">
        <div class="col-md-10">
                <input  type="text"
                        id="carSearch"
                        name="search"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Search brand, model, year, fuel type, status, engine number, or frame number"
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
                        <th>Photo</th>
                        <th>Vehicle</th>
                        <th>Details</th>
                        <th>Engine / Frame</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cars as $car)
                    <tr>
                        <td>
                            @if($car->photo)
                                <img src="{{ asset('storage/' . $car->photo) }}"
                                     width="90"
                                     height="65"
                                     class="rounded shadow-sm"
                                     style="object-fit:cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center rounded bg-light text-muted"
                                     style="width:90px;height:65px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>

                       <td>
                            <div class="fw-bold">
                                {{ $car->brand }} {{ $car->model }}
                            </div>

                            <small class="text-muted">
                                {{ $car->year }}

                                @if($car->body_type)
                                    · {{ $car->body_type }}
                                @endif
                            </small>
                        </td>

                        <td>
                            <div>Color: {{ $car->color ?? '-' }}</div>

                            <small class="text-muted">
                                Mileage:
                                {{ $car->mileage ? number_format($car->mileage) . ' km' : '-' }}
                            </small>

                            <br>

                            <small class="text-muted">
                                {{ $car->transmission ?? '-' }}
                                /
                                {{ $car->fuel_type ?? '-' }}
                            </small>

                            <br>

                            @if($car->condition)
                                <span class="badge bg-info mt-1">
                                    {{ $car->condition }}
                                </span>
                            @endif
                        </td>

                        <td>
                            <small>
                                <strong>Engine:</strong> {{ $car->engine_number ?? '-' }}
                            </small><br>
                            <small>
                                <strong>Frame:</strong> {{ $car->frame_number ?? '-' }}
                            </small>
                        </td>

                        <td class="fw-bold text-success">
                            ${{ number_format($car->price, 2) }}
                        </td>

                        <td>
                            @if($car->status == 'Available')
                                <span class="badge bg-success">Available</span>
                            @elseif($car->status == 'Sold')
                                <span class="badge bg-danger">Sold</span>
                            @else
                                <span class="badge bg-warning text-dark">Reserved</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('cars.show', $car->id) }}"
                            class="btn btn-info btn-sm text-white">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('cars.edit', $car->id) }}"
                            class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('cars.destroy', $car->id) }}"
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
                    @if(!empty($car->remark))
                    <tr>
                        <td colspan="7" class="small text-muted">
                            <strong>Remark:</strong>
                            {{ $car->remark }}
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-car-front fs-1 d-block mb-2"></i>
                            No vehicles found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $cars->links('pagination::bootstrap-5') }}
</div>

<script>
    const searchBox = document.getElementById('carSearch');

    if (searchBox) {
        searchBox.focus();
        searchBox.setSelectionRange(searchBox.value.length, searchBox.value.length);
    }
</script>
@endsection