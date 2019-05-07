

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

      <?php $this->load->view('menu')?>

      <div class="row marketing">
        <div class="col-lg-12">
            <p>Daftar Barang<p>
            <hr/>
            <div class="form-group">
                 <a href="<?php echo $this->config->item('base_url') ?>index.php/kuota/daftar_tambah" class="btn btn-primary simpan"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data Barang</a>
            </div>
            <div class="form-group">
                <table class="table table-condensed daftar_barang" >
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stock Saat Ini</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Tanggal Entry</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($barang -> result() as $row){?>
                        <tr>
                            <th><?php echo $row->id_barang?></th>
                            <td><?php echo $row->nama?></td>
                            <td><?php echo rupiah($row->harga)?></td>
                            <td><?php echo $row->stock?> Buah <a href="<?php echo $this->config->item('base_url') ?>index.php/kuota/stock_ubah/<?php echo $row->id_barang?>/<?php echo $row->stock?>" ><span class="label label-danger">ubah stock</span></a></td>
                            <td><?php echo $row->kadaluarsa?></td>
                            <td><?php echo $row->create_date?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                    
            </div>
        </div>

      </div>

      <footer class="footer">
      </footer>

    </div>
    
    <script src="<?php echo $this->config->item('base_url') ?>js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url') ?>css/datatables.min.css"/>
    <script type="text/javascript" src="<?php echo $this->config->item('base_url') ?>js/datatables.min.js"></script>
    <script>
    $(document).ready( function () {
        $('.daftar_barang').DataTable();
    } );
    </script>

  </body>
</html>
