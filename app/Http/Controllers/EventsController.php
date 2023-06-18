<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Image;
use App\Http\Requests\CreateEventRequest;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events= Event::getAll();
        return response()->json($events);
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
    public function store(CreateEventRequest $request)
    {
        $event =  new Event();
        $event->title=$request ->title;
        $event->description = $request->description;
        $event->user_id= auth()->user()->id;
        $event->save();

        $imgs=[];
        foreach($request-> images as $img){
            $imgs[]= new Image($img);
        }

        $event->images()->saveMany($imgs);
        return $this->show($event->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::with(['images','user','comments','comments.user'])->find($id);
        return $event;
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
    public function update(CreateEventRequest $request, string $id)
    {
        $event = Event::find($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event -> user_id ->auth()->user()->id;
        $event->save();

        $event->images()->delete();
        $imgs=[];
        foreach($request->images as $img){
        $imgs[] = new Image($img) ;
        }
        $event->images()->saveMany($imgs);
        return $this->show($event->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->delete();

        return response()->json([
            'message' => 'Event deleted'
        ]);

    }
}