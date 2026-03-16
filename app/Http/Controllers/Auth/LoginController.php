<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
        $this->middleware("auth")->only("logout");
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(\Illuminate\Http\Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => 'Por favor, completa el captcha.',
            'captcha.captcha' => 'El captcha ingresado es incorrecto.',
        ]);
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(\Illuminate\Http\Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['is_active' => 1]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::where($this->username(), $request->input($this->username()))->first();

        if ($user && !$user->is_active) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                $this->username() => ['Su cuenta no se ha encontrado.'],
            ]);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     * Supports both GET and POST requests
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(\Illuminate\Http\Request $request)
    {
        // Handle both GET and POST logout requests
        // if ($request->isMethod("get")) {
        //     return $this->handleGetLogout($request);
        // }

        // Default POST logout behavior
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear all session data
        $request->session()->flush();

        // Clear authentication cookies
        if ($request->hasCookie("laravel_session")) {
            \Cookie::queue(\Cookie::forget("laravel_session"));
        }

        return $this->loggedOut($request) ?: redirect("/");
    }

    /**
     * Handle GET logout requests
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // protected function handleGetLogout(\Illuminate\Http\Request $request)
    // {
    //     // Perform the same logout actions as POST
    //     $this->guard()->logout();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     // Clear all session data
    //     $request->session()->flush();

    //     // Clear authentication cookies
    //     if ($request->hasCookie("laravel_session")) {
    //         \Cookie::queue(\Cookie::forget("laravel_session"));
    //     }

    //     // Add a message to indicate successful logout
    //     return redirect("/")
    //         ->with("status", "Has cerrado sesión correctamente.")
    //         ->with("logout_method", "get");
    // }
}
