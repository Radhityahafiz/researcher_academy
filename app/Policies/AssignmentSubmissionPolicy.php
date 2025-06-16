<?php

namespace App\Policies;

use App\Models\AssignmentSubmission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssignmentSubmissionPolicy
{
    public function view(User $user, AssignmentSubmission $submission)
    {
        return $user->id === $submission->user_id || $user->id === $submission->assignment->user_id;
    }

    public function create(User $user)
    {
        return $user->isPeserta();
    }

    public function update(User $user, AssignmentSubmission $submission)
    {
        return $user->id === $submission->user_id;
    }

    public function grade(User $user, AssignmentSubmission $submission)
    {
        return $user->id === $submission->assignment->user_id;
    }
}