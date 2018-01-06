<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Contact;

class FrontController extends Controller
{
    public function index()
    {
        $data['projects'] = DB::select("select p.id,u.pengantin_pria, u.pengantin_wanita, p.quotes, g.gbr1 from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        ");


        return view('pages.home', $data);
    }

    public function getDetail($id)
    {
        //DB::connection()->enableQueryLog();
        $data['details'] = DB::select("select * from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        where p.id = 
        ".$id);

        $data['projects'] = DB::select("select p.id,u.pengantin_pria, u.pengantin_wanita, p.quotes, g.gbr1 from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        ");

        // $queries = DB::getQueryLog();

        // dd($queries);



        return view('pages.detail', $data);
    }

    public function getAbout()
    {
        return 'This Page is Under Construction';
    }

    public function getContact()
    {
        $data['projects'] = DB::select("select p.id,u.pengantin_pria, u.pengantin_wanita, p.quotes, g.gbr1 from projects p 
        join users u on p.user_id = u.id
        join galleries g on p.id = g.project_id
        ");
        return view('contact.index', $data);
    }

    public function doSend(Requests $request)
    {
 
        $input = $request->all();
        $password = bcrypt($request->input('password'));
        $input['password'] = $password;
        $input['activation_code'] = str_random(60) . $request->input('email');
        $register = User::create($input);
 
        $data = [
        'name' => $input['name'],
        'code' => $input['activation_code']
        ];

        $this->sendEmail($data, $input);

        //return redirect()->route('index');
        return redirect('client');

    }

    public function post_contact(Request $request)
    {
        $rules = [
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'message'=>'required|min:10'
            //'g-recaptcha-response' => 'required|captcha'
        ];

        $messages = [
            'name.min'=>'Please input your name',
            'phone.regex'=>'O campo telefone precisa estar no padrão (xx) xxxxx-xxxx!',
            'g-recaptcha-response.required'=>'Você precisa confirmar que não é um robô!',
            'g-recaptcha-response.captcha'=>'O ReCAPTCHA precisa ser um código CAPTCHA válido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect(('contact'))
                //->route('front.getContact')
                ->withErrors($validator->errors())
                ->withInput();
        }


        //Enviar email

        Mail::send(
            'emails.contact',
            array(
                //'site_domain' => $this->site_domain,

                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'messages' => $request->get('message')
            ),
            function ($message) {
            
                $message->from(env('MAIL_USERNAME', null));
                $message->to(env('MAIL_USERNAME', null), 'Site Admin')->subject('Email from user website ');
            }
        );


        $contact = new Contact();
        $contact->nama = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->message = $request->input('message');
        $contact->save();

        DB::commit();
       
        Log::info('IP from '.$request->getClientIp(). ' sent email to your site');

        

        //Redirect back
        Alert::success('Thanks for contact us!');
        return redirect('contact');
    }
}
