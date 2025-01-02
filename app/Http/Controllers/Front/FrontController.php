<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Slider;
use App\Models\WelcomeItem;
use App\Models\Feature;
use App\Models\CounterItem;
use App\Models\Testimonial;
use App\Models\TeamMember;
use Hash;


class FrontController extends Controller
{
    public function home(){

        $sliders= Slider::get();
        $welcome_item= WelcomeItem::where('id',1)->first();
        $features=Feature::get();
        $testimonials=Testimonial::get();
        return view("front.home",compact('sliders','welcome_item','features','testimonials'));
    }
    public function about(){
        $welcome_item= WelcomeItem::where('id',1)->first();
        $features=Feature::get();
        $counter_item=CounterItem::where('id',1)->first();

        return view("front.about",compact('welcome_item','features','counter_item'));
    }
    public function blog(){
        return view("front.blog");
    }
    public function contact(){
        return view("front.contact");
    }
    public function faq(){
        return view("front.faq");
    }
    public function team_members(){

        $team_members=TeamMember::get();

        return view("front.team_members",compact('team_members'));
    }
    public function team_member_details($id){
        $team_member=TeamMember::find($id);
        return view("front.team_member_details",compact('team_member'));
    }

    public function destinations(){
        return view("front.destinations");
    }
    public function packages(){
        return view("front.packages");
    }
    public function registration(){
        return view("front.registration");
    }
    public function registration_submit(Request $request){
        $request->validate([
            "name"=> "required",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|min:6",
            "confirm_password"=>["required","same:password"],
        ]);
        $token= Hash('sha256',time());
        $verification_link= route('user_registration_verify_email',['email'=>$request->email,'token'=>$token]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token= $token;
        $user->save();

        $subject = "User Account Verification";
        $message = 'Please click the following link to verify your email address: <br><a href="'.$verification_link.'">Verify Email</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('user_login')->with("success","Registration Successful. Now, check your email to verify and login.");
    }
    public function registration_verify_email($email, $token){  
        $user = User::where("email", $email)->where('token', $token)->first();
        if(!$user){
            return redirect()->route('user_registration')->with('error','The registration could not verified correctly');
        }
        $user->token = '';
        $user->status = '1';
        $user->save();

        return redirect()->route('user_login')->with('success','Your email is verified successfully.');
    }

    public function login(){
        return view("front.login");
    }
    public function login_submit(Request $request){
        $request->validate([
            "email"=> ["required","email"],
            "password"=> ["required",],
            "status"=>'1',
        ]);
        $check=$request->all();
        $data=[
            "email"=> $check["email"],
            "password"=> $check["password"],
            "status"=> '1',
        ];
        if(Auth::guard("web")->attempt($data)){
            return redirect()->route("user_dashboard")->with("success","Login is Successful.");
        }else{
            return redirect()->route("user_login")->with("error","The entered information is not correct")->withInput();
        }

    }
    public function logout(){
        Auth::guard("web")->logout();
        return redirect()->route("user_login")->with("success","Logout Successfully");
    }

    public function forget_password(){
        return view("front.forget-password");
    }
    public function forget_password_submit(Request $request){
        $request->validate([
            "email"=> ["required","email"],
        ]);
        $user= User::where("email", $request->email)->first();
        if(!$user){
            return redirect()->route("user_login")->with("error","Email not found");
        }
        $token=Hash('sha256',time());
        $user->token=$token;
        $user->save();

        $reset_link=url('user/reset-password/'.($request->email).'/'.$token);
        $subject= 'Reset User Password';
        $message= 'Plz click the following link to reset your password.<br><a href="'.$reset_link.'">Click Here</a>';

        Mail::to($user->email)->send(new Websitemail( $subject, $message));
        // return redirect()->route('user_login')->with('success','Password reset successfully, plz login with new password.');
        return redirect()->route('user_login')->with('success','We have sent a password reset link to reset password.');
    }
    public function reset_password($email, $token){
        $user= User::where('email', $email)->where('token', $token)->first();
        if(!$user){
            return redirect()->route('user_login')->with('error','Email or Token is not valid');
        }
        return view('user.reset-password',compact(['email','token']));
    }
    
    public function reset_password_submit(Request $request, $email, $token){
        $request->validate([
            'password'=> ['required'],
            'confirm_password'=> ['required','same:password'],
        ]);

        $user= User::where('email', $email)->where('token', $token)->first();
        $user->password= bcrypt($request->password);
        $user->token="";
        $user->save();
        return redirect()->route('user_login')->with('success','Password reset successfully, plz login with new password.');
        
    }

}
