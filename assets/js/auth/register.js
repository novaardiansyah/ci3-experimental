$(document).ready(function () {
  $('.form_register.form-control').each(function () {
    $(this).keyup(function () {
      let focus = $(this).attr('id');
      let dataform = setupform('form_register', 'serialize');

      $('.is-invalid').removeClass('is-invalid');
      register(dataform.url, dataform.method, dataform.form, dataform.formData, focus);
    });
  });

  $('#form_register').on('submit', function (e) {
    e.preventDefault();
    let dataform = setupform('form_register', 'serialize');

    $('.is-invalid').removeClass('is-invalid');
    register(dataform.url, dataform.method, dataform.form, dataform.formData, false);
  });

  const register = function (url, method, form, formData, focus) {
    $.ajax({
      url: url,
      type: method,
      data: formData,
      dataType: 'json',
      async: false,
      success: function (callback) {
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