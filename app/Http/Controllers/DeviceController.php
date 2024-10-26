<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::select('id', 'serial_number', 'meta_data')
        ->orderBy('id', 'desc')
        ->paginate(5);

        return view('devices.index', [
            "devices" => $devices,
        ]);
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(DeviceRequest $request)
    {
        // $validatedData = $request->validate([
        //     "serial_number" => "required|min:2",
        //     "meta_data" => "required",
        // ], [
        //     "serial_number.required" => "Serial number harus diisi!",
        //     "serial_number.min" => "Minimal 2 karakter",
        //     "meta_data.required" => "Meta data harus diisi!",
        // ]);

        $device = [
            "serial_number" => $request->input('serial_number'),
            "meta_data" => $request->input('meta_data'),
        ];

        Device::create($device);

        return redirect('/devices')->with('success', 'Berhasil menambahkan data device!');
    }

    public function edit($id)
    {
        $device = Device::find($id);

        return view('devices.edit', [
            "device" => $device,
        ]);
    }

    public function update(DeviceRequest $request, $id)
    {
        // $validatedData = $request->validate([
        //     "serial_number" => "required|min:2",
        //     "meta_data" => "required",
        // ], [
        //     "serial_number.required" => "Serial number harus diisi!",
        //     "serial_number.min" => "Minimal 2 karakter",
        //     "meta_data.required" => "Meta data harus diisi!",
        // ]);
        $requestDevice = [
            "serial_number" => $request->input('serial_number'),
            "meta_data" => $request->input('meta_data'),
        ];

        $device = Device::where('id', $id);
        $device->update($requestDevice);

        return redirect('/devices')->with('success', 'Berhasil memperbarui data!');
    }

    public function delete($id) {
        $device = Device::where('id', $id);
        $device->delete();

        return redirect('/devices')->with('success', 'Berhasil menghapus data!');
    }
}
