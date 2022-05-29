$(document).ready(function () {
  $('.form_login.form-control').each(function () {
    $(this).on("blur focus", function () {
      let focus = $(this).attr('id');
      let dataform = setupform('form_login', 'serialize');

      $('.form_login').removeClass('is-invalid');
      $('.form_login').removeClass('is-valid');

      login(dataform.url + '/validation', dataform.method, dataform.form, dataform.formData, focus);
    });
  });

  $('#form_login').on('submit', function (e) {
    e.preventDefault();
    let dataform = setupform('form_login', 'serialize');

    $('.form_login').removeClass('is-invalid');
    $('.form_login').removeClass('is-valid');

    $('#submit_login').html('<i class="fa fa-spinner fa-spin"></i>');

    setTimeout(() => {
      login(dataform.url + '/process', dataform.method, dataform.form, dataform.formData, false);
    }, 300);
  });

  console.log(base_url('auth/dashboard'));

  const login = function (url, method, form, formData, focus) {
    $.ajax({
      url: url,
      type: method,
      data: formData,
      dataType: 'json',
      async: false,
      success: function (callback) {
        $('#submit_login').html('Sign In');

        if (callback.status == false && callback.errors !== null) {
          let errors = callback.errors;

          $.each(errors, function (key, value) {
            if (focus !== false && focus == key) {
              $('#' + key).addClass('is-invalid');
              $('.invalid-feedback.' + key).text(value);
            } else if (focus == false) {
              $('#' + key).addClass('is-invalid');
              $('.invalid-feedback.' + key).text(value);
            }
          });
        } else if (callback.status == false && callback.errors == null) {
          Swal.fire({
            text: callback.message,
            icon: 'error',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            willClose: function () {
              $('.form_login').removeClass('is-valid');
              $('.form_login').removeClass('is-invalid');

              $('.form_login.form_reset').val('');
            }
          });
        } else if (callback.status == true && callback.type == 'validation') {
          $('.form_login').addClass('is-valid');
          $('.form_login').removeClass('is-invalid');
        } else if (callback.status == true && callback.type == 'process') {
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
        }
      },
      error: function (callback) {
        console.log(callback)
      }
    });
  }

  const setupform = function (formId, typeFormData) {
    let form = $(`#${formId}`);

    let formData;
    if (typeFormData == 'serialize') {
      formData = form.serialize();
    } else {
      formData = new FormData(form[0]);
    }

    let url = form.attr('action');
    let method = form.attr('method');

    return { 'form': form, 'formData': formData, 'url': url, 'method': method };
  }
});