<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class siswa extends BaseController
{
    protected $jm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->jm = new SiswaModel();

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
                    'aktif'=>'', 
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
                    'aktif'=>'active', 
                ],
            ];
            $this->rules = [
              'id_siswa' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'id_siswa tidak boleh kosong',
                ]
              ],
              'nisn_siswa' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'nisn_siswa tidak boleh kosong',
                ]
              ],

              'nama_siswa' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'nama_siswa tidak boleh kosong',
                ]
              ],
              'wali_siswa' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'wali_siswa tidak boleh kosong',
                ]
              ],   
              'ttl_siswa' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'ttl_wali tidak boleh kosong',
                ]
              ],   
            ];
    }
    public function index()
    {

        $breadcrumb =' <div class="col-sm-6">
        <h1 class="m-0">siswa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
          <li class="breadcrumb-item active">siswa</li>
        </ol>
      </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data siswa";


        $query = $this->jm->find();
        $data['data_siswa'] = $query;

        return view('siswa/content', $data);
    }

     public function tambah()
     
     {
       $breadcrumb ='<div class="col-sm-6">
        <h1 class="m-0">siswa</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
           <li class="breadcrumb-item"><a href="'.base_url() .'/siswa">siswa</a></li>
           <li class="breadcrumb-item active"> Tambah siswa</li>
         </ol>
       </div>';  
     
        
$data['menu'] = $this->menu;
$data['breadcrumb'] = $breadcrumb;
$data['title_card'] = 'Tambah siswa';
$data['action'] = base_url() . '/siswa/simpan';
return view('siswa/input', $data);
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

        return redirect()->to('siswa')->with('success', 'Data Berhasi Di simpan');
       
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
        return redirect()->to('siswa')->with('success', 'Data prodi dengan kode'.$id.'berhasil dihapus');
      } catch (\CodeIgniter\Database\Exceptions\DataException $e) {
        return redirect()->to('siswa')->with('error', $e->getMessage());
      }
     }
     public function edit($id){
      $breadcrumb ='<div class="col-sm-6">
        <h1 class="m-0">siswa</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
           <li class="breadcrumb-item"><a href="'.base_url() .'/siswa">siswa</a></li>
           <li class="breadcrumb-item active"> Tambah siswa</li>
         </ol>
       </div>';  
     
        
$data['menu'] = $this->menu;
$data['breadcrumb'] = $breadcrumb;
$data['title_card'] = 'Edit siswa';
$data['action'] = base_url() . '/siswa/update';

$data['edit_siswa'] = $this->jm->find($id);
return view('siswa/input', $data);
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
      return redirect()->to('siswa')->with('success','Data berhasil di update');
    } catch (\CodeIgniter\Database\Exceptions\DataException $e) {
      session()->setFlashdata('error',  $e->getMessage());
      return redirect()->back()->withInput();
    }

   }
}
