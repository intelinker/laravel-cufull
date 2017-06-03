<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function register() {
        return view('users.register');
    }

    public function login() {
        return view('users.login');
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {

//        $allRequest = $request->all();
//        $allRequest = $request->except('_token', 'confirmPassword');
//        $allRequest = array_slice($allRequest, 1, count($allRequest)-2);
//        dd($allRequest);
//        User::create($allRequest);
        $user = new User();
        $user->name = $request['name'];
        $user->password = bcrypt($request['password']);
        $user->remember_token = $request['_token'];
        $user->phone = $request['phone'];
        $user->avatar= '/images/avatar.png';
        $user->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function signin(Requests\UserLoginRequest $request) {
//        dd($request->all());
        if(Auth::attempt([
            'phone' => $request->get('phone'),
            'password' => $request->get('password'),

        ]))
            return redirect('/');
        Session::flash('user_login_failed', '手机号或密码错误');
        return redirect('/user/login')->withInput();
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
