<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text"
               name="name"
               class="form-control"
               placeholder="Enter staff full name"
               value="{{ old('name', $staff->name ?? '') }}">

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Position</label>
        <select name="position" class="form-select">
            <option value="">Select Position</option>

            <option value="General Manager" {{ old('position', $staff->position ?? '') == 'General Manager' ? 'selected' : '' }}>General Manager</option>
            <option value="Sales Manager" {{ old('position', $staff->position ?? '') == 'Sales Manager' ? 'selected' : '' }}>Sales Manager</option>
            <option value="Sales Supervisor" {{ old('position', $staff->position ?? '') == 'Sales Supervisor' ? 'selected' : '' }}>Sales Supervisor</option>
            <option value="Sales Consultant" {{ old('position', $staff->position ?? '') == 'Sales Consultant' ? 'selected' : '' }}>Sales Consultant</option>
            <option value="Salesperson" {{ old('position', $staff->position ?? '') == 'Salesperson' ? 'selected' : '' }}>Salesperson</option>
            <option value="Marketing Officer" {{ old('position', $staff->position ?? '') == 'Marketing Officer' ? 'selected' : '' }}>Marketing Officer</option>
            <option value="Security Guard" {{ old('position', $staff->position ?? '') == 'Security Guard' ? 'selected' : '' }}>Security Guard</option>
            <option value="Security Guard" {{ old('position', $staff->position ?? '') == 'Security Guard' ? 'selected' : '' }}>Security Guard</option>
            <option value="Security Guard and Driver" {{ old('position', $staff->position ?? '') == 'Security Guard and Driver' ? 'selected' : '' }}>Security Guard and Driver</option>
            <option value="Car Technician" {{ old('position', $staff->position ?? '') == 'Car Technician' ? 'selected' : '' }}>Car Technician</option>
            <option value="Admin" {{ old('position', $staff->position ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
        </select>

        @error('position')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Phone Number</label>
        <input type="text"
               name="phone"
               class="form-control"
               placeholder="012345678"
               value="{{ old('phone', $staff->phone ?? '') }}">

        @error('phone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email"
               name="email"
               class="form-control"
               placeholder="staff@pskormotors.com"
               value="{{ old('email', $staff->email ?? '') }}">

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Hire Date</label>
        <input type="date"
               name="hire_date"
               class="form-control"
               value="{{ old('hire_date', $staff->hire_date ?? '') }}">

        @error('hire_date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Staff Type</label>
        <select name="staff_type" class="form-select">
            <option value="">Select Staff Type</option>
            <option value="Full-time" {{ old('staff_type', $staff->staff_type ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="Part-time" {{ old('staff_type', $staff->staff_type ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="Freelance" {{ old('staff_type', $staff->staff_type ?? '') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
            <option value="Manager" {{ old('staff_type', $staff->staff_type ?? '') == 'Manager' ? 'selected' : '' }}>Manager</option>
        </select>

        @error('staff_type')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="Active" {{ old('status', $staff->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ old('status', $staff->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="Resigned" {{ old('status', $staff->status ?? '') == 'Resigned' ? 'selected' : '' }}>Resigned</option>
        </select>

        @error('status')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label fw-semibold">Remark</label>
        <textarea name="remark"
                  rows="3"
                  class="form-control"
                  placeholder="Example: Sales team leader, freelance agent, specializes in Korean vehicles...">{{ old('remark', $staff->remark ?? '') }}</textarea>

        @error('remark')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

</div>