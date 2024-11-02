<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::orderBy('id', 'desc')->get();

        return response()->json([
            "data" => $sensors,
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "nama_sensor" => "required",
            "data" => "required",
            "topic" => "required",
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "data" => $validatedData->errors(),
            ], 422);
        }

        Sensor::create($validatedData->validate());

        return response()->json([
            "data" => $validatedData->validate(),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            "nama_sensor" => "required",
            "data" => "required",
            "topic" => "required",
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "data" => $validatedData->errors(),
            ], 422);
        }

        Sensor::where('id', $id)->update($validatedData->validate());

        return response()->json([
            "data" => $validatedData->validate(),
        ], 200);
    }

    public function delete($id)
    {
        $sensor = Sensor::where('id', $id);
        $data = $sensor->first();

        if (!$sensor->first()) {
            return response()->json([
                "data" => "Data tidak ditemukan",
            ], 400);
        }

        $sensor->delete();

        return response()->json([
            "data" => $data,
        ], 200);
    }
}
