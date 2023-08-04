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
                <form action="<?php echo $action; ?>"  method="post" autocomplete="off">
                <div class="card-body">
                    <?php if (validation_errors()) {
                        ?>
                        
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                          <h5><i class="icone fas fa-ban"></i>error</h5>
                          <?php echo validation_list_errors() ?>
                        </div>
              <?php 
                    }
                    ?>
                    <?php
              if(session()->getFlashdata('error')){
                ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <h5><i class="icone fas fa-warning"></i>error</h5>
                  <?php echo session()->getflashdata('error'); ?>
                </div>
              <?php
              }
              ?>
              
                <?php echo csrf_field() ?>
                <?php
                if(current_url(true)->getSegment(2) == 'edit'){
                  ?>
                  <input type="hidden" name="param" id="param" value="<?php echo $edit_siswa['id_siswa'];?>">
                  <?php
                }
                ?>    
                <div class=" form-group">
                    <label for="id_siswa">ID siswa</label>
                    <input type="text" name="id_siswa" id="id_siswa" value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_siswa['id_siswa']) ? "": $edit_siswa['id_siswa']) : set_value('id_siswa'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nisn_siswa">NISN</label>
                    <input type="text" name="nisn_siswa" id="nisn_siswa" value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_siswa['id_siswa']) ? "": $edit_siswa['nisn_siswa']) : set_value('nisn_siswa'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" name="nama_siswa" id="nama_siswa"  value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_siswa['id_siswa']) ? "": $edit_siswa['nama_siswa']) : set_value('nama_siswa'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="wali_siswa">Wali Siswa</label>
                    <input type="text" name="wali_siswa" id="wali_siswa"  value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_siswa['id_siswa']) ? "": $edit_siswa['wali_siswa']) : set_value('wali_siswa'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ttl_siswa">TTL Siswa</label>
                    <input type="text" name="ttl_siswa" id="ttl_siswa"  value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_siswa['id_siswa']) ? "": $edit_siswa['ttl_siswa']) : set_value('ttl_siswa'); ?>" class="form-control">
                </div>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
              </div>
              </form>
</div>

<?php
echo $this->endSection(); ?>