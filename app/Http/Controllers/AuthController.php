<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 3/02/19
 * Time: 0:07
 */

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
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

    public function register(Request $request) {
        $this->validate($request, [
            'email' => 'required|max:255',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'birth_date' => 'required'
        ]);

        $params = $request->all();
        $birthDate = Carbon::createFromFormat('d/m/Y', $params['birth_date']);

        $options = [
            'cost' => 11
        ];
        $pass = password_hash($params['password'], PASSWORD_BCRYPT, $options);
        $client = new Client([
            'phone' => $params['phone'],
            'birth_date' => $birthDate,
        ]);
        $client->save();
        $client->user()->create([
            'name' => $params['name'],
            'lastname' => $params['lastname'],
            'email' => $params['email'],
            'userable_id' => $client->id,
            'userable_type' => Client::class,
            'password' => $pass
        ]);
        $client->save();


    }

}