$(document).ready(function () {
  $('.form_register.form-control').each(function () {
    $(this).keyup(function () {
      let focus = $(this).attr('id');
      let dataform = setupform('form_register', 'serialize');

      $('.form_register').removeClass('is-invalid');
      $('.form_register').removeClass('is-valid');

      register(dataform.url + '/validation', dataform.method, dataform.form, dataform.formData, focus);
    });
  });

  $('#form_register').on('submit', function (e) {
    e.preventDefault();
    let dataform = setupform('form_register', 'serialize');

    $('.form_register').removeClass('is-invalid');
    $('.form_register').removeClass('is-valid');

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
        register(dataform.url + '/process', dataform.method, dataform.form, dataform.formData, false);
      }, 300);
    }
  });

  const register = function (url, method, form, formData, focus) {
    $.ajax({
      url: url,
      type: method,
      data: formData,
      dataType: 'json',
      async: false,
      success: function (callback) {
        $('#submit_register').html('Sign Up');

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
              $('.form_register').removeClass('is-valid');
              $('.form_register').removeClass('is-invalid');

              $('.form_register.form_reset').val('');
            }
          });
        } else if (callback.status == true && callback.type == 'validation') {
          $('.form_register').addClass('is-valid');
          $('.form_register').removeClass('is-invalid');
        } else if (callback.status == true && callback.type == 'process') {
          Swal.fire({
            text: callback.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            willClose: function () {
              window.location.href = callback.redirect;
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