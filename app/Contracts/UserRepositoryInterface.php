<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getUsers(): Collection;

    public function getById(int $id): User;

    public function create(array $data): User;

    public function update(array $data, User $user): bool;

    public function delete(User $user): bool;
}
