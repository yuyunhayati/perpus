<?php defined('BASEPATH') or exit ('NO Direct Script Access Allowed');  
class Peminjaman extends CI_Controller{    
 function __construct(){         
 parent::__construct();         
 // cek login         
 if($this->session->userdata('status') != "login"){             
 	$alert=$this->session->set_flashdata('alert', 'Anda belum Login');             
 	redirect(base_url());         
 }     
}  
    function index(){         
    	$data['peminjaman'] = $this->db->query("SELECT * FROM detail_pinjam D, peminjaman P, buku B, anggota A WHERE B.id_buku=D.id_buku and A.id_anggota=P.id_anggota")->result(); 
 $this->load->view('admin/header');        
  $this->load->view('admin/peminjaman',$data);         
  $this->load->view('admin/footer');     }  
  //one to many     
  public function tambah_pinjam($id){         
  	if($this->session->userdata('status') != "login"){             
  		$alert=$this->session->set_flashdata('alert', 'Anda belum Login');             
  		redirect(base_url());         
  	}else{             
  		$d = $this->M_perpus->find($id, 'buku');             
  		$isi = array(                 
  			'id_pinjam' => $this->M_perpus->kode_otomatis(),                 
  			'id_buku' => $id,                 
  			'id_anggota' => $this->session->userdata('id_agt'),                 
  			'tgl_pencatatan' => date('Y-m-d'),                 
  			'tgl_pinjam' => '-',                 
  			'tgl_kembali' => '-',                 
  			'denda' => '10000',                 
  			'tgl_pengembalian' =>'-',                 
  			'total_denda' =>'0',                 
  			'status_peminjaman' =>'Belum Selesai',                 
  			'status_pengembalian' =>'Belum Kembali',             
  			);             
  		$o = $this->M_perpus->edit_data(array('id_buku'=>$id),'transaksi')->num_rows();             
  		if($o>0) {                 
  			$this->session->set_flashdata('alert','Buku ini sudah ada dikeranjang');                 
  			redirect(base_url().'member');             }             
  			$this->M_perpus->insert_data($isi, 'transaksi');             
  			$jml_buku = $d->jumlah_buku-1;             
  			$w=array('id_buku'=>$id);             
  			$data = array('jumlah_buku'=>$jml_buku);             
  			$this->M_perpus->update('buku', $data,$where);             
  			redirect(base_url().'member');         
  		}     
    }
}
