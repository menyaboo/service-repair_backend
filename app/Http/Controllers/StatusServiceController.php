<?php

namespace App\Http\Controllers;

use App\Models\StatusService;
use Illuminate\Http\Request;

class StatusServiceController extends Controller
{
    public function index()
    {
        return StatusService::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        return StatusService::create($data);
    }

    public function show(StatusService $statusService)
    {
        return $statusService;
    }

    public function update(Request $request, StatusService $statusService)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $statusService->update($data);

        return $statusService;
    }

    public function destroy(StatusService $statusService)
    {
        $statusService->delete();

        return response()->json();
    }
}
