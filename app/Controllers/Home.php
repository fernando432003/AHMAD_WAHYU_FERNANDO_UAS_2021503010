<?php

namespace App\Controllers;

use CodeIgniter\Debug\Toolbar\Collectors\Views;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda'=>[
                'title'=>'BERANDA',
                'link'=>base_url(),
                'icon'=> 'fa-solid fa-house',
                'aktif'=>'active', 
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
                'aktif'=>'', 
            ],
        ];

        $breadcrumb =' <div class="col-sm-6">
        <h1 class="m-0">Beranda</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Beranda</li>
        </ol>
      </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to may site";
        $data['selamat_datang'] = "selamat datang";
        return View("template/content",$data);
    }
}
