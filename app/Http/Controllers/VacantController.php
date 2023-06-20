<?php

namespace App\Http\Controllers;

use App\Models\Vacant;
use Illuminate\Http\Request;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Vacant::class);

        return view('vacants.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Vacant::class);

        return view('vacants.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacant $vacant)
    {
        return view('vacants.show', [
            'vacant' => $vacant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacant $vacant)
    {
        $this->authorize('update', $vacant);

        return view('vacants.edit', [
            'vacant' => $vacant
        ]);
    }
}
