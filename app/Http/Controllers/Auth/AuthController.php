<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('pages.login');
    }

    public function registerWorker(): View
    {
        $data = ['roles' => [
            [
                'text' => 'Обходчик ГТС',
                'value' => 'inspector',
            ],
            [
                'text' => 'Инженерно-технический работник',
                'value' => 'engineering-worker',
            ],
        ],
    ];
        return view('pages.register', $data);
    }

    public function register(Request $request): RedirectResponse
    {
        $credentials  = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'personnel_number' => ['required', 'integer'],
            'password' => ['required'],
            'repeatPassword' => ['required', 'same:password'],
            'role' => ['required', 'in:inspector,engineering-worker'],
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);

        $user->assignRole($credentials['role']);

        Auth::login($user);

        return redirect('/');
    }

    public function login(Request $request): RedirectResponse | View
    {
        $credentials  = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return view('pages.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
