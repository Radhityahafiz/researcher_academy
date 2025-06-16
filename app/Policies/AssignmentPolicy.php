<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssignmentPolicy
{
    public function view(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id || $user->isPeserta();
    }

    public function create(User $user)
    {
        return $user->isMentor();
    }

    public function update(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id;
    }

    public function delete(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id;
    }
}