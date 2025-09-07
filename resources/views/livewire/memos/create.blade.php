<?php

use function Livewire\Volt\{state, rules, mount};
use App\Models\Memo;

state(['title' => '', 'body' => '']);

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

$save = function () {
    $validated = $this->validate();

    $memo = new Memo();
    $memo->user_id = auth()->id();
    $memo->title = $validated['title'];
    $memo->body = $validated['body'];
    $memo->save();

    return redirect()
        ->route('memos.show', ['memo' => $memo->id])
        ->with('status', 'メモを作成しました。');
};

?>

<div>
    <div class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                新規メモ作成
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                新しいメモを作成します。
            </p>
        </header>

        <form wire:submit="save" class="mt-6 space-y-6">
            <div>
                <x-input-label for="title" value="タイトル" />
                <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full"
                    required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="body" value="本文" />
                <x-textarea wire:model="body" id="body" name="body" class="mt-1 block w-full" rows="10"
                    required>{{ $body }}</x-textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>保存</x-primary-button>
                <a href="{{ route('memos.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    キャンセル
                </a>
            </div>
        </form>
    </div>
</div>
