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
    return [
        'user' => $request->user(),
        'can' => [
            'update-servers' => $request->user()->tokenCan('update-servers'),
            'create-servers' => $request->user()->tokenCan('create-servers'),
            'delete-servers' => $request->user()->tokenCan('delete-servers')
        ]
    ];
});

// To test the token was created successfully, use an HTTP client to make a
// request to /api/user with a bearer token output from below.
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
