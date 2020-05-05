<?php

namespace App\Http\Controllers\api;

use App\Facades\UserFacade as UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['password', 'email']);
        $response = UserService::login($credentials);
        return response()->json(['token' => $response['token']]);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name','email','password']);
        $response = UserService::register($data);
        if ($response['statusCode'] === Response::HTTP_INTERNAL_SERVER_ERROR) {
            return response()->json(
                ['msg' => $response['msg']],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        return response()->json(['msg' => $response['msg']]);
    }

    public function index()
    {
        $users = UserService::getListUser();
        return response()->json($users);
    }

    public function getUserInfo(): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->find(Auth::id());
        return response()->json($user);
    }

    public function logout()
    {
        $user = User::query()->find(Auth::id());
        $user->tokens()->delete();
        return response()->json(['logout' => 'success']);
    }

    public function destroy(Request $request)
    {
        $response = UserService::deleteUser($request->id);
        if ($response['statusCode'] === Response::HTTP_BAD_REQUEST) {
            return response()->json(
                ['msg' => $response['msg']],
                Response::HTTP_BAD_REQUEST
            );
        }
        return response()->json(['msg' => $response['msg']]
        );
    }
}
