<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telepon extends Model
{
    protected $table = 'telepon';

    protected $primaryKey = 'id_siswa'; //digunakan karena laravel secara default menggunakan id sbg primary key. Karena tabel telepon tidak menggunakan id sbg primary key maka harus diset seperti ini

    protected $fillable = ['id_siswa', 'nomor_telepon'];

    public function siswa() {
    	return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
