<?php

use function Livewire\Volt\{state, rules, mount};
use App\Models\Memo;

state(['title' => '', 'body' => '', 'memo' => null]);

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

mount(function (Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->body = $memo->body;
});

$save = function () {
    $validated = $this->validate();

    $this->memo->title = $validated['title'];
    $this->memo->body = $validated['body'];
    $this->memo->save();

    return redirect()
        ->route('memos.show', ['memo' => $this->memo->id])
        ->with('status', 'メモを更新しました。');
};

?>

<div>
    <div class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                メモの編集
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                メモの内容を編集します。
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
                <x-primary-button>更新</x-primary-button>

                <x-secondary-link-button :href="route('memos.show', ['memo' => $memo->id])">
                    キャンセル
                </x-secondary-link-button>
            </div>
        </form>
    </div>
</div>
