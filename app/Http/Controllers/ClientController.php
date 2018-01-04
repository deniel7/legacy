<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\User;
use App\Project;
use App\Package;
use Auth;
use DB;
use Mail;
use App\Http\Requests\LoginRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['projects'] = DB::select("select p.id,u.pengantin_pria, u.pengantin_wanita, p.quotes, g.gbr1 from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        ");

        return view('client.index', $data);
    }

    public function register()
    {
        $data['projects'] = DB::select("select p.id,u.pengantin_pria, u.pengantin_wanita, p.quotes, g.gbr1 from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        ");
        
         return view('client.register', $data);

    }

    public function doRegister(RegistrationRequest $request)
    {
 
        $input = $request->all();
        $input['full_name'] = $request->input('name');
        $input['pengantin_pria'] = $request->input('pengantin_pria');
        $input['pengantin_wanita'] = $request->input('pengantin_wanita');
        $password = bcrypt($request->input('password'));
        $input['password'] = $password;
        $input['activation_code'] = str_random(60) . $request->input('email');

        //dd($input);
        $register = User::create($input);
 
        $data = [
        'name' => $input['name'],
        'code' => $input['activation_code']
        ];

        $this->sendEmail($data, $input);

        //return redirect()->route('index');
        return redirect('client');

    }

    public function sendEmail($data, $input)
    {
 
         Mail::send('emails.register', $data, function ($message) use ($input) {
 
            $message->from('support@legacyweddingorganizer.com', 'Support');

            $message->to($input['email'], $input['name'])->subject('Please verify your account registration!');
 
         });

    }

    public function activate($code, User $user)
    {

        if ($user->activateAccount($code)) {
             return 'Activated!';
        }

        return 'Fail';
 
    }


    public function login(LoginRequest $request)
    {

    
        $credentials = $request->only('username', 'password');

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        //Auth::user()->attempt(['email' => $email, 'password' => $password], $remember)
        if (Auth::user()->attempt($credentials)) {
            /*
            Jika username dan password match, lakukan logika if berikut ini.
            kalau user belum mengaktifkan accountnya, maka logout, dan tampilka message untuk mengaktifkannya
            */
            if (Auth::user()->get()->active == 0) {
                Auth::logout();
                return 'Please activate your account';
            } else {
                //return 'You have been log in';
                return redirect('client-home');
            }
        } else {
            return 'The username and password do not match';
        }

    }

    public function logout()
    {
 
        Auth::user()->logout();

        return redirect('client');

    }

    public function home()
    {
        $user_id =  Auth::user()->get()->id;

        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt 
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id." 
        ");

        $data['projects'] = DB::select("select * from projects
        ");

        //DB::connection()->enableQueryLog();

        $data['events'] = Project::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('events', 'projects.id', '=', 'events.project_id')
        ->where('projects.user_id', '=', $user_id)->get();
        //$queries = DB::getQueryLog();

        //dd($queries);
        return view('client.home', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
