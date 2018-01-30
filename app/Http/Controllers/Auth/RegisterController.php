<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    protected $redirectTo = 'user.index';



    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {


        $this->middleware(['auth', 'admin']);


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


            'lastname' => 'required|string|max:255',

            'firstname' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:6|confirmed',

            'account_type' =>  'required'


        ]);


    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {


        return User::create([

            'lastname' => $data['lastname'],

            'firstname' => $data['firstname'],

            'email' => $data['email'],

            'password' => bcrypt($data['password']),

            'account_type' => $data['account_type'],

            'userable_id'   => null,

            'userable_type' => "",

        ]);


    }



    public function showRegistrationForm()
    {


        return view('user.create');


    }


    public function index ()
    {


        $users = User::whereIn('account_type',['administrateur', 'personnel'])

                     ->orderBy('lastname', 'asc')

                     ->paginate(20);

        return view('user.index', compact('users'));


    }

    public function edit ($id)
    {


        $user = User::find($id);

        return view('user.edit', compact('user'));


    }


    public function update (Request $request , int $id)
    {


        $this->validate($request, [


            'lastname' => 'required|string|max:255',

            'firstname' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users,email,'.$id,

            'password' => 'nullable|string|min:6|confirmed',

            'account_type' =>  'required'


        ]);

        $data = $request->all();

        if ($data['password'] === null )

            unset($data['password']);

        else

            $data['password'] = bcrypt($data['password']);



        if ( User::find($id)->update( $data ) )


            session()->flash('success', 'Utilisateur modifié avec succès');


        else


            session()->flash('failed', 'Une erreur est survenue lors de la modification.');



        return redirect()->route($this->redirectTo);


    }



    protected function registered( Request $request, $user )
    {


        return redirect()->route($this->redirectTo);


    }


    public function destroy ($id)
    {


        if ( User::find($id)->delete() )


            session()->flash('success', 'Utilisateur supprimé avec succès');


        else


            session()->flash('failed', 'Une erreur est survenue lors de la suppression.');



        return redirect()->route($this->redirectTo);


    }

}
