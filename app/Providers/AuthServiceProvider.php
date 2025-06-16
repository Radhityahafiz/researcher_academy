<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Policies\AssignmentPolicy;
use App\Policies\AssignmentSubmissionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
    Assignment::class => \App\Policies\AssignmentPolicy::class,
    AssignmentSubmission::class => \App\Policies\AssignmentSubmissionPolicy::class,
];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
