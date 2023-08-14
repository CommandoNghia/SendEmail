<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return string()
     */
    public function index()
    {

        $listdata = [
            'nghiadangcapgold@gmail.com',
            'nghiadangcapgold2@gmail.com',
            'hoangtrungnghia040598@gmail.com',
            'hoangtrungnghia2255@gmail.com'
        ];


        collect($listdata)->each(function ($user){
        $mailData = [
            'title' => 'Mail from kudoNghia',
            'body' => 'This is for testing email using smtp.'
        ];


        Mail::to($user)->send(new DemoMail($mailData));
        });



//        return "Email is sent successfully.";
        return redirect()->route('callback.cb')->with('flash_message','send message successfully');
    }

    public function callback()
    {
        if (session()->has('flash_message')) {
            $flashMessage = session('flash_message');
            return view('emails.callback')->with('flash_message', $flashMessage);
        }

        return view('emails.callback');
    }
}
