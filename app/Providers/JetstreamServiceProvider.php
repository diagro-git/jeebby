<?php

namespace App\Providers;

use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use App\Permissions;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use App\Extensions\Jetstream\Jetstream;
use App\Extensions\Jetstream\RemoveTeamMember;
use App\Extensions\Jetstream\DeleteUser;
use App\Extensions\Jetstream\AddTeamMember;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions([]);

        Jetstream::role('jeebby_system', 'Jeebby System', [Permissions::MONITOR_WRITE, Permissions::STORAGE_READ, Permissions::STORAGE_WRITE], false)
            ->description('Jeebby system users have ability to read/write to storage and write monitor.');

        Jetstream::role('admin', 'Administrator', [Permissions::getAllPermissions()])
            ->description('Administrators can do it all!');

        //TODO: filter permissions.
        Jetstream::role('user', 'User', [Permissions::getAllPermissions()])
            ->description('Users can do all except team admin actions.');

        Jetstream::role('viewer', 'Viewer',Permissions::getAllPermissions(fn(array $permissions) => Arr::where($permissions, fn($permission) => str_ends_with($permission, ':read'))))
            ->description('Viewers can only read.');
    }
}
