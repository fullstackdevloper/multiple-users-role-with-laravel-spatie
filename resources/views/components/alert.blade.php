@props(['status' => 'success', 'message' => 'Action successfully executed'])

@php

    switch ($status) {
        case 'error':
            $bgclass = 'bg-red-500';
            $textclass = 'text-white';
            break;
        default:
            $bgclass = 'bg-green-300';
            $textclass = 'text-green-800';
            break;
    }

@endphp

@if ($status)
    <div class="flex-1 max-h-full p-5 overflow-hidden" x-data="{ show: true }" x-show="show" x-transition
        x-init="setTimeout(() => show = false, 5000)">
        <div class="flex justify-between {{ $bgclass }} shadow-inner rounded p-2 {{ $textclass }}">
            <p class="self-center">
                <strong>{{ $status }}</strong> {{ $message }}
            </p>
            <strong class="text-xl align-center cursor-pointer alert-del" @click="show = false">&times;</strong>
        </div>
    </div>
@endif
