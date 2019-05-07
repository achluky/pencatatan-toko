

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
            <p>Daftar Transaksi Toko<p>
            <hr/>
            <form action="<?php echo $this->config->item('base_url') ?>index.php/kuota/trx">
            <div class="form-group">
                <p>Filter</p>
                <input type="date" class="waktu" name="waktu" >
                <button class="btn btn-primary btn-sm simpan"> <span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter</button>
            </div>
            </form>
            <div class="form-group">
                <table class="table table-striped daftar_barang">
                    <thead>
                        <tr>
                        <th>Tanggal</th>
                        <th>Id Barang</th>
                        <th>Barang</th>
                        <th>Harga/Satuan</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Total</th>
                        <?php if(isset($_GET['private']) and $_GET['private'] == 'karunia') {?>
                        <th>Margin Total</th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $jumlah =  0;
                          $harga_tot =  0;
                          $margin_tot =  0;
                          foreach($trx -> result() as $row){
                            $jumlah += $row->jumlah;
                            $harga_tot += ($row->jumlah * $row->harga);
                            $margin_tot += ($row->jumlah * $row->margin);
                        ?>
                          <tr>
                              <td><?php echo $row->waktu?></td>
                              <th><?php echo $row->id_barang?></th>
                              <td><?php echo $row->nama?></td>
                              <td><?php echo rupiah($row->harga)?></td>
                              <td><?php echo $row->jumlah?></td>
                              <td><?php echo rupiah($row->jumlah * $row->harga)?></td>
                              <?php if(isset($_GET['private']) and $_GET['private'] == 'karunia') {?>
                              <td><?php echo rupiah($row->jumlah * $row->margin)?></td>
                              <?php } ?>
                          </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo $jumlah?></th>
                            <th><?php echo rupiah($harga_tot)?></th>
                            <?php if(isset($_GET['private']) and $_GET['private'] == 'karunia') {?>
                            <th><?php echo rupiah($margin_tot)?></th>
                            <?php } ?>
                        </tr>
                    </tfoot>
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
