<?php


namespace App\Classes\LogicalModels;


use App\Models\Role;
use App\Models\Users;
use Illuminate\Support\Collection;


class UsersRepository
{
    public $users;

    public function getList(): Collection
    {
        $this->users = new Users();
        $result = $this->users->with('roles_relation')->orderBy('id', 'desc')->get();

        return $result;
    }

    public function applyRole(int $role_id, int $user_id): void
    {
        $newRole = Role::where('id', '=', $role_id)->first();
        $this->users = new Users();
        $user = $this->users->where('id', '=', $user_id)->first();
        $user->roles_relation()->detach();
        $user->roles_relation()->attach($newRole);
    }

    public function updateStatus($user_id, $status)
    {
        $this->users = new Users();
        $user = $this->users->findOrFail($user_id);
        $user->status = intval($status);
        $user->save();
    }

    public function getOne($key, $value)
    {
        $this->users = new Users();
        return $this->users->select()->where($key, '=', $value)->first();
    }

}

