<?php

use function Livewire\Volt\{state, computed};
use App\Models\Memo;

state(['memos' => fn() => auth()->user()->memos()->latest()->get()]);

$title = computed(fn() => __('メモ一覧'));

?>

<div>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">{{ $this->title }}</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('memos.create') }}"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    新規メモ作成
                </a>
            </div>
        </div>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <div class="min-w-full divide-y divide-gray-300">
                            @foreach ($memos as $memo)
                                <div class="bg-white px-4 py-5 sm:px-6 hover:bg-gray-50">
                                    <a href="{{ route('memos.show', $memo) }}" class="block">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                            {{ $memo->title }}
                                        </h3>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
