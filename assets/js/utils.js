$(document).ready(function () {
});

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