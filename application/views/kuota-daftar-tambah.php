

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
            <p>Tambah Daftar Kuota</p>
            <form id="form_daftar_barang">
                <div class="form-group">
                    <p>Nama Barang</p>
                    <input type="input" class="nama" name="nama" require>
                </div>
                <div class="form-group">
                    <p>kadaluarsa</p>
                    <input type="date" class="kadaluarsa" name="kadaluarsa" require>
                </div>
                <div class="form-group">
                    <p>Stock</p>
                    <input type="input" class="stock" name="stock" require>
                </div>
                <div class="form-group">
                    <p>Harga</p>
                    <select name="id_harga" class="id_harga">
                        <?php foreach ($harga->result() as $row){?>
                        <option value="<?php echo $row->id_harga?>"><?php echo rupiah($row->harga)?>/jual - <?php echo rupiah($row->harga_beli)?>/beli - <?php echo rupiah($row->margin)?>/margin</option>
                        <?php } ?>
                    </select>

                    <a href="<?php echo $this->config->item('base_url') ?>index.php/kuota/harga_tambah" class="btn btn-primary  btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> tambah data harga</a>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary simpan">Simpan</button>
                    <div class="loading_save">
                        loading ...
                    </div>
                </div>
                <div class="notif_status">
                </div>
            </form>
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
        $(document).on('submit', '#form_daftar_barang', function(e){
			e.preventDefault();
            $(".loading_save").show();
            var data = new FormData(document.getElementById('form_daftar_barang'));
            $.ajax({
                url: '<?php echo $this->config->item('base_url') ?>index.php/kuota/daftar_save',
                type: 'POST',
	            data: data,
                dataType: 'JSON',
                contentType:false,
	            processData:false,
	            success: function(rst){
	                if(rst.status != 'error'){   
                        $(".notif_status").html("<div class=\"alert alert-success\" role=\"alert\"><span data-feather=\"info\"></span> Data Berhasil disimpan</div>");
                    } else {
                        $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Data Gagal disimpan. Mungkin terdapat data yang belum lengkap</div>");
                    }
                    $(".loading_save").hide();
                }
            });
        });
    });
    </script>
    
  </body>
</html>
