<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    <div class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll" x-data="{}">
        <div class="flex justify-between">
            <h3 class="mt-6 text-xl">Permissions</h3>
            <x-nav-link
                class="inline-flex items-center px-4  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                href="{{ route('permission.create') }}">{{ __('Add') }}</x-nav-link>
        </div>
        <div class="flex flex-col mt-6" x-data="permissionData">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                        <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($permissions as $permission)
                                    <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $permission->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <form
                                                action="{{ route('permission.destroy', ['permission' => $permission->id]) }}"
                                                method="post" id="form_{{ $permission->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-indigo-900" type="button"
                                                    x-on:click.prevent="permissionId = '{{ $permission->id }}', $dispatch('open-modal', 'confirm-permission-deletion')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-4">
                            {{ $permissions->links() }}
                        </div>
                    </div>
                </div>
                <x-modal name="confirm-permission-deletion" :show="$errors->roleDeletion->isNotEmpty()" focusable>
                    <div class="p-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Are you sure you want to delete this permission?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once permission is deleted, all of its resources and data will be permanently deleted.') }}
                        </p>
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3" x-on:click="submit()">
                                {{ __('Delete') }}
                            </x-danger-button>
                        </div>
                    </div>
                </x-modal>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('permissionData', () => ({
                    permissionId: null,
                    submit() {
                        $('#form_' + this.permissionId).submit();
                    }
                }))
            });
        </script>
    @endpush
</x-app-layout>
