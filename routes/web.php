<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
CARA INSTALL LARAVEL :
Syntax jika ingin install versi terbaru :
composer create-project laravel/laravel namaProject
Syntax jika ingin install versi tertentu :
composer create-project laravel/laravel namaProject 5.7.*


CARA MENGETAHUI VERSI LARAVEL :
Syntax : php artisan -V


CARA MENGHAPUS URL PUBLIC :
- Rename file server.php di folder utama projek menjadi index.php
- Pindahkan / Save As file .htaccess yang berada di folder public ke folder utama projek


KOMENTAR
Versi PHP :
/* komentar */					/*

Versi Blade :
<!-- komentar ini masih terlihat di page source -->
{{-- komentar ini tidak terlihat di page source --}}


CARA MEMBUAT CONTROLLER :
file yang dihasilkan berada di /app/Http/Controllers

Controller standar alias kosongan tanpa class apapun :
Syntax : php artisan make:controller NamaController
Contoh : php artisan make:controller EmployeeController

Controller lengkap dengan class index, create, store, show, edit, update, destroy
Syntax : php artisan make:controller NamaController -r
Contoh : php artisan make:controller EmployeeController -r
atau
Syntax : php artisan make:controller NamaController --resource
Contoh : php artisan make:controller EmployeeController --resource


CARA MEMBUAT MIGRATION DATABASE :
file yang dihasilkan berada di /database/migrations
Syntax : php artisan make:migration create_users_table --create=users

Untuk eksekusinya : php artisan migrate
atau php artisan migrate:refresh

Jika ada error path to long harus tambahkan syntax berikut pada file app/Providers/AppServiceProvider.php :
use Illuminate\Support\Facades\Schema;
public function boot()
{
    Schema::defaultStringLength(191);
}


CARA MEMBUAT MODEL :
file yang dihasilkan berada di /app
Syntax : php artisan make:model Nama
Contoh : php artisan make:model Siswa


CARA MEMBUAT PROVIDER :
file yang dihasilkan berada di /app/Providers
Syntax : php artisan make:provider NamaServiceProvider
Contoh : php artisan make:provider BelajarSeviceProvider
Agar kode yang dimasukkan ke service provider dapat berjalan maka kita perlu memanggilnya. Jadi pada file /config/app.php pada array application service provider kita set code : App\Providers\BelajarServiceProvider::class, 


CARA MEMBUAT REQUEST :
file yang dihasilkan berada di app/Http/Requests
Syntax : php artisan make:request NamaRequest
Contoh : php artisan make:request SiswaRequest

CARA MENGINTAL FORM BUILDER LARAVELCOLLECTIVE :
Site : https://github.com/LaravelCollective/laravelcollective.com
Syntax : composer require "laravelcollective/html":"^5.8.0"
Selanjutnya ikuti dokumentasinya


SORT DATA ELOQUEN :
contoh :
$siswa_list	= Siswa::all()->sortBy('nama');
$siswa_list	= Siswa::all()->sortByDesc('nama');


*/


/*Route::get('', function () {
    return view('welcome');
});*/

//Route::get('', function () {
    //return view('pages.homepage');
//});
Route::get('', 'PagesController@homepage');

//http://localhost/belajar/about
//Route::get('about', function () {
    //return view('pages.about');
//});
//Route::get('about', function () {
    //$halaman = 'about';
    //return view('pages.about', compact('halaman'));
//});
Route::get('about', 'PagesController@about');

//http://localhost/belajar/halo
Route::get('halo', function () {
	return 'Halo, Selamat Belajar Laravel.';
});

//http://localhost/belajar/about1
Route::get('about1', function () {
	return 'Aplikasi <strong>Laravel</strong> dibuat sebagai latihan untuk mempelajari Laravel.';
});

//CONTOH NAMED ROUTE -----------------------------------------------

//CARA 1
//http://localhost/belajar/halaman-rahasia
Route::get('halaman-rahasia', ['as' => 'secret', function() {
	return 'Anda sedang melihat <strong>Halaman Rahasia.</strong>';
}]);

//http://localhost/belajar/showmesecret akan mengarah ke http://localhost/belajar/halaman-rahasia
Route::get('showmesecret', function() {
	return redirect()->route('secret');
});

//CARA 2
//http://localhost/belajar/halaman-rahasia1
Route::get('halaman-rahasia1', function () {
	return 'Anda sedang melihat <strong>Halaman Rahasia 1.</strong>';
})->name('secret1');

//http://localhost/belajar/showmesecret1 akan mengarah ke http://localhost/belajar/halaman-rahasia1
Route::get('showmesecret1', function() {
	return redirect()->route('secret1');
});

//CARA 3 Menggunakan Controller
//http://localhost/belajar/halaman-rahasia2
Route::get('halaman-rahasia2', [
	'as'	=> 'secret2',
	'uses'	=> 'RahasiaController@halamanRahasia2'
]);

//http://localhost/belajar/showmesecret2 akan mengarah ke http://localhost/belajar/halaman-rahasia2
Route::get('showmesecret2', 'RahasiaController@showMeSecret2');

//CARA 4 Menggunakan Controller YANG PALING SEDERHANA
//http://localhost/belajar/halaman-rahasia3
Route::get('halaman-rahasia3', 'RahasiaController@halamanRahasia3')->name('secret3');

//http://localhost/belajar/showmesecret3 akan mengarah ke http://localhost/belajar/halaman-rahasia3
Route::get('showmesecret3', 'RahasiaController@showMeSecret3');

//CONTOH AKSES VIEW -----------------------------------------------

//http://localhost/belajar/ds-homepage
Route::get('ds-homepage', function () {
	return view('homepage');
});

//http://localhost/belajar/ds-about
Route::get('ds-about', function () {
	return view('about');
});

//CONTOH AKSES VIEW DARI SUB FOLDER -------------------------------

//http://localhost/belajar/ds-homepage1
Route::get('ds-homepage1', function () {
	return view('pages/homepage');
});

//http://localhost/belajar/ds-about1
Route::get('ds-about1', function () {
	return view('pages/about');
});

//http://localhost/belajar/ds-homepage2
Route::get('ds-homepage2', function () {
	return view('pages.homepage');
});

//http://localhost/belajar/ds-about2
Route::get('ds-about2', function () {
	return view('pages.about');
});

//CONTOH MEMBERIKAN DATA KE VIEW ----------------------------------

//http://localhost/belajar/siswa
//Route::get('siswa', function () {
	//$siswa = ['Rudi Amirudin', 'Ajeng Dwie Rahayu Lestari', 'M. Adli Shidqi', 'M. Nasser Alfillah Haq'];
	//return view('siswa.index', compact('siswa'));
//});
//Route::get('siswa', function () {
	//$halaman = 'siswa';
	//$siswa = ['Rudi Amirudin', 'Ajeng Dwie Rahayu Lestari', 'M. Adli Shidqi', 'M. Nasser Alfillah Haq'];
	//return view('siswa.index', compact('siswa', 'halaman'));
//});
//Route::get('siswa', 'SiswaController@index');

//http://localhost/belajar/siswa1
Route::get('siswa1', function () {
	$siswa = ['Rudi Amirudin', 'Ajeng Dwie Rahayu Lestari', 'M. Adli Shidqi', 'M. Nasser Alfillah Haq'];
	return view('siswa.index')->with('siswa', $siswa);
});

//http://localhost/belajar/siswa2
Route::get('siswa2', function () {
	$siswa = ['Rudi Amirudin', 'Ajeng Dwie Rahayu Lestari', 'M. Adli Shidqi', 'M. Nasser Alfillah Haq'];
	return view('siswa.index', ['siswa' => $siswa]);
});

//http://localhost/belajar/siswa3
Route::get('siswa3', function () {
	$siswa = ['Rudi Amirudin', 'Ajeng Dwie Rahayu Lestari', 'M. Adli Shidqi', 'M. Nasser Alfillah Haq'];
	return view('siswa.daftar_siswa', compact('siswa'));
});



//http://localhost/belajar/siswa/create --> menampilkan form create
//Route::get('siswa/create', 'SiswaController@create');

//http://localhost/belajar/siswa/1 --> manampilkan siswa dg id 1
//Route::get('siswa/{siswa}', 'SiswaController@show');

//http://localhost/belajar/siswa --> menyimpan inputan dari form create
//Route::post('/siswa', 'SiswaController@store');

//http://localhost/belajar/siswa/1/edit --> menampilkan form edit
//Route::get('siswa/{siswa}/edit', 'SiswaController@edit');

//Route::patch('siswa/{siswa}', 'SiswaController@update');

//Route::delete('siswa/{siswa}', 'SiswaController@destroy');


Route::group(['middleware' => ['web']], function() {
	//Route::get('siswa', 'SiswaController@index');
	//Route::get('siswa/create', 'SiswaController@create');
	//Route::get('siswa/{siswa}', 'SiswaController@show');
	//Route::post('siswa', 'SiswaController@store');
	//Route::get('siswa/{siswa}/edit', 'SiswaController@edit');
	//Route::patch('siswa/{siswa}', 'SiswaController@update');
	//Route::delete('siswa/{siswa}', 'SiswaController@destroy');

	Route::get('siswa/cari', 'SiswaController@cari');
	Route::resource('siswa', 'SiswaController');
});





//CONTOH ENCRYPT DECRYPT ----------------------------------

//http://localhost/belajar/encrypt/12345
Route::get('encrypt/{key}', 'Test1Controller@encrypt');

//http://localhost/belajar/decrypt/key
Route::get('decrypt/{key}', 'Test1Controller@decrypt');

//http://localhost/belajar/encode/12345
Route::get('encode/{key}', 'Test1Controller@encode');

//http://localhost/belajar/decode/key
Route::get('decode/{key}', 'Test1Controller@decode');


//CONTOH INSERT DATA ---------------------------------------

//http://localhost/belajar/sampledata
Route::get('sampledata', function() {
	DB::table('siswa')->insert([
		[
			'nisn'			=> '1001',
			'nama'			=> 'Rudi Amirudin',
			'tanggal_lahir'	=> '1987-06-05',
			'jenis_kelamin' => 'L',
			'id_kelas'		=> '1',
			'created_at'	=> '2019-05-11 13:00:00'
		],

		[
			'nisn'			=> '1002',
			'nama'			=> 'Ajeng Dwie Rahayu Lestari',
			'tanggal_lahir'	=> '1989-06-12',
			'jenis_kelamin' => 'P',
			'id_kelas'		=> '2',
			'created_at'	=> '2019-05-11 13:00:00'
		],

		[
			'nisn'			=> '1003',
			'nama'			=> 'Muhammad Adli Shidqi',
			'tanggal_lahir'	=> '2013-11-04',
			'jenis_kelamin' => 'L',
			'id_kelas'		=> '3',
			'created_at'	=> '2019-05-11 13:00:00'
		],

		[
			'nisn'			=> '1004',
			'nama'			=> 'Muhammad Nasser Alfillah Haq',
			'tanggal_lahir'	=> '2014-10-31',
			'jenis_kelamin' => 'L',
			'id_kelas'		=> '4',
			'created_at'	=> '2019-05-11 13:00:00'
		],

	]);
});


//ELOQUENT : COLLECTION ---------------------------------------

//http://localhost/belajar/tes-collection
Route::get('tes-collection', 'SiswaController@tesCollection');

//http://localhost/belajar/tes-collection-first
Route::get('tes-collection-first', 'SiswaController@tesCollectionFirst');

//http://localhost/belajar/tes-collection-last
Route::get('tes-collection-last', 'SiswaController@tesCollectionLast');

//http://localhost/belajar/tes-collection-count
Route::get('tes-collection-count', 'SiswaController@tesCollectionCount');

//http://localhost/belajar/tes-collection-count1
Route::get('tes-collection-count1', 'SiswaController@tesCollectionCount1');

//http://localhost/belajar/tes-collection-take
Route::get('tes-collection-take', 'SiswaController@tesCollectionTake');

//http://localhost/belajar/tes-collection-pluck
Route::get('tes-collection-pluck', 'SiswaController@tesCollectionPluck');

//http://localhost/belajar/tes-collection-where
Route::get('tes-collection-where', 'SiswaController@tesCollectionWhere');

//http://localhost/belajar/tes-collection-wherein
Route::get('tes-collection-wherein', 'SiswaController@tesCollectionWhereIn');

//http://localhost/belajar/tes-collection-toarray
Route::get('tes-collection-toarray', 'SiswaController@tesCollectionToArray');

//http://localhost/belajar/tes-collection-tojson
Route::get('tes-collection-tojson', 'SiswaController@tesCollectionToJson');


//ACCESSOR MUTATOR ---------------------------------------

//http://localhost/belajar/date-mutator
Route::get('date-mutator', 'SiswaController@dateMutator');

//http://localhost/belajar/date-mutator1
Route::get('date-mutator1', 'SiswaController@dateMutator1');

//http://localhost/belajar/date-mutator-age
Route::get('date-mutator-age', 'SiswaController@dateMutatorAge');

//http://localhost/belajar/date-mutator-ultah
Route::get('date-mutator-ultah', 'SiswaController@dateMutatorUltah');