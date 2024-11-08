<?php

namespace App\Http\Controllers;

use App\Models\Imu;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ImuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Imu::query();

            if ($request->has(['start_date', 'end_date'])) {
                $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
                $end_date = Carbon::parse($request->input('end_date'))->endOfDay();
                $query->whereBetween('created_at', [$start_date, $end_date]);
            }
            $imus = $query->orderBy('created_at', 'desc')->get();
            return response()->json($imus);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'x' => 'required|numeric',
                'y' => 'required|numeric',
                'z' => 'required|numeric',
                'location' => 'nullable|string',
                'lat' => 'nullable|numeric',
                'lon' => 'nullable|numeric',
                'alt' => 'nullable|numeric',
            ]);

            $imu = Imu::create($validatedData);

            return response()->json($imu, 201);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $imu = Imu::findOrFail($id);
            return response()->json($imu);

        } catch (ModelNotFoundException $e) {
            return $this->handleException($e);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
