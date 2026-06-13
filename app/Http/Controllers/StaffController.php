<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $staff = Staff::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                      ->orWhere('position', 'ILIKE', "%{$search}%")
                      ->orWhere('phone', 'ILIKE', "%{$search}%")
                      ->orWhere('email', 'ILIKE', "%{$search}%")
                      ->orWhere('staff_type', 'ILIKE', "%{$search}%")
                      ->orWhere('status', 'ILIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('staff.index', compact('staff', 'search'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'hire_date' => 'nullable|date',
            'staff_type' => 'nullable',
            'status' => 'required',
            'remark' => 'nullable'
        ]);

        Staff::create($request->all());

        return redirect()->route('staff.index')->with('success', 'Staff registered successfully.');
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'hire_date' => 'nullable|date',
            'staff_type' => 'nullable',
            'status' => 'required',
            'remark' => 'nullable'
        ]);

        $staff->update($request->all());

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
}