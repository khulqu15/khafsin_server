<?php

namespace App\Http\Controllers;

use App\Models\Imu;
use Exception;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
