<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/dist/css/adminlte.min.css">
  <!-- Main Style -->
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
</head>

<body class="hold-transition <?= $page ?>" data-baseurl="<?= base_url() ?>" id="base_url">
  <div id="loader" class="d-flex justify-content-center align-items-center loader">
    <img src="<?= base_url('assets/images/loader.gif') ?>" alt="loader" width="150" class="img-fluid" />
  </div>