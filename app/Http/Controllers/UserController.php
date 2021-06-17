<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'unique:users'
            ],
            'password' => [
                'required',
                'string',
                'confirmed'
            ],
        ];

        Validator::make($request->all(), $rules)->validate();

        $datos = $request->all();
        $datos['password'] = Hash::make($request->password);

        $user = User::create($datos);
        return $this->ValidResponse($user,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $author
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        return $this->validResponse($user);
    }


    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => [
                'string',
            ],
            'email' => [
                'string',
                'unique:users,email,'.$user->id,
            ],
            'password' => [
                'string',
            ],
        ];

        Validator::make($request->all(), $rules)->validate();

        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return $this->ValidResponse($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->validResponse($user);
    }
}
