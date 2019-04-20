

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
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>">Utama</a></li>
            <li role="presentation" class="active"><a href="<?php echo $this->config->item('base_url') ?>index.php/kuota">Kuota</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/atm">ATM</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/atk">ATK</a></li>
            <li role="presentation"><a href="<?php echo $this->config->item('base_url') ?>index.php/foto_copy">Foto - Copy</a></li>
          </ul>
        </nav>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
            <p>Ubah Stock</p>

            <div class="form-group">
                <p>Penambahan Stock</p>
                <input type="hidden" class="stock_old" name="stock_old" value="<?php echo $stock_old ?>" >
                <input type="hidden" class="id_barang" name="id_barang" value="<?php echo $id_barang ?>" >
                <input type="input" class="stock" name="stock" >
            </div>
            <div class="form-group">
            <button class="btn btn-primary simpan">Simpan</button>
                <div class="loading_save">
                    loading ...
                </div>
            </div>
            <div class="notif_status">
            </div>
    
        </div>

      </div>

      <footer class="footer">
        <ul class="nav nav-pills pull-left">
            <li><a href="<?php echo $this->config->item('base_url') ?>index.php/kuota">Input Transaksi</a></li>
            <li><a href="<?php echo $this->config->item('base_url') ?>index.php/kuota/daftar">Daftar Barang</a></li>
            <li><a href="<?php echo $this->config->item('base_url') ?>index.php/kuota/trx">Transaksi Kuota</a></li>
        </ul>
      </footer>

    </div>


    <script src="<?php echo $this->config->item('base_url') ?>js/jquery-3.3.1.js"></script>
    <script>
    $(document).ready(function(){
        $(".loading_save").hide();
        $(".simpan").click(function(){
            var id_barang = $(".id_barang").val();
            var stock_old = $(".stock_old").val();
            var stock = $(".stock").val();
            if(id_barang == '' || stock == ""){
                $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Seluruh Data harus diisi</div>");
                return;
            }
            $(".loading_save").show();
            $.ajax({
                url: '<?php echo $this->config->item('base_url') ?>index.php/kuota/stock_save/'+id_barang+'/'+stock+'/'+stock_old,
                type: 'GET',
                success: function(rst, status){
                    rst = $.parseJSON(rst);
                    if(rst.status != 'error'){   
                        $(".notif_status").html("<div class=\"alert alert-success\" role=\"alert\"><span data-feather=\"info\"></span> Data Berhasil disimpan</div>");
                        window.location = "<?php echo $this->config->item('base_url') ?>/index.php/kuota/daftar";
                    } else {
                        $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Data Gagal disimpan</div>");
                    }
                    $(".loading_save").hide();
                }
            });
        });

    });
    </script>
    
  </body>
</html>
