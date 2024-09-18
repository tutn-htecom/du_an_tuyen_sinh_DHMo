<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function __construct()
    {
        
    }

    //Send mail
    public function sendmail(){
        $details = [
            'title' => 'Mail from Laravel App',
            'body' => 'This is a test email sent from a Laravel application.',
            'subject'=> 'Test send mail',
            'from'=> 'tu.tran@htecom.vn'
        ];
        // Mail::to('tu.tran@htecom.vn')->send(new SendMail($details));
        Mail::send('includes.mail', $details, function ($message) use ($details) {
            $message->to('tu.tran@htecom.vn')
                    ->subject('New Contact Message');
        });

        // return back()->with('success', 'Email sent successfully!');
        return "Email sent!";
    }
    public function login() {
        return view('page.login');
    }
    public function register() {
        $marjors = DB::table('marjors')->get();
        $sources = DB::table('sources')->get();
        $blockAdminssions = DB::table('block_adminssions')->get();

        $responseCities = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $cities = $responseCities->json();

        // $responseCountries = Http::get('https://api.nosomovo.xyz/country/getalllist');
        // $countries = $responseCountries->json();

        // $responseEthnics = Http::get('https://api.nosomovo.xyz/ethnic/getalllist');
        // $ethnics = $responseEthnics->json();
        $ethnics = [];

        $responseProvinces = Http::get('https://provinces.open-api.vn/api/?depth=3');
        $provinces = $responseProvinces->json();

        // dd($blockAdminssions);
        return view(
            'page.form',
            compact('marjors','sources', 'cities', 'ethnics', 'provinces', 'blockAdminssions')
        );
    }
    public function loginCRM() {
        return view('crm.auth.login');
    }
    public function registerCRM() {
        return view('crm.auth.register');
    }
    
}
