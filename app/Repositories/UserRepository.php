<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $userModel)
    {
        $this->model = $userModel;
    }

    public function getUsers(): Collection
    {
        return $this->model->all();
    }

    public function getById(int $id): User
    {
        return $this->model->find($id);
    }

    public function create(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->model->create($data);
    }

    public function update(array $data, $id): bool
    {
        return $this->model->update($data, $id);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
