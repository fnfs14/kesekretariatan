<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}

		$a['page']	= "d_amain";

		$this->load->view('administrator/master_kategori', $a);
	}

	public function master_kategori(){
            $idk	= addslashes($this->input->post('id_kat'));
            $nmk		= addslashes($this->input->post('nama_kat'));
            $cari        = addslashes($this->input->post('q'));
			$nmk = str_replace('\"', '"', $nmk);

            if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
                redirect("admin/login");
            }
            $aksi = $this->uri->segment(3);
            $id_kategori = $this->uri->segment(4);
            if($aksi=="add"){
                $a['page']	= "f_master_kategori";
            }
            /***********************************************
             ** Feature Cari
             ** By: Muhamad Farhan Badrussalam
             ***********************************************/
            else if($aksi=="cari"){
                $a['data']  = $this->db->query("SELECT * FROM notadinas.master_kategori where nama_kategori LIKE '%$cari%'")->result();
                $a['page']  = "l_master_kategori";
            }
            else if($aksi=="m_kategori"){

                $a['data']	= $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
                $a['page']	= "l_master_kategori";
            }else if($aksi == "save"){
                $this->db->query("INSERT INTO notadinas.master_kategori VALUES (DEFAULT,'".$nmk."')");
                $a['data']	= $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
                redirect('administrator/master_kategori/m_kategori');
            } else if($aksi=="edit"){
                $a['page']	= "u_master_kategori";
                $a['data_kategori'] = $this->db->query("SELECT * FROM notadinas.master_kategori where id_kategori = '$id_kategori'")->result();
            } else if($aksi=="update"){
                $this->db->query("UPDATE notadinas.master_kategori SET nama_kategori = '".$nmk."' where id_kategori = '$id_kategori'");
                $a['data']	= $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
                redirect('administrator/master_kategori/m_kategori');
            }else if($aksi=="delete"){
                $this->db->query("DELETE FROM notadinas.master_kategori where id_kategori = '$id_kategori'");
                $a['data']	= $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
                redirect('administrator/master_kategori/m_kategori');
            }

            $this->load->view('administrator/master_kategori', $a);
	}


    public function list_kategori_doktrin(){
        //echo "ddd";die();
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $a['data']	= $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
        $a['page']	= "f_list_kategori";

        $this->load->view('administrator/list_kategori', $a);
    }

    public function list_peraturan()
    {
        $idk = addslashes($this->input->post('id_kat'));
        $nmk = addslashes($this->input->post('nama_kat'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $id_kategori = $this->uri->segment(3);

        $a['data'] = $this->db->query("SELECT a.*, b.* FROM notadinas.master_kategori as a join notadinas.master_doktrin as b on a.id_kategori = b.id_kategori where a.id_kategori ='$id_kategori' ")->result();
        $a['page'] = "f_list_peraturan";

        $this->load->view('administrator/list_peraturan', $a);
    }

    public function feedback()
    {

        date_default_timezone_set('Asia/Jakarta');

        $pesan = $_POST['pesan'];
        $id = $_POST['id'];
        $time = date('H:i:s');
		$this->db->query("UPDATE notadinas.surat_masuk_waka SET status = 'Sudah Feedbak = Selesai' WHERE surat_masuk = $id");
        $pengirim = $this->session->userdata('admin_jabatan');
        // $setum = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = '6' AND tingkatan = '1'")->result();
		$array = [];
        // foreach ($setum as $key1) {
			$key1 = 2;
            $this->db->query("INSERT INTO notadinas.feedback_surat_masuk (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','".$key1."')");
			$array[$key1] = true;
        // }
		// commented due to multiple chat inserted
        $kpd = $this->db->query('SELECT * FROM notadinas.surat_masuk WHERE id = '.$id)->row();
		//n if($kpd->kepada!=$pengirim){
			$this->db->query("INSERT INTO notadinas.feedback_surat_masuk (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','".$kpd->kepada."')");
			$array[$kpd->kepada] = true;
		//n }
        $disp = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '".$id."' AND penerima_disposisi_satuan IS NULL")->result();
        foreach ($disp as $key) {
            if($key->penerima_disposisi != $pengirim and !isset($array[$key->penerima_disposisi])){
                $this->db->query("INSERT INTO notadinas.feedback_surat_masuk (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','".$key->penerima_disposisi."')");
				$array[$key->penerima_disposisi] = true;
            }else if(!isset($array[$key->penerima_disposisi])){
                $this->db->query("INSERT INTO notadinas.feedback_surat_masuk (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,baca,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time', '1','".$key->penerima_disposisi."')");
				$array[$key->penerima_disposisi] = true;
            }
         } 
    }

    public function feedback_satuan()
    {

        date_default_timezone_set('Asia/Jakarta');

        $pesan = $_POST['pesan'];
        $id = $_POST['id'];
        $time = date('H:i:s');
        $pengirim = $this->session->userdata('admin_jabatan');
        $jbt = $this->db->query("SELECT subdis FROM notadinas.master_jabatan WHERE id = '".$this->session->userdata('admin_jabatan')."'")->row();
        $this->db->query("INSERT INTO notadinas.feedback_surat_masuk_satuan (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,baca,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','1','".$pengirim."')");
        if($jbt->subdis==null){
            $jatas = $this->db->query("SELECT * FROM notadinas.master_subjabatan WHERE id_jabatan = '".$this->session->userdata('admin_jabatan')."' ORDER BY urut_subjabatan ASC")->result();
            if(!empty($jatas)){
                foreach($jatas as $isi){
                    $jt = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE subdis = '".$isi->id_subjabatan."'")->row();
                    $kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = ".$id." AND penerima_disposisi_satuan = '".$jt->id."'")->row();
                    if($kets!=NULL){
                        $this->db->query("INSERT INTO notadinas.feedback_surat_masuk_satuan (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','".$kets->penerima_disposisi_satuan."')");
                    }
                    // var_dump($kets);
                }
            }
        }else{
            $jatas = $this->db->query("SELECT * FROM notadinas.master_subjabatan WHERE id_subjabatan = '".$jbt->subdis."'")->row();
            $this->db->query("INSERT INTO notadinas.feedback_surat_masuk_satuan (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','".$jatas->id_jabatan."')");
            $dtjb = $this->db->query("SELECT * FROM notadinas.master_subjabatan WHERE id_jabatan = '".$jatas->id_jabatan."' ORDER BY urut_subjabatan ASC")->result();
            if(!empty($dtjb)){
                foreach($dtjb as $key2){
                    $jt = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE subdis = '".$key2->id_subjabatan."'")->row();
                    $kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = ".$id." AND penerima_disposisi_satuan = '".$jt->id."'")->row();
                    if($kets!=NULL){
                        if($kets->penerima_disposisi_satuan!=$pengirim){
                            $this->db->query("INSERT INTO notadinas.feedback_surat_masuk_satuan (id_surat_masuk,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','NOW()','$time','".$kets->penerima_disposisi_satuan."')");
                        }
                    }
                }
            }
        }
        die();
    }

    public function feedbacknotas()
    {

        date_default_timezone_set('Asia/Jakarta');

        $pesan = $_POST['pesan'];
        $id = $_POST['id'];
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $pengirim = $this->session->userdata('admin_jabatan');
		$penerima = [];
		$tembusan = $this->db->query("
			SELECT id_jabatan as id
			FROM notadinas.tembusan_nota_dinas
			WHERE
				id_notadinas = $id
				AND id_jabatan != $pengirim
			UNION
			SELECT kepada as id
			FROM notadinas.nota_dinas
			WHERE
				id = $id
				AND kepada != $pengirim
			UNION
			SELECT mu.jabatan as id
			FROM notadinas.nota_dinas as nd
			INNER JOIN notadinas.master_user as mu
				ON nd.create_by = mu.id
			WHERE
				nd.id = $id
				AND mu.jabatan != $pengirim
		")->result();
		foreach($tembusan as $t){
			$penerima[] = $t->id;
		}
		$this->db->query("INSERT INTO notadinas.feedback_nota_dinas (id_nota_dinas,pengirim,pesan_feedback,created_at,waktu,penerima,baca) VALUES ($id,$pengirim,'$pesan','$date','$time',$pengirim,1)");
		foreach($penerima as $p){
			$this->db->query("INSERT INTO notadinas.feedback_nota_dinas (id_nota_dinas,pengirim,pesan_feedback,created_at,waktu,penerima) VALUES ($id,$pengirim,'$pesan','$date','$time','".$p."')");
		}
    }

    public function feedbacksuratkel()
    {

        date_default_timezone_set('Asia/Jakarta');

        $pesan = $_POST['pesan'];
        $id = $_POST['id'];
        $time = date('H:i:s');
        $pengirim = $this->session->userdata('admin_jabatan');
        $this->db->query("INSERT INTO notadinas.feedback_surat_keluar (id_surat_keluar,pengirim,pesan_feedback,created_at,waktu) VALUES ($id,$pengirim,'$pesan','NOW()','$time')");
    }



    public function get_rak()
    {
        $id = $_GET['ids'];
        $rak = $this->db->query('SELECT * FROM notadinas.master_rak WHERE id_ruang = '.$id)->result();

        $ext = "<option value=''>PILIH RAK</option>";
        foreach ($rak as $se) {
           $ext .= "<option value=".$se->id_rak.">";
           $ext .= $se->nama_rak;
           $ext .= "</option>";

        }

        echo $ext;
    }


     public function get_box()
    {
        $id = $_GET['ids'];
        $rak = $this->db->query('SELECT * FROM notadinas.master_box WHERE id_rak = '.$id)->result();

        $ext = "<option value=''>PILIH BOX</option>";
        foreach ($rak as $se) {
           $ext .= "<option value=".$se->id_box.">";
           $ext .= $se->nama_box;
           $ext .= "</option>";

        }

        echo $ext;
    }


    public function baca_feedback()
    {

        $id = $_GET['id'];
        $this->db->query('UPDATE notadinas.feedback_surat_masuk SET baca=1
        WHERE notadinas.feedback_surat_masuk.id_surat_masuk = '.$id.' AND notadinas.feedback_surat_masuk.penerima = '.$this->session->userdata('admin_jabatan'));
    }

    public function baca_feedback_satuan()
    {

        $id = $_GET['id'];
        $this->db->query('UPDATE notadinas.feedback_surat_masuk_satuan SET baca = 1
        WHERE notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '.$id.' AND notadinas.feedback_surat_masuk_satuan.penerima = '.$this->session->userdata('admin_jabatan'));
		$this->db->query("UPDATE notadinas.disposisi_surat_masuk SET disposisi = 'yes' WHERE id_surat_masuk = $id AND penerima_disposisi_satuan = ". $this->session->userdata('admin_jabatan'));
    }

    public function baca_feedback_kadis()
    {

        $id = $_GET['id'];
        $this->db->query('UPDATE notadinas.feedback_surat_masuk SET baca=1
        WHERE notadinas.feedback_surat_masuk.id_surat_masuk = '.$id.' AND notadinas.feedback_surat_masuk.penerima = '.$this->session->userdata('admin_jabatan'));
        $this->db->query('UPDATE notadinas.feedback_surat_masuk_satuan SET baca = 1
        WHERE notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '.$id.' AND notadinas.feedback_surat_masuk_satuan.penerima = '.$this->session->userdata('admin_jabatan'));
    }

    /**
     * @return object
     */
    public function master_surat_keluar(){
        $imsk	= addslashes($this->input->post('id_master_surat_keluar'));
        $jsk		= addslashes($this->input->post('jenis_surat_keluar'));
        $isk		= stripslashes($this->input->post('isi_surat_keluar'));
        $cari = addslashes($this->input->post('q'));
		$jsk = str_replace('\"', '"', $jsk);
        $fsk        = stripslashes($this->input->post('format_surat_keluar'));
		// $isk = str_replace('\"', '"', $isk);

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_surat_keluar = $this->uri->segment(4);
        if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM master_surat_keluar WHERE jenis_surat_keluar ILIKE '%$cari%' ORDER BY id_master_surat_keluar DESC")->result();
            $a['page'] = "l_master_surat_keluar";
        }else if($aksi=="add"){
            $a['page']	= "f_master_surat_keluar";
        }else if($aksi=="m_surat_keluar"){

            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
            $a['page']	= "l_master_surat_keluar";
        }else if($aksi == "save"){
            $this->db->query("INSERT INTO notadinas.master_surat_keluar VALUES (DEFAULT,'".$jsk."','".$isk."','".$fsk."')");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_surat_keluar")->result();
            redirect('administrator/master_surat_keluar/m_surat_keluar');
        } else if($aksi=="edit"){
            $a['page']	= "u_master_surat_keluar";
            $a['data_surat_keluar'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar where id_master_surat_keluar = '$id_surat_keluar'")->result();
        } else if($aksi=="update"){
            $this->db->query("UPDATE notadinas.master_surat_keluar SET isi_surat_keluar = '".$isk."', jenis_surat_keluar = '".$jsk."', format_surat_keluar = '".$fsk."' where id_master_surat_keluar = '$id_surat_keluar'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_surat_keluar")->result();
            redirect('administrator/master_surat_keluar/m_surat_keluar');
        }else if($aksi=="delete"){
            $this->db->query("DELETE FROM notadinas.master_surat_keluar where id_master_surat_keluar = '$id_surat_keluar'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_surat_keluar")->result();
            redirect('administrator/master_surat_keluar/m_surat_keluar');
        }

        $this->load->view('administrator/master_surat_keluar', $a);
    }
	public function master_surat_masuk(){
        $imsk	= addslashes($this->input->post('id_master_surat_masuk'));
        $jsk		= addslashes($this->input->post('jenis_surat_masuk'));
        $isk		= stripslashes($this->input->post('isi_surat_masuk'));
        $cari = addslashes($this->input->post('q'));
		$jsk = str_replace('\"', '"', $jsk);

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_surat_masuk = $this->uri->segment(4);
		$select = "
			id_master_surat_masuk AS id_jenis_surat_masuk,
			jenis_surat_masuk AS nama_jenis_surat,
			isi_surat_masuk AS isi_jenis_surat
		";
        if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT $select FROM notadinas.master_surat_masuk WHERE jenis_surat_masuk ILIKE '%$cari%' ORDER BY id_master_surat_masuk DESC")->result();
            $a['page'] = "l_master_surat_masuk";
        }else if($aksi=="add"){
            $a['page']	= "f_master_surat_masuk";
        }else if($aksi=="m_surat_masuk"){

            $a['data']	= $this->db->query("SELECT $select FROM notadinas.master_surat_masuk")->result();
            $a['page']	= "l_master_surat_masuk";
        }else if($aksi == "save"){
			$idZ = $this->db->query("SELECT MAX(id_master_surat_masuk) FROM notadinas.master_surat_masuk")->row()->max + 1;
            $this->db->query("INSERT INTO notadinas.master_surat_masuk VALUES ($idZ,'".$jsk."','".$isk."')");
            $a['data']	= $this->db->query("SELECT $select FROM notadinas.master_surat_masuk")->result();
            redirect('administrator/master_surat_masuk/m_surat_masuk');
        } else if($aksi=="edit"){
            $a['page']	= "u_master_surat_masuk";
            $a['data_surat_masuk'] = $this->db->query("SELECT $select FROM notadinas.master_surat_masuk where id_master_surat_masuk = '$id_surat_masuk'")->result();
        } else if($aksi=="update"){
            $this->db->query("UPDATE notadinas.master_surat_masuk SET isi_surat_masuk = '".$isk."', jenis_surat_masuk = '".$jsk."' where id_master_surat_masuk = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT $select FROM notadinas.master_surat_masuk")->result();
            redirect('administrator/master_surat_masuk/m_surat_masuk');
        }else if($aksi=="delete"){
            $this->db->query("DELETE FROM notadinas.master_surat_masuk where id_master_surat_masuk = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT $select FROM notadinas.master_surat_masuk")->result();
            redirect('administrator/master_surat_masuk/m_surat_masuk');
        }

        $this->load->view('administrator/master_surat_masuk', $a);
    }
	public function master_klasifikasi_surat_masuk(){
        $imsk	= addslashes($this->input->post('id_master_klasifikasi_surat_masuk'));
        $jsk		= addslashes($this->input->post('jenis_surat_masuk'));
        $isk		= stripslashes($this->input->post('isi_surat_masuk'));
        $cari = addslashes($this->input->post('q'));
		$jsk = str_replace('\"', '"', $jsk);
        date_default_timezone_set('Asia/Jakarta');
        $upd_date = date("Y-m-d H:i:s");

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_surat_masuk = $this->uri->segment(4);
        if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM master_klasifikasi_surat_masuk WHERE klasifikasi_surat_masuk ILIKE '%$cari%' ORDER BY id_master_klasifikasi_surat_masuk DESC")->result();
            $a['page'] = "l_master_klasifikasi_surat_masuk";
        }else if($aksi=="add"){
            $a['page']	= "f_master_klasifikasi_surat_masuk";
        }else if($aksi=="m_klasifikasi"){

            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk")->result();
            $a['page']	= "l_master_klasifikasi_surat_masuk";
        }else if($aksi == "save"){
            $this->db->query("INSERT INTO notadinas.master_klasifikasi_surat_masuk VALUES (DEFAULT,'".$jsk."')");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk")->result();
            redirect('administrator/master_klasifikasi_surat_masuk/m_klasifikasi');
        } else if($aksi=="edit"){
            $a['page']	= "u_master_klasifikasi_surat_masuk";
            $a['data_surat_masuk'] = $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk where id_master_klasifikasi_surat_masuk = '$id_surat_masuk'")->result();
        } else if($aksi=="update"){
            $older_ver = $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk where id_master_klasifikasi_surat_masuk = '$id_surat_masuk'")->row();
            $this->db->query("UPDATE notadinas.surat_masuk SET klasifikasi = '".$jsk."', updated_at = '$upd_date' where klasifikasi = '".$older_ver->klasifikasi_surat_masuk."'");
            $this->db->query("UPDATE notadinas.master_klasifikasi_surat_masuk SET klasifikasi_surat_masuk = '".$jsk."' where id_master_klasifikasi_surat_masuk = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk")->result();
            redirect('administrator/master_klasifikasi_surat_masuk/m_klasifikasi');
        }else if($aksi=="delete"){
            $this->db->query("DELETE FROM notadinas.master_klasifikasi_surat_masuk where id_master_klasifikasi_surat_masuk = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk")->result();
            redirect('administrator/master_klasifikasi_surat_masuk/m_klasifikasi');
        }

        $this->load->view('administrator/master_klasifikasi_surat_masuk', $a);
    }
	public function master_derajat(){
        $imsk	= addslashes($this->input->post('id_master_derajat'));
        $jsk		= addslashes($this->input->post('jenis_derajat'));
        $isk		= stripslashes($this->input->post('isi_derajat'));
        $cari = addslashes($this->input->post('q'));
		$jsk = str_replace('\"', '"', $jsk);
        date_default_timezone_set('Asia/Jakarta');
        $upd_date = date("Y-m-d H:i:s");

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_surat_masuk = $this->uri->segment(4);
        if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM master_derajat WHERE derajat ILIKE '%$cari%' ORDER BY id_master_derajat DESC")->result();
            $a['page'] = "l_master_derajat";
        }else if($aksi=="add"){
            $a['page']	= "f_master_derajat";
        }else if($aksi=="m_derajat"){

            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_derajat")->result();
            $a['page']	= "l_master_derajat";
        }else if($aksi == "save"){
            $this->db->query("INSERT INTO notadinas.master_derajat VALUES (DEFAULT,'".$jsk."')");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_derajat")->result();
            redirect('administrator/master_derajat/m_derajat');
        } else if($aksi=="edit"){
            $a['page']	= "u_master_derajat";
            $a['data_derajat'] = $this->db->query("SELECT * FROM notadinas.master_derajat where id_master_derajat = '$id_surat_masuk'")->result();
        } else if($aksi=="update"){
            $older_ver = $this->db->query("SELECT * FROM notadinas.master_derajat where id_master_derajat = '$id_surat_masuk'")->row();
            $this->db->query("UPDATE notadinas.surat_masuk SET drajat = '".$jsk."', updated_at = '$upd_date' where drajat = '".$older_ver->derajat."'");
            $this->db->query("UPDATE notadinas.master_derajat SET derajat = '".$jsk."' where id_master_derajat = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_derajat")->result();
            redirect('administrator/master_derajat/m_derajat');
        }else if($aksi=="delete"){
            $this->db->query("DELETE FROM notadinas.master_derajat where id_master_derajat = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_derajat")->result();
            redirect('administrator/master_derajat/m_derajat');
        }

        $this->load->view('administrator/master_derajat', $a);
    }
	public function master_tujuan(){
        $imsk	= addslashes($this->input->post('id_master_tujuan'));
        $jsk		= addslashes($this->input->post('jenis_nama'));
        $isk		= stripslashes($this->input->post('isi_nama'));
        $cari = addslashes($this->input->post('q'));
		$jsk = str_replace('\"', '"', $jsk);
        date_default_timezone_set('Asia/Jakarta');
        $upd_date = date("Y-m-d H:i:s");

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_surat_masuk = $this->uri->segment(4);
        if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM master_tujuan WHERE nama ILIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "l_master_tujuan";
        }else if($aksi=="add"){
            $a['page']	= "f_master_tujuan";
        }else if($aksi=="m_tujuan"){

            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_tujuan ORDER BY nama")->result();
            $a['page']	= "l_master_tujuan";
        }else if($aksi == "save"){
            $cek_nama = $this->db->query("SELECT nama FROM notadinas.master_tujuan WHERE nama = '$jsk'")->num_rows();

            if ($cek_nama > 0) {
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">tujuan nama sudah ada.</div>");
                redirect('administrator/master_tujuan/add');
            }else{
            $this->db->query("INSERT INTO notadinas.master_tujuan VALUES (DEFAULT,'".$jsk."')");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            redirect('administrator/master_tujuan/m_tujuan');
            }
        } else if($aksi=="edit"){
            $a['page']	= "u_master_tujuan";
            $a['data_nama'] = $this->db->query("SELECT * FROM notadinas.master_tujuan where id = '$id_surat_masuk'")->result();
        } else if($aksi=="update"){
            $older_ver = $this->db->query("SELECT * FROM notadinas.master_tujuan where id = '$id_surat_masuk'")->row();
            $this->db->query("UPDATE notadinas.surat_masuk SET drajat = '".$jsk."', updated_at = '$upd_date' where drajat = '".$older_ver->nama."'");
            $this->db->query("UPDATE notadinas.master_tujuan SET nama = '".$jsk."' where id = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            redirect('administrator/master_tujuan/m_tujuan');
        }else if($aksi=="delete"){
            $this->db->query("DELETE FROM notadinas.master_tujuan where id = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            redirect('administrator/master_tujuan/m_tujuan');
        }

        $this->load->view('administrator/master_tujuan', $a);
    }
	public function master_arsip_surat(){
        $agenda	= addslashes($this->input->post('agenda'));
        $ruang	= addslashes($this->input->post('ruang'));
        $lemari	= addslashes($this->input->post('lemari'));
        $rak	= addslashes($this->input->post('rak'));
        $box	= addslashes($this->input->post('box'));
        $jenis_surat	= addslashes($this->input->post('jenis_surat'));
        $cari = addslashes($this->input->post('q'));
        $cari2 = addslashes($this->input->post('qq'));
        $stat = addslashes($this->input->post('stat'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_surat_masuk = $this->uri->segment(4);
        if ($aksi == "cari") {
                    $a['data'] = $this->db->query("SELECT * FROM master_arsip_surat WHERE agenda ILIKE '%$cari%' ORDER BY id_arsip_surat DESC")->result();
                    $a['page'] = "l_master_arsip_surat";
                    $a['pagi'] = "";
                    $a['q'] = 0;
                    //  var_dump($a['data']);
                    // die();
        }else if($aksi == "cari2"){
                    $a['data'] = 
                    $this->db->query("SELECT *,no_setum as agenda FROM notadinas.surat_masuk LEFT JOIN notadinas.master_arsip_surat ON notadinas.master_arsip_surat.agenda = notadinas.surat_masuk.no_setum WHERE no_setum ILIKE '%$cari%'")->result();
                    $a['page'] = "l_master_arsip_surat";
                    $a['q'] = 1;    
                    $a['pagi'] = "";
                    // var_dump($a['data']);
                    // die();
        }else if($aksi == "cari3"){
                    $a['data'] = 
                    $this->db->query("SELECT *,no_agenda as agenda FROM notadinas.surat_keluar LEFT JOIN notadinas.master_arsip_surat ON notadinas.master_arsip_surat.agenda = notadinas.surat_keluar.no_agenda WHERE no_agenda ILIKE '%$cari%'")->result();
                    $a['page'] = "l_master_arsip_surat";
                    $a['q'] = 2;    
                    $a['pagi'] = "";
                    // var_dump($a['data']);
                    // die();
        }else if($aksi=="add"){
			if($this->session->userdata('admin_tingkatan') == 1 and $this->session->userdata('admin_satuan') != 6){
				$surat = $this->db->query("SELECT * FROM surat_keluar")->result();
			}else if($this->session->userdata('admin_jabatan')== 2 ){
				$surat = $this->db->query("SELECT * FROM surat_masuk")->result();
			}
			$a['surat'] = $surat;
            $a['page']	= "f_master_arsip_surat";
            //popo
        }else if($aksi=="m_arsip_surat"){
			$awal = $this->uri->segment(4);
			// die($awal);
			$awal = (empty($awal)) ? 0 : $awal;
			$perpage = 5;
				$a['data']	= $this->db->query("SELECT *, notadinas.master_ruang.nama_ruang as ruangan, notadinas.master_lemari.nama_lemari as lemari, notadinas.master_rak.nama_rak as rak, notadinas.master_box.nama_box as box FROM notadinas.master_arsip_surat inner join notadinas.master_ruang on notadinas.master_ruang.id_ruang = notadinas.master_arsip_surat.ruang inner join notadinas.master_lemari on notadinas.master_lemari.id_lemari = notadinas.master_arsip_surat.lemari inner join notadinas.master_rak on notadinas.master_rak.id_rak = notadinas.master_arsip_surat.rak inner join notadinas.master_box on notadinas.master_box.id_box = notadinas.master_arsip_surat.box inner join notadinas.surat_masuk on notadinas.surat_masuk.no_setum = notadinas.master_arsip_surat.agenda WHERE tipe_surat = 'surat_masuk' LIMIT $perpage OFFSET $awal")->result();
                $a['datas']  = $this->db->query("SELECT *, notadinas.master_ruang.nama_ruang as ruangan, notadinas.master_lemari.nama_lemari as lemari, notadinas.master_rak.nama_rak as rak, notadinas.master_box.nama_box as box FROM notadinas.master_arsip_surat inner join notadinas.master_ruang on notadinas.master_ruang.id_ruang = notadinas.master_arsip_surat.ruang inner join notadinas.master_lemari on notadinas.master_lemari.id_lemari = notadinas.master_arsip_surat.lemari inner join notadinas.master_rak on notadinas.master_rak.id_rak = notadinas.master_arsip_surat.rak inner join notadinas.master_box on notadinas.master_box.id_box = notadinas.master_arsip_surat.box inner join notadinas.surat_keluar on notadinas.surat_keluar.no_agenda = notadinas.master_arsip_surat.agenda WHERE tipe_surat = 'surat_keluar' LIMIT $perpage OFFSET $awal")->result();
                $total_row = $this->db->query("SELECT * FROM notadinas.master_arsip_surat")->num_rows();
				$total_row_masuk = $this->db->query("SELECT * FROM notadinas.master_arsip_surat WHERE tipe_surat = 'surat_masuk'")->num_rows();
                $total_row_keluar = $this->db->query("SELECT * FROM notadinas.master_arsip_surat WHERE tipe_surat = 'surat_keluar'")->num_rows();
				$url = "administrator/master_arsip_surat/m_arsip_surat";
                $a['pagi'] = _page($total_row, $perpage, 4, base_url() . $url);
			$a['pagitu'] = _page($total_row_masuk, $perpage, 4, base_url() . $url);
            $a['pagik'] = _page($total_row_keluar, $perpage, 4, base_url() . $url);
            $a['page']	= "l_master_arsip_surat";
			$a['q'] = 0;
        }else if($aksi == "m_arsip_surat_masuk"){
			$awal = $this->uri->segment(4);
			// die($awal);
			$awal = (empty($awal)) ? 0 : $awal;
			$perpage = 5;
            $c = "";
            $dat = $this->db->query("SELECT * FROM notadinas.master_arsip_surat WHERE tipe_surat = 'surat_masuk'")->result();
            foreach($dat as $ky){
                if($c==""){
                    $c .= "'".$ky->agenda."'";
                }else{
                    $c .= ",'".$ky->agenda."'";  
                }
            }
            if($c==""){
                $a['data']  = $this->db->query("SELECT * FROM notadinas.surat_masuk")->result();
                $total_row = $this->db->query("SELECT * FROM notadinas.surat_masuk")->num_rows();                
            }else{
                $a['data']  = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_setum NOT IN ($c)")->result();
                $total_row = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_setum NOT IN ($c)")->num_rows();
            }

				$url = "administrator/master_arsip_surat/m_arsip_surat_masuk";
			$a['pagi'] = _page($total_row, $perpage, 4, base_url() . $url);
            $a['page']	= "l_master_arsip_surat";
			$a['q'] = 1;
        }else if($aksi == "m_arsip_surat_keluar"){
			$awal = $this->uri->segment(4);
			// die($awal);
			$awal = (empty($awal)) ? 0 : $awal;
			$perpage = 5;
            $c = "";
            $dat = $this->db->query("SELECT * FROM notadinas.master_arsip_surat WHERE tipe_surat = 'surat_keluar'")->result();
            foreach($dat as $ky){
                if($c==""){
                    $c .= "'".$ky->agenda."'";
                }else{
                    $c .= ",'".$ky->agenda."'";  
                }
            }

            if($c==""){
                $a['data']  = $this->db->query("SELECT * FROM notadinas.surat_keluar")->result();
                $total_row = $this->db->query("SELECT * FROM notadinas.surat_keluar")->num_rows();                
            }else{
                $a['data']  = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE no_agenda NOT IN ($c)")->result();
                $total_row = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE no_agenda NOT IN ($c)")->num_rows();
            }
				$url = "administrator/master_arsip_surat/m_arsip_surat_keluar";
			$a['pagi'] = _page($total_row, $perpage, 4, base_url() . $url);
            $a['page']	= "l_master_arsip_surat";
			$a['q'] = 2;
            // var_dump($a['data']);
            // die();
        }else if($aksi == "save"){
			// echo $agenda;
			// die();
            $this->db->query("INSERT INTO notadinas.master_arsip_surat VALUES (DEFAULT,'$jenis_surat','$agenda',$ruang,$lemari,$rak,$box)");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_arsip_surat")->result();
            redirect('administrator/master_arsip_surat/m_arsip_surat');
        } else if($aksi=="edit"){
			if($this->session->userdata('admin_tingkatan') == 1 and $this->session->userdata('admin_satuan') != 6){
				$surat = $this->db->query("SELECT * FROM surat_keluar")->result();
			}else if($this->session->userdata('admin_jabatan')== 2 ){
				$surat = $this->db->query("SELECT * FROM surat_masuk")->result();
			}
			$a['surat'] = $surat;
            $a['page']	= "u_master_arsip_surat";
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_arsip_surat where id_arsip_surat = '$id_surat_masuk'")->row();
        } else if($aksi=="update"){
            $this->db->query("UPDATE notadinas.master_arsip_surat SET ruang = $ruang, lemari = $lemari, rak = $rak, box = $box where id_arsip_surat = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_arsip_surat")->result();
            redirect('administrator/master_arsip_surat/m_arsip_surat');
        }else if($aksi=="delete"){
            $this->db->query("DELETE FROM notadinas.master_arsip_surat where id_arsip_surat = '$id_surat_masuk'");
            $a['data']	= $this->db->query("SELECT * FROM notadinas.master_arsip_surat")->result();
            redirect('administrator/master_arsip_surat/m_arsip_surat');
        }

        $this->load->view('administrator/master_arsip_surat', $a);
    }
	function get_data_db_surat(){
		$table = $this->input->post('table');
		$primary = $this->input->post('primary');
		$where = $this->input->post('where');
		$id = $this->input->post('id');
		$master = $this->db->query("SELECT * FROM notadinas.$table WHERE $where = '$id'")->row();
		if(isset($master->$primary)){
			$master_ = $this->db->query("SELECT * FROM notadinas.$table INNER JOIN notadinas.master_arsip_surat ON notadinas.master_arsip_surat.agenda = notadinas.$table.$where WHERE $where = '$id'")->row();
			if(isset($master_->$primary)){
				// $message = "Surat sudah terarsip.";
				$data = $master_;
				return $data;
				die();
			}else{
				// $message = "Surat belum terarsip. Silakan diarsip.";
				$data = 1;
			}
		}else{
			// $message = "Surat tidak ada.";
			$data = 2;
		}
		echo $data;
	}
	function get_data_db_arsip(){
		$table = $this->input->post('table');
		$primary = $this->input->post('primary');
		$where = $this->input->post('where');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
        $result = "<option value='' style='display:none;'>Pilih</option>";
        if($table=="master_lemari"){
            $master = $this->db->query("SELECT *, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.$table INNER JOIN notadinas.master_ruang ON notadinas.$table.id_ruang = notadinas.master_ruang.id_ruang WHERE notadinas.$table.$where = '$id'")->result();
            foreach($master as $a){
                $result .= "<option value='" . $a->$primary ."'>". $a->$name ." - ".$a->nam_ru."</option>";
            }
        }else if($table=="master_rak"){
            $master = $this->db->query("SELECT *, notadinas.master_lemari.nama_lemari as nam_lem, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.$table INNER JOIN notadinas.master_lemari ON notadinas.$table.id_lemari = notadinas.master_lemari.id_lemari INNER JOIN notadinas.master_ruang ON notadinas.master_lemari.id_ruang = notadinas.master_ruang.id_ruang WHERE notadinas.$table.$where = '$id'")->result();
            foreach($master as $a){
                $result .= "<option value='" . $a->$primary ."'>". $a->$name ." - ".$a->nam_lem."(".$a->nam_ru.")</option>";
            }
        }else if($table=="master_box"){
            $master = $this->db->query("SELECT *, notadinas.master_rak.nama_rak as nam_rak, notadinas.master_lemari.nama_lemari as nam_lem, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.$table INNER JOIN notadinas.master_rak ON notadinas.$table.id_rak = notadinas.master_rak.id_rak INNER JOIN notadinas.master_lemari ON notadinas.master_lemari.id_lemari = notadinas.master_rak.id_lemari INNER JOIN notadinas.master_ruang ON notadinas.master_lemari.id_ruang = notadinas.master_ruang.id_ruang WHERE notadinas.$table.$where = '$id'")->result();
            foreach($master as $a){
                $result .= "<option value='" . $a->$primary ."'>". $a->$name ."(".$a->nam_rak.") - ".$a->nam_lem."(".$a->nam_ru.")</option>";
            }
        }else{
    		$master = $this->db->query("SELECT * FROM notadinas.$table WHERE $where = '$id'")->result();
            foreach($master as $a){
    			$result .= "<option value='" . $a->$primary ."'>". $a->$name ."</option>";
    		}
        }
		echo $result;
	}
}
