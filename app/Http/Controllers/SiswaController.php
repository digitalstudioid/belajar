<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Telepon;
use App\Kelas;
use App\Hobi;
use Carbon\Carbon;
//use Validator; Validasi Manual
use App\Http\Requests\SiswaRequest;
//use storage;
use Illuminate\Support\Facades\Storage;
use Session;

class SiswaController extends Controller
{
	private function uploadFoto(SiswaRequest $request) {
		$foto 	= $request->file('foto');
		$ext 	= $foto->getClientOriginalExtension();

		if ($request->file('foto')->isValid()) {
			$foto_name		= date('YmdHis'). ".$ext";
			$upload_path	= 'fotoupload';
			$request->file('foto')->move($upload_path, $foto_name);

			return $foto_name;
		}

		return false;
	}

	private function hapusFoto(Siswa $siswa) {
		$exist = Storage::disk('foto')->exists($siswa->foto);

		if (isset($siswa->foto) && $exist) {
			$delete = Storage::disk('foto')->delete($siswa->foto);
			if ($delete) {
				return true;
			}
			return false;
		}
	}

    public function index () {
    	//$halaman = 'siswa';
		//$siswa = ['Rudi Amirudin', 'Ajeng Dwie Rahayu Lestari', 'M. Adli Shidqi', 'M. Nasser Alfillah Haq'];
		//return view('siswa.index', compact('siswa', 'halaman'));

		//$halaman 		= 'siswa'; //digantikan dg source di template
		//$siswa_list		= Siswa::all()->sortBy('nisn');
		//$jumlah_siswa	= $siswa_list->count();
		//return view('siswa.index', compact('halaman', 'siswa_list', 'jumlah_siswa'));
		//return view('siswa.index', compact('siswa_list', 'jumlah_siswa'));

    	//Menambah simple pagination
		//$siswa_list		= Siswa::orderBy('nisn', 'asc')->simplePaginate(3);	
		$siswa_list		= Siswa::orderBy('nisn', 'asc')->Paginate(3);	
		$jumlah_siswa	= Siswa::count();
		return view('siswa.index', compact('siswa_list', 'jumlah_siswa'));
    }

    public function create() {
    	//$halaman = 'siswa'; //digantikan dg source di template
    	//return view('siswa.create', compact('halaman'));

    	//hanya untuk simpan data tanpa adanya relasi
    	//return view('siswa.create');

    	
    	/*Karena kita menggunakan visual composer maka tidak menggunakan syntax ini
    	$list_kelas = Kelas::pluck('nama_kelas', 'id');
    	$list_hobi	= Hobi::pluck('nama_hobi', 'id');
    	return view('siswa.create', compact('list_kelas', 'list_hobi'));*/

    	return view('siswa.create');
    }

    //public function store(Request $request) {
    	//$siswa = $request->all();
    	//return $siswa;
    //}

    /*Agar object request dapat dibaca semua class maka kita masukkan object request di tingkat constructor :
    
    protected $request;

	public function __construct(Request $req) {
		$this->request = $req;
	}

	public function store() {
		$data = $this->request;
		$siswa = $data->all();
		$siswa = $this->request->all();
		return $siswa;		
	}*/

	//public function store(Request $request) {
	//Kita menggunakan validation form
	public function store(SiswaRequest $request) {
		/*Step ini cukup repot jika kita memiliki banyak field
		$siswa = new \App\Siswa;
		$siswa->nisn 			= $request->nisn;
		$siswa->nama 			= $request->nama;
		$siswa->tanggal_lahir	= $request->tanggal_lahir;
		$siswa->jenis_kelamin	= $request->jenis_kelamin;
		$siswa->save();
		return redirect('siswa');*/

		//$input = $request->all();
		//Siswa::create($input);
		//return redirect('siswa');

		/*Menyimpan data tanpa validator
		Siswa::create($request->all());
		return redirect('siswa');*/

		$input	= $request->all();

		//Validasi Manual
		//$validator	= Validator::make($input, [

		//Validasi Validate Trait
		/*Kita hapus jg karena menggunakan validation form
		$this->validate($request, [
			'nisn'			=> 'required|string|size:4|unique:siswa,nisn',
			'nama'			=> 'required|string|max:30',
			'tanggal_lahir'	=> 'required|date',
			'jenis_kelamin'	=> 'required|in:L,P',
			'nomor_telepon'	=> 'sometimes|numeric|digits_between:10,15|unique:telepon,nomor_telepon',
			'id_kelas'		=> 'required',
		]);*/

		/*Validasi Manual
		if ($validator->fails()) {
			return redirect('siswa/create')
				->withInput()
				->withErrors($validator);
		}*/

		/*Penyimpanan tanpa relasi
		Siswa::create($input);
		return redirect('siswa');*/

		/*if ($request->hasFile('foto')) {
			$foto	= $request->file('foto');
			$ext 	= $foto->getClientOriginalExtension();

			if ($request->file('foto')->isValid()) {
				$foto_name		= date('YmdHis'). ".$ext";
				$upload_path	= 'fotoupload';
				$request->file('foto')->move($upload_path, $foto_name);
				$input['foto']	= $foto_name;
			}
		}*/

		//Upload foto
		if ($request->hasFile('foto')) {
			$input['foto'] = $this->uploadFoto($request);
		}

		//Simpan Siswa
		$siswa 	= Siswa::create($input);

		//Simpan Telepon
		$telepon = new Telepon;
		$telepon->nomor_telepon = $request->input('nomor_telepon');
		$siswa->telepon()->save($telepon);

		//Simpan Hobi
		$siswa->hobi()->attach($request->input('hobi_siswa'));
		Session::flash('flash_message', 'Data siswa berhasil disimpan.');
		return redirect('siswa');

	}

	//public function show($id) {
	public function show(Siswa $siswa) {
		//$halaman	= 'siswa';  //digantikan dg source di template
		//$siswa 		= Siswa::findOrFail($id);
		//return view('siswa.show', compact('halaman', 'siswa'));
		return view('siswa.show', compact('siswa'));
	}

	//public function edit($id) {
	public function edit(Siswa $siswa) {
		/*Penyimpanan tanpa relasi
		$siswa = Siswa::findOrFail($id);
		return view('siswa.edit', compact('siswa'));*/

		//$siswa = Siswa::findOrFail($id);
		$siswa->nomor_telepon = $siswa->telepon->nomor_telepon;
		/*Karena kita menggunakan visual composer maka tidak menggunakan syntax ini
		$list_kelas = Kelas::pluck('nama_kelas', 'id');
		$list_hobi	= Hobi::pluck('nama_hobi', 'id');
		return view('siswa.edit', compact('siswa', 'list_kelas', 'list_hobi'));*/
		return view('siswa.edit', compact('siswa'));
	}

	//public function update($id, Request $request) {
	//Kita menggunakan validation form
	//public function update($id, SiswaRequest $request) {
	public function update(Siswa $siswa, SiswaRequest $request) {
		/*Menyimpan tanpa validasi
		$siswa = Siswa::findOrFail($id);
		$siswa->update($request->all());
		return redirect('siswa');*/

		//$siswa 	= Siswa::findOrFail($id);
		$input 	= $request->all();

		//Validasi Manual
		//$validator = Validator::make($input, [

		//Validasi Validate Trate
		/*Kita hapus jg karena menggunakan validation form
		$this->validate($request, [
			'nisn' 			=> 'required|string|size:4|unique:siswa,nisn,' . $request->input('id'),
			'nama'			=> 'required|string|max:30',
			'tanggal_lahir'	=> 'required|date',
			'jenis_kelamin'	=> 'required|in:L,P',
			'nomor_telepon'	=> 'sometimes|numeric|digits_between:10,15|unique:telepon,nomor_telepon,' . $request->input('id') . ',id_siswa',
			'id_kelas'		=> 'required',
		]);*/

		/*Validasi Manual
		if ($validator->fails()) {
			return redirect('siswa/' . $id . '/edit')
					->withInput()
					->withErrors($validator);
		}*/


		//Cek apakah ada foto baru di form
		if ($request->hasFile('foto')) {

			//Hapus foto lama jika ada foto baru
			/*$exist = Storage::disk('foto')->exists($siswa->foto);
			if (isset($siswa->foto) && $exist) {
				$delete = Storage::disk('foto')->delete($siswa->foto);
			}*/
			$this->hapusFoto($siswa);

			//Upload foto baru
			/*$foto 	= $request->file('foto');
			$ext 	= $foto->getClientOriginalExtension();

			if ($request->file('foto')->isValid()) {
				$foto_name		= date('YmdHis'). ".$ext";
				$upload_path	= 'fotoupload';
				$request->file('foto')->move($upload_path, $foto_name);
				$input['foto'] 	= $foto_name;
			}*/
			$input['foto'] = $this->uploadFoto($request);
		}

		//Update Siswa
		//$siswa->update($request->all());
		$siswa->update($input);

		//Update Telepon
		/*untuk update relasi*/
		$telepon = $siswa->telepon;
		//$telepon->nomor_telepon = $request->input('nomor_telepon');
		$telepon->nomor_telepon = $input['nomor_telepon'];
		$siswa->telepon()->save($telepon);

		//Update Hobi
		$siswa->hobi()->sync($request->input('hobi_siswa'));

		Session::flash('flash_message', 'Data siswa berhasil diupdate.');

		return redirect('siswa');
	}

	//public function destroy($id) {
	public function destroy(Siswa $siswa) {
		//$siswa = Siswa::findOrFail($id);
		$this->hapusFoto($siswa);
		$siswa->delete();

		Session::flash('flash_message', 'Data siswa berhasil dihapus.');
		Session::flash('penting', true);

		return redirect('siswa');
	}

	public function cari(Request $request) {
		/*$kata_kunci		= $request->input('kata_kunci');
		$query			= Siswa::where('nama', 'LIKE', '%' . $kata_kunci . '%');
		$siswa_list 	= $query->paginate(2);
		$pagination		= $siswa_list->appends($request->except('page'));
		$jumlah_siswa	= $siswa_list->total();
		return view('siswa.index', compact('siswa_list', 'kata_kunci', 'pagination', 'jumlah_siswa'));*/

		$kata_kunci		= trim($request->input('kata_kunci');

		if(!empty($kata_kunci)) {
			$jenis_kelamin = $request->input('jenis_kelamin');
			$id_kelas = $request->input('id_kelas');

			//Query
			$query = Siswa::where('nama', 'LIKE', '%' . $kata_kunci . '%');
			(!empty($jenis_kelamin)) ? $query->where('jenis_kelamin', $jenis_kelamin) : '';
			(!empty($id_kelas)) ? $query->where('id_kelas', $id_kelas) : '';
			$siswa_list = $query->paginate(2);

			//URL Link Pagination
			$pagination = (!empty($jenis_kelamin)) ? $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : '';
			$pagination = (!empty($id_kelas)) ? $pagination = $siswa_list->appends(['id_kelas' => $id_kelas]) : '';
			$pagination = $siswa_list->appends(['kata_kunci' => $kata_kunci]);

			$jumlah_siswa = $siswa_list->total();
			return view('siswa.index', compact('siswa_list', 'kata_kunci', 'pagination', 'jumlah_siswa', 'id_kelas', 'jenis_kelamin'));
		}

		return redirect('siswa');
	}

	public function tesCollection() {
		$orang 		= ['rudi amirudin', 'ajeng dwie rahayu lestari', 'muhammad adli shidqi', 'muhammad nasser alfillah haq'];
		$koleksi	= collect($orang)->map(function($nama) {
			return ucwords($nama);
		});

		return $koleksi;
	}

	public function tesCollectionFirst() {
		$collection = Siswa::all()->first();
		return $collection;
	}

	public function tesCollectionLast() {
		$collection = Siswa::all()->last();
		return $collection;
	}

	public function tesCollectionCount() {
		$collection = Siswa::all();
		$jumlah 	= $collection->count();
		return 'Jumlah Data : ' . $jumlah;

		//Jika sudah ada filter maka jumlah yang ditampilkan adalah jumlah data yg terfilter
	}

	public function tesCollectionCount1() {
		$siswa 	= Siswa::all();
		$jumlah = Siswa::count();
		return 'Jumlah Data : ' . $jumlah;
	}

	public function tesCollectionTake() {
		$collection 	= Siswa::all()->take(2);
		return $collection;
	}

	public function tesCollectionPluck() {
		$collection 	= Siswa::all()->pluck('nama');
		return $collection;
	}

	public function tesCollectionWhere() {
		$collection 	= Siswa::all();
		$collection 	= $collection->where('nisn', '1002');
		return $collection;
	}

	public function tesCollectionWhereIn() {
		$collection 	= Siswa::all();
		$collection 	= $collection->whereIn('nisn', ['1003', '1004']);
		return $collection;
	}

	public function tesCollectionToArray() {
		$collection 	= Siswa::select('nisn', 'nama')->take(3)->get();
		$koleksi		= $collection->toArray();
		foreach ($koleksi as $siswa) {
			echo $siswa['nisn'] . ' - ' . $siswa['nama'] . '<br>';
		}
	}

	public function tesCollectionToJson() {
		$data = [
			['nisn' => '1001', 'nama' => 'Rudi Amirudin'],
			['nisn' => '1002', 'nama' => 'Ajeng Dwie Rahayu Lestari'],
			['nisn' => '1003', 'nama' => 'Muhammad Adli Shidqi'],			
		];

		$koleksi =  collect($data);
		$koleksi->toJson();
		return $koleksi;
	}

	public function dateMutator() {
		$siswa = Siswa::findOrFail(9);
		dd($siswa->tanggal_lahir);
	}

	public function dateMutator1() {
		$siswa = Siswa::findOrFail(9);
		dd($siswa->created_at);
	}

	public function dateMutatorAge() {
		$siswa = Siswa::findOrFail(9);
		return 'Umur siswa ini adalah : ' . $siswa->tanggal_lahir->age . ' tahun.';
	}

	public function dateMutatorUltah() {
		$siswa 	= Siswa::findOrFail(9);
		$str 	= 'Tanggal Lahir : ' . $siswa->tanggal_lahir->format('d-m-Y') . '<br>' . 'Ulang tahun ke-40 akan jatuh pada tanggal : ' . '<strong>' . $siswa->tanggal_lahir->addYears(40)->format('d-m-Y')  . '</strong>';
		return $str;
	}

}
