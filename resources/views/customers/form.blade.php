<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text"
               name="name"
               class="form-control"
               placeholder="Enter customer full name"
               value="{{ old('name', $customer->name ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Phone Number</label>
        <input type="text"
               name="phone"
               class="form-control"
               placeholder="012345678"
               value="{{ old('phone', $customer->phone ?? '') }}">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label fw-semibold">Address</label>
        <input type="text"
               name="address"
               class="form-control"
               placeholder="Phnom Penh, Cambodia"
               value="{{ old('address', $customer->address ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Customer Type</label>
        <select name="customer_type" class="form-select">
            <option value="Potential Buyer">Potential Buyer</option>
            <option value="Buyer">Buyer</option>
            <option value="VIP Customer">VIP Customer</option>
            <option value="Referral Customer">Referral Customer</option>
        </select>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Interested Vehicle</label>
        <input type="text"
               name="interested_vehicle"
               class="form-control"
               placeholder="Kia Morning, Hyundai Porter..."
               value="{{ old('interested_vehicle', $customer->interested_vehicle ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Budget ($)</label>
        <input type="number"
               step="0.01"
               name="budget"
               class="form-control"
               placeholder="15000"
               value="{{ old('budget', $customer->budget ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Preferred Payment</label>
        <select name="preferred_payment" class="form-select">
            <option value="">Select Payment Method</option>
            <option value="Cash">Cash</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Loan">Loan</option>
            <option value="Installment">Installment</option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Note</label>
        <input type="text"
               name="note"
               class="form-control"
               placeholder="Customer prefers SUV, waiting for loan approval..."
               value="{{ old('note', $customer->note ?? '') }}">
    </div>

</div>