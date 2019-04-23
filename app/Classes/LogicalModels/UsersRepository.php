<?php


namespace App\Classes\LogicalModels;


use App\Models\Role;
use App\Models\Users;
use Illuminate\Support\Collection;


class UsersRepository
{

    public $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function getList(): Collection
    {
        return $this->users->with('roles_relation')->get();
    }

    public function applyRole(int $role_id, int $user_id): void
    {
        $newRole = Role::where('id', '=', $role_id)->first();
        $user = $this->users->where('id', '=', $user_id)->first();
        $user->roles_relation()->detach();
        $user->roles_relation()->attach($newRole);
    }
}
