<!-- Start: Content Wrapper -->
<div class="content-wrapper">

  <!-- Start: Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Uji</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- End: Content Header (Page header) -->

  <!-- Start: Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_uji')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_uji');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url() ?>DataUji/hitung" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Age</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="Age">
                    </div>
                    <div class="form-group">
                      <label>AnnualSalary</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="AnnualSalary">
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>User_ID</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>AnnualSalary</th>
                  <th>Purchased</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($training as $row) { ?>
                  <tr>
                    <td><?= $row->User_ID ?></td>
                    <td><?= $row->Gender ?></td>
                    <td><?= $row->Age ?></td>
                    <td><?= $row->AnnualSalary ?></td>
                    <td><?= $row->Purchased ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url() ?>DataUji/hapus/<?= $row->User_ID ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                        <a href="<?= base_url() ?>DataUji/ubah/<?= $row->User_ID ?>" class="btn btn-warning">update</a>
                      </div>
                    </td>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End: Main content -->

</div>
<!-- End: Content Wrapper -->

<!-- Start: Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hasil data Uji </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $this->session->flashdata('flash_hitung'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal -->