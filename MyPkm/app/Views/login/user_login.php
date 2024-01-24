<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Halaman Login</title>

  <link rel="stylesheet" href="/assets/css/signin.css">

  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  
  <link href="/assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
  <main class="form-signin">
  <form method="POST" action="<?= base_url('login/login_action'); ?>">
    <p>
      <?php if (!empty(session()->getFlashdata('error'))) { ?>
      <div class="alert alert-warning">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php } ?>
    </p>
      <img class="mb-4" src="/assets/image/Mypkm.jpg" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Please Sign in!</h1>
      <div class="form-floating">
      <input type="npm" required name="npm" class="form-control" id="npm" placeholder="Npm">
        <label for="floatingInput">Npm</label>
      </div>
      <div class="form-floating">
        <input type="password" required class="form-control" name="password" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <div class="checkbox mb-3">
      <div class="text-end">
      <a href="/login/register">Register</small>
      </div>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; Aplikasi MYPKM</p>
    </form>
  </main>

</body>

</html>