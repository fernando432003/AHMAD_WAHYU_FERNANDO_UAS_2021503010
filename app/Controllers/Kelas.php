<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
class Kelas extends BaseController
{
    protected $jm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->jm = new kelasModel();

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
                    'aktif'=>'active', 
                ],
                'siswa'=>[
                    'title'=>'DATA SISWA',
                    'link'=>base_url(). '/siswa',
                    'icon'=> 'fa-solid fa-users',
                    'aktif'=>'', 
                ],
            ];
            $this->rules = [
              'idkelas' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'kode kelas tidak boleh kosong',
                ]
              ],
              'nama_kelas' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'nama kelas tidak boleh kosong',
                ]
              ],

              'no_kelas' => [
                'rules' => 'required',
                'errors' => [
                  'required' => 'no_kelas tidak boleh kosong',
                ]
              ], 
            ];
    }
    public function index()
    {

        $breadcrumb =' <div class="col-sm-6">
        <h1 class="m-0">kelas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
          <li class="breadcrumb-item active">kelas</li>
        </ol>
      </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data kelas";


        $query = $this->jm->find();
        $data['data_kelas'] = $query;

        return view('kelas/content', $data);
    }

     public function tambah()
     
     {
       $breadcrumb ='<div class="col-sm-6">
        <h1 class="m-0">kelas</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
           <li class="breadcrumb-item"><a href="'.base_url() .'/kelas">kelas</a></li>
           <li class="breadcrumb-item active"> Tambah kelas</li>
         </ol>
       </div>';  
     
        
$data['menu'] = $this->menu;
$data['breadcrumb'] = $breadcrumb;
$data['title_card'] = 'Tambah kelas';
$data['action'] = base_url() . '/kelas/simpan';
return view('kelas/input', $data);
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

        return redirect()->to('kelas')->with('success', 'Data Berhasi Di simpan');
       
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
        return redirect()->to('kelas')->with('success', 'Data prodi dengan kode'.$id.'berhasil dihapus');
      } catch (\CodeIgniter\Database\Exceptions\DataException $e) {
        return redirect()->to('kelas')->with('error', $e->getMessage());
      }
     }
     public function edit($id){
      $breadcrumb ='<div class="col-sm-6">
        <h1 class="m-0">kelas</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item "><a href="'.base_url() .'">Beranda</a></li>
           <li class="breadcrumb-item"><a href="'.base_url() .'/kelas">kelas</a></li>
           <li class="breadcrumb-item active"> Tambah kelas</li>
         </ol>
       </div>';  
     
        
$data['menu'] = $this->menu;
$data['breadcrumb'] = $breadcrumb;
$data['title_card'] = 'Edit kelas';
$data['action'] = base_url() . '/kelas/update';

$data['edit_kelas'] = $this->jm->find($id);
return view('kelas/input', $data);
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
      return redirect()->to('kelas')->with('success','Data berhasil di update');
    } catch (\CodeIgniter\Database\Exceptions\DataException $e) {
      session()->setFlashdata('error',  $e->getMessage());
      return redirect()->back()->withInput();
    }
}
}