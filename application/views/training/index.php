Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Training</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Training</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_training')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_training');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
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
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url() ?>DataTraining/validation_form" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Id Training</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="id_training">
                    </div> -->
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Age</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="jml_penghasilan">
                    </div>
                    <div class="form-group">
                      <label>AnnualSalary</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="AnnualSalary">
                    </div>
                    <div class="form-group">
                      <label>Purchased</label>
                      <select class="form-control" name="Purchased">
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>User_ID</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>AnnualSalary</th>
                  <th>Purchased</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($training as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->User_ID ?></td>
                    <td><?= $row->Gender ?></td>
                    <td><?= $row->Age ?></td>
                    <td><?= $row->AnnualSalary ?></td>
                    <td><?= $row->Purchased ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url() ?>DataTraining/hapus/<?= $row->User_ID ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                        <a href="<?= base_url() ?>DataTraining/ubah/<?= $row->User_ID ?>" class="btn btn-warning">update</a>
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper