<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(session()->getFlashdata('success')) {
                ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i>Success</h5>
                  <?php echo session()->getFlashdata('success'); ?>
                </div>
                <?php
                }
                ?>
                
                
                <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>/siswa/tambah"><i class="fa-solid fa-plus"></i> Tambah siswa</a>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Id siswa</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Wali Siswa</th>
                      <th>TTL</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($data_siswa as $r){
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r['id_siswa']; ?></td>
                        <td><?php echo $r['nisn_siswa']; ?></td>
                        <td><?php echo $r['nama_siswa']; ?></td>
                        <td><?php echo $r['wali_siswa']; ?></td>
                        <td><?php echo $r['ttl_siswa']; ?></td>
                        <td>
                          <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/siswa/edit/<?php echo $r['id_siswa']; ?>"><i class="fa-solid fa-edit"></i></a>
                          <a class="btn btn-xs btn-danger" href="#" onclick="return hapusconfig(<?php echo $r['id_siswa']; ?>)"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    } 
                    ?>
                  </tbody>
                </table>
             </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <script>
          function hapusconfig(id){
            Swal.fire({
  title: 'Anda yakin akan hapus',
  text: "Data akan di hapus secara permanent",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      window.location.href='<?php echo base_url();?>/siswa/hapus/' +id;
  }
})
          }
        </script>
<?php
echo $this->endSection();?>