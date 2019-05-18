<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; //ini karena aturan dari laravel penamaan harus plural diakhiri s. karena yang kita buat tidak diakhiri s maka kita harus set seperti ini

    protected $fillable = [
    	'nisn',
    	'nama',
    	'tanggal_lahir',
    	'jenis_kelamin',
        'id_kelas',
    ]; //array yang berisi nama-nama kolom yang dapat kita isi secara mass assigment. misal kita punya tabel user yg memiliki field is_admin tidak boleh diisi sembarangan. makanya kita batasi field apa saja yg bisa di input dg cara ini

    //protected $guarded = ['status']; //field selain status boleh diisi secara mas assigment

    //Accessor : Mengkonversi nilai dari database yang ingin ditampilkan pada form
    public function getNamaAttribute($nama) {
    	return ucwords($nama);
    }

    //Mutator : Mengkonversi inputan dari form untuk disimpan ke database
    public function setNamaAttribute($nama) {
    	$this->attributes['nama'] = strtolower($nama);
    }

    protected $dates = ['tanggal_lahir']; //Menjadikan field tanggal lahir menjadi instance carbon

    public function telepon() {
        return $this->hasOne('App\Telepon', 'id_siswa');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function hobi() {
        return $this->belongsToMany('App\Hobi', 'hobi_siswa', 'id_siswa', 'id_hobi')->withTimeStamps();
    }

    public function getHobiSiswaAttribute() {
        return $this->hobi->pluck('id')->toArray();
    }
}
