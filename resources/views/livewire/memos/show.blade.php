<?php

use function Livewire\Volt\{state, mount};
use App\Models\Memo;
use Illuminate\Support\Facades\Gate;

state(['memo' => fn(Memo $memo) => $memo]);

mount(function (Memo $memo) {
    if (Gate::denies('view', $memo)) {
        abort(403);
    }
});

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">{{ $memo->title }}</h1>
                <div class="whitespace-pre-wrap mb-4">{{ $memo->body }}</div>
                <div class="text-sm text-gray-500">作成日時: {{ $memo->created_at->format('Y年m月d日 H:i') }}</div>
            </div>
        </div>
    </div>
</div>
