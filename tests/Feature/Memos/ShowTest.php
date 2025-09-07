<?php

use App\Models\Memo;
use App\Models\User;
use Livewire\Volt\Volt;

test('メモ詳細画面が正しく表示される', function () {
    $user = User::factory()->create();
    $memo = Memo::factory()->create([
        'user_id' => $user->id,
        'title' => 'テストメモ',
        'body' => 'これはテストメモの本文です。',
        'created_at' => '2024-03-20 10:00:00'
    ]);

    $this->actingAs($user)
        ->get(route('memos.show', $memo))
        ->assertOk()
        ->assertSeeText('テストメモ')
        ->assertSeeText('これはテストメモの本文です。')
        ->assertSeeText('2024年03月20日 10:00');
});

test('未認証ユーザーはメモ詳細画面にアクセスできない', function () {
    $user = User::factory()->create();
    $memo = Memo::factory()->create([
        'user_id' => $user->id
    ]);

    $this->get(route('memos.show', $memo))
        ->assertRedirect(route('login'));
});

test('他のユーザーのメモにはアクセスできない', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $memo = Memo::factory()->create([
        'user_id' => $user2->id
    ]);

    $this->actingAs($user1)
        ->get(route('memos.show', $memo))
        ->assertForbidden();
});
