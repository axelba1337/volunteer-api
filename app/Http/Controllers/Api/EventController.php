<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event; // wajib
use App\Http\Resources\EventResource; // wajib
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        // Pagination (Bonus)
        $events = Event::withCount('users')->paginate(10);
        return EventResource::collection($events);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date'
        ]);
        $event = Event::create($request->all());
        return new EventResource($event);
    }

    public function show($id) {
        $event = Event::with('users')->findOrFail($id);
        return new EventResource($event);
    }

    // tambah Request $request ke parameter
    public function join(Request $request, $id) 
    {
        $event = Event::findOrFail($id);
        
        // Gunakan $request->user() alih-alih auth()->user()
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Cek agar tidak join dua kali
        if (!$event->users()->where('user_id', $user->id)->exists()) {
            $event->users()->attach($user->id);
            return response()->json(['message' => 'Berhasil bergabung ke event']);
        }
        
        return response()->json(['message' => 'Anda sudah terdaftar'], 400);
    }
}