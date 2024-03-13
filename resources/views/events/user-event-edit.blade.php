<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscribe Event') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Event Subscription') }}
                            </h2>

                        </header>

                            <div>
                                <h3 class="text-lg">Title :</h3>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    value="{{$event->title}}" required autofocus autocomplete="title" disabled/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div class="flex flex-row ">
                                <div class="m-2">
                                    <x-input-label for="start_time" :value="__('Start Time')" />
                                    {{$event->start_time}}

                                </div>
                                <div class="m-2">
                                    <x-input-label for="end_time" :value="__('End Time')" />
                                    {{$event->end_time}}
                                </div>
                            </div>
                            <div class="flex flex-row ">
                                <div class="m-2">
                                    <x-input-label for="fee_per_seat" :value="__('Per/Seat')" />
                                    ₹ {{$event->fee_per_seat}}

                                </div>
                                <div class="m-2">
                                    <x-input-label for="seats" :value="__('Seats')" />
                                    {{$event->seats_available}}
                                </div>
                            </div>
                         
                        <form method="post" action="{{ route('userevent.store',['userevent'=>$event->id]) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                                @csrf
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="seats" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats</label>
                                    <input type="number" min="1" max="{{$event->seats_available}}" name="seats" id="seats" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="No. of seats" required="">
                                    <span id="errorMsg" class="hidden text-red-500">Minimum Number of seats is 1 and cannot exceed {{$event->seats_available}}</span>
                                </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Subscribe') }}</x-primary-button>

                                @if (session('status') === 'role-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                                <div class="total">
                                    <p>Seats : <span id="seats_selected">0</span></p>
                                    <p>Total : <span id="total_price">0</span></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('#seats').on('keyup',function(e){
        seats = $(this).val();
        seats_available = parseInt('{{$event->seats_available}}');
        if(seats >= 1)
        {
            if (seats > seats_available && seats > 1) {
            $(this).val('');
            seats = $(this).val();
            $('#errorMsg').removeClass('hidden')
            }else{
                $('#errorMsg').addClass('hidden')
                price = '{{$event->fee_per_seat}}'
                setTimeout(() => {
                    total = seats*price;
                    $('#seats_selected').text(seats)
                    $('#total_price').text(total)
                }, 1000);
            }
        }else{
            $(this).val('');
            seats = $(this).val();
            $('#errorMsg').removeClass('hidden')
        }
       
    })

</script>
</x-app-layout>
