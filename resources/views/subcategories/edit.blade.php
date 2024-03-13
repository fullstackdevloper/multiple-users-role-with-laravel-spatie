<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update SubCategory') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Update SubCategory Information') }}
                            </h2>

                        </header>

                        <form method="post" action="{{ route('subcategory.update', ['subcategory' => $category->id]) }}"
                            class="mt-6 space-y-6" >
                            @csrf
                            @method('patch')
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    value="{{$category->title}}" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="roles" :value="__('Parent Category')" />
                                <x-text-select id="category" name="category" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="name" >
                                    @foreach ($categories as $cat)
                                    @if($category->category_id == $cat->id)
                                        <option value="{{ $cat->id }}" class="uppercase" selected>{{ $cat->title }}</option>
                                    @endif
                                        <option value="{{ $cat->id }}" class="uppercase">{{ $cat->title }}</option>
                                    @endforeach
                                </x-text-select>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>
                            <div>
                                <x-input-label for="desc" :value="__('Description')" />
                                <textarea id="desc" name="description" type="text"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required autofocus>{{$category->description}}"</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
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
