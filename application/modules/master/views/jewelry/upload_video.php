<!-- @include header -->
<!-- @inlude navbar -->
<!-- @include sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Upload Video</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row main-row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body px-4">

              <div class="row mb-3">
                <div class="col-12">
                  <label for="" class="text-capitalize">Images</label>
                </div>

                <div class="col-md-3">
                  <img src="<?= base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" alt="images" class="img-fluid" width="100">
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                  <img src="<?= base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" alt="images" class="img-fluid" width="100">
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                  <img src="<?= base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" alt="images" class="img-fluid" width="100">
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                  <img src="<?= base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" alt="images" class="img-fluid" width="100">
                </div>
                <!-- /.col -->
              </div>

              <form action="<?= base_url('master/jewelry/upload_vide') ?>" method="post" enctype="multipart/form-data">

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="item_code" class="text-capitalize">item code</label>
                    <input type="text" class="form-control" id="item_code" name="item_code" placeholder="item code" value="<?= set_value('item_code') ?>" disabled />
                  </div>
                  <!-- /.col -->

                  <div class="col-md-6">
                    <label for="item_name" class="text-capitalize">item name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" placeholder="item name" value="<?= set_value('item_name') ?>" disabled />
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.form-group -->

                <div class="form-group row">
                  <div class="col-md-6 order-1">
                    <label for="video_path" role="button" class="text-capitalize">video</label>

                    <div class="custom-file">
                      <input type="file" id="video_path" name="video_path" class="custom-file-input" value="<?= set_value('video_path') ?>" role="button" />

                      <label class="custom-file-label" for="">Choose file</label>
                    </div>

                    <div class="row video-preview mt-3">
                      <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://youtube.com/embed/5hT2O-0tc9I"></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->

                  <div class="col-md-6">
                    <label for="item_code" class="text-capitalize">item code</label>
                    <input type="text" class="form-control" id="item_code" name="item_code" placeholder="item code" value="<?= set_value('item_code') ?>" disabled />
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.form-group -->
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.main-row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- @include footer -->