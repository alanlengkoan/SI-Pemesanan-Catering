<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link href="admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="admin/assets/styles.css" rel="stylesheet" media="screen">

  </head>
  <body id="login">

    <!-- container -->
    <div class="container">
      <form class="form-signin" name="login" action="login_cek.php" method="POST" onSubmit="return validasi(this)">
        <h2 class="form-signin-heading">Silahkan Login</h2>
        <input name="username" type="text" class="input-block-level" placeholder="Username" required>
        <input name="password" type="password" class="input-block-level" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>

        <p>Belum punya Akun ? Klik <a href="register.php">disini</a> </p>

        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>
    </div>
    <!-- /container -->

  </body>
</html>
