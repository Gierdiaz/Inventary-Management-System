<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
use App\Models\{User};
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {

        // Verifica se o usuário autenticado é admin
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'error'   => 'Unauthorized',
                'message' => 'You do not have permission to access this resource.',
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $users = $this->userRepository->getUsers();

            if ($users->isEmpty()) {
                return response()->json([
                    'error' => 'No users found',
                ], Response::HTTP_NOT_FOUND);
            };

            return response()->json(UserResource::collection($users), Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error'   => 'Unable to fetch users',
                'message' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userRepository->getById($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(new UserResource($user), Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error'   => 'User not found',
                'message' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $exception) {
            return response()->json([
                'error'   => 'Unable to fetch user',
                'message' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(UserFormRequest $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validated();

            $validated['password'] = bcrypt($validated['password']);  // Criptografa a senha

            $user = $this->userRepository->create($validated);

            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'user'  => new UserResource($user),
                'token' => $token,
            ], Response::HTTP_CREATED);

        } catch (ValidationException $exception) {
            return response()->json(['error' => 'Unable to store user',
                'message'                    => $exception->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            return response()->json([
                'error'   => 'Unable to store user',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function update(UserFormRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            $user = $this->userRepository->update($validated, $id);

            DB::commit();

            return response()->json(new UserResource($user), Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error'   => 'User not found',
                'message' => 'The requested user does not exist.',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Unable to update user',
                'message'                    => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {

            $user = $this->userRepository->delete($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(new UserResource($user), Response::HTTP_OK);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error'   => 'User not found',
                'message' => 'The requested user does not exist.',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Unable to delete user',
                'message'                    => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function assignAdminRole($id)
    {
        $user = User::findOrFail($id);
        $user->assignAdminRole();

        return response()->json(['message' => 'Admin role assigned successfully'], Response::HTTP_OK);
    }

    public function revokeAdminRole($id)
    {
        $user = User::findOrFail($id);
        $user->revokeAdminRole();

        return response()->json(['message' => 'Admin role revoked successfully'], Response::HTTP_OK);
    }
}
