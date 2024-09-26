<?php

namespace App\Policies;

use App\Models\Extraction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExtractionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // すべてのユーザーが自分の一覧を表示できるようにする
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Extraction $extraction): bool
    {
        return $user->id === $extraction->user_id;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Extraction $extraction): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Extraction $extraction): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Extraction $extraction): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Extraction $extraction): bool
    {
        //
    }
}
