<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions Add') }}
        </h2>
    </x-slot>
    @if (session('status') === 'success')
        <x-alert status="{{ session('status') }}" message="{{ session('message') }}" />
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Permission Information') }}
                        </h2>

                    </header>


                    <form method="post" action="{{ route('permission.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div class="grid grid-cols-5 gap-4">
                            @foreach ($route_lists as $route)
                                <div class="divide-y">
                                    <div class="flex items-start space-x-3">
                                        <input type="checkbox" name ='permissions[]' value="{{ $route }}"
                                            @if (in_array($route, $permissions->pluck('name')->toArray())) checked @endif
                                            class="border-gray-300 rounded w-5" />
                                        <div class="flex flex-col pl-2">
                                            <h1 class="text-gray-700 font-medium leading-none">{{ $route }}</h1>
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
