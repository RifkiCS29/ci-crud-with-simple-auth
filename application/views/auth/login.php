<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url();?>assets/css/style.css">

    <title> <?php echo $judul; ?> </title>
  </head>
  <body>    
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <?php if($this->session->flashdata('pesan_login')): ?>
          <div class="row mt-3">
              <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Data <?= $this->session->flashdata('pesan_login'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          </div>
        <?php endif ?>
          <div class="card mt-3">
            <div class="card-header">Login Mahasiswa</div>
             <div class="card-body">
                <form action="<?= base_url() ?>auth/cek_login" method="post">
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                      <small  class="form-text text-danger"><?= form_error('email'); ?></small>
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      <small  class="form-text text-danger"><?= form_error('password'); ?></small>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
             </div> 
          </div>
        </div>
    </div>
  </div>
    