$(document).ready(function () {
  $('.form_register.form-control').each(function () {
    $(this).on("blur", function () {
      let focus = $(this).attr('id');
      let dataform = setupform('form_register', 'serialize');

      setTimeout(function () {
        register(dataform.url + '/validation', dataform.method, dataform.formData, focus);
      }, 500);
    });

    $(this).on("focus", function () {
      let focus = $(this).attr('id');
      $(`.invalid-feedback.${focus}`).hide();
    });
  });

  $('#form_register').on('submit', function (e) {
    e.preventDefault();
    let dataform = setupform('form_register', 'serialize');

    $('.form_register').removeClass('is-invalid');

    $('#submit_register').html('<i class="fa fa-spinner fa-spin"></i>');

    let agreeTerms;
    $('#agreeTerms').is(':checked') ? agreeTerms = true : agreeTerms = false;

    if (agreeTerms == false) {
      Swal.fire({
        text: 'You must agree to the terms and conditions',
        icon: 'error',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        willClose: function () {
          $('#submit_register').html('Sign Up');
        }
      });
    } else {
      setTimeout(() => {
        register(dataform.url + '/process', dataform.method, dataform.formData, false);
      }, 300);
    }
  });

  const register = function (url, method, formData, focus) {
    $.ajax({
      url: url,
      type: method,
      data: formData,
      dataType: 'json',
      async: false,
      success: function (callback) {
        $('#submit_register').html('Sign Up');

        if (callback.status == true) {
          Swal.fire({
            text: callback.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            willClose: function () {
              window.location.href = base_url('auth');
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
                $('.form_register.form_reset').val('');
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