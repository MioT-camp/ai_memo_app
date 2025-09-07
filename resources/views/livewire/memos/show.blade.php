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

$delete = function () {
    if (Gate::denies('delete', $this->memo)) {
        abort(403);
    }

    $this->memo->delete();

    return redirect()->route('memos.index')->with('status', 'メモを削除しました。');
};

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">{{ $memo->title }}</h1>
                <div class="whitespace-pre-wrap mb-4">{{ $memo->body }}</div>
                <div class="text-sm text-gray-500 mb-4">作成日時: {{ $memo->created_at->format('Y年m月d日 H:i') }}</div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('memos.edit', $memo) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        編集
                    </a>
                    <a href="{{ route('memos.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        戻る
                    </a>
                    <button wire:click="delete" wire:confirm="本当にこのメモを削除しますか？"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        削除
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
