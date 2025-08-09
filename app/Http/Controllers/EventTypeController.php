<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;
use App\Http\Requests\StoreEventTypeRequest;
use App\Http\Requests\UpdateEventTypeRequest;
use Illuminate\Http\JsonResponse;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $eventTypes = auth()->user()->eventTypes;
        return response()->json($eventTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventTypeRequest $request): JsonResponse
    {
        $eventType = auth()->user()->eventTypes()->create($request->validated());
        return response()->json($eventType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventType $eventType): JsonResponse
    {
        $this->authorize('view', $eventType);
        return response()->json($eventType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventTypeRequest $request, EventType $eventType): JsonResponse
    {
        $this->authorize('update', $eventType);
        $eventType->update($request->validated());
        return response()->json($eventType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventType $eventType): JsonResponse
    {
        $this->authorize('delete', $eventType);
        $eventType->delete();
        return response()->json(null, 204);
    }
}