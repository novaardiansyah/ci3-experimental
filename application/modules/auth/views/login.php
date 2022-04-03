<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>"><b>CI3</b> Experimental</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?= base_url('auth/process_login') ?>" method="post" id="form_login" autocomplete="off">
        <div class="input-group mb-3">
          <input type="email" class="form-control form_login" id="email" name="email" placeholder="Email">
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

        <div class="input-group mb-3">
          <input type="password" class="form-control form_login form_reset" id="password" name="password" placeholder="Password">
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

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="submit_login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="<?= base_url('auth/forgot-password') ?>">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url('auth/register') ?>" class="text-center">Register a new account.</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->