<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuota extends CI_Controller {

	public function index()
	{
        $barang = $this->db->query("select * from barang join harga on barang.id_harga=harga.id_harga");
        $data['barang'] = $barang;
		$this->load->view('kuota', $data);
    }
    public function getharga($id_barang){
        $barang = $this->db->query("select harga,barang.id_harga, stock from barang join harga on barang.id_harga=harga.id_harga where id_barang=".$id_barang."")->row();
        $data['msg'] = array('harga'=>$barang->harga, 'id_harga' => $barang->id_harga, 'stock' => $barang->stock);
        $data['status'] = 'succes';
        echo json_encode($data);
    }
    public function harga_tambah(){
		$this->load->view('kuota-harga-tambah');
    }
    public function harg_save($harga, $harga_beli, $margin){
        $data = array( 'harga' => $harga,'harga_beli' => $harga_beli, 'margin' => $margin );
        if($this->db->insert('harga', $data)){
            $data['status'] = 'succes';
            echo json_encode($data);
        }else{
            $data['status'] = 'error';
            echo json_encode($data);
        }
    }
    public function save($id_barang, $idharga, $jumlah, $stock){
        $this->db->trans_start();
        $data = array( 'id_barang' => $id_barang,'id_harga' => $idharga, 'jumlah' => $jumlah );
        $this->db->insert('trx', $data);
        $stock = $stock - $jumlah;
        $this->db->query("update barang set stock=".$stock." where id_barang=".$id_barang."");
        $this->db->trans_complete();

        if($this->db->trans_status()){
            $data['status'] = 'succes';
            echo json_encode($data);
        }else{
            $data['status'] = 'error';
            echo json_encode($data);
        }
    }
    public function daftar(){
        $barang = $this->db->query("select * from barang join harga on barang.id_harga=harga.id_harga");
        $data['barang'] = $barang;
		$this->load->view('kuota-daftar', $data);
    }
    public function daftar_tambah(){
        $harga = $this->db->query("select * from harga");
        $data['harga'] = $harga;
		$this->load->view('kuota-daftar-tambah', $data);
    }
    public function daftar_save(){
        if( $_POST['nama'] == '' || $_POST['kadaluarsa'] == '' || $_POST['stock'] == '' || $_POST['id_harga'] == ''){
            $data['status'] = 'error';
            echo json_encode($data);
        } else {
            $this->db->trans_start();
            $this->db->insert('barang', $_POST);
            $id_barang = $this->db->insert_id();
            $data = array( 'id_barang' => $id_barang,'stock' => $_POST['stock'] );
            $this->db->insert('stock', $data);
            $this->db->trans_complete();

            if($this->db->trans_status()){
                $data['status'] = 'succes';
                echo json_encode($data);
            }else{
                $data['status'] = 'error';
                echo json_encode($data);
            }
        }
    }
    public function trx(){
        if( isset( $_GET['waktu']) ){
            $waktu = $_GET['waktu'];
            $trx = $this->db->query("select * from trx left join barang on barang.id_barang=trx.id_barang left join harga on harga.id_harga=trx.id_harga where waktu like '".$waktu."%'");
            $data['trx'] = $trx;
        } else {
            $trx = $this->db->query("select * from trx left join barang on barang.id_barang=trx.id_barang left join harga on harga.id_harga=trx.id_harga");
            $data['trx'] = $trx;
        }
		$this->load->view('kuota-trx', $data);
    }
    public function stock_ubah($id_barang, $stock_old){
        $data['id_barang'] = $id_barang;
        $data['stock_old'] = $stock_old;
		$this->load->view('kuota-stock-ubah', $data);
    }
    public function stock_save($id_barang, $stock, $stock_old){
        $this->db->trans_start();
        $data = array( 'id_barang' => $id_barang,'stock' => $stock );
        $this->db->insert('stock', $data);
        $this->db->query("update barang set stock=".($stock+$stock_old)." where id_barang=".$id_barang."");
        $this->db->trans_complete();

        if($this->db->trans_status()){
            $data['status'] = 'succes';
            echo json_encode($data);
        }else{
            $data['status'] = 'error';
            echo json_encode($data);
        }
    }
}
