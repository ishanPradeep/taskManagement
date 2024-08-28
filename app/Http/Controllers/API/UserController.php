<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Mail\MailQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Invalid credintials',
                'error' => 'invalid_credintials',
                'status_code' => 401
            ], 401);
        }

        $user = $request->user();

        if ($user->email_verified_at == null) {
            return response()->json([
                'message' => "Email not verified",
                'error' => 'common_error',
                'status_code' => 401
            ], 401);

        } else {
            $tokenData = $user->createToken('MyApp', [$user->userLevel->scope]);
            $token = $tokenData->accessToken;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }

            if ($token->save()) {
                return response()->json([
                    'user' => new UserResource($user),
                    'accessToken' => $tokenData->plainTextToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse($token->expires_at)->toDayDateTimeString(),
                    'status_code' => 200
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Common error',
                    'error' => 'common_error',
                    'status_code' => 500
                ], 500);
            }
        }
    }


    public function confirmMail($user_id, $key)
    {

        $user = User::find($user_id);

        if ($key == $this->confirmKey($user)) {
            $user->verification_code = null;
            $user->email_verified_at = now();
            $user->save();
            return redirect(env('CLIENT_URL') . '/login');
        } else {
            return redirect(env('CLIENT_URL') . '/404');
        }
    }
}
