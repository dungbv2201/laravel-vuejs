<?php


namespace App\Services;


use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return ['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'msg' => 'Email or password is invalid.'];
        }
        $user = User::query()->where('email', $credentials['email'])->first();
        $token = $user->createToken('login-token');
        return ['statusCode' => Response::HTTP_CREATED, 'token' => $token->plainTextToken];
    }

    public function register(array $request)
    {
        try {
            User::query()->create($request);
        } catch (\Exception $ex) {
            return ['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR];
        }
        return ['statusCode' => Response::HTTP_CREATED];
    }

    public function getListUser()
    {
        return User::query()->latest('id')->paginate(5);
    }

    public function deleteUser($id)
    {
        try{
            $user = User::query()->find($id);
            DB::beginTransaction();
            $user->tokens()->delete();
            $user->delete();
            DB::commit();
        }catch(\Exception $ex){
            DB::rollBack();
            return ['statusCode'=>Response::HTTP_BAD_REQUEST,'msg'=>'ID not found'];
        }
        return ['statusCode'=>Response::HTTP_OK,'msg'=>'deleted successfully'];
    }
}
