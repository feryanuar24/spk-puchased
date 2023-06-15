Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Training</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Training</li>
            <li class="breadcrumb-item active">Ubah Data Training</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">User_ID</label>
                      <input type="text" class="form-control disabled" name="User_ID" value="<?= $ubah["User_ID"] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Age</label>
                      <input type="text" class="form-control" name="Age" value="<?= $ubah['Age'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">AnnualSalary</label>
                      <input type="text" class="form-control" name="AnnualSalary" value="<?= $ubah['AnnualSalary'] ?>">
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper