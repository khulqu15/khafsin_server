<?php

namespace App\Http\Controllers;

use App\Events\ImuAdded;
use App\Events\ImuDataUpdated;
use App\Events\ImuDeleted;
use App\Exports\ImusExport;
use App\Models\Imu;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Maatwebsite\Excel\Facades\Excel;

class ImuController extends Controller
{

    public function index(Request $request) {
        try {
            $query = Imu::query();

            if ($request->has(['start_date', 'end_date'])) {
                $start_date = \Carbon\Carbon::parse($request->input('start_date'))->startOfDay();
                $end_date = \Carbon\Carbon::parse($request->input('end_date'))->endOfDay();
                $query->whereBetween('created_at', [$start_date, $end_date]);
            }

            $imus = $query->orderBy('created_at', 'desc')->get();

            if ($request->expectsJson()) {
                return response()->json($imus);
            }

            return view('welcome', compact('imus'));

        } catch (Exception $e) {
            return $this->handleException($e, $request);
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
                'status' => 'nullable|string',
                'description' => 'nullable|string',
                'lat' => 'nullable|numeric',
                'lon' => 'nullable|numeric',
                'alt' => 'nullable|numeric',
            ]);

            $imu = Imu::create($validatedData);

            event(new ImuAdded($imu));

            if ($request->expectsJson()) {
                return response()->json($imu, 201);
            }

            return redirect()->route('imus-web.index')->with('success', 'IMU record created successfully!');

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $imu = Imu::findOrFail($id);
            if ($request->expectsJson()) {
                return response()->json($imu);
            }

            return view('imus.show', compact('imu'));

        } catch (ModelNotFoundException $e) {
            return $this->handleException($e);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $imu = Imu::findOrFail($id);

            $validatedData = $request->validate([
                'x' => 'required|numeric',
                'y' => 'required|numeric',
                'z' => 'required|numeric',
                'location' => 'nullable|string',
                'status' => 'nullable|string',
                'description' => 'nullable|string',
                'lat' => 'nullable|numeric',
                'lon' => 'nullable|numeric',
                'alt' => 'nullable|numeric',
            ]);

            $imu->update($validatedData);

            if ($request->expectsJson()) {
                return response()->json($imu);
            }

            return redirect()->route('imu-web.index')->with('success', 'IMU record updated successfully!');

        } catch (ModelNotFoundException $e) {
            return $this->handleException($e);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $imu = Imu::findOrFail($id);
            $imu->delete();
            event(new ImuDeleted($id));

            if ($request->expectsJson()) {
                return response()->json(['message' => 'IMU record deleted successfully']);
            }
            return redirect()->route('imu-web.index')->with('success', 'IMU record deleted successfully!');


        } catch (ModelNotFoundException $e) {
            return $this->handleException($e);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Delete all IMU records.
     */
    public function deleteAll(Request $request)
    {
        try {
            Imu::truncate();

            if ($request->expectsJson()) {
                return response()->json(['message' => 'All IMU records deleted successfully!']);
            }

            return redirect()->route('imu-web.index')->with('success', 'All IMU records deleted successfully!');

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting records'], 500);
        }
    }

    /**
     * Export IMU data to Excel.
     */
    public function export()
    {
        return Excel::download(new ImusExport, 'imus_data.xlsx');
    }


    /**
     * Delete selected IMU records.
     */
    public function deleteSelected(Request $request)
    {
        try {
            $ids = $request->input('ids');
            Imu::destroy($ids);

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Selected IMU records deleted successfully!']);
            }

            return redirect()->route('imu-web.index')->with('success', 'Selected IMU records deleted successfully!');

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting records'], 500);
        }
    }
}
