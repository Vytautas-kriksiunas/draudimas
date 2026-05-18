<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Requests\CarRequest;
use App\Models\CarPhoto;

class CarController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $owners = Owner::all();
        return view('cars.edit', compact('car','owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car)
    {
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
