<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\CreateEventRequestValidation;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class EventsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $events = Event::latest()->paginate(10);
            return response()->json($events, 200);
        } catch (QueryException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 500);
        }
    }

    /**
     * @param CreateEventRequestValidation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEventRequestValidation $request)
    {
        try {
            $event = new Event();
            if($event->where('date', $request->date)->exists()) {
                return response()->json(["message" => "Already have an event on this date, Please select another date to continue."], 400);
            }

            $event->uid= mt_rand(10000000,99999999);
            $event->name= $request->name;
            $event->author= $request->author;
            $event->description= $request->description;
            $event->date= $request->date;
            $event->time_from= $request->time_from;
            $event->time_to= $request->time_to;
            $event->total_seat= $request->total_seat;
            $event->type= $request->type;
            $event->created_by= auth('admin')->id();
            $event->save();
            return response()->json(["data" => $event], 201);
        } catch(QueryException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 500);
        }
    }

    /**
     * @param CreateEventRequestValidation $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateEventRequestValidation $request, $id)
    {
        try {
            $event = Event::find($id);
            $event->name= $request->name;
            $event->author= $request->author;
            $event->description= $request->description;
            $event->date= $request->date;
            $event->time_from= $request->time_from;
            $event->time_to= $request->time_to;
            $event->total_seat= $request->total_seat;
            $event->type= $request->type;
            $event->modified_by= auth('admin')->id();
            $event->save();
            return response()->json(["data" => $event], 200);
        } catch(ModelNotFoundException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 400);
        } catch(QueryException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $event = Event::find($id);
            return response()->json(["data" => $event], 200);
        } catch(ModelNotFoundException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $event = Event::find($id);
            if($event->event_users()->exists()) {
                return response()->json(["message" => "You can't delete this event because some users already registered."], 400);
            }
            $event->delete();
            return response()->json(["message" => "Successfully deleted!"], 200);
        } catch(ModelNotFoundException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 400);
        } catch(QueryException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 500);
        }
    }
}
