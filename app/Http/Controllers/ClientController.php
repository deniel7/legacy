<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\User;
use App\Project;
use App\WeddingData;
use App\BestmensBridesmaid;
use App\FamCoordinator;
use App\GuestWelcoming;
use App\GuestbookAngpao;
use App\TeaPay;
use App\CorsageList;
use App\FamilyPhotoList;
use App\FriendPhotoList;
use App\Package;
use App\Event;
use Auth;
use DB;
use Mail;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Flash;

class ClientController extends Controller
{
    public function __construct()
    {
        $user = Auth::user();
    }

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

        $data['projects'] = DB::select("select * from projects where user_id = 
        ".$user_id);


        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('users.id', '=', $user_id)->get();

        $data['dl'] = Project::select(['main_rundown'])
        ->where('user_id', '=', $user_id)->first();
        
        
        return view('client.home', $data);
    }

    public function weddingData(WeddingData $wedding)
    {
        $user_id =  Auth::user()->get()->id;
        $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt 
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id." 
        ");

        $data['projects'] = DB::select("select * from projects where user_id = 
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = WeddingData::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        //$data['weddings'] = DB::select("select * from wedding_datas where user_id=".$user_id."");

        return view('client.wedding-data', compact('wedding'), $data);
    }

    public function postWeddingData(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        $c = "[" . implode(",", $request->input('groom_siblings')) . "]";


        WeddingData::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'name_groom' => $request->input('name_groom'),
                        'name_bride' => $request->input('name_bride'),
                        'groom_mobile_num' => $request->input('groom_mobile'),
                        'bride_mobile_num' => $request->input('bride_mobile'),
                        'groom_email' => $request->input('groom_email'),
                        'bride_email' => $request->input('bride_email'),
                        'dob_groom' => $request->input('dob_groom'),
                        'dob_bride' => $request->input('dob_bride'),
                        'groom_address' => $request->input('groom_address'),
                        'bride_address' => $request->input('bride_address'),
                        'name_groom_father' => $request->input('groom_father'),
                        'name_bride_father' => $request->input('bride_father'),
                        'groom_father_num' => $request->input('groom_father_mobile'),
                        'bride_father_num' => $request->input('bride_father_mobile'),
                        'name_groom_mother' => $request->input('groom_mother'),
                        'name_bride_mother' => $request->input('bride_mother'),
                        'groom_mother_num' => $request->input('groom_mother_mobile'),
                        'bride_mother_num' => $request->input('bride_mother_mobile'),
                        'groom_siblings' => json_encode($request->input('groom_siblings')),
                        'groom_sibling_num' => json_encode($request->input('groom_siblings_number')),
                        'bride_siblings' => json_encode($request->input('bride_siblings')),
                        'bride_sibling_num' => json_encode($request->input('bride_siblings_number')),
                        'bride_grandparents' => $request->input('bride_grandparents'),
                        'groom_grandparents' => $request->input('groom_grandparents'),

                    ]);

        DB::commit();
        Flash::success('Saved');

        //dd($request->input('user_id'));


        

        return redirect('wedding-data');
    }

    public function weddingDataBestmen(BestmensBridesmaid $wedding)
    {
        $user_id =  Auth::user()->get()->id;
        $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt 
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id." 
        ");

        $data['projects'] = DB::select("select * from projects where user_id = 
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = BestmensBridesmaid::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-bestmen', compact('wedding'), $data);
    }

    public function postDataBestmen(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        BestmensBridesmaid::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'name_bestmen' => json_encode($request->input('name_bestmen')),
                        'bestmen_num' => json_encode($request->input('bestmen_num')),
                        'name_bridesmaid' => json_encode($request->input('name_bridesmaid')),
                        'bridesmaid_num' => json_encode($request->input('bridesmaid_num')),
                        

                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-bestmen');
    }

    public function weddingDataFamcoord(FamCoordinator $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = FamCoordinator::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-famcoord', $data);
    }

    public function postDataFamcoord(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        FamCoordinator::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'photo_coord' => json_encode($request->input('photo_coord')),
                        'photocoord_num' => json_encode($request->input('photocoord_num')),
                        'photo_coord_bride' => json_encode($request->input('photo_coord_bride')),
                        'photocoord_bride_num' => json_encode($request->input('photocoord_bride_num')),
                        'lunchmeal' => json_encode($request->input('lunchmeal')),
                        'lunchmeal_num' => json_encode($request->input('lunchmeal_num')),
                        'lunchmeal_bride' => json_encode($request->input('lunchmeal_bride')),
                        'lunchmeal_bride_num' => json_encode($request->input('lunchmeal_bride_num')),
                        'gift_angpao_coord' => json_encode($request->input('gift_angpao_coord')),
                        'gift_angpao_num' => json_encode($request->input('gift_angpao_num')),
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-famcoord');
    }

    public function weddingDataGuestwelcoming(GuestWelcoming $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = GuestWelcoming::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-guestwelcoming', $data);
    }

    public function postDataGuestwelcoming(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        GuestWelcoming::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'groom_gw' => json_encode($request->input('groom_gw')),
                        'groom_gw_num' => json_encode($request->input('groom_gw_num')),
                        
                        'brides_gw' => json_encode($request->input('brides_gw')),
                        'brides_gw_num' => json_encode($request->input('brides_gw_num')),
                        
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-guest-welcoming');
        
    }

    public function weddingDataGuestbookAngpao(GuestbookAngpao $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = GuestbookAngpao::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-guestbookangpao', $data);
    }

    public function postDataGuestbookAngpao(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        GuestbookAngpao::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'groom_name' => json_encode($request->input('groom_name')),
                        'groom_num' => json_encode($request->input('groom_num')),
                        
                        'bride_name' => json_encode($request->input('bride_name')),
                        'bride_num' => json_encode($request->input('bride_num')),
                        
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-guestbookangpao');
        
    }

    public function weddingDataTeaPay(TeaPay $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = TeaPay::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-teapay', $data);
    }

    public function postDataTeaPay(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        TeaPay::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'groom_name' => json_encode($request->input('groom_name')),
                        'groom_num' => json_encode($request->input('groom_num')),
                        
                        'bride_name' => json_encode($request->input('bride_name')),
                        'bride_num' => json_encode($request->input('bride_num')),
                        
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-teapay');
        
    }

    public function weddingDataCorsageList(CorsageList $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = CorsageList::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-corsagelist', $data);
    }

    public function postDataCorsageList(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        CorsageList::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'groom_name' => json_encode($request->input('groom_name')),
                        'groom_num' => json_encode($request->input('groom_num')),
                        
                        'bride_name' => json_encode($request->input('bride_name')),
                        'bride_num' => json_encode($request->input('bride_num')),
                        
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-corsagelist');
        
    }

    public function weddingDataFamilyPhotoList(FamilyPhotoList $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = FamilyPhotoList::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-familyphotolist', $data);
    }

    public function postDataFamilyPhotoList(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        FamilyPhotoList::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'groom_name' => json_encode($request->input('groom_name')),
                        'groom_num' => json_encode($request->input('groom_num')),
                        
                        'bride_name' => json_encode($request->input('bride_name')),
                        'bride_num' => json_encode($request->input('bride_num')),
                        
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-familyphotolist');
        
    }

    public function weddingDataFriendPhotoList(FriendPhotoList $wedding)
    {
         $user_id =  Auth::user()->get()->id;
         $data['user_id'] = $user_id;
        
        $data['packages'] = DB::select("select p.id, p.nama, pt.updated_at from package_takens pt
        join packages p on pt.package_id = p.id
        join projects pr on pr.id = pt.project_id
        where pr.user_id =".$user_id."
        ");

        $data['projects'] = DB::select("select * from projects where user_id =
        ".$user_id);

        $data['events'] = Event::select(['events.tanggal','events.event', 'events.updated_at'])
        ->join('users', 'users.id', '=', 'events.user_id')
        ->where('events.user_id', '=', $user_id)->get();

        $data['weddings'] = FriendPhotoList::select('*')
        ->where('user_id', '=', $user_id)->get()->first();
        
        return view('client.wedding-data-friendphotolist', $data);
    }

    public function postDataFriendPhotoList(Request $request)
    {
        $user_id =  Auth::user()->get()->id;

        FriendPhotoList::updateOrCreate(['user_id' => $user_id], [
                        'user_id' => $request->input('user_id'),
                        'groom_friend' => json_encode($request->input('groom_friend')),
                        'groom_vip' => json_encode($request->input('groom_vip')),
                        
                        'bride_friend' => json_encode($request->input('bride_friend')),
                        'bride_vip' => json_encode($request->input('bride_vip')),
                        
                        
                    ]);

        DB::commit();
        Flash::success('Saved');

        return redirect('wedding-data-friendphotolist');
        
    }
}
