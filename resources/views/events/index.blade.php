<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>
    <div class="flex-1 max-h-full p-5 overflow-hidden" x-data="{}">
        <h3 class="mt-6 text-xl">Events</h3>
        <div class="flex justify-end">
            <a href="{{ route('event.create') }}" class="your-button-styles">
                <x-primary-button>{{ __('Add Event') }}</x-primary-button>
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
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Images
                                    </th>
                        
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Start Time
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        End Time
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Per/Seat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Seats
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($events as $event)
                                    <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full"
                                                        src="https://avatars0.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                                        alt="" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $event->title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $event->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                   
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-normal">
                                            <?php $images = explode(',',$event->images); ?>
                                            <img class="w-60" src="{{asset('category_images/'.$images[0])}}" alt="image description">
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php 
                                                        $start = Carbon\Carbon::parse($event->start_time)->format('Y-m-d g:i A');
                                                        $end = Carbon\Carbon::parse($event->end_time)->format('Y-m-d g:i A');
                                                        ?>
                                                        {{ $start }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $end }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $event->fee_per_seat }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $event->seats_available }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div x-data="{ event: '{{ $event->title }}' }"  x-show="role = 'super admin'">
                                                <form action="{{ route('event.destroy', ['event' => $event->id]) }}"
                                                    method="post" id="form_{{ $event->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button x-data=""
                                                        x-on:click.prevent="eventId = '{{ $event->id }}', $dispatch('open-modal', 'confirm-event-deletion')"
                                                        class="text-red-600 hover:text-indigo-900"
                                                        type="button">Delete</button>
                                                </form>
                                            </div>
                                            <a href="{{ route('event.edit', ['event' => $event]) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>

                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-4">
                            {{ $events->links() }}
                        </div>
                    </div>
                    
                    <x-modal  name="confirm-event-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable >
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

                                <x-danger-button class="ms-3" x-data="eventModal" x-on:click="submit()">
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
        Alpine.data('eventModal', () => ({
            submit() {
                $('#form_' + eventId).submit();
            },
        }))
    });
</script> 
@endpush
</x-app-layout>
