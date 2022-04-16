<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/token', function () {
    $user = User::find(1);

    // 'Laracon' is just a made up name that the user usually supplies and is related
    // to their application or server using the token.
    return $user->createToken('Laracon',  [
        // Some made-up OAuth scopes (abilities)
        'create-servers',
        'update-servers'
    ]);
});
