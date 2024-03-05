<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Update') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Role Information') }}
                        </h2>

                    </header>


                    <form method="post" action="{{ route('roles.update', ['role' => $role->id]) }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input readonly id="name" name="name" type="text"
                                class="mt-1 block w-full" :value="old('name', $role->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="grid grid-cols-5 gap-4">
                            @foreach ($permissions as $permission)
                                <div class="divide-y">
                                    <div class="flex items-start space-x-3">
                                        <input type="checkbox" name='permissions[]' value="{{ $permission->name }}"
                                            @if (in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked @endif
                                            class="border-gray-300 rounded w-5" />
                                        <div class="flex flex-col pl-2">
                                            <h1 class="text-gray-700 font-medium leading-none">{{ $permission->name }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
</x-app-layout>
