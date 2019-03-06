<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 3/02/19
 * Time: 0:07
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller {

    /**
     * @var JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        try {

            // $user = User::where('email', '=', 'sam@mail.com')->first();

            // if (!$token = $this->jwt->fromUser($user)) {
            //     return response()->json(['user_not_found'], 404);
            // }
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }

}