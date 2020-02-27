<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
    }

    public function show(Request $request)
    {
        return view('auth.set_password')->with('id', $request->user()->getKey());
    }

    protected function validatorPassword(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    protected function setPassword(Request $request)
    {
        $this->validatorPassword($request->all())->validate();

        $pass = User::findOrFail($request->user()->id);
        $pass->password = $request->user()->password;
        $pass->save();

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}
