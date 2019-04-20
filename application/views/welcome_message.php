

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Narrow Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->config->item('base_url') ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->config->item('base_url') ?>css/jumbotron-narrow.css" rel="stylesheet">

  </head>

  <body>

    <div class="">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-left">
            <li role="presentation" class="active"><a href="#">Utama</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/kuota">Kuota</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/atm">ATM Mini</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/atk">ATK</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/foto_copy">Foto Copy</a></li>
          </ul>
        </nav>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h4>Pencatatan Toko</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
        </div>
      </div>

      <footer class="footer">
      </footer>

    </div> <!-- /container -->


    
  </body>
</html>
