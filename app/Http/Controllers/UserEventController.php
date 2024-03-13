<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Repositories\EventRepository;
use App\Repositories\UserEventRepository;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    protected $eventRepository;
    protected $eventSubscriptionRepository;
    public function __construct(EventRepository $eventRepository, UserEventRepository $eventSubscriptionRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->eventSubscriptionRepository = $eventSubscriptionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->eventRepository->all();
        return view('events.user-view',compact('events'));
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
    public function store(SubscriptionRequest $request)
    {

        $subscription = $this->eventSubscriptionRepository->makeSubscription($request->userevent,$request->validated());
        if($subscription){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Event Subscribed !!']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Please Select Valid number of seats !!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = $this->eventRepository->find($id);
        return view('events.user-event-edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
