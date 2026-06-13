<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $cars = Car::query()
            ->when($search, function ($query) use ($search) {
                $query->where('brand', 'ILIKE', "%{$search}%")
                      ->orWhere('model', 'ILIKE', "%{$search}%")
                      ->orWhere('year', 'ILIKE', "%{$search}%")
                      ->orWhere('color', 'ILIKE', "%{$search}%")
                      ->orWhere('engine_number', 'ILIKE', "%{$search}%")
                      ->orWhere('frame_number', 'ILIKE', "%{$search}%")
                      ->orWhere('fuel_type', 'ILIKE', "%{$search}%")
                      ->orWhere('body_type', 'ILIKE', "%{$search}%")
                      ->orWhere('condition', 'ILIKE', "%{$search}%")
                      ->orWhere('status', 'ILIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('cars.index', compact('cars', 'search'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'color' => 'nullable',
            'mileage' => 'nullable|integer',
            'engine_number' => 'nullable',
            'frame_number' => 'nullable',
            'transmission' => 'nullable',
            'fuel_type' => 'nullable',
            'body_type' => 'nullable',
            'condition' => 'nullable',
            'remark' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'status' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('cars', 'public');
        }

        Car::create($data);

        return redirect()
            ->route('cars.index')
            ->with('success', 'Vehicle registered successfully.');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'color' => 'nullable',
            'mileage' => 'nullable|integer',
            'engine_number' => 'nullable',
            'frame_number' => 'nullable',
            'transmission' => 'nullable',
            'fuel_type' => 'nullable',
            'body_type' => 'nullable',
            'condition' => 'nullable',
            'remark' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'price' => 'required|numeric',
            'status' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {

            if ($car->photo) {
                Storage::disk('public')->delete($car->photo);
            }

            $data['photo'] = $request->file('photo')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()
            ->route('cars.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Car $car)
    {
        if ($car->photo) {
            Storage::disk('public')->delete($car->photo);
        }

        $car->delete();

        return redirect()
            ->route('cars.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
