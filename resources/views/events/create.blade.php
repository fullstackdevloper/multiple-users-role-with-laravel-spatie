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


                        <form method="post" action="{{ route('event.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="roles" :value="__('SubCategory')" />
                                <x-text-select id="subcategory" name="subcategory_id" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="name" >
                                    @foreach ($subcategories as $cat)
                                        <option value="{{ $cat->id }}" class="uppercase">{{ $cat->title }}</option>
                                    @endforeach
                                </x-text-select>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Description')" />
                                <textarea id="desc" name="description" type="text"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required autofocus></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div>
                                <div id="image-preview" class="flex flex-row"></div>
                                <x-input-label for="images" :value="__('Images')" />
                                <input name="images[]" id="multiple_files"  type="file" multiple class="mt-1 block w-full border border-gray-300 rounded-lg dark:text-gray-400 block focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:border-gray-600 dark:placeholder-gray-400" />
                                <x-input-error class="mt-2" :messages="$errors->get('images')" />
                            </div>
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input type="text" id="startdatetime" name="start_time"  placeholder="yyyy/mm/dd --:--" autocomplete="off" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <x-text-input type="text" id="enddatetime" name="end_time" placeholder="yyyy/mm/dd --:--" autocomplete="off" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                            </div>
                            <div>
                                <x-input-label for="fee_per_seat" :value="__('Fee Per/Seat')" />
                                <x-text-input type="number" id="fee_per_seat" name="fee_per_seat" class="mt-1 block w-full border border-gray-300 rounded-lg  dark:text-gray-400 block focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:border-gray-600 dark:placeholder-gray-400"/>
                                <x-input-error class="mt-2" :messages="$errors->get('fee_per_seat')" />
                            </div>
                            <div>
                                <x-input-label for="seats" :value="__('Seats')" />
                                <x-text-input type="number" id="seats" name="seats" class="mt-1 block w-full"/>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
