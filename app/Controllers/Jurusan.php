<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;

class Jurusan extends BaseController
{
    protected $jm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->jm = new JurusanModel();

        $this->menu = [
                'beranda'=>[
                    'title'=>'BERANDA',
                    'link'=>base_url(),
                    'icon'=> 'fa-solid fa-house',
                    'aktif'=>'', 
                ],
                'jurusan'=>[
                    'title'=>'BIDANG PERMINATAN',
                    'link'=>base_url(). '/jurusan',
                    'icon'=> 'fa-solid fa-building-columns',
                    'aktif'=>'active', 
                ],
                'kelas'=>[
                    'title'=>'DATA KELAS',
                    'link'=>base_url(). '/kelas',
                    'icon'=> 'fa-solid fa-list',
                    'aktif'=>'', 
                ],
                'siswa'=>[
                    'title'=>'DATA SISWA',
                    'link'=>base_url(). '/siswa',
                    'icon'=> 'fa-solid fa-users',
                    'aktif'=>'', 
                ],
            ];
            $this->rules = [
              'kdjurusan' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'kode jurusan tidak boleh kosong',
                ]
              ],
              'nama_jurusan' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'nama jurusan tidak boleh kosong',
                ]
              ],

              'kelas' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'kelas tidak boleh kosong',
                ]
              ],
              'password' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'password tidak boleh kosong',
                ]
              ],   
            ];
    }
    public function index()
    {

        $breadcrumb =' <div class="col-sm-6">
        <h1 class="m-0">Jurusan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
          <li class="breadcrumb-item active">Jurusan</li>
        </ol>
      </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Jurusan";


        $query = $this->jm->find();
        $data['data_jurusan'] = $query;

        return view('jurusan/content', $data);
    }

     public function tambah()
     
     {
       $breadcrumb ='<div class="col-sm-6">
        <h1 class="m-0">Jurusan</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
           <li class="breadcrumb-item"><a href="'.base_url() .'/jurusan">Jurusan</a></li>
           <li class="breadcrumb-item active"> Tambah Jurusan</li>
         </ol>
       </div>';  
     
        
$data['menu'] = $this->menu;
$data['breadcrumb'] = $breadcrumb;
$data['title_card'] = 'Tambah Jurusan';
$data['action'] = base_url() . '/jurusan/simpan';
return view('jurusan/input', $data);
     }
     
     public function simpan()
     {

      if (strtolower($this->request ->getmethod())!== 'post'){

       return redirect()->back()->withInput();

      }

      if(!$this->validate($this->rules))
      {
        return redirect()->back()->withInput();
      }

      $dt  = $this->request->getPost();

      try {
        $simpan = $this->jm->insert($dt);

        return redirect()->to('jurusan')->with('success', 'Data Berhasi Di simpan');
       
      } catch (\CodeIgniter\Database\Exceptions\DataException $e) {

        session()->setFlashdata('error',  $e->getMessage());
        return redirect()->back()->withInput();

      }

      }


     public function hapus($id)
     {
      if (empty($id)) {
        return redirect()->back()->with('error', 'hapus data gagal parameter tidak valid');
      }
      try {
        $this->jm->delete($id);
        return redirect()->to('jurusan')->with('success', 'Data prodi dengan kode'.$id.'berhasil dihapus');
      } catch (\CodeIgniter\Database\Exceptions\DataException $e) {
        return redirect()->to('jurusan')->with('error', $e->getMessage());
      }
     }
     public function edit($id){
      $breadcrumb ='<div class="col-sm-6">
        <h1 class="m-0">Jurusan</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
           <li class="breadcrumb-item"><a href="'.base_url() .'/jurusan">Jurusan</a></li>
           <li class="breadcrumb-item active"> Tambah Jurusan</li>
         </ol>
       </div>';  
     
        
$data['menu'] = $this->menu;
$data['breadcrumb'] = $breadcrumb;
$data['title_card'] = 'Edit jurusan';
$data['action'] = base_url() . '/jurusan/update';

$data['edit_jurusan'] = $this->jm->find($id);
return view('jurusan/input', $data);
}

public function update(){
      $dtedit = $this->request->getPost();
      $param = $dtedit['param'];
      unset($dtedit['param']);
      unset($this->rules['password']);

      if (!$this->validate($this->rules)) {
        return redirect()->back()->withinput();
     }

     if(empty($dtedit['password'])){
      unset($dtedit['password']);
    }

    try {
      $this->jm->update($param, $dtedit);
      return redirect()->to('jurusan')->with('success','Data berhasil di update');
    } catch (\CodeIgniter\Database\Exceptions\DataException $e) {
      session()->setFlashdata('error',  $e->getMessage());
      return redirect()->back()->withInput();
    }

   }
}
