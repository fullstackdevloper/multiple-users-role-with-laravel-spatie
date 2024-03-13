<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Event') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Event Information') }}
                            </h2>

                        </header>


                        <form method="post" action="{{ route('event.update', ['event' => $event->id]) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    value="{{$event->title}}" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="roles" :value="__('SubCategory')" />
                                <x-text-select id="subcategory" name="subcategory_id" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="name" >
                                    @foreach ($subcategories as $cat)
                                    @if($cat->id == $event->subcategory_id)
                                        <option value="{{ $cat->id }}" class="uppercase" selected>{{ $cat->title }}</option>
                                    @endif
                                        <option value="{{ $cat->id }}" class="uppercase">{{ $cat->title }}</option>
                                    @endforeach
                                </x-text-select>
                                <x-input-error class="mt-2" :messages="$errors->get('subcategory_id')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Description')" />
                                <textarea id="desc" name="description" type="text"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required autofocus>{{$event->description}}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div>
                                Existing Images
                                <?php $images = explode(',',$event->images); ?>
                                <div class="flex ">
                                    @foreach ($images as $item)
                                    <img class="w-40 p-2" src="{{asset('category_images/'.$item)}}" alt="image description">
                                    @endforeach

                                </div>
                            </div>
                            <div>
                                <x-input-label for="images" :value="__('Images')" />
                                <input name="images[]"  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" accept="image/jpeg, image/png , image/jpg" type="file" multiple>
                                <x-input-error class="mt-2" :messages="$errors->get('images[]')" />
                            </div>
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <input type="datetime-local" id="start_time" name="start_time" value="{{$event->start_time}}">
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <input type="datetime-local" id="end_time" name="end_time" value="{{$event->end_time}}">
                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                            </div>
                            <div>
                                <x-input-label for="fee_per_seat" :value="__('Fee Per/Seat')" />
                                <input type="number" id="fee_per_seat" name="fee_per_seat" value="{{$event->fee_per_seat}}">
                                <x-input-error class="mt-2" :messages="$errors->get('fee_per_seat')" />
                            </div>
                            <div>
                                <x-input-label for="seats" :value="__('Seats')" />
                                <input type="number" id="seats" name="seats" value="{{$event->seats_available}}">
                                <x-input-error class="mt-2" :messages="$errors->get('seats')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'role-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
