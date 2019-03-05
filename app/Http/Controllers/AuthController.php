<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 3/02/19
 * Time: 0:07
 */

namespace App\Http\Controllers;


use Laravel\Lumen\Http\Request;

class AuthController extends Controller {

    public function login(Request $request) {
        $data = $request;
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

}