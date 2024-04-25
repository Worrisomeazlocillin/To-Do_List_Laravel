<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view("user.login", [
                "title" => "Login"
            ]);
    }

    public function register(): Response
    {
        return response()
            ->view("user.register", [
                "title" => "Register"
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        // validate input
        if (empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "User or password is required"
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $user = User::where('username', $user)->first();
            $request->session()->put("user", $user->username);
            $request->session()->put("user_id", $user->id);
            return redirect("/");
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "User or password is wrong"
        ]);
    }

    public function doRegister(Request $request)
    {
        $user = $request->input('user');
        $password = $request->input('password');

        // validate input
        if (empty($user) || empty($password)) {
            return response()->view("user.register", [
                "title" => "Register",
                "error" => "User or password is required"
            ]);
        }

        if ($this->userService->register($user, $password)) return redirect("/login");
    }

    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget("user");
        $request->session()->forget("user_id");
        return redirect("/");
    }
}
