

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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>css/bootstrap-select.min.css">

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
          <p>Input Transaksi Kuota</p>
            <div class="form-group">
                <p>Barang</p>
                <select class="barang selectpicker"  data-live-search="true" name="barang" require>
                    <option value="">- Pilih -</option>
                    <?php foreach($barang->result() as $row){?>
                    <option value="<?php echo $row->id_barang?>"><?php echo $row->nama?> -  <?php echo rupiah($row->harga)?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <p>Harga</p>
                <div class="loading">
                    loading ...
                </div>
                <div class="harga">
                </div>
            </div>
            <div class="form-group">
                <p>Stock</p>
                <div class="loading">
                    loading ...
                </div>
                <div class="stock">
                </div>
            </div>
            <div class="form-group">
                <p>Jumlah</p>
                <select class="jumlah selectpicker" name="jumlah" require>
                    <option value="">- Pilih -</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
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
    <script src="<?php echo $this->config->item('base_url') ?>js/bootstrap.js"></script>
    <script src="<?php echo $this->config->item('base_url') ?>js/bootstrap-select.min.js"></script>
    <script src="<?php echo $this->config->item('base_url') ?>js/i18n/defaults-id_ID.js"></script>


    <script>
    $(document).ready(function(){
        $(".loading").hide();
        $(".loading_save").hide();
        $('select.barang.selectpicker').on('change', function(){
            var barang = $('.barang.selectpicker option:selected').val();
            if(barang == ''){
                $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Barang harus dipilih</div>");
            } else {
                $(".loading").show();
                $.ajax({
                    url: '<?php echo $this->config->item('base_url') ?>index.php/kuota/getharga/'+barang,
                    type: 'GET',
                    success: function(rst, status){
                        rst = $.parseJSON(rst);
                        if(rst.status != 'error'){   
                            $(".loading").hide();
                            $(".harga").html("<div class=\"alert alert-info\" role=\"alert\"><span data-feather=\"info\"></span> "+formatRupiah(rst.msg.harga)+"</div><input type='hidden' name='id_harga' class='id_harga' value='"+rst.msg.id_harga+"'>");
                            $(".stock").html("<div class=\"alert alert-info\" role=\"alert\"><span data-feather=\"info\"></span>"+rst.msg.stock+"</div><input type='hidden' name='stock' class='stock' value='"+rst.msg.stock+"'>");
                        } else {
                            $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> "+rst.msg+"</div>");
                        }
                    }
                });
            }
        });

        $(".simpan").click(function(){
            var barang = $('.barang.selectpicker option:selected').val();
            var harga = $(".id_harga").val();
            var jumlah = $('.jumlah.selectpicker option:selected').val();
            var stock = $(".stock").val();
            if(barang == '' || jumlah == ""){
                $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Barang dan jumlah harus dipilih</div>");
                return;
            }
            var stock = $(".stock").text();
            if (stock == '0'){
                $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Stock barang Kosong</div>");
            }else{
                $(".loading_save").show();
                $.ajax({
                    url: '<?php echo $this->config->item('base_url') ?>index.php/kuota/save/'+barang+'/'+harga+'/'+jumlah+'/'+stock,
                    type: 'GET',
                    success: function(rst, status){
                        rst = $.parseJSON(rst);
                        if(rst.status != 'error'){   
                            $(".notif_status").html("<div class=\"alert alert-success\" role=\"alert\"><span data-feather=\"info\"></span> Data Berhasil disimpan</div>");
                        } else {
                            $(".notif_status").html("<div class=\"alert alert-danger\" role=\"alert\"><span data-feather=\"info\"></span> Data Gagal disimpan</div>");
                        }
                        $(".loading_save").hide();
                    }
                });
            }
        });
        
        function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

    });
    </script>

    
  </body>
</html>
