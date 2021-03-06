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
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Symfony\Component\Console\Output\ConsoleOutput;
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

    public function loginFb(Request $request) {
        $params = $request->only('name', 'phone', 'email', 'facebookID', 'birthday', 'gender');
        $email = $params['email'];
        $password = 'facebooksecret';
        $output = new ConsoleOutput();
        $output->writeln("email: " . $email . " password: " . $password);
        $output->writeln("params: " . serialize($params ));
        if (! $token = $this->jwt->attempt(['email' => $email, 'password' => $password])) {
            return $this->registerFb($params);
        }

        $user = User::where('email', $request->input('email'))->first();
//        $user->setToken($token);
        $userType = $user->userable;
        //       $userType->user->token = $token;

        return response()->json(['client' => $userType, 'token' => $token]);

    }

    private function registerFb($params) {
        $pass = $this->generatePass('facebooksecret');
        $client = new Client([
            'phone' => isset($params['phone']) ? $params['phone'] : '12345667',
            'birth_date' => isset($params['birthday']) ? $params['birthday'] : null,
            'gender' => $params['gender']
        ]);
        $client->save();
        $client->user()->create([
            'name' => $params['name'],
            'lastname' => '',
            'email' => $params['email'],
            'userable_id' => $client->id,
            'userable_type' => Client::class,
            'password' => $pass
        ]);
        $client->save();
        $token = $this->jwt->attempt(['email' => $params['email'], 'password' => 'facebooksecret']);
        //$client->user->token = $token;
        $client->user = $client->user;
        return response()->json(['client' => $client, 'token'=>$token]);
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
        $user = User::where('email', $request->input('email'))->first();
//        $user->setToken($token);
        $userType = $user->userable;
        //       $userType->user->token = $token;

        return response()->json(['client' => $userType, 'token' => $token]);
    }

    public function register(Request $request) {
        $this->validate($request, [
            'email' => 'required|max:255',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
        ]);

        $params = $request->all();
        $birthDate = isset($params['birth_date']) && !empty($params['birth_date']) ? Carbon::createFromFormat('Y-m-d', $params['birth_date']) : null;

        $pass = $this->generatePass($params['password']);
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
        $token = $this->jwt->attempt($request->only('email', 'password'));
        //$client->user->token = $token;
        $client->user = $client->user;
        return response()->json(['client' => $client, 'token'=>$token]);

    }

    private function generatePass($password) {
        $options = [
            'cost' => 11
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        return $pass;
    }

}