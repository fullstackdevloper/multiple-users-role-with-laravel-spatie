<?php

namespace App\Repositories;

use App\Models\Events;
use App\Services\UploadImages;


class EventRepository extends BaseRepository {

    public $uploadImages;
    public function __construct(Events $events ,UploadImages $uploadImages) {
        parent::__construct($events);
        $this->uploadImages = $uploadImages;
    }
    public function addEvent($event)
    {

        $files  = $this->uploadImages->uploadImageFiles($event['images']);
        $start = date('Y-m-d H:i:s', strtotime($event['start_time']));
        $end = date('Y-m-d H:i:s', strtotime($event['end_time']));
        $event = $this->create(['title' => $event['title'],'subcategory_id'=>$event['subcategory_id'],'description'=> $event['description'],'images'=>$files,'start_time'=>$start,'end_time'=>$end,'fee_per_seat'=>$event['fee_per_seat'],'seats_available'=>$event['seats']]);
        return $event;
    }
    public function deleteEvent($id){
        $event = $this->deleteById($id);
        return $event;
    }
    public function updateEvent($id , $event){
        if (!empty($event['images'])) {
            $files = $this->uploadImages->uploadImageFiles($event['images']);
        }else{
            $images = $this->find($id);
            $files = $images->images;
        }
        $start = date('Y-m-d H:i:s', strtotime($event['start_time']));
        $end = date('Y-m-d H:i:s', strtotime($event['end_time']));
        $updated = $this->updateByCriteria(['id'=>$id],['title' => $event['title'],'subcategory_id'=>$event['subcategory_id'],'description'=> $event['description'],'images'=>$files,'start_time'=>$start,'end_time'=>$end,'fee_per_seat'=>$event['fee_per_seat'],'seats_available'=>$event['seats']]);
        return $updated;
    }
}