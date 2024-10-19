<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::select('id', 'serial_number', 'meta_data')
        ->orderBy('id', 'desc')
        ->get();

        return view('devices.index', [
            "devices" => $devices,
        ]);
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
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

    public function update(Request $request, $id)
    {
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
