<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url() ?>"><b>CI3</b> Experimental</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?= base_url('auth/process_register') ?>" method="post" id="form_register">
        <div class="input-group">
          <input type="text" class="form-control form_register" id="fullname" name="fullname" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>

          <div class="invalid-feedback fullname">
            <!-- Content Here (from Ajax) -->
          </div>
        </div>
        <!-- /.input-group -->

        <div class="input-group mt-3">
          <input type="text" class="form-control form_register" id="email" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

          <div class="invalid-feedback email">
            <!-- Content Here (from Ajax) -->
          </div>
        </div>
        <!-- /.input-group -->

        <div class="input-group mt-3">
          <input type="password" class="form-control form_register" id="password" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          <div class="invalid-feedback password">
            <!-- Content Here (from Ajax) -->
          </div>
        </div>
        <!-- /.input-group -->

        <div class="input-group mt-3">
          <input type="password" class="form-control form_register" id="confirm_password" name="confirm_password" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          <div class="invalid-feedback confirm_password">
            <!-- Content Here (from Ajax) -->
          </div>
        </div>
        <!-- /.input-group -->

        <div class="row mt-3">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="submit_register">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="<?= base_url('auth') ?>" class="text-center">I already have an account.</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->