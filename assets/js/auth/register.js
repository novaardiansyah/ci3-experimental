$(document).ready(function () {
  $('.form_register.form-control').each(function () {
    $(this).on("blur", function () {
      let focus = $(this).attr('id');
      const { url, method, form, formData } = setupform('form_register', 'serialize');

      setTimeout(function () {
        register(url, method, form, formData, focus);
      }, 500);
    });

    $(this).on("focus", function () {
      let focus = $(this).attr('id');
      $(`.invalid-feedback.${focus}`).hide();
    });
  });

  $('#form_register').on('submit', function (e) {
    e.preventDefault();
    const { url, method, form, formData } = setupform('form_register', 'serialize');

    $('#submit_register').html('<i class="fa fa-spinner fa-spin"></i>');

    let agreeTerms;
    $('#agreeTerms').is(':checked') ? agreeTerms = true : agreeTerms = false;

    setTimeout(() => {
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

        $('#submit_register').html('Sign Up');
      } else {
        register(url, method, form, formData);
      }
    }, 500);
  });

  const register = function (url, method, form, formData, focus = false) {
    if (focus !== false) {
      formData += `&focus=${focus}`;
    }

    $.ajax({
      url: url,
      type: method,
      data: formData,
      dataType: 'json',
      async: false,
      success: function (callback) {
        if (callback.status == true && callback.message !== undefined) {
          Swal.fire({
            text: stripHtml(callback.message),
            icon: 'success',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            willClose: function () {
              $('#submit_register').html('Sign Up');
              window.location.href = base_url('auth');
            }
          });

          $('#submit_register').html('Sign Up');
        } else if (callback.status == false) {
          $('#submit_register').html('Sign Up');

          let errors = callback.errors;

          if (errors) {
            $.each(errors, function (key, value) {
              if (focus !== false && focus == key) {
                $('.invalid-feedback.' + key).text(value).show();
              } else if (focus == false) {
                $('.invalid-feedback.' + key).text(value).show();
              }
            });
          } else {
            Swal.fire({
              text: stripHtml(callback.message),
              icon: 'error',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              willClose: function () {
                $('#submit_register').html('Sign Up');
              }
            });

            $('#submit_register').html('Sign Up');
          }
        }

        return;
      },
      error: function (xhr, status, error) {
        Swal.fire({
          text: `Something went wrong, please try again (8N0R9E).`,
          icon: 'error',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          willClose: function () {
            $('#submit_register').html('Sign Up');
          }
        });

        $('#submit_register').html('Sign Up');
        console.log(xhr.responseText);
      }
    });
  }
});