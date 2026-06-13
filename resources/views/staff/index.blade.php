@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Staff Management</h3>
        <p class="text-muted mb-0">Manage staff records, employment status, contact information, and role details.</p>
    </div>

    <a href="{{ route('staff.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Register Staff
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Total Staff Records</small>
            <h4 class="fw-bold mb-0">{{ $staff->total() }}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Records This Page</small>
            <h4 class="fw-bold mb-0">{{ $staff->count() }}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Current Page</small>
            <h4 class="fw-bold mb-0">{{ $staff->currentPage() }}</h4>
        </div>
    </div>
</div>

<div class="card shadow-sm p-3 mb-4">
    <form method="GET" class="row g-2">
        <div class="col-md-10">
            <input type="text"
                   id="staffSearch"
                   name="search"
                   value="{{ $search }}"
                   class="form-control"
                   placeholder="Search staff name, position, phone, email, type, or status"
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
                        <th>Staff</th>
                        <th>Role</th>
                        <th>Contact</th>
                        <th>Employment</th>
                        <th>Remark</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($staff as $s)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $s->name }}</div>
                            <small class="text-muted">Staff ID: #{{ $s->id }}</small>
                        </td>

                        <td>
                            <span class="badge bg-dark">{{ $s->position }}</span>
                            <br>
                            <small class="text-muted">{{ $s->staff_type ?? '-' }}</small>
                        </td>

                        <td>
                            <div>
                                <i class="bi bi-telephone text-muted"></i>
                                {{ $s->phone }}
                            </div>

                            <small class="text-muted">
                                <i class="bi bi-envelope"></i>
                                {{ $s->email ?? '-' }}
                            </small>
                        </td>

                        <td>
                            @if(($s->status ?? 'Active') == 'Active')
                                <span class="badge bg-success">Active</span>
                            @elseif($s->status == 'Inactive')
                                <span class="badge bg-warning text-dark">Inactive</span>
                            @else
                                <span class="badge bg-secondary">Resigned</span>
                            @endif

                            <br>

                            <small class="text-muted">
                                Hire Date:
                                {{ $s->hire_date ? \Carbon\Carbon::parse($s->hire_date)->format('d M Y') : '-' }}
                            </small>
                        </td>

                        <td>
                            <small class="text-muted">
                                {{ $s->remark ?? '-' }}
                            </small>
                        </td>

                        <td>
                            <a href="{{ route('staff.edit', $s->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('staff.destroy', $s->id) }}"
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
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-person-workspace fs-1 d-block mb-2"></i>
                            No staff records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $staff->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

<script>
const staffSearch = document.getElementById('staffSearch');

if (staffSearch) {
    staffSearch.focus();
    staffSearch.setSelectionRange(staffSearch.value.length, staffSearch.value.length);
}
</script>
@endsection