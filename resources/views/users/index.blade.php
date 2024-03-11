<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="flex-1 max-h-full p-5 overflow-hidden" x-data="{}">
        <h3 class="mt-6 text-xl">Users</h3>
        <div class="flex justify-end">
            <a href="{{ route('user.create') }}" class="your-button-styles">
                <x-primary-button>{{ __('Add User') }}</x-primary-button>
            </a>
        </div>
        <div class="flex flex-col mt-6">
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
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Role
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full"
                                                        src="https://avatars0.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                                        alt="" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $user->roles->pluck('name')->implode(', ') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div x-data="{ user: '{{ $user->name }}' }"  x-show="role = 'super admin'">
                                                <form action="{{ route('user.destroy', ['user' => $user->id]) }}"
                                                    method="post" id="form_{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button x-data=""
                                                        x-on:click.prevent="userId = '{{ $user->id }}', $dispatch('open-modal', 'confirm-user-deletion')"
                                                        class="text-red-600 hover:text-indigo-900"
                                                        type="button">Delete</button>
                                                </form>
                                            </div>
                                            <a href="{{ route('user.edit', ['user' => $user]) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>

                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                    
                    <x-modal  name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable >
                        <div class="p-4">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this user?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once user is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>
                            <div  class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3" x-data="userModal" x-on:click="submit()">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </div>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>

    document.addEventListener('alpine:init', () => {
        Alpine.data('userModal', () => ({
            submit() {
                $('#form_' + userId).submit();
            },
        }))
    });
</script>
@endpush
</x-app-layout>
