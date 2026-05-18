<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Requests\OwnerRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OwnerController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            $owners = Owner::all();
        } elseif ($user->privilege === 'admin' || $user->privilege === 'reader') {
            $owners = Owner::all();
        } else {
            $owners = Owner::where('user_id', $user->id)->get();
        }

        return view('owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OwnerRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        Owner::create($data);
        return redirect()->route('owners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        $this->authorize('update', $owner);
        return view('owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OwnerRequest $request, Owner $owner)
    {
        $this->authorize('update', $owner);
        $owner->update($request->all());
        return redirect()->route('owners.index');
    }

    public function destroy(Owner $owner)
    {
        $this->authorize('delete', $owner);
        $owner->delete();
        return redirect()->route('owners.index');
    }
}
