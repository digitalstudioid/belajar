<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RahasiaController extends Controller
{
    public function halamanRahasia2 () {
    	return 'Anda sedang melihat <strong>Halaman Rahasia2.</strong>';
    }

    public function showMeSecret2 () {
    	return redirect()->route('secret2');
    }

    public function halamanRahasia3 () {
    	return 'Anda sedang melihat <strong>Halaman Rahasia3.</strong>';
    }

    public function showMeSecret3 () {
    	$url 	= route('secret3');
    	$link	= '<a href="'. $url . '">Ke Halaman Rahasia3</a>';
    	return $link;
    }
}
