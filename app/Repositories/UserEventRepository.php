<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Models\EventSubscription;
use App\Services\UploadImages;
use Illuminate\Support\Facades\Auth;

class UserEventRepository extends BaseRepository {

    protected $eventRepository;
    public function __construct(EventSubscription $eventSubscription, EventRepository $eventRepository) {
        parent::__construct($eventSubscription);
        $this->eventRepository = $eventRepository;
    }
    public function makeSubscription($id,$subscription)
    {
        $event = $this->eventRepository->find($id);
        if($event->seats_available > $subscription['seats']){
            $seats_left = $event->seats_available-$subscription['seats'];
        }
        else{
            return false;
        }
        $update_event = $this->eventRepository->updateByCriteria(['id'=>$id],['seats_available'=> $seats_left]);
        $subscription = $this->create(['event_id' => $id,'user_id'=> Auth::user()->id,'seats'=>$subscription['seats']]);
        return $subscription;
    }
    // public function destroyCategory($id){
    //     $category = $this->deleteById($id);
    //     return $category;
    // }
    // public function updateCategory($id , $category){

    //     if (!empty($category['images'])) {
    //         $files = $this->uploadImages->uploadImageFiles($category['images']);
    //     }else{
    //         $images = $this->find($id);
    //         $files = $images->images;
    //     }
    //     $updated = $this->updateByCriteria(['id'=>$id],['title'=>$category['title'],'description'=>$category['description'],'images'=>$files]);
    //     return $updated;
    // }
}