<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Category') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Update Category Information') }}
                            </h2>

                        </header>

                        <form method="post" action="{{ route('category.update', ['category' => $category->id]) }}"
                            class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    value="{{$category->title}}" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Description')" />
                                <textarea id="desc" name="description" type="text"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required autofocus>{{$category->description}}"</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div>
                                Existing Images
                                <?php $images = explode(',',$category->images); ?>
                                <div class="flex ">
                                    @foreach ($images as $item)
                                    <img class="w-40 p-2" src="{{asset('storage/images/'.$item)}}" alt="image description">
                                    @endforeach

                                </div>
                            </div>
                            <div>
                                <x-input-label for="images" :value="__('Images')" />
                                <input name="images[]" value="" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" accept="image/jpeg, image/png , image/jpg" type="file" multiple>
                                <x-input-error class="mt-2" :messages="$errors->get('images[]')" />
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
