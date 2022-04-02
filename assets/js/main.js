$(document).ready(function () {
});

function base_url(path) {
  if (path !== '') {
    return $('#base_url').data('baseurl') + path;
  } else {
    return $('#base_url').data('baseurl');
  }
}