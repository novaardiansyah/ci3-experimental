$(document).ready(function () {
  setTimeout(function () {
    $('#loader').removeClass("loader");
  }, 500);
});

function base_url(path) {
  if (path !== '') {
    return $('#base_url').data('baseurl') + path;
  } else {
    return $('#base_url').data('baseurl');
  }
}