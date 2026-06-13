<div class="row">

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Brand</label>
    <input type="text"
           name="brand"
           class="form-control"
           placeholder="Toyota, Lexus, Kia..."
           value="{{ old('brand', $car->brand ?? '') }}">
    @error('brand')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Model</label>
    <input type="text"
           name="model"
           class="form-control"
           placeholder="Camry, Morning, Ray..."
           value="{{ old('model', $car->model ?? '') }}">
    @error('model')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Year</label>
    <input type="number"
           name="year"
           class="form-control"
           placeholder="2020"
           value="{{ old('year', $car->year ?? '') }}">
    @error('year')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Color</label>
    <input type="text"
           name="color"
           class="form-control"
           placeholder="White, Black, Silver..."
           value="{{ old('color', $car->color ?? '') }}">
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Mileage (KM)</label>
    <input type="number"
           name="mileage"
           class="form-control"
           placeholder="50000"
           value="{{ old('mileage', $car->mileage ?? '') }}">
    @error('mileage')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Transmission</label>
    <select name="transmission" class="form-select">
        <option value="">Select Transmission</option>

        <option value="Automatic"
            {{ old('transmission', $car->transmission ?? '') == 'Automatic' ? 'selected' : '' }}>
            Automatic
        </option>

        <option value="Manual"
            {{ old('transmission', $car->transmission ?? '') == 'Manual' ? 'selected' : '' }}>
            Manual
        </option>
    </select>
</div>

<div class="col-md-6 mb-3">
    <label class="form-label fw-semibold">Engine Number</label>
    <input type="text"
           name="engine_number"
           class="form-control"
           placeholder="Enter engine number"
           value="{{ old('engine_number', $car->engine_number ?? '') }}">
</div>

<div class="col-md-6 mb-3">
    <label class="form-label fw-semibold">Frame Number</label>
    <input type="text"
           name="frame_number"
           class="form-control"
           placeholder="Enter frame number"
           value="{{ old('frame_number', $car->frame_number ?? '') }}">
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Fuel Type</label>

    <select name="fuel_type" class="form-select">
        <option value="">Select Fuel Type</option>

        <option value="Gasoline"
            {{ old('fuel_type', $car->fuel_type ?? '') == 'Gasoline' ? 'selected' : '' }}>
            Gasoline
        </option>

        <option value="Diesel"
            {{ old('fuel_type', $car->fuel_type ?? '') == 'Diesel' ? 'selected' : '' }}>
            Diesel
        </option>

        <option value="Hybrid"
            {{ old('fuel_type', $car->fuel_type ?? '') == 'Hybrid' ? 'selected' : '' }}>
            Hybrid
        </option>

        <option value="Electric"
            {{ old('fuel_type', $car->fuel_type ?? '') == 'Electric' ? 'selected' : '' }}>
            Electric
        </option>
    </select>
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Body Type</label>

    <select name="body_type" class="form-select">
        <option value="">Select Body Type</option>

        <option value="Sedan"
            {{ old('body_type', $car->body_type ?? '') == 'Sedan' ? 'selected' : '' }}>
            Sedan
        </option>

        <option value="SUV"
            {{ old('body_type', $car->body_type ?? '') == 'SUV' ? 'selected' : '' }}>
            SUV
        </option>

        <option value="Hatchback"
            {{ old('body_type', $car->body_type ?? '') == 'Hatchback' ? 'selected' : '' }}>
            Hatchback
        </option>

        <option value="Truck"
            {{ old('body_type', $car->body_type ?? '') == 'Truck' ? 'selected' : '' }}>
            Truck
        </option>

        <option value="Van"
            {{ old('body_type', $car->body_type ?? '') == 'Van' ? 'selected' : '' }}>
            Van
        </option>

        <option value="Pickup"
            {{ old('body_type', $car->body_type ?? '') == 'Pickup' ? 'selected' : '' }}>
            Pickup
        </option>
    </select>
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Condition</label>

    <select name="condition" class="form-select">

        <option value="New"
            {{ old('condition', $car->condition ?? '') == 'New' ? 'selected' : '' }}>
            New
        </option>

        <option value="Used"
            {{ old('condition', $car->condition ?? '') == 'Used' ? 'selected' : '' }}>
            Used
        </option>

        <option value="Excellent"
            {{ old('condition', $car->condition ?? '') == 'Excellent' ? 'selected' : '' }}>
            Excellent
        </option>

        <option value="Good"
            {{ old('condition', $car->condition ?? '') == 'Good' ? 'selected' : '' }}>
            Good
        </option>

        <option value="Needs Repair"
            {{ old('condition', $car->condition ?? '') == 'Needs Repair' ? 'selected' : '' }}>
            Needs Repair
        </option>

    </select>
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Price (USD)</label>

    <input type="number"
           step="0.01"
           name="price"
           class="form-control"
           placeholder="18000"
           value="{{ old('price', $car->price ?? '') }}">

    @error('price')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Status</label>

    <select name="status" class="form-select">

        <option value="Available"
            {{ old('status', $car->status ?? '') == 'Available' ? 'selected' : '' }}>
            Available
        </option>

        <option value="Reserved"
            {{ old('status', $car->status ?? '') == 'Reserved' ? 'selected' : '' }}>
            Reserved
        </option>

        <option value="Sold"
            {{ old('status', $car->status ?? '') == 'Sold' ? 'selected' : '' }}>
            Sold
        </option>

    </select>

    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-12 mb-3">
    <label class="form-label fw-semibold">Vehicle Remark</label>

    <textarea name="remark"
              rows="3"
              class="form-control"
              placeholder="Full Option, Sunroof, Push Start, Korean Import, Accident Free...">{{ old('remark', $car->remark ?? '') }}</textarea>
</div>

<div class="col-md-12 mb-3">
    <label class="form-label fw-semibold">Vehicle Photo</label>

    <input type="file"
           name="photo"
           class="form-control"
           accept="image/*"
           onchange="previewImage(event)">

    <div class="mt-3">
        <img id="preview"
             src="{{ isset($car) && $car->photo ? asset('storage/' . $car->photo) : '' }}"
             class="rounded shadow-sm border"
             style="max-height:220px;{{ isset($car) && $car->photo ? '' : 'display:none;' }}">
    </div>

    @error('photo')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

</div>

<script>
function previewImage(event)
{
    const preview = document.getElementById('preview');

    if(event.target.files && event.target.files[0])
    {
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
}
</script>
