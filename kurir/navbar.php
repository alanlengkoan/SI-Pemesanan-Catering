<!-- navbar menu -->
<nav class="navbar navbar-default navbar-fixed">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="index.php">Beranda</a>
        </li>
        <li>
          <a href="order.php">Daftar Order</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> <?= $nama ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="keluar.php">Keluar <span class="glyphicon glyphicon-log-out"></span></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar menu -->
