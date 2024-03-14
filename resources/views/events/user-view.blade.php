<x-app-layout>
<div class="flex flex-wrap justify-center">
    @forelse ($events as $event)
        <a href="#" class="m-2 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <?php $images = explode(',',$event->images)?>
            <img class="object-cover w-full rounded-t-lg h-96  md:w-48 md:rounded-none md:rounded-s-lg" src="{{asset('storage/images/'.$images[0])}}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$event->title}}</h5>
                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400">{{$event->description}}</p>
                <p class="mb-3 text-sm font-normal text-black-700 dark:text-gray-400"><span class="font-black">Start : </span>{{$event->start_time}}</p>
                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400"><span class="font-black">End : </span>{{$event->end_time}}</p>
                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400"><span class="font-black">Seats : </span>{{$event->seats_available}}</p>
                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400"><span class="font-black">Per/Seat </span>₹ {{$event->fee_per_seat}}</p>
                    {{-- <button x-data="" @click.prevent="$dispatch('open-subscription-modal',{{$event->id}})" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Subscribe
                    </button> --}}
                    <?php $subscribed = App\Models\EventSubscription::where('user_id',Auth::user()->id)->pluck('event_id')->toArray() ?>
                    @if(in_array($event->id,$subscribed))
                    <button   class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 card-button">Subscribed</button>
                    @else
                    <button onclick="link({{$event->id}})"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 card-button">Subscribe</button>
                    @endif
                  
                </div>
        </a>
        @empty
                 <div class="text-center text-gray-700 dark:text-gray-400 text-4xl">No events found</div>
        @endforelse
    </div>
    
        <!-- Modal toggle button -->
        {{-- <x-subscription-modal >

            <form class="mt-6 " >
                <div class="col-span-2 sm:col-span-1">
                        <p><span class="font-black">Event :</span> {{$event->title}} </p>
                        <p><span class="font-black">Seats :</span> 80</p>
                        <p><span class="font-black">Start :</span> Crickerter</p>
                        <p><span class="font-black">End :</span> Crickerter</p>
                </div>
                <div class="col-span-2 sm:col-span-1">
                        <label for="seats" class="block mb-2 text-sm font-black text-gray-900 dark:text-white">Seats</label>
                        <input type="number" name="seats" id="seats" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="No. of seats" required>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-2">
                <!-- $event.target.getAttribute('id') -->
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                   Pay <span x-text="id" ></span>
                </button>
            </form>
        </x-subscription-modal> --}}
        <!-- Main modal -->

<script>
    function link(id) {
        var routeUrl = "{{ route('userevent.edit', ['userevent' => ':id']) }}";
        routeUrl = routeUrl.replace(':id', id);
        window.location.href = routeUrl;
    }
</script>
        
        
</x-app-layout>