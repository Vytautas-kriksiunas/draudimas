<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Requests\CarRequest;
use App\Models\CarPhoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->privilege === 'admin' || $user->privilege === 'reader') {
            $cars = Car::all();
        } else {
            $cars = Car::whereHas('owner', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();
        }

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Car::class);
        $owners = Owner::all();
        return view('cars.create', compact('owners'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $car = Car::create($request->all());

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = $photo->hashName();
                // Naudojame move(), kad failas atsirastų tiesiai public kataloge
                $photo->move(public_path('photos/carphotos'), $filename);

                CarPhoto::create([
                    'car_id' => $car->id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect()->route('cars.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        $owners = Owner::all();
        return view('cars.edit', compact('car','owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car)
    {
        $this->authorize('update', $car);
        $car->update($request->all());

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = $photo->hashName();
                $photo->move(public_path('photos/carphotos'), $filename);

                CarPhoto::create([
                    'car_id' => $car->id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        // Ištriname fizinius nuotraukų failus iš public katalogo prieš ištrinant automobilį
        foreach ($car->photos as $photo) {
            $filePath = public_path('photos/carphotos/' . $photo->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $photo->delete();
        }

        $car->delete();
        return redirect()->route('cars.index');
    }


    public function destroyPhoto(CarPhoto $photo)
    {
        if ($photo->filename != null) {
            $filePath = public_path('photos/carphotos/' . $photo->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $photo->delete();
        }
        return redirect()->back();
    }

}
