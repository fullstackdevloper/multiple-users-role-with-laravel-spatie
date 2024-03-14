<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Events;
use App\Repositories\EventRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $eventRepository;
    protected $subCategoryRepository;
    protected $limit = 10;
    public function __construct(EventRepository $eventRepository, SubCategoryRepository $subCategoryRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->eventRepository->paginate($this->limit,[],['subcategory']);
        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = $this->subCategoryRepository->all();
        return view('events.create',compact('subcategories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $event = $this->eventRepository->addEvent($request->validated());
        if($event){
            return redirect()->back()->with(['status'=>'success','message'=>'Event Added Successfully!']);
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
    public function edit(Events $event)
    {
        $subcategories = $this->subCategoryRepository->all();
        return view('events.edit',compact('event','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventUpdateRequest $request, string $id)
    {

        $event  = $this->eventRepository->updateEvent($id,$request->validated());
        if($event){
            return redirect()->back()->with(['status'=>'success','message'=>'Event Updation Successfull!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = $this->eventRepository->deleteEvent($id);
        if($event){
            return redirect()->back()->with(['status'=>'success','message'=>'Event Deletion Successfull!']);
        }
    }
}
