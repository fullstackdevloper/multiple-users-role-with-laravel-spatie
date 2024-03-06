<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Add User Information') }}
                            </h2>
                        </header>
                        <form method="post" action="{{ route('users.create') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="name" :value="old('name')" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="text" :value="old('email')"
                                    class="mt-1 block w-full" required autofocus autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                     required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                            <div>
                                <x-input-label for="roles" :value="__('Role')" />
                                <x-text-select id="role" name="roles[]" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="name" multiple>
                                    @foreach ($all_roles as $role)
                                        <option value="{{ $role->name }}" class="uppercase">{{ $role->name }}
                                        </option>
                                    @endforeach
                                </x-text-select>
                                <x-input-error class="mt-2" :messages="$errors->get('roles')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#role').select2();
            });
        </script>
    @endpush
</x-app-layout>
