<?php

namespace App\Policies;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemoPolicy
{
    use HandlesAuthorization;

    /**
     * メモの閲覧を許可するかどうかを判定
     */
    public function view(User $user, Memo $memo): bool
    {
        return $user->id === $memo->user_id;
    }

    /**
     * メモの更新を許可するかどうかを判定
     */
    public function update(User $user, Memo $memo): bool
    {
        return $user->id === $memo->user_id;
    }

    /**
     * メモの削除を許可するかどうかを判定
     */
    public function delete(User $user, Memo $memo): bool
    {
        return $user->id === $memo->user_id;
    }
}
