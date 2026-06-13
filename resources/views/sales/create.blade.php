@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Record Sale</h3>
        <p class="text-muted mb-0">Create a new vehicle sales transaction.</p>
    </div>

    <a href="{{ route('sales.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<form action="{{ route('sales.store') }}" method="POST" class="card p-4 shadow-sm">
    @csrf

    <h5 class="fw-bold mb-3">Sale Information</h5>

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Vehicle</label>
            <select name="car_id" id="carSelect" class="form-select">
                <option value="">Select Vehicle</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}"
                            data-price="{{ $car->price }}"
                            {{ old('car_id') == $car->id ? 'selected' : '' }}>
                        {{ $car->brand }} {{ $car->model }} - {{ $car->year }} - ${{ number_format($car->price, 2) }}
                    </option>
                @endforeach
            </select>
            @error('car_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Customer</label>
            <select name="customer_id" class="form-select">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} - {{ $customer->phone }}
                    </option>
                @endforeach
            </select>
            @error('customer_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Staff</label>
            <select name="staff_id" class="form-select">
                <option value="">Select Staff</option>
                @foreach($staff as $s)
                    <option value="{{ $s->id }}" {{ old('staff_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->name }} - {{ $s->position }}
                    </option>
                @endforeach
            </select>
            @error('staff_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Sale Date</label>
            <input type="date"
                   name="sale_date"
                   class="form-control"
                   value="{{ old('sale_date', date('Y-m-d')) }}">
            @error('sale_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Payment Method</label>
            <select name="payment_method" class="form-select">
                <option value="">Select Payment Method</option>
                <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="Loan" {{ old('payment_method') == 'Loan' ? 'selected' : '' }}>Loan</option>
                <option value="Installment" {{ old('payment_method') == 'Installment' ? 'selected' : '' }}>Installment</option>
            </select>
            @error('payment_method') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Sale Price (USD)</label>
            <input type="number"
                   id="salePrice"
                   name="total_price"
                   step="0.01"
                   class="form-control"
                   placeholder="Sale price"
                   value="{{ old('total_price') }}">
            @error('total_price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-semibold">Remarks</label>
            <textarea name="remarks"
                      rows="3"
                      class="form-control"
                      placeholder="Optional note about payment, bank loan, discount, or customer request">{{ old('remarks') }}</textarea>
        </div>

    </div>

    <div class="d-flex gap-2 mt-3">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Save Sale
        </button>

        <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </div>
</form>

<script>
const carSelect = document.getElementById('carSelect');
const salePrice = document.getElementById('salePrice');

function updateSalePrice()
{
    const selected = carSelect.options[carSelect.selectedIndex];

    if(selected && selected.dataset.price && !salePrice.value){
        salePrice.value = selected.dataset.price;
    }
}

carSelect.addEventListener('change', function(){
    const selected = carSelect.options[carSelect.selectedIndex];

    if(selected && selected.dataset.price){
        salePrice.value = selected.dataset.price;
    }
});

updateSalePrice();
</script>
@endsection