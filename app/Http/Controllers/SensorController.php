<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::orderBy('id', 'desc')->paginate(5);

        return view('sensors.index', compact('sensors'));
    }

    public function create()
    {
        return view('sensors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama_sensor" => "required|min:2",
            "data" => "required",
            "topic" => ["required", "min:2"],
        ]);

        // $sensor = [
        //     "nama_sensor" => $request->input('nama_sensor'),
        //     "data" => $request->input('data'),
        //     "topic" => $request->input('topic'),
        // ];

        Sensor::create($validatedData);

        return redirect('/sensors')->with('success', 'Berhasil menambahkan data sensor!');
    }

    public function edit($id)
    {
        $sensor = Sensor::find($id);

        return view('sensors.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "nama_sensor" => "required|min:2",
            "data" => "required",
            "topic" => ["required", "min:2"],
        ]);

        // $sensor = [
        //     "nama_sensor" => $request->input('nama_sensor'),
        //     "data" => $request->input('data'),
        //     "topic" => $request->input('topic'),
        // ];

        Sensor::where('id', $id)->update($validatedData);

        return redirect('/sensors')->with('success', 'Berhasil mengubah data sensor!');
    }

    public function delete($id)
    {
        Sensor::where('id', $id)->delete();

        return redirect('/sensors')->with('success', 'Berhasil menghapus data sensor!');
    }
}
