<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Voucher;
use Auth;
use Mail;
use App\Mail\SampleMail;

class VoucherController extends Controller
{
    
    public function getVoucher() {

        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $voucher = new Voucher;
        $count = $voucher->where('user_id', $id)->count();
        $return_message = '';
        if ($count < 10) {
            $generated_voucher = $this->generateVoucher();

            $voucher->user_id = $id;
            $voucher->voucher = $generated_voucher;
            $voucher->save();
            $content = [
                'subject' => 'This is the mail subject',
                'body' => 'This is your voucher: '.$generated_voucher
            ];

            Mail::to($email)->send(new SampleMail($content));
            $return_message = 'Success!';
        } else {
            $return_message = 'Already reached limit of 10 vouchers!';
        }
        

        return response()->json($return_message); 
    }

    public function getAllVouchers() {
        $id = Auth::user()->id;
        $vouchers = Voucher::where('user_id', $id)->get();
        return response()->json($vouchers); 
    }

    public function deleteVoucher(Request $request) {
        $voucher_code = $request->voucher;
        $voucher = new Voucher;
        $res = $voucher->where('voucher',$voucher)->delete();
        $voucher = $voucher->all();
        return response()->json($voucher); 
    }

    private function generateVoucher() {
        $generated_voucher = strtoupper(substr(md5(microtime()),0,5));
        if (Voucher::where('voucher', $generated_voucher)->exists()) {
           $this->generateVoucher();
        }

        return $generated_voucher;
    }
}
