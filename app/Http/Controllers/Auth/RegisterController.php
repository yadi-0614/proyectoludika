<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Register Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles the registration of new users as well as their
     | validation and creation. By default this controller uses a trait to
     | provide this functionality without requiring any additional code.
     |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'captcha' => ['required', 'captcha'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Password::min(8)
                    ->mixedCase() // Al menos una mayúscula y una minúscula
                    ->symbols(),   // Al menos un símbolo
                'regex:/([^A-Za-z0-9].*){2,}/', // Específicamente requerimos al menos 2 símbolos
            ],
        ], [
            'password.regex' => 'La contraseña debe contener al menos 2 caracteres especiales.',
            'captcha.required' => 'Por favor, completa el captcha.',
            'captcha.captcha' => 'El captcha ingresado es incorrecto.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            return $request->wantsJson()
                ? new \Illuminate\Http\JsonResponse([], 201)
                : redirect($this->redirectPath());
        }
        catch (QueryException $e) {
            // Capturar error de duplicación de email (código 23000)
            if ($e->getCode() == 23000) {
                return redirect()->back()
                    ->withInput($request->except('password', 'password_confirmation'))
                    ->withErrors([
                    'email' => 'Este correo electrónico ya está registrado. Por favor, utiliza otro correo o inicia sesión.'
                ]);
            }

            // Si es otro tipo de error, lanzarlo de nuevo
            throw $e;
        }
    }
}
