<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$a['page']	= "d_amain";
		
		$this->load->view('admin/aaa', $a);
	}

	public function klas_surat() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM ref_klasifikasi")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/klas_surat/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$uraian					= addslashes($this->input->post('uraian'));
	
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi WHERE nama LIKE '%$cari%' OR uraian LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_klas_surat";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_klas_surat";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM ref_klasifikasi WHERE id = '$idu'")->row();	
			$a['page']		= "f_klas_surat";
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE ref_klasifikasi SET nama = '$nama', uraian = '$uraian' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('admin/klas_surat');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_klas_surat";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	
	public function surat_masuk() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$ta = $this->session->userdata('admin_ta');
		
		/* pagination */	
		

		$total_row		= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta'")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/surat_masuk/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		$to 					= $this->uri->segment(5);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel post
		$idp					= addslashes($this->input->post('idp'));
		$file_attachment		= addslashes($this->input->post('file_attachement'));
		$no_surat				= addslashes($this->input->post('no_surat'));

		$tglsurat				= addslashes($this->input->post('tgl_surat'));
		$tgl_surat				= date("Y-m-d", strtotime($tglsurat));

		$uraian					= addslashes($this->input->post('uraian'));
		$keterangan				= addslashes($this->input->post('ket'));
		$no_setum				= addslashes($this->input->post('no_setum'));
		$tgl_setum				= date('Y-m-d');
		$status_surat			= addslashes($this->input->post('status_surat'));
		$derajat				= addslashes($this->input->post('derajat'));
		$klasifikasi			= addslashes($this->input->post('klasifikasi'));
		$kepada					= addslashes($this->input->post('kepada'));
		$perihal				= addslashes($this->input->post('perihal'));
		$instansi				= addslashes($this->input->post('instansi')); 
		

		//upload config 
		$config['upload_path'] 		= './upload/surat_masuk';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000000';
		$config['max_width']  		= '30000';
		$config['max_height'] 		= '30000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM notadinas.surat_masuk WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('index.php/admin/surat_masuk');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE perihal LIKE '%$cari%' OR file_attachment LIKE '%$cari%' OR dari LIKE '%$cari%' OR no_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_surat_masuk";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_masuk";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();	
			$a['page']		= "f_surat_masuk";
		}else if ($mau_ke == "kirim") {
			$cc = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '".$idu."'")->row();
			if($cc->kepada == 1 ){
				$this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 2 WHERE id = '$idu'");
			}else if ($cc->kepada == 5){
				$this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 4 WHERE id = '$idu'");			
			}else{
				$this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 3 WHERE id = '$idu'");			
			}
			
			$this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,'".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','1','".$this->session->userdata('admin_id')."')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been sent. ".$this->upload->display_errors()."</div>");
			redirect('index.php/admin/surat_masuk');
		} else if ($mau_ke == "disp") {
			$admin = $this->session->userdata('admin_jabatan');
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();	
			$a['dataksi']	= $this->db->query("SELECT * FROM notadinas.master_aksi")->result();	
			$a['datajabat']	= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id NOT IN (SELECT id FROM notadinas.master_jabatan WHERE id = '$admin')")->result();	
			$a['page']		= "f_surat_masuk";
		} else if ($mau_ke == "kadisp") {
			$admin = $this->session->userdata('admin_jabatan');
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();	
			$a['tabaksi'] = $this->db->query("select c.tanggal_proses,d.nama_jabatan,b.keterangan,b.jenis,e.nama_aksi from notadinas.surat_masuk a
            join notadinas.log_proses_surat_masuk c on a.id = c.id_suratmasuk
            join notadinas.disposisi_surat_masuk b on c.id = b.id_log_proses
            join notadinas.master_jabatan d on b.penerima_disposisi = d.id
            join notadinas.master_aksi e on b.aksi = e.id
            where a.id = '$idu'")->result();
            $a['dataksi']	= $this->db->query("SELECT * FROM notadinas.master_aksi")->result();	
			$a['datajabat']	= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = '2'")->result();	
			$a['page']		= "f_surat_masuk";
		}else if($mau_ke == "subdisp"){
			$admin = $this->session->userdata('admin_jabatan');
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();	
			$a['tabaksi'] = $this->db->query("select c.tanggal_proses,d.nama_jabatan,b.keterangan,b.jenis,e.nama_aksi from notadinas.surat_masuk a
            join notadinas.log_proses_surat_masuk c on a.id = c.id_suratmasuk
            join notadinas.disposisi_surat_masuk b on c.id = b.id_log_proses
            join notadinas.master_jabatan d on b.penerima_disposisi = d.id
            join notadinas.master_aksi e on b.aksi = e.id
            where a.id = '$idu'")->result();
			$a['subaksi'] = $this->db->query("select c.tanggal_proses,d.nama_jabatan,b.keterangan,b.jenis,e.nama_aksi from notadinas.surat_masuk a
            join notadinas.log_proses_surat_masuk c on a.id = c.id_suratmasuk
            join notadinas.disposisi_surat_masuk b on c.id = b.id_log_proses
            join notadinas.master_jabatan d on b.penerima_disposisi = d.id
            join notadinas.master_aksi e on b.aksi = e.id
            where b.penerima_disposisi = 5 and a.id = '$idu'")->result();
            $a['dataksi']	= $this->db->query("SELECT * FROM notadinas.master_aksi")->result();	
			$a['datajabat']	= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id NOT IN (SELECT id FROM notadinas.master_jabatan WHERE id = '$admin')")->result();	
			$a['page']		= "f_surat_masuk";
		}else if ($mau_ke == "act_add") {	
				
			if ($this->upload->do_upload('file_attachment')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO notadinas.surat_masuk VALUES (DEFAULT, '$tgl_surat', '$instansi', '$no_surat', '$perihal', '$keterangan', '$kepada', '$no_setum', '$tgl_setum', '$klasifikasi', '$derajat', 1, '".$this->session->userdata('admin_id')."' ,'".$up_data['file_name']."')");
				
			} else {
				$this->db->query("INSERT INTO notadinas.surat_masuk VALUES (DEFAULT, '$tgl_surat', '$instansi', '$no_surat', '$perihal', '$keterangan', '$kepada', '$no_setum', '$tgl_setum', '$klasifikasi', '$derajat', 1, '".$this->session->userdata('admin_id')."' , 'Tidak ada attachment')");
			}	
				$id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.surat_masuk")->row();
				$this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,$id->qwe,NOW(),'".$this->session->userdata('admin_id')."','$kepada','$keterangan','1','".$this->session->userdata('admin_id')."')");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. ".$this->upload->display_errors()."</div>");
			redirect('index.php/admin/surat_masuk');
		} else if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('file_attachment')) {
				$up_data	 	= $this->upload->data();
							
				$this->db->query("UPDATE notadinas.surat_masuk SET tgl_surat = '$tgl_surat', instansi = '$instansi', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$keterangan', kepada = '$kepada', no_setum = '$no_setum', tgl_setum = '$tgl_setum', klasifikasi = '$klasifikasi', file_attachment = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE notadinas.surat_masuk SET tgl_surat = '$tgl_surat', instansi = '$instansi', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$keterangan', kepada = '$kepada', no_setum = '$no_setum', tgl_setum = '$tgl_setum', klasifikasi = '$klasifikasi' WHERE id = '$idp'");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. ".$this->upload->display_errors()."</div>");			
			redirect('index.php/admin/surat_masuk');
		} else if($mau_ke == "disp_proses"){
			$data = array();
			$data =$this->input->post('data');
			$no = $this->input->post('no');
			$lihat = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $no")->row();
			$idn = $lihat->id;
			$admin = $this->session->userdata('admin_id');

			foreach($data as $a){
				$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT, '$a[0]', '$idn', '$a[1]', '1', '$a[2]', '$a[3]')");		var_dump($a[3]);
				$this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,'$no',NOW(),'$admin','$a[0]','$a[3]','2','".$this->session->userdata('admin_id')."')");
			}

			$this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 3 WHERE id = '$no'");

			die();
		} else if($mau_ke == "kadisp_proses"){
			$data = array();
			$data =$this->input->post('data');
			$no = $this->input->post('no');
			$lihat = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $no")->row();
			$idn = $lihat->id;
			$admin = $this->session->userdata('admin_id');

			foreach($data as $a){
				$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT, '$a[0]', '$idn', '$a[1]', '1', '$a[2]', '$a[3]')");		var_dump($a[3]);
				$this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,'$no',NOW(),'$admin','$a[0]','$a[3]','2','".$this->session->userdata('admin_id')."')");
			}

			$this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 4 WHERE id = '$no'");

			die();
		} else {
			$admin = $this->session->userdata('admin_jabatan');
			if($admin == 2){
				$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();
			}else if($admin == 1){
				$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND kepada = '$admin' LIMIT $akhir OFFSET $awal")->result();
			}else if($admin == 3){
				$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND status_surat_masuk = '3' OR kepada = '$admin' LIMIT $akhir OFFSET $awal")->result();
			}else{
				$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND status_surat_masuk = '4' LIMIT $akhir OFFSET $awal")->result();
			}
			$a['page']		= "l_surat_masuk";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function surat_keluar() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$ta = $this->session->userdata('admin_ta');
		// print_r($this->session->all_userdata());
		// die();
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta'")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/surat_keluar/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan //i think these variable will not use again anymore
		$idp					= addslashes($this->input->post('idp'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		$kode					= addslashes($this->input->post('kode'));
		$uraian					= addslashes($this->input->post('uraian'));

		//new variable
		$dari					= addslashes($this->input->post('dari'));

		$tglsurat				= addslashes($this->input->post('tgl_surat'));
		$tgl_surat				= date("Y-m-d", strtotime($tglsurat));

		$no_surat				= addslashes($this->input->post('no_surat'));
		$perihal				= addslashes($this->input->post('perihal'));
		$isi_surat				= addslashes($this->input->post('isi_surat'));
		$lampiran				= addslashes($this->input->post('lampiran'));
		$ket					= addslashes($this->input->post('ket'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload/surat_keluar';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		// $config['max_size']			= '2000';
		// $config['max_width']  		= '3000';
		// $config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if($mau_ke == "cetak_surat_keluar"){
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user")->result();
			$a['page'] = 'cetak_surat_keluar';
			// var_dump($a['user_n']);
			// die();
		}else if($mau_ke == "verifikasi_submit_setum"){
			if($this->input->post('no_surat')!=""){
				$this->db->query("UPDATE notadinas.surat_keluar SET no_surat = '".$this->input->post('no_surat')."', status_surat_keluar = 5 WHERE id = $idu");
			}
			redirect(base_url().'admin/surat_keluar');
		}else if($mau_ke == "verifikasi_submit_kapushidrosal_setuju"){
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '".$idu."'")->row();
			$this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','4','".$this->input->post('komentar_kapushidrosal')."')");
			$this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 4 WHERE id = $idu");
			redirect(base_url().'admin/surat_keluar');
		}elseif($mau_ke == "verifikasi_submit_kapushidrosal"){
			// die($cc->kepada);
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '".$idu."'")->row();
			$this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','1','".$this->input->post('komentar_kapushidrosal')."')");
			$this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 3 WHERE id = $idu");
			redirect(base_url().'admin/surat_keluar');
		}else if($mau_ke == "verifikasi_submit"){
			$jabatan = $this->input->post('jabatan');
			$status = $this->input->post('status');
			$keterangan = $this->input->post('keterangan_tembusan');
			$count = 0;
			$a = "";
			$b = "";
			for($l=0; $l<count($status); $l++){
				if($status[$l]==2){
					$a .= "2";
				}
				$b .= "2";
			}
			// var_dump($keterangan);
			// die();
			$this->db->query("DELETE FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = $idu");
			for($ab=1;$ab<=count($jabatan);$ab++){
				$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
				$jids = $jid->qwe + 1;
				$this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('".$jids."','".$jabatan[$count]."','".$status[$count]."','".$keterangan[$count]."','".$idu."')");
				$count = $count + 1;
			}
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '".$idu."'")->row();
			if($a==$b){
				$this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 2 WHERE id = $idu");
				$this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','3','')");
			}else{
				$this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 0 WHERE id = $idu");
				$this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','1','')");
			}
			redirect(base_url().'admin/surat_keluar');
		}else if($mau_ke == "verifikasi_surat_keluar"){
			$a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id WHERE log_proses_surat_keluar.id_suratkeluar = $idu")->result();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
			$a['datpil_tembusan']	= $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$idu'")->result();
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user")->result();
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();
			$a['page']		= "f_surat_keluar";
		}else if($mau_ke == "kirim_kelain"){
			$this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 1 WHERE id = '".$idu."';");
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '".$idu."'")->row();
			$this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','2','')");
			redirect(base_url().'admin/surat_keluar');
		}else if($mau_ke == "cetak_input_tembusan"){
			$data = addslashes($this->input->post('data'));
			$count = addslashes($this->input->post('count'));
			$aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
			foreach($aa as $aaa){
				$bb = "
					<input type='text' name='jabatan[]' value='".$aaa->id."' readonly hidden/>
					<input type='text' name='status[]' value='1' readonly hidden/>";
				$count++;
			}
			echo $bb;
			die();
		}else if($mau_ke == "tambah_tembusan"){
			$data = addslashes($this->input->post('data'));
			$count = addslashes($this->input->post('count'));
			$aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
			foreach($aa as $aaa){
				$bb = "
				<tbody>
				<tr style='vertical-align:top;'>
					<td>".$count."</td>
					<td>".$aaa->nama_jabatan ."</td>
					<td><!--
						<div class='col-md-6'><a class='btn-default btn btn-xs' style='float:right;'>Setuju</a></div>
						<div class='col-md-6'><a class='btn-default btn btn-xs' style='float:left;'>Koreksi</a></div>-->
					</td>
					<td><textarea name='keterangan_tembusan[]' class='form-control'></textarea></td>
				</tr>
				</tbody>";
				$count++;
			}
			echo $bb;
			die();
		}else if ($mau_ke == "del") {
			$this->db->query("DELETE FROM notadinas.surat_keluar WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			if($this->session->userdata('admin_level') != "Super Admin"){
			redirect('admin/surat_keluar');}
			else{
			redirect('admin/agenda_surat_keluar');
			}
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE perihal LIKE '%$cari%' OR tujuan LIKE '%$cari%' OR no_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_surat_keluar";
		} else if ($mau_ke == "add") {
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user")->result();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
			$a['page']		= "f_surat_keluar";
		} else if ($mau_ke == "edt") {
			$a['lognya']	= $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = $idu ORDER BY id DESC")->row();
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user")->result();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
			$a['datpil_tembusan']	= $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$idu'")->result();
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();	
			$a['page']		= "f_surat_keluar";
		} else if ($mau_ke == "act_add") {	
			$id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.surat_keluar")->row();
			echo $ids = $id->qwe + 1;
			// die();
			echo $jabatan = $this->input->post('jabatan');
			$keterangan_tembusan = $this->input->post('keterangan_tembusan');
			// die();/*
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				$count = 0;
				for($ab=1;$ab<=count($jabatan);$ab++){
					$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
					$jids = $jid->qwe + 1;
					$this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('".$jids."','".$jabatan[$count]."','0','".$keterangan_tembusan[$count]."','".$ids."')");
					$count = $count + 1;
				}
				$this->db->query("INSERT INTO notadinas.surat_keluar VALUES ('$ids', '$tgl_surat', '".$this->session->userdata('admin_id')."', '', '$perihal', '$ket', '$isi_surat', '0', '".$this->session->userdata('admin_id')."','".$up_data['file_name']."', '$dari')");
				// $this->db->query("INSERT INTO surat_keluar VALUES (NULL, '$kode', '$no_agenda', '$uraian', '$dari', '$no_surat', '$tgl_surat', NOW(), '$ket', '".$up_data['file_name']."', '".$this->session->userdata('admin_id')."')");
			} else {
				$count = 0;
				for($ab=1;$ab<=count($jabatan);$ab++){
					$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
					$jids = $jid->qwe + 1;
					$this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('".$jids."','".$jabatan[$count]."','0','".$keterangan_tembusan[$count]."','".$ids."')");
					$count = $count + 1;
				}
				$this->db->query("INSERT INTO notadinas.surat_keluar VALUES ('$ids', '$tgl_surat', '".$this->session->userdata('admin_id')."', '', '$perihal', '$ket', '$dari', '$isi_surat', '0', '".$this->session->userdata('admin_id')."','')");
				// $this->db->query("INSERT INTO surat_keluar VALUES (NULL, '$kode', '$no_agenda', '$uraian', '$dari', '$no_surat', '$tgl_surat', NOW(), '$ket', '', '".$this->session->userdata('admin_id')."')");
			}		
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			redirect('admin/surat_keluar');//*/
		} else if ($mau_ke == "act_edt") {
			$jabatan = $this->input->post('jabatan');
			$status = $this->input->post('status');
			$keterangan_tembusan = $this->input->post('keterangan_tembusan');
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				$this->db->query("UPDATE notadinas.surat_keluar SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat', file_attachment = '".$up_data['file_name']."' WHERE id = '$idp'");
				// $this->db->query("UPDATE surat_keluar SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE notadinas.surat_keluar SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat' WHERE id = '$idp'");
				// $this->db->query("UPDATE surat_keluar SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
			}	
			$this->db->query("DELETE FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = '$idp'");
			$count = 0;
			for($ab=1;$ab<=count($jabatan);$ab++){
				$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
				$jids = $jid->qwe + 1;
				$this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('".$jids."','".$jabatan[$count]."','".$status[$count]."','".$keterangan_tembusan[$count]."','".$idp."')");
				$count = $count + 1;
			}
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated ".$this->upload->display_errors()."</div>");		
			if($this->session->userdata('admin_jabatan' != 0)){	
			redirect('admin/surat_keluar');}
			else{
			redirect('admin/agenda_surat_keluar');
			}
		} else {
			$a['data_user'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan=notadinas.master_jabatan.id WHERE notadinas.master_user.id = '".$this->session->userdata('admin_id')."'")->row();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();
			/*$a['data']		= $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_user.nama_lengkap from notadinas.surat_keluar INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.surat_keluar.kepada WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();*/
			$a['page']		= "l_surat_keluar";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	public function master_kegiatan(){
		$idk	= addslashes($this->input->post('id_keg'));
		$nmk		= addslashes($this->input->post('nama_keg'));

		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		$aksi = $this->uri->segment(3);
		if($aksi=="add"){
			$a['page']	= "f_master_kegiatan";
		}else if($aksi=="m_kegiatan"){
			$a['data']	= $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
			$a['page']	= "l_master_kegiatan";
		}else if($aksi == "save"){
			$this->db->query("INSERT INTO notadinas.kegiatan_dinas VALUES ('".$idk."','".$nmk."')");
			$a['data']	= $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
			$a['page']	= "l_master_kegiatan";
		}


		$this->load->view('admin/aaa', $a);
	}
	public function nota_dinas() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$ta = $this->session->userdata('admin_ta');
		// print_r($this->session->all_userdata());
		// die();
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta'")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/nota_dinas/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		$kegiatan_id 			= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan //i think these variable will not use again anymore
		$idp					= addslashes($this->input->post('idp'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		$kode					= addslashes($this->input->post('kode'));
		$uraian					= addslashes($this->input->post('uraian'));

		//new variable
		$dari					= addslashes($this->input->post('dari'));
		$keg_id				= addslashes($this->input->post('kegiatan'));
		$staf_id				= addslashes($this->input->post('staf_tugas'));
		$tglsurat				= addslashes($this->input->post('tgl_surat'));
		$tgl_surat				= date("Y-m-d", strtotime($tglsurat));
		$no_surat				= addslashes($this->input->post('no_surat'));
		$perihal				= addslashes($this->input->post('perihal'));
		$isi_surat				= addslashes($this->input->post('isi'));
		$lampiran				= addslashes($this->input->post('lampiran'));
		$ket					= addslashes($this->input->post('ket'));
		$file_lam				= addslashes($this->input->post('no_lampiran'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload/nota_dinas';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['file_name']		= $file_lam;
		// $config['max_size']			= '2000';
		// $config['max_width']  		= '3000';
		// $config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if($mau_ke == "cetak_nota_dinas"){
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
			$a['page'] = 'cetak_nota_dinas';
			// var_dump($a['user_n']);
			// die();
		}else if($mau_ke == "verifikasi_submit_setum"){
			if($this->input->post('no_surat')!=""){
				$this->db->query("UPDATE notadinas.nota_dinas SET no_surat = '".$this->input->post('no_surat')."', status_notadinas = 5 WHERE id = $idu");
			}
			redirect(base_url().'admin/nota_dinas');
		}else if($mau_ke == "verifikasi_submit_kapushidrosal_setuju"){
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas WHERE id = '".$kegiatan_id."'")->row();
			$this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','4','".$this->input->post('komentar_kapushidrosal')."')");
			$this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 4 WHERE id = $idu");
			redirect(base_url().'admin/nota_dinas');
		}elseif($mau_ke == "verifikasi_submit_kapushidrosal"){
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '".$idu."'")->row();
			$this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('".$lpskids."','".$idu."','NOW()','".$this->session->userdata('admin_id')."','".$cc->create_by."','".$cc->keterangan."','1','".$this->input->post('komentar_kapushidrosal')."')");
			$this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 1 WHERE id = $idu");
			redirect(base_url().'admin/nota_dinas');
		}elseif($mau_ke == "getDetailKegiatan"){
			$a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas INNER JOIN notadinas.master_proses_nota_dinas ON notadinas.log_proses_nota_dinas.id_proses = notadinas.master_proses_nota_dinas.id WHERE log_proses_nota_dinas.id_notadinas = $idu")->result();
			$a['lognya']	= $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas WHERE id_notadinas = $idu ORDER BY id DESC")->row();
			$a['log']	= $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas where id_proses = 1 and id_notadinas = $idu")->row();
			$a['keg_nota'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.kegiatan_dinas.nama_kegiatan, notadinas.master_user.nama_lengkap from ((notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by) INNER JOIN notadinas.kegiatan_dinas on notadinas.kegiatan_dinas.id_kegiatan = notadinas.nota_dinas.kegiatan_id) where notadinas.nota_dinas.status_notadinas >= 2 AND notadinas.nota_dinas.kegiatan_id = $kegiatan_id;")->result();
			$a['page']		= "notadinas/kegiatan_notadinas";
		}else if($mau_ke == "verifikasi_submit"){
			$jabatan = $this->input->post('jabatan');
			$status = $this->input->post('status');
			$keterangan = $this->input->post('keterangan_tembusan');
			$count = 0;
			$a = "";
			$b = "";
			for($l=0; $l<count($status); $l++){
				if($status[$l]==2){
					$a .= "2";
				}
				$b .= "2";
			}
			// var_dump($keterangan);
			// die();
			$this->db->query("DELETE FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = $idu");
			for($ab=1;$ab<=count($jabatan);$ab++){
				$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
				$jids = $jid->qwe + 1;
				$this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('".$jids."','".$jabatan[$count]."','".$status[$count]."','".$keterangan[$count]."','".$idu."')");
				$count = $count + 1;
			}
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '".$idu."'")->row();
			if($a==$b){
				$this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 2 WHERE id = $idu");
				$this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','3','')");
			}else{
				$this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 0 WHERE id = $idu");
				$this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('".$lpskids."','".$idu."',NOW(),'".$this->session->userdata('admin_id')."','".$cc->kepada."','".$cc->keterangan."','1','')");
			}
			redirect(base_url().'admin/nota_dinas');
		}else if($mau_ke == "verifikasi_nota_dinas"){
			$a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas INNER JOIN notadinas.master_proses_nota_dinas ON notadinas.log_proses_nota_dinas.id_proses = notadinas.master_proses_nota_dinas.id WHERE log_proses_nota_dinas.id_notadinas = $idu")->result();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
			$a['datpil_tembusan']	= $this->db->query("SELECT notadinas.tembusan_nota_dinas.*, notadinas.master_jabatan.*, notadinas.tembusan_nota_dinas.id AS idnya_tembusan FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE id_notadinas = '$idu'")->result();
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
			$a['log']	= $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas where id_proses = 1 and id_notadinas = '$idu'")->result();
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
			$a['page']		= "f_nota_dinas";
		}else if($mau_ke == "kirim_kelain"){
			$this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 2 WHERE id = '".$idu."';");
			$lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
			$lpskids = $lpskid->qwe + 1;
			$cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '".$idu."'")->row();
			$this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('".$lpskids."','".$idu."','NOW()','".$this->session->userdata('admin_id')."','".$cc->create_by."','".$cc->keterangan."','2','')");
			redirect(base_url().'admin/nota_dinas');
		}else if($mau_ke == "cetak_input_tembusan"){
			$data = addslashes($this->input->post('data'));
			$count = addslashes($this->input->post('count'));
			$aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
			foreach($aa as $aaa){
				$bb = "
					<input type='text' name='jabatan[]' value='".$aaa->id."' readonly hidden/>
					<input type='text' name='status[]' value='1' readonly hidden/>";
				$count++;
			}
			echo $bb;
			die();
		}else if($mau_ke == "tambah_tembusan"){
			$data = addslashes($this->input->post('data'));
			$count = addslashes($this->input->post('count'));
			$aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
			foreach($aa as $aaa){
				$bb = "
				<tbody>
				<tr style='vertical-align:top;'>
					<td>".$count."</td>
					<td>".$aaa->nama_jabatan ."</td>
					<td><!--
						<div class='col-md-6'><a class='btn-default btn btn-xs' style='float:right;'>Setuju</a></div>
						<div class='col-md-6'><a class='btn-default btn btn-xs' style='float:left;'>Koreksi</a></div>-->
					</td>
					<td><textarea name='keterangan_tembusan[]' class='form-control'></textarea></td>
				</tr>
				</tbody>";
				$count++;
			}
			echo $bb;
			die();
		}else if ($mau_ke == "del") {
			$this->db->query("DELETE FROM notadinas.nota_dinas WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('admin/nota_dinas');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id=notadinas.nota_dinas.kepada WHERE perihal LIKE '%$cari%' OR tujuan LIKE '%$cari%' OR no_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_nota_dinas";
		} else if ($mau_ke == "add") {
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
			$a['kegiatan']	= $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
			//$a['kegiatan']	= $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
			$a['page']		= "f_nota_dinas";
		} else if ($mau_ke == "edt") {
			$a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas INNER JOIN notadinas.master_proses_nota_dinas ON notadinas.log_proses_nota_dinas.id_proses = notadinas.master_proses_nota_dinas.id WHERE log_proses_nota_dinas.id_notadinas = $idu")->result();
			$a['lognya']	= $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas WHERE id_notadinas = $idu ORDER BY id DESC")->row();
			$a['log']	= $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas where id_proses = 1 and id_notadinas = $idu")->row();
			$a['user_n']	= $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
			$a['kegiatan']	= $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
			$a['datpil_tembusan']	= $this->db->query("SELECT notadinas.tembusan_nota_dinas.*, notadinas.master_jabatan.*, notadinas.tembusan_nota_dinas.id AS idnya_tembusan FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE id_notadinas = '$idu'")->result();
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();	
			$a['page']		= "f_nota_dinas";
		} else if ($mau_ke == "act_add") {	
			$id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.nota_dinas")->row();
			echo $ids = $id->qwe + 1;
			// die();
			$jabatan = $this->input->post('jabatan');
			$keterangan_tembusan = $this->input->post('keterangan_tembusan');
			// die();/*
			if ($this->upload->do_upload('file_attachment')) {
				$up_data	 	= $this->upload->data();
				$count = 0;
				for($ab=1;$ab<=count($jabatan);$ab++){
					$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
					$jids = $jid->qwe + 1;
					$this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('".$jids."','".$jabatan[$count]."','1','".$keterangan_tembusan[$count]."','".$ids."')");
					$count = $count + 1;
				}
				$this->db->query("INSERT INTO notadinas.nota_dinas VALUES ('".$ids."', '".$tgl_surat."', '".$this->session->userdata('admin_id')."', '', '".$perihal."', '".$ket."', '".$dari."', '".$isi_surat."', '', '', '1', '".$this->session->userdata('admin_id')."','".$up_data['file_name']."', '".$keg_id."', '".$staf_id."')");
				// $this->db->query("INSERT INTO nota_dinas VALUES (NULL, '$kode', '$no_agenda', '$uraian', '$dari', '$no_surat', '$tgl_surat', NOW(), '$ket', '".$up_data['file_name']."', '".$this->session->userdata('admin_id')."')");
			} else {
				$count = 0;
				for($ab=1;$ab<=count($jabatan);$ab++){
					$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
					$jids = $jid->qwe + 1;
					$this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('".$jids."','".$jabatan[$count]."','1','".$keterangan_tembusan[$count]."','".$ids."')");
					$count = $count + 1;
				}
				$this->db->query("INSERT INTO notadinas.nota_dinas VALUES ('".$ids."', '".$tgl_surat."', '".$this->session->userdata('admin_id')."', '', '".$perihal."', '".$ket."', '".$dari."', '".$isi_surat."', '', '', '1', '".$this->session->userdata('admin_id')."','".$up_data['file_name']."', '".$keg_id."', '".$staf_id."')");
				// $this->db->query("INSERT INTO nota_dinas VALUES (NULL, '$kode', '$no_agenda', '$uraian', '$dari', '$no_surat', '$tgl_surat', NOW(), '$ket', '', '".$this->session->userdata('admin_id')."')");
			}		
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			redirect('admin/nota_dinas');//*/
		} else if ($mau_ke == "act_edt") {
			$jabatan = $this->input->post('jabatan');
			$status = $this->input->post('status');
			$keterangan_tembusan = $this->input->post('keterangan_tembusan');
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				$this->db->query("UPDATE notadinas.nota_dinas SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi', klasifikasi = '', drajat = '', file_attachment = '".$up_data['file_name']."', kegiatan_id = '".$keg_id."', staf_tugas = '".$staf_id."' WHERE id = '$idp'");
				// $this->db->query("UPDATE nota_dinas SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE notadinas.nota_dinas SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat', kegiatan_id = '".$keg_id."', staf_tugas = '".$staf_id."' WHERE id = '$idp'");
				// $this->db->query("UPDATE nota_dinas SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
			}	
			$this->db->query("DELETE FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = '$idp'");
			$count = 0;
			for($ab=1;$ab<=count($jabatan);$ab++){
				$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
				$jids = $jid->qwe + 1;
				$this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('".$jids."','".$jabatan[$count]."','".$status[$count]."','".$keterangan_tembusan[$count]."','".$idp."')");
				$count = $count + 1;
			}
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated ".$this->upload->display_errors()."</div>");			
			redirect('admin/nota_dinas');
		} else {
			$a['data_user'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan=notadinas.master_jabatan.id WHERE notadinas.master_user.id = '".$this->session->userdata('admin_id')."'")->row();
			$a['data']		= $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.master_user.jabatan, notadinas.tembusan_nota_dinas.id_jabatan as jabatan_id FROM ((notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by) INNER JOIN notadinas.tembusan_nota_dinas on notadinas.nota_dinas.id = notadinas.tembusan_nota_dinas.id_notadinas) WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();
			$a['data_tebus']		= $this->db->query("SELECT * from notadinas.tembusan_nota_dinas")->result();
			$a['keg'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.kegiatan_dinas.* FROM notadinas.nota_dinas INNER JOIN notadinas.kegiatan_dinas ON notadinas.nota_dinas.kegiatan_id = notadinas.kegiatan_dinas.id_kegiatan where notadinas.nota_dinas.status_notadinas >= 2;")->result();
			$a['page']		= "l_nota_dinas";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function surat_disposisi() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(4);
		$idu1					= $this->uri->segment(3);
		$idu2					= $this->uri->segment(5);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$id_surat				= addslashes($this->input->post('id_surat'));
		$kpd_yth				= addslashes($this->input->post('kpd_yth'));
		$isi_disposisi			= addslashes($this->input->post('isi_disposisi'));
		$sifat					= addslashes($this->input->post('sifat'));
		$batas_waktu			= addslashes($this->input->post('batas_waktu'));
		$catatan				= addslashes($this->input->post('catatan'));
		
		$cari					= addslashes($this->input->post('q'));
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_disposisi WHERE id_surat = '$idu1'")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/surat_disposisi/".$idu1."/p");
		
		$a['judul_surat']	= gval("notadinas.surat_masuk", "id", "perihal", $idu1);
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM t_disposisi WHERE id = '$idu2'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('admin/surat_disposisi/'.$idu1);
		} else if ($mau_ke == "add") {
			$a['page']		= "f_surat_disposisi";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu2'")->row();	
			$a['page']		= "f_surat_disposisi";
		} else if ($mau_ke == "act_add") {	
			$this->db->query("INSERT INTO t_disposisi VALUES (NULL, '$id_surat', '$kpd_yth', '$isi_disposisi', '$sifat', '$batas_waktu', '$catatan')");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			redirect('admin/surat_disposisi/'.$id_surat);
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE t_disposisi SET kpd_yth = '$kpd_yth', isi_disposisi = '$isi_disposisi', sifat = '$sifat', batas_waktu = '$batas_waktu', catatan = '$catatan' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('admin/surat_disposisi/'.$id_surat);
		} else {
			$a['data']		= $this->db->query("SELECT * FROM t_disposisi WHERE id_surat = '$idu1' LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_surat_disposisi";
		}
		
		$this->load->view('admin/aaa', $a);	
	}
	
	public function pengguna() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		
		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$alamat					= addslashes($this->input->post('alamat'));
		$kepsek					= addslashes($this->input->post('kepsek'));
		$nip_kepsek				= addslashes($this->input->post('nip_kepsek'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('logo')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kepsek = '$kepsek', nip_kepsek = '$nip_kepsek', logo = '".$up_data['file_name']."' WHERE id = '$idp'");

			} else {
				$this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kepsek = '$kepsek', nip_kepsek = '$nip_kepsek' WHERE id = '$idp'");
			}		

			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('admin/pengguna');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM tr_instansi WHERE id = '1' LIMIT 1")->row();
			$a['page']		= "f_pengguna";
		}
		
		$this->load->view('admin/aaa', $a);	
	}
	
	public function agenda_surat_masuk() {
		$a['page']	= "f_config_cetak_agenda";
		$a['data']	= $this->db->query("SELECT * FROM notadinas.surat_masuk ORDER BY id asc")->result();
		$this->load->view('admin/aaa', $a);
	} 

	public function agenda_surat_keluar() {
		$a['page']	= "f_config_cetak_agenda";
		$a['data']	= $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_user.nama_lengkap from notadinas.surat_keluar INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.surat_keluar.kepada  ORDER BY id asc")->result();
		$this->load->view('admin/aaa', $a);
	} 
	
	public function agenda_nota_dinas() {
		$a['page']	= "f_config_cetak_agenda";
		$a['data']	= $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by ORDER BY id asc")->result();
		$this->load->view('admin/aaa', $a);
	} 
	
	public function cetak_agenda() {
		$jenis_surat	= $this->input->post('tipe');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');
		
		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;		

		if($jenis_surat == "agenda_surat_masuk") {	
			$a['data']	= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result(); 
			$this->load->view('admin/agenda_surat_masuk', $a);
		}else if($jenis_surat == "agenda_surat_keluar"){
			$a['data']	= $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_surat_keluar', $a);
		}else if($jenis_surat == "agenda_nota_dinas"){
			$a['data']	= $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_nota_dinas', $a);
		}
	}	
	
	public function manage_admin() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$username				= addslashes($this->input->post('username'));
		$password				= md5(addslashes($this->input->post('password')));
		$nama_lengkap				= addslashes($this->input->post('nama_lengkap'));
		$email					= addslashes($this->input->post('email'));
		$level					= addslashes($this->input->post('level'));
		$jabatan					= addslashes($this->input->post('jabatan'));
		$jenis					= 1 ;
		$no_telp					= addslashes($this->input->post('no_telp'));
		
		$cari					= addslashes($this->input->post('q'));

		$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.master_user")->row();
				$jids = $jid->qwe + 1;
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM notadinas.master_user WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('admin/manage_admin');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_user WHERE nama_lengkap LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_admin";
		} else if ($mau_ke == "add") {
			$a['groups'] 	= $this->db->query("SELECT * FROM notadinas.master_jabatan")->result();
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM notadinas.master_user WHERE id = '$idu'")->row();	
			$a['groups'] 	= $this->db->query("SELECT * FROM notadinas.master_jabatan")->result();
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "act_add") {	
			$cek_user_exist = $this->db->query("SELECT username FROM notadinas.master_user WHERE username = '$username'")->num_rows();

			if (strlen($username) < 6) {
				$this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Username minimal 6 huruf</div>");
			} else if ($cek_user_exist > 0) {
				$this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Username telah dipakai. Ganti yang lain..!</div>");	
			} else {
				$this->db->query("INSERT INTO notadinas.master_user (id,username,password,nama_lengkap,email,no_telp,level,jabatan,status_jabatan) VALUES ('$jids', '$username', '$password', '$nama_lengkap', '$email','$no_telp', '$level','$jabatan','$jenis')");
				$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			redirect('admin/manage_admin');
		} else if ($mau_ke == "act_edt") {
			if ($password = md5("-")) {
				$this->db->query("UPDATE notadinas.master_user SET username = '$username', nama_lengkap = '$nama_lengkap', email = '$email', level = '$level' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE notadinas.master_user SET username = '$username', password = '$password', nama_lengkap = '$nama_lengkap', email = '$email', level = '$level' WHERE id = '$idp'");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");			
			redirect('admin/manage_admin');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM notadinas.master_user")->result();
			$a['page']		= "l_manage_admin";
		}
		
		$this->load->view('admin/aaa', $a);

	}

	public function get_klasifikasi() {
		$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT id, kode, nama FROM ref_klasifikasi WHERE kode LIKE '%$kode%' ORDER BY id ASC")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->kode;
			$json_array['label']	= $d->kode." - ".$d->nama;
			$klasifikasi[] 			= $json_array;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function get_instansi_lain() {
		$kode 				= $this->input->post('dari',TRUE);
		
		$data 				=  $this->db->query("SELECT dari FROM notadinas.surat_masuk WHERE dari LIKE '%$kode%' GROUP BY dari")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$klasifikasi[] 	= $d->dari;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function disposisi_cetak() {
		$idu = $this->uri->segment(3);
		$a['datpil1']	= $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();	
		$a['datpil2']	= $this->db->query("SELECT kpd_yth FROM t_disposisi WHERE id_surat = '$idu'")->result();	
		$a['datpil3']	= $this->db->query("SELECT isi_disposisi, sifat, batas_waktu FROM t_disposisi WHERE id_surat = '$idu'")->result();	
		$this->load->view('admin/f_disposisi', $a);
	}
	
	public function passwod() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$ke				= $this->uri->segment(3);
		$id_user		= $this->session->userdata('admin_id');
		
		//var post
		$p1				= md5($this->input->post('p1'));
		$p2				= md5($this->input->post('p2'));
		$p3				= md5($this->input->post('p3'));
		
		if ($ke == "simpan") {
			$cek_password_lama	= $this->db->query("SELECT password FROM t_admin WHERE id = $id_user")->row();
			//echo 
			
			if ($cek_password_lama->password != $p1) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Lama tidak sama</div>');
				redirect('admin/passwod');
			} else if ($p2 != $p3) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Baru 1 dan 2 tidak cocok</div>');
				redirect('admin/passwod');
			} else {
				$this->db->query("UPDATE t_admin SET password = '$p3' WHERE id = ".$id_user."");
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-success">Password berhasil diperbaharui</div>');
				redirect('admin/passwod');
			}
		} else {
			$a['page']	= "f_passwod";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function login() {
		$this->load->view('admin/login');
	}
	
	public function do_login() {
		$u 		= $this->security->xss_clean($this->input->post('u'));
		$ta 	= $this->security->xss_clean($this->input->post('ta'));
        $p 		= md5($this->security->xss_clean($this->input->post('p')));
         
		$q_cek	= $this->db->query("SELECT * FROM notadinas.master_user WHERE username = '".$u."' AND password = '".$p."'");
		$j_cek	= $q_cek->num_rows();
		$d_cek	= $q_cek->row();
		//echo $this->db->last_query();
		
        if($j_cek == 1) {
            $data = array(
                    'admin_id' => $d_cek->id,
                    'admin_user' => $d_cek->username,
                    'admin_nama' => $d_cek->nama_lengkap,
                    'admin_ta' => $ta,
                    'admin_jabatan' => $d_cek->jabatan,
                    'admin_status' => $d_cek->status_jabatan,
					'admin_level' =>$d_cek->level,
					'admin_valid' => true
                    );
            $this->session->set_userdata($data);
            redirect('admin');
        } else {	
			$this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
			redirect('admin/login');
		}
	}
	
	public function logout(){
        $this->session->sess_destroy();
		redirect('admin/login');
    }

    public function generate_filename(){
    	$a = $this->db->query("select max(file_attachment) from notadinas.nota_dinas")->row();
    	$b = explode(".",$a->max);
    	$c = explode("-",$b[0]);
    	$d = $c[1] + 1;
    	if(strlen($d)<4){
    		if(strlen($d)<3){
	    		if(strlen($d)<2){
		    		if(strlen($d)<1){
		    		}else{
		    			echo "000" . $d;
		    		}
	    		}else{
	    			echo "00" . $d;
	    		}
    		}else{
    			echo "0" . $d;
    		}
    	}else{
    		echo $d;
    	}
    }
    public function cetak_no_lampiran($a){
    	$asd = ['a'=>$a];
		$this->load->view('admin/notadinas/cetak_nolampiran', $asd);
    }
}