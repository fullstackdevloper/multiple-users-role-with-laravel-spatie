<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
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
                                    <img class="w-40 p-2" src="{{asset('storage/images/'.$item)}}" alt="image description">
                                    @endforeach

                                </div>
                            </div>
                            <div>
                                <x-input-label for="images" :value="__('Images')" />
                                <input name="images[]"  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" accept="image/jpeg,image/png,image/jpg" type="file" multiple>
                                <x-input-error class="mt-2" :messages="$errors->get('images[]')" />
                                <div id="image-preview" class="flex flex-row mt-2"></div>
                            </div>
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input type="text" id="startdatetime" name="start_time" value="{{$event->start_time}}" placeholder="yyyy/mm/dd --:--" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <x-text-input type="text" id="enddatetime" name="end_time" value="{{$event->end_time}}" placeholder="yyyy/mm/dd --:--" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                            </div>
                            <div>
                                <x-input-label for="fee_per_seat" :value="__('Fee Per/Seat')" />
                                <x-text-input type="number" id="fee_per_seat" name="fee_per_seat" value="{{$event->fee_per_seat}}" class="mt-1 block w-full border border-gray-300 rounded-lg  dark:text-gray-400 block focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:border-gray-600 dark:placeholder-gray-400"/>
                                <x-input-error class="mt-2" :messages="$errors->get('fee_per_seat')" />
                            </div>
                            <div>
                                <x-input-label for="seats" :value="__('Seats')" />
                                <x-text-input type="number" id="seats" name="seats" value="{{$event->seats_available}}"  class="mt-1 block w-full"/>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script>
        $("#startdatetime").datetimepicker({
            minDate:new Date(),
            onChangeDateTime: function(selectedDateTime) {
                hours = selectedDateTime.getHours() + 1;
                mins = selectedDateTime.getMinutes();
                time = hours + ':' + mins;
                $start = $('#startdatetime').val();
                $end = $("#enddatetime").val();
                $('#enddatetime').datetimepicker('setOptions', {minDate:selectedDateTime,minTime:time});
                if($start>$end){
                    $('#enddatetime').val($start);
                }
            }
        });
        $("#enddatetime").datetimepicker({
            minDate:new Date(),
            onChangeDateTime: function(selectedDateTime) {
                $start = $('#startdatetime').val();
                $end = $("#enddatetime").val();
                if($start>$end){
                    $('#startdatetime').val($end);
                }
            }
        });
    </script>
        <script>
            $(document).ready(function() {
                $('#multiple_files').on('change', function() {
                    var files = this.files;
                    $('#image-preview').empty();
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image-preview').append('<img class="h-auto w-40 mx-1 rounded" src="' + e.target.result + '" alt="image preview">');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
</x-app-layout>
