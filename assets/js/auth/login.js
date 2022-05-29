$(document).ready(function () {
  $('.form_login.form-control').each(function () {
    $(this).on("blur", function () {
      let focus = $(this).attr('id');
      let dataform = setupform('form_login', 'serialize');

      setTimeout(function () {
        login(dataform.url + '/validation', dataform.method, dataform.formData, focus);
      }, 500);
    });

    $(this).on("focus", function () {
      let focus = $(this).attr('id');
      $(`.invalid-feedback.${focus}`).hide();
    });
  });

  $('#form_login').on('submit', function (e) {
    e.preventDefault();
    let dataform = setupform('form_login', 'serialize');

    $('.form_login').removeClass('is-invalid');
    $('.form_login').removeClass('is-valid');

    $('#submit_login').html('<i class="fa fa-spinner fa-spin"></i>');

    setTimeout(() => {
      login(dataform.url + '/process', dataform.method, dataform.formData, false);
    }, 300);
  });

  const login = function (url, method, formData, focus) {
    $.ajax({
      url: url,
      type: method,
      data: formData,
      dataType: 'json',
      async: false,
      success: function (callback) {
        $('#submit_login').html('Sign In');

        if (callback.status == true) {
          Swal.fire({
            text: callback.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            willClose: function () {
              window.location.href = base_url('dashboard');
            }
          });
        } else {
          let errors = callback.errors;

          if (errors) {
            $.each(errors, function (key, value) {
              if (focus !== false && focus == key) {
                $('.invalid-feedback.' + key).text(value);
                $('.invalid-feedback.' + key).show();
              } else if (focus == false) {
                $('.invalid-feedback.' + key).text(value);
                $('.invalid-feedback.' + key).show();
              }
            });
          } else {
            Swal.fire({
              text: callback.message,
              icon: 'error',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              willClose: function () {
                $('.form_login.form_reset').val('');
              }
            });
          }
        }
      },
      error: function (callback) {
        console.log(callback)
      }
    });
  }
});