

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
            <p>Tambah Daftar Harga</p>
            <div class="form-group">
                <p>Harga Beli</p>
                <input type="number" class="harga_beli" name="harga_beli" >
            </div>
            <div class="form-group">
                <p>Margin/Keuntungan</p>
                <input type="number" class="margin" name="margin" >
            </div>
            <div class="form-group">
                <p>Harga Jual</p>
                <input type="number" class="harga" name="harga" >
            </div>
            <div class="form-group">
                <button class="btn btn-primary simpan">Simpan</button>
                <div class="loading_save">
                    loading ...
                </div>
            </div>
            <div class="notif_status">
            </div>
            <div class="form-group">
              <a href="<?php echo $this->config->item('base_url') ?>index.php/kuota/daftar_tambah" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> tambah daftar barang</a>
            </div>
        </div>
      </div>

      <footer class="footer">
      </footer>

    </div>


    <script src="<?php echo $this->config->item('base_url') ?>js/jquery-3.3.1.js"></script>
    <script>
    $(document).ready(function(){
        $(".loading_save").hide();
        $(".simpan").click(function(){
            var harga = $(".harga").val();
            var harga_beli = $(".harga_beli").val();
            var margin = $(".margin").val();
            if(harga == '' || harga_beli == "" || margin == ""){
                $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Seluruh Data harus diisi</div>");
                return;
            }
            $(".loading_save").show();
            $.ajax({
                url: '<?php echo $this->config->item('base_url') ?>index.php/kuota/harg_save/'+harga+'/'+harga_beli+'/'+margin,
                type: 'GET',
                success: function(rst, status){
                    rst = $.parseJSON(rst);
                    if(rst.status != 'error'){   
                        $(".notif_status").html("<div class=\"alert alert-success\" role=\"alert\"><span data-feather=\"info\"></span> Data Berhasil disimpan</div>");
                    } else {
                        $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Data Gagal disimpan silahkan cek setiap data yang diinputkan</div>");
                    }
                    $(".loading_save").hide();
                }
            });
        });

    });
    </script>
    
  </body>
</html>
