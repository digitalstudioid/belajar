<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Test1Controller extends Controller
{
    public function encrypt($key) {
    	return Crypt::encryptString($key);
    }

    public function decrypt($key) {
    	return Crypt::decryptString($key);
    }

    public function encode($key) {
    	return base64_encode($key);
    }

    public function decode($key) {
    	return base64_decode($key);
    }
}
