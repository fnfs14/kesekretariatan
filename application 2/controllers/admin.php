<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
	function dd($var, $pretty = false)
		{
			$backtrace = debug_backtrace();
			echo "\n<pre>\n";
			if (isset($backtrace[0]['file'])) {
				echo $backtrace[0]['file'] . "\n\n";
			}
			echo "Type: " . gettype($var) . "\n";
			echo "Time: " . date('c') . "\n";
			echo "---------------------------------\n\n";
			($pretty) ? print_r($var) : var_dump($var);
			echo "</pre>\n";
			die;
		}

	function pushFirebase($txt_jabatan_firebase){
		$array_jabatan_firebase = explode(',',$txt_jabatan_firebase);
		$jabatan_firebase = [];
		for($for=0; $for<count($array_jabatan_firebase); $for++){
			if($array_jabatan_firebase[$for]!="" and $array_jabatan_firebase[$for]!=null){
				$tingkatan_by_jabatan = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $array_jabatan_firebase[$for]")->row();
				$tingkatan = $tingkatan_by_jabatan->tingkatan;
				$satuan = $tingkatan_by_jabatan->satuan;
				$jabatan_firebase[] = $this->get_amount_of_surat(1, $tingkatan, $array_jabatan_firebase[$for],$satuan);
			}
		}
		$_SESSION['firebase'] = $jabatan_firebase;
		// $this->dd($_SESSION['firebase']);
	}
	function get_amount_of_surat($id, $tingkatan, $jabatan,$satuan){
		$bell = $this->db->query("SELECT CASE WHEN notadinas.tembusan_surat_keluar.tanggal IS NULL THEN 'unchecked' ELSE 'checked' END AS ka_waka_setum, updated_at, notadinas.surat_keluar.status_tujuan AS tujuan_status, 'keluar' AS tablenya, 1 AS status, notadinas.surat_keluar.opened, notadinas.surat_keluar.kepada, notadinas.tembusan_surat_keluar.id_jabatan, notadinas.surat_keluar.perihal, notadinas.surat_keluar.status_surat_keluar, notadinas.surat_keluar.id AS idnya 
FROM notadinas.surat_keluar 
LEFT JOIN notadinas.tembusan_surat_keluar ON notadinas.surat_keluar.id = notadinas.tembusan_surat_keluar.id_surat_keluar 
WHERE notadinas.surat_keluar.status_surat_keluar = 1 or notadinas.surat_keluar.status_surat_keluar = 2 or notadinas.surat_keluar.status_surat_keluar = 3 or notadinas.surat_keluar.status_surat_keluar = 4 or notadinas.surat_keluar.status_surat_keluar = 5 or notadinas.surat_keluar.status_surat_keluar = 6  or notadinas.surat_keluar.status_surat_keluar = 8 
UNION SELECT 'hak_akses' AS ka_waka_setum, updated_at, notadinas.surat_masuk.status_tujuan AS tujuan_status, 'masuk' AS tablenya, notadinas.disposisi_surat_masuk.status, notadinas.surat_masuk.opened, notadinas.surat_masuk.kepada, notadinas.disposisi_surat_masuk.penerima_disposisi, notadinas.surat_masuk.perihal, notadinas.surat_masuk.status_surat_masuk, notadinas.surat_masuk.id AS idnya 
FROM notadinas.surat_masuk 
LEFT JOIN notadinas.disposisi_surat_masuk ON notadinas.surat_masuk.id = notadinas.disposisi_surat_masuk.id_surat_masuk 
WHERE notadinas.surat_masuk.status_surat_masuk = 2 or  notadinas.surat_masuk.status_surat_masuk = 3 or notadinas.surat_masuk.status_surat_masuk = 4 
UNION SELECT 'subdis' AS ka_waka_setum, updated_at,notadinas.surat_masuk.status_tujuan AS tujuan_status, 'masuk' AS tablenya, notadinas.disposisi_surat_masuk.status, notadinas.surat_masuk.opened, notadinas.surat_masuk.kepada, notadinas.disposisi_surat_masuk.penerima_disposisi_satuan, notadinas.surat_masuk.perihal, notadinas.surat_masuk.status_surat_masuk, notadinas.surat_masuk.id AS idnya 
FROM notadinas.surat_masuk 
LEFT JOIN notadinas.disposisi_surat_masuk ON notadinas.surat_masuk.id = notadinas.disposisi_surat_masuk.id_surat_masuk 
WHERE (notadinas.surat_masuk.status_surat_masuk = 2 or  notadinas.surat_masuk.status_surat_masuk = 3 or notadinas.surat_masuk.status_surat_masuk = 4) and notadinas.disposisi_surat_masuk.penerima_disposisi_satuan IS NOT NULL 
UNION SELECT ka_waka_setum, updated_at,notadinas.nota_dinas.status_tujuan AS tujuan_status, 'nota' AS tablenya, status AS status, notadinas.nota_dinas.opened, notadinas.nota_dinas.kepada, notadinas.tembusan_nota_dinas.id_jabatan, notadinas.nota_dinas.perihal, notadinas.nota_dinas.status_notadinas, notadinas.nota_dinas.id AS idnya 
FROM notadinas.nota_dinas 
LEFT JOIN notadinas.tembusan_nota_dinas ON notadinas.nota_dinas.id = notadinas.tembusan_nota_dinas.id_notadinas 
WHERE notadinas.nota_dinas.status_notadinas = 4 or notadinas.nota_dinas.status_notadinas = 5 or ka_waka_setum != '4-5-6'
UNION SELECT 'hak_akses' AS ka_waka_setum, tgl_surat, 0 AS tujuan_status, 'kadis' AS tablenya, 1 AS status, notadinas.surat_antar_kadis.opened, notadinas.surat_antar_kadis.kepada, notadinas.tembusan_surat_antar_kadis.id_jabatan, notadinas.surat_antar_kadis.perihal, notadinas.surat_antar_kadis.status_surat_antar_kadis, notadinas.surat_antar_kadis.id AS idnya 
FROM notadinas.surat_antar_kadis 
INNER JOIN notadinas.tembusan_surat_antar_kadis ON notadinas.surat_antar_kadis.id = notadinas.tembusan_surat_antar_kadis.id_surat 
WHERE notadinas.surat_antar_kadis.status_surat_antar_kadis = 1 or notadinas.surat_antar_kadis.status_surat_antar_kadis = 3 
ORDER BY updated_at DESC")->result();
		if($tingkatan==2){
			$user_subjabatan = $this->db->query("SELECT notadinas.master_jabatan.id AS id FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_user.jabatan = " . $jabatan)->row();
		}
		$notif = [];
		$msk = 0;
		$klr = 0;
		$ntd = 0;
		$zxc = 0;
		$_check = "";
		foreach($bell as $bl){ //qqq	
			$get_creator = $this->db->query("
				SELECT notadinas.master_jabatan.id
				FROM notadinas.surat_keluar 
				INNER JOIN notadinas.master_user
					ON notadinas.surat_keluar.create_by = notadinas.master_user.id
				INNER JOIN notadinas.master_jabatan
					ON notadinas.master_jabatan.id = notadinas.master_user.jabatan
				WHERE notadinas.surat_keluar.id = " . $bl->idnya)->row();
			if($bl->tablenya=="masuk" and !isset($notif['masuk'][$bl->idnya])){
				$_tembusan = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $bl->idnya AND penerima_disposisi = " . $jabatan . "AND status = 1 AND (penerima_disposisi=1 OR penerima_disposisi=28)")->row();
				if($_tembusan!=NULL and count($_tembusan)!=0){
					$_check .= "masuk - 1 ~ ";
					$zxc = $zxc + 1;
					$msk = $msk + 1;
					$notif['masuk'][$bl->idnya] = true;
				}else if($tingkatan==2 and $bl->status_surat_keluar==4 and $bl->ka_waka_setum=="subdis" and $bl->id_jabatan==$user_subjabatan->id and $bl->opened==4){
					$check_asjdk = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $bl->idnya and penerima_disposisi_satuan = $user_subjabatan->id")->row();
					if($check_asjdk->disposisi!="yes"){
						$_check .= "masuk - 2 ~ ";
						$zxc = $zxc + 1;
						$msk = $msk + 1;
						$notif['masuk'][$bl->idnya] = true;
					}
				}else if($bl->status_surat_keluar==2 and $jabatan==1 /* and $bl->kepada!=28 */ and ($bl->opened==2 or $bl->opened==228)){
					$_check .= "masuk - 3 ~ ";
					$zxc = $zxc + 1;
					$msk = $msk + 1;
					$notif['masuk'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==2 and $jabatan==28 and $bl->kepada==28 and ($bl->opened==2 or $bl->opened==21)){
					$_check .= "masuk - 4 ~ ";
					$zxc = $zxc + 1;
					$msk = $msk + 1;
					$notif['masuk'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==3 and $jabatan==$bl->id_jabatan and $bl->status==1 and $bl->opened==3){
					$_check .= "masuk - 5 ~ ";
					$zxc = $zxc + 1;
					$msk = $msk + 1;
					$notif['masuk'][$bl->idnya] = true;
				} else if($bl->status_surat_keluar==4 and $jabatan==$bl->id_jabatan and $bl->status==1){
					$_check .= "masuk - 6 ~ ";
					$zxc = $zxc + 1;
					$msk = $msk + 1;
					$notif['masuk'][$bl->idnya] = true;
				}
			}else if($bl->tablenya=="nota" and !isset($notif['nota'][$bl->idnya])){
				$tembusanZ = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_jabatan = " . $jabatan . " AND id_notadinas = $bl->idnya")->row();
				if($jabatan==$bl->kepada and $bl->opened==100 and $bl->tujuan_status == 0){
					$_check .= "nota - 1 ~ ";
					$zxc = $zxc + 1;
					$ntd = $ntd + 1;
					$notif['nota'][$bl->idnya] = true;
				}elseif($tembusanZ!=NULL and $jabatan==$tembusanZ->id_jabatan and $tembusanZ->status!=100){
					$_check .= "nota - 2 ~ ";
					$zxc = $zxc + 1;
					$ntd = $ntd + 1;
					$notif['nota'][$bl->idnya] = true;
				}elseif($jabatan==1 and strpos($bl->ka_waka_setum, '1') !== false){
					$_check .= "nota - 3 ~ ";
					$zxc = $zxc + 1;
					$ntd = $ntd + 1;
					$notif['nota'][$bl->idnya] = true;
				}elseif($jabatan==2 and strpos($bl->ka_waka_setum, '2') !== false){
					$_check .= "nota - 4 ~ ";
					$zxc = $zxc + 1;
					$ntd = $ntd + 1;
					$notif['nota'][$bl->idnya] = true;
				}elseif($jabatan==28 and strpos($bl->ka_waka_setum, '3') !== false){
					$_check .= "nota - 5 ~ ";
					$zxc = $zxc + 1;
					$ntd = $ntd + 1;
					$notif['nota'][$bl->idnya] = true;
				}
			}if($bl->tablenya=="keluar" and !isset($notif['keluar'][$bl->idnya])){
				if($bl->ka_waka_setum=='unchecked' and $bl->status_surat_keluar==1 and $jabatan==$bl->id_jabatan and $bl->opened==1){
					$_check .= "keluar - 1 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==2 and $jabatan==1 and $bl->opened==2 and $bl->tujuan_status != 1){
					$_check .= "keluar - 2 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==2 and $jabatan==28 and $bl->opened==2){
					$_check .= "keluar - 3 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==3 and $bl->opened==3 and $get_creator->id == $jabatan){
					$_check .= "keluar - 4 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==4 and $satuan==6 and $bl->opened==4 and $bl->tujuan_status != 1){
					$_check .= "keluar - 5 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==5 and $satuan==6 and $bl->opened==5 and $bl->tujuan_status != 1){
					$_check .= "keluar - 6 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==6 and $jabatan==1 and $bl->opened==6){
					$_check .= "keluar - 7 ~ ";
					$zxc = $zxc + 1;
					$klr = $klr + 1;
					$notif['keluar'][$bl->idnya] = true;
				}else if($bl->status_surat_keluar==8 and $bl->opened==88){
					if($get_creator->id == $jabatan){
						$_check .= "keluar - 8 ~ ";
						$zxc = $zxc + 1;
						$klr = $klr + 1;
						$notif['keluar'][$bl->idnya] = true;
					}
				}
			}
		}
		// return $_check;
		// die();
		$arrya = array(
					'jabatan' => $jabatan,
					'notadinas' => $ntd,
					'suratmasuk' => $msk,
					'suratkeluar' => $klr
				);
		// $this->dd($arrya);
		return $arrya;
	}

	function push_notification($text, $array){
		$sql = $this->db->query("Select token From notadinas.token_android")->result();
		$tokens = array();
		foreach($sql as $a){
			$tokens[] = $a->token;
		}
		$message = array("message" => "$text diterima", "title" => "$text", "jabatan" => $array);
		$message_status = $this->send_notification($tokens, $message);
		echo $message_status;
	}

	function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);

		$headers = array(
			'Authorization:key = AAAAcoK-I84:APA91bE1KFw6ukT5hzvBGzPfHr18CKn5uG4M87Spz5CZrynzBq105n_U0yG2RBjIL8W4vGloZGjkQscqUWuFOfam6TSc8x3Gs6FHqlBrHcMRRQFdZEJ70qd64lXnY9ZPUGuzwSJUNc0T',
			'Content-Type: application/json'
			);

	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}

    public function mail()
    {
        $this->load->library('email');
        $this->email->to('hshizuo14@gmail.com');
        $this->email->from('farhannfs5121@gmail.com', 'Jurnalweb');
        $this->email->subject('JUDUL EMAIL (Teks)');
        $this->email->message('Isi email ditulis disini');
        $this->email->send();
    }

	public function angka_romawi($a){
		if($a==1){
			$a = "I";
		} else if($a==2){
			$a = "II";
		} else if($a==3){
			$a = "III";
		} else if($a==4){
			$a = "IV";
		} else if($a==5){
			$a = "V";
		} else if($a==6){
			$a = "VI";
		} else if($a==7){
			$a = "VII";
		} else if($a==8){
			$a = "VIII";
		} else if($a==9){
			$a = "IX";
		} else if($a==10){
			$a = "X";
		} else if($a==11){
			$a = "XI";
		} else if($a==12){
			$a = "XII";
		} else {
			$a = "00";
		}
		return $a;
	}

    public function surat_antar_kadis()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $ta = $this->session->userdata('admin_ta');
        // print_r($this->session->all_userdata());
        // die();

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta'")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, base_url() . "admin/surat_antar_kadis/p");

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan //i think these variable will not use again anymore
        $idp = addslashes($this->input->post('idp'));
        $no_agenda = addslashes($this->input->post('no_agenda'));
        $kode = addslashes($this->input->post('kode'));
        $uraian = addslashes($this->input->post('uraian'));

        //new variable
        $dari = addslashes($this->input->post('dari'));

        $tglsurat = addslashes($this->input->post('tgl_surat'));
        $tgl_surat = date("Y-m-d", strtotime($tglsurat));

        $no_surat = addslashes($this->input->post('no_surat'));
        $perihal = addslashes($this->input->post('perihal'));
        $isi_surat = addslashes($this->input->post('isi_surat'));
        $lampiran = addslashes($this->input->post('lampiran'));
        $ket = addslashes($this->input->post('ket'));

        $cari = addslashes($this->input->post('q'));

        //upload config
        $config = [];
        $config['upload_path'] = './upload/surat_antar_kadis';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['file_name'] = $this->input->post('no_lampiran');
        // $config['max_size']			= '2000';
        // $config['max_width']  		= '3000';
        // $config['max_height'] 		= '3000';

        $this->load->library('upload', $config);
        if ($mau_ke == "cari") {
            $tembusan = $this->db->query("SELECT * FROM notadinas.tembusan_surat_antar_kadis")->result();
            $array = [];
            // $arr = [];
            foreach ($tembusan as $b) {
                $array[$b->id_jabatan][$b->id_surat] = "1";
                // $arr[$b->id_jabatan][$b->id_surat][$b->status] s= "1";
            }
            $a['tembusan'] = $array;
            $a['data'] = $this->db->query("SELECT *, notadinas.master_user.nama_lengkap AS kepadanya, notadinas.surat_antar_kadis.id AS id FROM notadinas.surat_antar_kadis INNER JOIN notadinas.master_user ON notadinas.surat_antar_kadis.kepada = notadinas.master_user.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND ( notadinas.surat_antar_kadis.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.surat_antar_kadis.no_surat LIKE '%$cari%') LIMIT $akhir OFFSET $awal")->result();
            $a['page'] = "l_surat_antar_kadis";
        } else if ($mau_ke == "verifikasi_submit") {
            // if($this->input->post('no_surat')!=""){no_surat = '".$this->input->post('no_surat')."',
            $count = 0;
            $jabatan = $this->input->post('jabatan');
            var_dump($jabatan);
            // die();
            $this->db->query("UPDATE notadinas.surat_antar_kadis SET  status_surat_antar_kadis = 3, opened = 3, no_surat = '" . $this->input->post('no_surat') . "' WHERE id = $idu");
            for ($ab = 1; $ab <= count($jabatan); $ab++) {
                $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_antar_kadis")->row();
                $jids = $jid->qwe + 1;
                $this->db->query("INSERT INTO notadinas.tembusan_surat_antar_kadis VALUES ('" . $jids . "','" . $jabatan[$count] . "','0','','" . $idu . "')");
                $count = $count + 1;
            }
            $cc = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE id = '" . $idu . "'")->row();
            $mail_1 = $this->db->query("SELECT * FROM notadinas.tembusan_surat_antar_kadis WHERE id_surat = $idu")->result();
            $mail_result = "";
            $count = 1;
            foreach ($mail_1 as $a) {
                if ($count != count($mail_1)) {
                    $or = "or ";
                } else {
                    $or = "";
                }
                $mail_result .= "notadinas.master_user.jabatan = " . $a->id_jabatan . " " . $or;
                $count = $count + 1;
            }
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE $mail_result")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat kadis baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }
            // }
            redirect(base_url() . 'admin/surat_antar_kadis');
        } else if ($mau_ke == "verifikasi_surat_antar_kadis") {
            $a['datpil'] = $this->db->query("SELECT notadinas.surat_antar_kadis.*, notadinas.master_user.nama_lengkap FROM notadinas.surat_antar_kadis JOIN notadinas.master_user ON notadinas.surat_antar_kadis.kepada = notadinas.master_user.id WHERE notadinas.surat_antar_kadis.id = '$idu'")->row();
            // if($this->session->userdata('admin_jabatan')==$a['datpil']->kepada){
            $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $b = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE no_surat LIKE '%$year';")->result();
            $c = 0;
            foreach ($b as $d) {
                $e = explode('/', $d->no_surat);
                if ($e[0] > $c) {
                    $c = $e[0];
                }
            }
            $max = $c + 1;
            if (strlen($max) < 4) {
                if (strlen($max) < 3) {
                    if (strlen($max) < 2) {
                        $max = "000" . $max;
                    } else {
                        $max = "00" . $max;
                    }
                } else {
                    $max = "0" . $max;
                }
            }
            $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            // }
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_jabatan.tingkatan = 1")->result();
            $a['log_surat_antar_kadisnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_antar_kadis INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_antar_kadis.id_proses = notadinas.master_proses_surat_keluar.id WHERE log_proses_surat_antar_kadis.id_surat = $idu")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 2")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_antar_kadis.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_antar_kadis.id AS idnya_tembusan, notadinas.master_jabatan.id AS idnya_jabatan FROM notadinas.tembusan_surat_antar_kadis INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_antar_kadis.id_jabatan = notadinas.master_jabatan.id WHERE id_surat = '$idu'")->result();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            // $a['datpil']	= $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE id = '$idu'")->row();
            $a['page'] = "f_surat_antar_kadis";
        } else if ($mau_ke == "kirim_kelain") {
            $this->db->query("UPDATE notadinas.surat_antar_kadis SET status_surat_antar_kadis = 4, opened = 4 WHERE id = '" . $idu . "';");
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_antar_kadis")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_surat_antar_kadis VALUES ('" . $lpskids . "','" . $idu . "',NOW(),'" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','2','')");
            $cc = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE id = '" . $idu . "'")->row();
            $mail_1 = $this->db->query("SELECT * FROM notadinas.tembusan_surat_antar_kadis WHERE id_surat = $idu")->result();
            $mail_result = "";
            $count = 1;
            foreach ($mail_1 as $a) {
                $or = "or ";
                $mail_result .= "notadinas.master_user.jabatan = " . $a->id_jabatan . " " . $or;
                $count = $count + 1;
            }
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE $mail_result notadinas.master_user.jabatan = $cc->kepada")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat antar kadis baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }
            redirect(base_url() . 'admin/surat_antar_kadis');
        } else if ($mau_ke == "act_edt") {
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();
                $this->db->query("UPDATE notadinas.surat_antar_kadis SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat' WHERE id = '$idp'");
                // $this->db->query("UPDATE surat_antar_kadis SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
            } else {
                $this->db->query("UPDATE notadinas.surat_antar_kadis SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat' WHERE id = '$idp'");
                // $this->db->query("UPDATE surat_antar_kadis SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
            }
            $this->db->query("DELETE FROM notadinas.tembusan_surat_antar_kadis WHERE id_surat = '$idp'");
            $count = 0;
            for ($ab = 1; $ab <= count($jabatan); $ab++) {
                $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_antar_kadis")->row();
                $jids = $jid->qwe + 1;
                $this->db->query("INSERT INTO notadinas.tembusan_surat_antar_kadis VALUES ('" . $jids . "','" . $jabatan[$count] . "','" . $status[$count] . "','" . $keterangan_tembusan[$count] . "','" . $idp . "')");
                $count = $count + 1;
            }
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated " . $this->upload->display_errors() . "</div>");
            if ($this->session->userdata('admin_jabatan' != 0)) {
                redirect('admin/surat_antar_kadis');
            } else {
                redirect('admin/surat_antar_kadis');
            }
        } else if ($mau_ke == "edt") {
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_jabatan.tingkatan = 1")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_antar_kadis WHERE id_surat = $idu ORDER BY id DESC")->row();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_antar_kadis.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_antar_kadis.id AS idnya_tembusan, notadinas.tembusan_surat_antar_kadis.id_jabatan AS idnya_jabatan FROM notadinas.tembusan_surat_antar_kadis INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_antar_kadis.id_jabatan = notadinas.master_jabatan.id WHERE id_surat = '$idu'")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE id = '$idu'")->row();
            $a['page'] = "f_surat_antar_kadis";
        } else if ($mau_ke == "show") {
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_jabatan.tingkatan = 1")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_antar_kadis WHERE id_surat = $idu ORDER BY id DESC")->row();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_antar_kadis.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_antar_kadis.id AS idnya_tembusan, notadinas.tembusan_surat_antar_kadis.id_jabatan AS idnya_jabatan FROM notadinas.tembusan_surat_antar_kadis INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_antar_kadis.id_jabatan = notadinas.master_jabatan.id WHERE id_surat = '$idu'")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_antar_kadis WHERE id = '$idu'")->row();
            $a['page'] = "f_surat_antar_kadis";
        } else if ($mau_ke == "add") {
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1")->result();
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_jabatan.tingkatan = 1")->result();
            $a['page'] = "f_surat_antar_kadis";
        } else if ($mau_ke == "act_add") {
            $id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.surat_antar_kadis")->row();
            echo $ids = $id->qwe + 1;
            $jabatan = $this->input->post('jabatan');
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');
            // die();/*
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();
                $count = 0;
                for ($ab = 1; $ab <= count($jabatan); $ab++) {
                    $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_antar_kadis")->row();
                    $jids = $jid->qwe + 1;
                    $this->db->query("INSERT INTO notadinas.tembusan_surat_antar_kadis VALUES ('" . $jids . "','" . $jabatan[$count] . "','0','" . $keterangan_tembusan[$count] . "','" . $ids . "')");
                    $count = $count + 1;
                }
                $this->db->query("INSERT INTO notadinas.surat_antar_kadis VALUES ('$ids', '$tgl_surat', '', '$perihal', '$ket', '$isi_surat', '0', '" . $this->session->userdata('admin_id') . "','" . $up_data['file_name'] . "', '$dari', '" . $this->input->post('klasifikasi') . "', '" . $this->input->post('derajat') . "',0, '" . $this->session->userdata('admin_id') . "')");
            } else {
                $count = 0;
                for ($ab = 1; $ab <= count($jabatan); $ab++) {
                    $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_antar_kadis")->row();
                    $jids = $jid->qwe + 1;
                    $this->db->query("INSERT INTO notadinas.tembusan_surat_antar_kadis VALUES ('" . $jids . "','" . $jabatan[$count] . "','0','" . $keterangan_tembusan[$count] . "','" . $ids . "')");
                    $count = $count + 1;
                }
                $this->db->query("INSERT INTO notadinas.surat_antar_kadis VALUES ('$ids', '$tgl_surat', '', '$perihal', '$ket', '$isi_surat', '0', '" . $this->session->userdata('admin_id') . "','', '$dari', '" . $this->input->post('klasifikasi') . "', '" . $this->input->post('derajat') . "',0, '" . $this->session->userdata('admin_id') . "')");
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            redirect('admin/surat_antar_kadis');//*/
        } else {
            $a['data_user'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan=notadinas.master_jabatan.id WHERE notadinas.master_user.id = '" . $this->session->userdata('admin_id') . "'")->row();
            $a['data'] = $this->db->query("SELECT *, notadinas.master_user.nama_lengkap AS kepadanya, notadinas.surat_antar_kadis.id AS id FROM notadinas.surat_antar_kadis INNER JOIN notadinas.master_user ON notadinas.surat_antar_kadis.kepada = notadinas.master_user.jabatan WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();
            /*$a['data']		= $this->db->query("SELECT notadinas.surat_antar_kadis.*, notadinas.master_user.nama_lengkap from notadinas.surat_antar_kadis INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.surat_antar_kadis.kepada WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();*/
            $tembusan = $this->db->query("SELECT * FROM notadinas.tembusan_surat_antar_kadis")->result();
            $array = [];
            // $arr = [];
            foreach ($tembusan as $b) {
                $array[$b->id_jabatan][$b->id_surat] = "1";
                // $arr[$b->id_jabatan][$b->id_surat][$b->status] = "1";
            }
            $a['tembusan'] = $array;
            // $a['status_tembusan'] 	= $arr;
            $a['page'] = "l_surat_antar_kadis";
        }
        $this->load->view('admin/aaa', $a);
    }

    function cetak_nota_dinas($idu)
    {
        $getme = $idu; 

        $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
        $a['data'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$getme'")->row();
        $b = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE no_surat LIKE '%$year';")->result();
            $c = 0;
            foreach ($b as $d) {
                $e = explode('/', $d->no_surat);
                if(is_numeric($e[1])){
                    if ($e[0] > $c) {
                      $c = $e[0];
                    }
                }else{
                    if ($e[1] > $c) {
                      $c = $e[1];
                    }
                }
            }
            if (!ctype_digit($c)) {
            preg_match_all('!\d+!', $c, $matches);
            $max = $matches[0][0] + 1;

            }else{

            $max = $c+1;
            }
            if (strlen($max) < 4) {
                if (strlen($max) < 3) {
                    if (strlen($max) < 2) {
                        $max = "000" . $max;
                    } else {
                        $max = "00" . $max;
                    }
                } else {
                    $max = "0" . $max;
                }
            }
            // $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
        $a['generated_no_surat'] = $max . "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
        $a['data'] = $this->db->query("SELECT * FROM notadinas.nota_dinas inner join notadinas.kegiatan_dinas on notadinas.nota_dinas.kegiatan_id = notadinas.kegiatan_dinas.id_kegiatan WHERE id = '$getme'")->row();

        $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
        $a['tembusan'] = $this->db->query("SELECT notadinas.master_jabatan.nama_jabatan, notadinas.tembusan_nota_dinas.keterangan FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE notadinas.tembusan_nota_dinas.id_notadinas = $getme")->result();
        $a['jabatan'] = $this->db->query("
		SELECT notadinas.master_jabatan.nama_jabatan
		FROM notadinas.nota_dinas
		INNER JOIN notadinas.master_jabatan
		ON notadinas.nota_dinas.kepada = notadinas.master_jabatan.id
		WHERE notadinas.nota_dinas.id = $getme")->row();
        // var_dump($a['jabatan']);
        // die();
        $this->load->view('admin/cetak/nota_dinas', $a);
    }

    function cetak_surat_antar_kadis($id)
    {
        $data['q'] = $this->db->query("SELECT notadinas.surat_antar_kadis.*, notadinas.master_user.nama_lengkap AS kepadanya FROM notadinas.surat_antar_kadis INNER JOIN notadinas.master_user ON notadinas.surat_antar_kadis.kepada = notadinas.master_user.id WHERE notadinas.surat_antar_kadis.id = $id")->row();
        $data['w'] = $this->db->query("SELECT notadinas.master_user.id, notadinas.master_user.nama_lengkap FROM notadinas.surat_antar_kadis INNER JOIN notadinas.master_user ON notadinas.surat_antar_kadis.dari = notadinas.master_user.id WHERE notadinas.surat_antar_kadis.id = $id")->row();
        $data['e'] = $this->db->query("SELECT notadinas.master_jabatan.nama_jabatan FROM notadinas.master_jabatan INNER JOIN notadinas.master_user ON notadinas.master_jabatan.id = notadinas.master_user.jabatan WHERE notadinas.master_user.id = " . $data['w']->id)->row();
        $data['r'] = $this->db->query("SELECT * FROM notadinas.tembusan_surat_antar_kadis WHERE notadinas.tembusan_surat_antar_kadis.id_surat = $id")->result();
        $t = $this->db->query("SELECT * FROM notadinas.master_jabatan")->result();
        $array = [];
        foreach ($t as $a) {
            $array["t" . $a->id] = $a->nama_jabatan;
        }
        $data['t'] = $array;
        $this->load->view('admin/cetak/surat_antar_kadis', $data);
    }

    function cetak_log_surat_keluar($id)
    {
        $data['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id WHERE log_proses_surat_keluar.id_suratkeluar = $id")->result();
        $key = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_tujuan.nama AS kepadanya FROM notadinas.surat_keluar INNER JOIN notadinas.master_tujuan ON notadinas.surat_keluar.kepada = notadinas.master_tujuan.id WHERE notadinas.surat_keluar.id = $id")->row();
        $data['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan, notadinas.master_jabatan.id AS idnya_jabatan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$id'")->result();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();

        $data['isi'] = $key->isi;

        $this->load->view('admin/cetak/log_surat_keluar',$data);
    }

    function cetak_surat_keluar($id)
    {
        // ZAME
        $key = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_tujuan.nama AS kepadanya FROM notadinas.surat_keluar INNER JOIN notadinas.master_tujuan ON notadinas.surat_keluar.kepada = notadinas.master_tujuan.id WHERE notadinas.surat_keluar.id = $id")->row();
        $tglsurat = date("n", strtotime($key->tgl_surat));
        if($tglsurat==1){
            $bln = "Januari";
        }else if($tglsurat==2){
            $bln = "Februari";
        }else if($tglsurat==3){
            $bln = "Maret";
        }else if($tglsurat==4){
            $bln = "April";
        }else if($tglsurat==5){
            $bln = "Mei";
        }else if($tglsurat==6){
            $bln = "Juni";
        }else if($tglsurat==7){
            $bln = "Juli";
        }else if($tglsurat==8){
            $bln = "Agustus";
        }else if($tglsurat==9){
            $bln = "September";
        }else if($tglsurat==10){
            $bln = "Oktober";
        }else if($tglsurat==11){
            $bln = "November";
        }else if($tglsurat==12){
            $bln = "Desember";
        }
        $tgl = date("j", strtotime($key->tgl_surat));
        $th = date("Y", strtotime($key->tgl_surat));
        $fintgl = $tgl." ".$bln." ".$th;
        $data['no_surat'] = $key->no_surat;//ubah mei error
        $data['tgl_surat'] = $fintgl;
        $data['isi'] = $key->isi;
        $data['jenis_surat'] = $key->jenis_surat;
        $data['id'] = $key->id;


        $this->load->view('admin/cetak/cetak_surat_keluar',$data);

        // $this->load->view('admin/cetak/cetak_surat_keluar',$data);

        // $data['q'] = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_tujuan.nama AS kepadanya FROM notadinas.surat_keluar INNER JOIN notadinas.master_tujuan ON notadinas.surat_keluar.kepada = notadinas.master_tujuan.id WHERE notadinas.surat_keluar.id = $id")->row();
        // $data['w'] = $this->db->query("SELECT notadinas.master_user.id, notadinas.master_user.nama_lengkap FROM notadinas.surat_keluar INNER JOIN notadinas.master_user ON notadinas.surat_keluar.dari = notadinas.master_user.id WHERE notadinas.surat_keluar.id = $id")->row();
        // $data['e'] = $this->db->query("SELECT notadinas.master_jabatan.nama_jabatan FROM notadinas.master_jabatan INNER JOIN notadinas.master_user ON notadinas.master_jabatan.id = notadinas.master_user.jabatan WHERE notadinas.master_user.id = " . $data['w']->id)->row();
        // $data['r'] = $this->db->query("SELECT * FROM notadinas.tembusan_surat_keluar WHERE notadinas.tembusan_surat_keluar.id_surat_keluar = $id")->result();
        // $t = $this->db->query("SELECT * FROM notadinas.master_jabatan")->result();
        // $array = [];
        // foreach ($t as $a) {
        //     $array["t" . $a->id] = $a->nama_jabatan;
        // }

        // $id_surat = $key['0']['jenis_surat'];

        // $data['t'] = $array;
        // if ($id_surat == 1) {
        //     $this->load->view('admin/cetak/surat_keluar_rahasia', $data);
        // } elseif ($id_surat == 2) {
        //     $this->load->view('admin/cetak/surat_keluar_biasa', $data);
        // } elseif ($id_surat == 3) {
        //     $this->load->view('admin/cetak/surat_keluar_perintah', $data);
        // } elseif ($id_surat == 4) {
        //     $this->load->view('admin/cetak/surat_keluar_ijin', $data);
        // } elseif ($id_surat == 5) {
        //     $this->load->view('admin/cetak/surat_keluar_ijin_jalan', $data);
        // } elseif ($id_surat == 6) {
        //     $this->load->view('admin/cetak/surat_keluar_pengantar', $data);
        // } elseif ($id_surat == 7) {
        //     $this->load->view('admin/cetak/surat_keluar_tugas', $data);
        // } elseif ($id_surat == 8) {
        //     $this->load->view('admin/cetak/surat_keluar_notadinas', $data);
        // } elseif ($id_surat == 9) {
        //     $this->load->view('admin/cetak/surat_keluar_perjanjian_kerjasama', $data);
        // } elseif ($id_surat == 10) {
        //     $this->load->view('admin/cetak/surat_keluar_edaran', $data);
        // } elseif ($id_surat == 11) {
        //     $this->load->view('admin/cetak/surat_keluar_beritaacara', $data);
        // } elseif ($id_surat == 12) {
        //     $this->load->view('admin/cetak/surat_keluar_keterangan', $data);
        // } elseif ($id_surat == 13) {
        //     $this->load->view('admin/cetak/surat_keluar_perjalanan_dinas', $data);
        // } elseif ($id_surat == 14) {
        //     $this->load->view('admin/cetak/surat_keluar_keputusan', $data);
        // } elseif ($id_surat == 15) {
        //     $this->load->view('admin/cetak/surat_keluar_luar_negeri', $data);

        // } else {
        //     $this->load->view('admin/cetak/surat_keluar', $data);
        // }
    }

    function cetak_surat_masuk($idu)//ubah mei surmas5
    {
        $dati = str_replace("_", "/", $idu);
        $dita = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_setum = '$dati'")->row();
        // $idb = intval($dita->id);
        $idb = $idu;
        // var_dump($idb);
        // die();
        $a['data'] = $this->db->query("
		SELECT notadinas.surat_masuk.*, notadinas.master_tujuan.nama AS nama_instansi
		FROM notadinas.surat_masuk
		INNER JOIN notadinas.master_tujuan
		ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id
		WHERE notadinas.surat_masuk.id = $idb")->row();
		$disposisi = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $idb")->row();		
		$_waktu = "";
		if($disposisi->waktu!=""){
			$_waktu = explode('.',$disposisi->waktu);
			$_waktu = "<br/>" . $disposisi->tanggal_proses . " " . $_waktu[0];
		}
		$a['disposisi'] = substr($_waktu,-19);
        $a['jabatan'] = $this->db->query("
		SELECT notadinas.master_jabatan.nama_jabatan
		FROM notadinas.surat_masuk
		INNER JOIN notadinas.master_jabatan
		ON notadinas.surat_masuk.kepada = notadinas.master_jabatan.id
		WHERE notadinas.surat_masuk.id = $idb")->row();
        $a['alamat_aksi'] = $this->db->query('SELECT * FROM notadinas.master_jabatan WHERE urutan_view IS NOT NULL AND urutan_view != 0 ORDER BY urutan_view ASC')->result();//ubah me surmas3

        $idjab = $this->session->userdata('admin_jabatan');
        $a['alamat_aksi_sub'] = $this->db->query('SELECT * FROM notadinas.master_subjabatan WHERE id_jabatan = ' . $idjab)->result();

        $a['aksinya'] = $this->db->query('SELECT * FROM notadinas.master_aksi ORDER BY id ASC')->result();
        $asd = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $idb AND status = 2")->result();


        $array = [];
        $arr = [];
        foreach ($asd as $as) {
            $array[$as->penerima_disposisi] = 1;
            $arr[$as->aksi] = 1;
        }
        $a['tembusan'] = $asd;
        $a['aksi_tembusan'] = $arr;
        $a['jabatan_tembusan'] = $array;
        $a['idbut'] = $idb;
        $this->load->view('admin/cetak/surat_masuk', $a);
    }

    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $a['page'] = "d_amain";

        $this->load->view('admin/aaa', $a);
    }

    public function klas_surat()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM ref_klasifikasi")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, base_url() . "admin/klas_surat/p");

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $nama = addslashes($this->input->post('nama'));
        $uraian = addslashes($this->input->post('uraian'));

        $cari = addslashes($this->input->post('q'));


        if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM ref_klasifikasi WHERE nama LIKE '%$cari%' OR uraian LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "l_klas_surat";
        } else if ($mau_ke == "add") {
            $a['page'] = "f_klas_surat";
        } else if ($mau_ke == "edt") {
            $a['datpil'] = $this->db->query("SELECT * FROM ref_klasifikasi WHERE id = '$idu'")->row();
            $a['page'] = "f_klas_surat";
        } else if ($mau_ke == "act_edt") {
            $this->db->query("UPDATE ref_klasifikasi SET nama = '$nama', uraian = '$uraian' WHERE id = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");
            redirect('admin/klas_surat');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM ref_klasifikasi LIMIT $awal, $akhir ")->result();
            $a['page'] = "l_klas_surat";
        }

        $this->load->view('admin/aaa', $a);
    }
//sisexy
    public function surat_masuk()
    {

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $this->eoffice = $this->load->database('eoffice', TRUE);
        $ta = $this->session->userdata('admin_ta');

        /* pagination */


        $a['query1'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0")->result();
        $a['query2'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 5 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0")->result();
        $a['query3'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj")->result();//ubah disposisi mei
        $a['query4'] = $this->db->query("SELECT * FROM notadinas.master_task WHERE id_etask != 0")->result();//ubah disposisi mei

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        $to = $this->uri->segment(5);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel post
        $idp = addslashes($this->input->post('idp'));
        $file_attachment = addslashes($this->input->post('file_attachement'));
        $no_surat = addslashes($this->input->post('no_surat'));

        $tglsurat = addslashes($this->input->post('tgl_surat'));
        $tgl_surat = date("Y-m-d", strtotime($tglsurat));

        $uraian = addslashes($this->input->post('uraian'));
        $keterangan = addslashes($this->input->post('ket'));
        $no_setum = addslashes($this->input->post('no_setum'));
        $tgl_setum = date('Y-m-d');
        $tglset = addslashes($this->input->post('tgl_setum'));
        $tgl_setum2 = date("Y-m-d", strtotime($tglset));
        $status_surat = addslashes($this->input->post('status_surat'));
        $derajat = addslashes($this->input->post('derajat'));
        $klasifikasi = addslashes($this->input->post('klasifikasi'));
        $kepada = addslashes($this->input->post('kepada'));
        $perihal = addslashes($this->input->post('perihal'));
        $instansi = addslashes($this->input->post('instansi'));

        $ruang = 0;//addslashes($this->input->post('ruang'));
        $rak = 0;//addslashes($this->input->post('rak'));
        $box = 0;//addslashes($this->input->post('box'));
        $baris = 0;//addslashes($this->input->post('baris'));
        $jenis = addslashes($this->input->post('jenis_surat'));

        $workspace = addslashes($this->input->post('rknya'));
        $tasktask  = addslashes($this->input->post('tknya'));

        $perihal = str_replace('\"', '"', $perihal);
        date_default_timezone_set('Asia/Jakarta');
        $upd_date = date("Y-m-d H:i:s");

        //upload config
        $config['upload_path'] = './upload/surat_masuk';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['max_size'] = '2000000';
        $config['max_width'] = '30000';
        $config['max_height'] = '30000';
        $config['file_name'] = str_replace('.','',$this->input->post('no_lampiran'));

        $this->load->library('upload', $config);

        if ($mau_ke == "save_task") {
            $this->db->query("UPDATE notadinas.surat_masuk SET id_workspace = 0, id_taks = '".$_GET['task']."' WHERE id = ".$_GET['id']);
			die();
        }else if ($mau_ke == "del") {
            $this->db->query("DELETE FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = '$idu'");//ubah surat masuk mei
            $this->db->query("DELETE FROM notadinas.surat_masuk WHERE id = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('index.php/admin/surat_masuk');
        } else if ($mau_ke == "cari") {


            $admin = $this->session->userdata('admin_jabatan');
            if ($this->session->userdata('admin_satuan') == 6) {
                $a['data'] = $this->db->query("SELECT *, notadinas.master_tujuan.nama AS instansi, notadinas.surat_masuk.id AS id FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id INNER JOIN notadinas.master_surat_masuk ON notadinas.surat_masuk.id_jenis_surat_masuk = notadinas.master_surat_masuk.id_jenis_surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' and notadinas.master_surat_masuk.nama_jenis_surat ILIKE '%$cari%' ORDER BY notadinas.surat_masuk.id DESC")->result();//ubah surat masuk mei
            } else if ($admin == 1) {
                $a['data'] = $this->db->query("SELECT *, notadinas.master_tujuan.nama AS instansi, notadinas.surat_masuk.id AS id FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id INNER JOIN notadinas.master_surat_masuk ON notadinas.surat_masuk.id_jenis_surat_masuk = notadinas.master_surat_masuk.id_jenis_surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND kepada = '1' OR kepada = '28' OR notadinas.master_surat_masuk.nama_jenis_surat ILIKE '%$cari%' ORDER BY notadinas.surat_masuk.id DESC")->result();//ubah surat masuk mei
            } else if ($admin == 28) {
                $a['data'] = $this->db->query("SELECT *, notadinas.master_tujuan.nama AS instansi, notadinas.surat_masuk.id AS id FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id INNER JOIN notadinas.master_surat_masuk ON notadinas.surat_masuk.id_jenis_surat_masuk = notadinas.master_surat_masuk.id_jenis_surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND kepada = '$admin' OR notadinas.master_surat_masuk.nama_jenis_surat ILIKE '%$cari%' ORDER BY notadinas.surat_masuk.id DESC")->result();//ubah surat masuk mei
            } else if ($this->session->userdata('admin_tingkatan') == 1) {
                $abc = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk")->result();
                $array = [];
                $arr = [];
                foreach ($abc as $az) {
                    $array[$az->id_surat_masuk][$az->penerima_disposisi] = '1';
                    $arr[$az->id_surat_masuk][$az->penerima_disposisi][$az->disposisi] = '1';
                }
                $a['tembusan'] = $array;
                $a['disp_tembusan'] = $arr;
                $a['data'] = $this->db->query("SELECT *, notadinas.master_tujuan.nama AS instansi, notadinas.surat_masuk.id AS id FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id INNER JOIN notadinas.master_surat_masuk ON notadinas.surat_masuk.id_jenis_surat_masuk = notadinas.master_surat_masuk.id_jenis_surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND status_surat_masuk = '3' OR status_surat_masuk = '4' OR kepada = '$admin' OR notadinas.master_surat_masuk.nama_jenis_surat ILIKE '%$cari%' ORDER BY notadinas.surat_masuk.id DESC")->result();//ubah surat masuk mei
            } else {
                $abc = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk")->result();
                $array = [];
                $arr = [];
                foreach ($abc as $az) {
                    $array[$az->id_surat_masuk][$az->penerima_disposisi] = '1';
                    $arr[$az->id_surat_masuk][$az->penerima_disposisi][$az->disposisi] = '1';
                }
                $a['tembusan'] = $array;
                $a['disp_tembusan'] = $arr;
                $a['data'] = $this->db->query("SELECT *, notadinas.master_tujuan.nama AS instansi, notadinas.surat_masuk.id AS id FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id INNER JOIN notadinas.master_surat_masuk ON notadinas.surat_masuk.id_jenis_surat_masuk = notadinas.master_surat_masuk.id_jenis_surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND status_surat_masuk = '4' OR notadinas.master_surat_masuk.nama_jenis_surat ILIKE '%$cari%' ORDER BY notadinas.surat_masuk.id DESC")->result();//ubah surat masuk mei
            }
            // $abc = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk")->result();
            // $array = [];
            // $arr = [];
            // foreach ($abc as $az) {
                // $array[$az->id_surat_masuk][$az->penerima_disposisi] = '1';
                // $arr[$az->id_surat_masuk][$az->penerima_disposisi][$az->disposisi] = '1';
            // }
            // $a['tembusan'] = $array;
            // $a['disp_tembusan'] = $arr;
            // $a['data'] = $this->db->query("SELECT *,notadinas.master_tujuan.nama AS instansi FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id INNER JOIN notadinas.master_jenis_surat_masuk ON notadinas.surat_masuk.id_jenis_surat_masuk = notadinas.master_jenis_surat_masuk.id_jenis_surat_masuk WHERE notadinas.surat_masuk.perihal ILIKE '%$cari%' OR notadinas.surat_masuk.file_attachment ILIKE '%$cari%' OR notadinas.master_tujuan.nama ILIKE '%$cari%' OR notadinas.surat_masuk.no_surat ILIKE '%$cari%' OR notadinas.master_jenis_surat_masuk.nama_jenis_surat ILIKE '%$cari%'")->result();
            $a['page'] = "l_surat_masuk";
        } else if ($mau_ke == "add") {
			$a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_masuk")->row();
			$a['query12'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj ORDER BY id_ruang_kerja ASC")->result();
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan ORDER BY nama ASC")->result();
            $a['jabatan'] = $this->db->query("SELECT * FROM notadinas.master_jabatan ORDER BY urut_jabatan ASC")->result();
            $a['diteruskan_kepada'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0) ORDER BY urutan ASC")->result();
            $a['ruang'] = $this->db->query("SELECT * FROM notadinas.master_ruang")->result();
            $a['rak'] = $this->db->query("SELECT * FROM notadinas.master_rak")->result();
            $a['box'] = $this->db->query("SELECT * FROM notadinas.master_box")->result();
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();//ubah surat masuk mei
            $a['aksi'] = $this->db->query("SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC")->result();
            // $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            $b = $this->db->query("SELECT no_surat FROM notadinas.surat_masuk WHERE no_surat LIKE '%$year';")->result();
            $max = 1;
            if (strlen($max) < 4) {
                if (strlen($max) < 3) {
                    if (strlen($max) < 2) {
                        $max = "000" . $max;
                    } else {
                        $max = "00" . $max;
                    }
                } else {
                    $max = "0" . $max;
                }
            }
            // $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $a['generated_no_surat'] = $max . "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            $a['page'] = "f_surat_masuk";
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE jabatan = 1")->result();
                foreach ($mail_2 as $bc) {
                    $ok = @mail($bc->email, "Pembuatan Surat Masuk", "Surat masuk baru telah dibuat", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
            //prima
        } else if ($mau_ke == "edt") {
            $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
                $b = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_surat LIKE '%$year';")->result();
                $c = 0;
                foreach ($b as $d) {
                    $e = explode('/', $d->no_surat);
                    if ($e[0] > $c) {
                        $c = $e[0];
                    }
                }
                $max = $c + 1;
                if (strlen($max) < 4) {
                    if (strlen($max) < 3) {
                        if (strlen($max) < 2) {
                            $max = "000" . $max;
                        } else {
                            $max = "00" . $max;
                        }
                    } else {
                        $max = "0" . $max;
                    }
                }
                $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu' ")->row();
            $a['ruang'] = $this->db->query("SELECT * FROM notadinas.master_ruang")->result();
            $a['rak'] = $this->db->query("SELECT * FROM notadinas.master_rak")->result();
            $a['box'] = $this->db->query("SELECT * FROM notadinas.master_box")->result();
            // $a['jabatan'] = $this->db->query("SELECT * FROM notadinas.master_jabatan ORDER BY urut_jabatan ASC")->result();
			$a['jabatan'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE urutan_view IS NOT NULL AND urutan_view != 0 ORDER BY urutan_view ASC")->result();//ubah baru lagi
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();//ubah surat masuk mei
            $a['aksi'] = $this->db->query("SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC")->result();
            $a['query1'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0")->result();
            $a['query2'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 5 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0")->result();
			$a['datasatuan'] = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab, c.nama_jabatan as nam_jab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan INNER JOIN notadinas.master_jabatan as c ON b.id_jabatan = c.id WHERE a.tingkatan = 2 ORDER BY c.urut_jabatan ASC,id_jab ASC ,urut_subjab ASC")->result();
			$a['diteruskan_kepada'] = $this->db->query('SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0) ORDER BY urutan ASC')->result();

            $a['page'] = "show_surat_masuk";
         }else if ($mau_ke == "edited") {//ubah surat masuk mei
            $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
                $b = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_surat LIKE '%$year';")->result();
                $c = 0;
                foreach ($b as $d) {
                    $e = explode('/', $d->no_surat);
                    if ($e[0] > $c) {
                        $c = $e[0];
                    }
                }
                $max = $c + 1;
                if (strlen($max) < 4) {
                    if (strlen($max) < 3) {
                        if (strlen($max) < 2) {
                            $max = "000" . $max;
                        } else {
                            $max = "00" . $max;
                        }
                    } else {
                        $max = "0" . $max;
                    }
                }
                $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu' ")->row();
            $a['ruang'] = $this->db->query("SELECT * FROM notadinas.master_ruang")->result();
            $a['rak'] = $this->db->query("SELECT * FROM notadinas.master_rak")->result();
            $a['box'] = $this->db->query("SELECT * FROM notadinas.master_box")->result();
            $a['jabatan'] = $this->db->query("SELECT * FROM notadinas.master_jabatan ORDER BY urut_jabatan ASC")->result();
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();//ubah surat masuk mei
            $a['aksi'] = $this->db->query("SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC")->result();
            $a['query1'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0")->result();
            $a['query2'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 5 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0")->result();

            $a['page'] = "f_edt_surat_masuk";
        }  else if ($mau_ke == "act_edited") {///ubah surat masuk mei
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();

                $this->db->query("UPDATE notadinas.surat_masuk SET tgl_surat = '$tgl_surat', instansi = '$instansi', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$keterangan', kepada = '$kepada', no_setum = '$no_setum', tgl_setum = '$tgl_setum2', klasifikasi = '$klasifikasi', file_attachment = '".$up_data['file_name']."', id_ruang = '$ruang', id_rak = '$rak', id_box = '$box', baris = '$baris', id_jenis_surat_masuk = '$jenis', updated_at = '$upd_date'  WHERE id = '$idp'");//ubah mei surmas8
            } else {
                $this->db->query("UPDATE notadinas.surat_masuk SET tgl_surat = '$tgl_surat', instansi = '$instansi', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$keterangan', kepada = '$kepada', no_setum = '$no_setum', tgl_setum = '$tgl_setum2', klasifikasi = '$klasifikasi', id_ruang = '$ruang', id_rak = '$rak', id_box = '$box', baris = '$baris', id_jenis_surat_masuk = '$jenis', updated_at = '$upd_date' WHERE id = '$idp'");
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. " . $this->upload->display_errors() . "</div>");
            redirect('index.php/admin/surat_masuk');
        } else if ($mau_ke == "tambah_tugas") {
            $rk = $_GET['r'];
            $nama_task = $_GET['q'];
			$id_jns = $_GET['w'];
            $cek_nama = $this->db->query("SELECT nama_task FROM notadinas.master_task WHERE nama_task = '$nama_task'")->num_rows();

            if ($cek_nama > 0) {//ubah mei surmas1
                // $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">tujuan nama sudah ada.</div>");
                // $_SESSION['ka'] = "Nama Tujuan Sudah Ada.";
            }else{//ubah mei surmas1
                
                $jid = $this->eoffice->query("SELECT MAX(id) AS qwe FROM fo_objects")->row();
                    $jids = $jid->qwe + 1;
                $jiz = $this->db->query("SELECT MAX(id_task) AS qwo FROM notadinas.master_task")->row();
                        $jidz = $jiz->qwo + 1;
                $orid = $this->eoffice->query("SELECT MAX(id) AS qwu FROM fo_object_reminders")->row();
                        $idor = $orid->qwu + 1;
                $idal = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                        $idals = $idal->qwi + 1;
                        $idals2 = $idals + 1;
                $idmem = $this->eoffice->query("SELECT MAX(id) AS qwa FROM fo_members")->row();
                        $idmems = $idmem->qwa + 1;
                $userLogin = $this->session->userdata('admin_user');
                $useffice = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLogin'")->row();
                $id_usef = $useffice->object_id;
                $setum = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = 'kapushidrosal'")->row();
                    $idsetum = $setum->object_id;
                $setum_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$idsetum'")->row();
                    $id_memsetum = $setum_member->id;
                $log_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$id_usef'")->row();
                    $id_memlog = $log_member->id;
                $member_workspace = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$rk'")->row();
                $member_works = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '".$member_workspace->object_id."'")->row();
                    $id_memworks = $member_works->id;
                $date_wrk = date('Y-m-d h:i:s');
                $date_ts = date('Y-m-d');
                $idsub = $idsetum.', '.$id_usef;
				
                $this->eoffice->query("DELETE FROM fo_object_members WHERE object_id = $jids");//ubah mei surmas
                $this->eoffice->query("INSERT INTO fo_objects (id, object_type_id, name, created_on, created_by_id, updated_on, updated_by_id, trashed_on, trashed_by_id, archived_on, archived_by_id, timezone_id, timezone_value) VALUES ('".$jids."', '5', '".$nama_task."', '".$date_wrk."', '".$id_usef."', '".$date_wrk."', '".$id_usef."', '', '0', '', '0', '357', '25200')");
                $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals."', '".$id_usef."', '".$jids."', '".$nama_task."', '".$date_wrk."', '".$id_usef."', 'subscribe', '0', '1', '0', '".$idsub."')");
                $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals2."', '".$id_usef."', '".$jids."', '".$nama_task."', '".$date_wrk."', '".$id_usef."', 'add', '0', '0', '0', '')");
                $this->eoffice->query("INSERT INTO fo_object_members (object_id, member_id, is_optimization) VALUES ('".$jids."', '".$id_memsetum."', '0'), ('".$jids."', '".$id_memlog."', '0'), ('".$jids."', '".$id_memworks."', '0')");
                 $this->eoffice->query("INSERT INTO fo_object_reminders (id, object_id, contact_id, type, context, minutes_before, date) VALUES ('".$idor."', '".$jids."', '0', 'reminder_email', 'due_date', 1440, '".$date_ts."')");
                $this->eoffice->query("INSERT INTO fo_object_subscriptions (object_id, contact_id) VALUES ('".$jids."', '".$id_usef."'), ('".$jids."', '".$idsetum."')");
                $this->eoffice->query("INSERT INTO fo_project_tasks (object_id, parent_id, parents_path, depth, text, due_date, start_date, assigned_to_contact_id, assigned_on, assigned_by_id, time_estimate, completed_on, completed_by_id, started_on, started_by_id, priority, state, milestone_id, is_template, from_template_id, from_template_object_id, repeat_end, repeat_forever, repeat_num, repeat_d, repeat_m, repeat_y, repeat_by, object_subtype, percent_completed, use_due_time, use_start_time, original_task_id, instantiation_id, type_content, total_worked_time) VALUES ('".$jids."', '0', '', '0', 'Deskripsi dari Tugas ".$nama_task."', '".$date_ts."', '".$date_ts."', '".$idsetum."', '".$date_wrk."', '".$id_usef."', '0', '', '0', '', '0', '200', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '0', 'html', '0')");
                
                $this->eoffice->query("INSERT INTO fo_searchable_objects (rel_object_id, column_name, content, contact_id) VALUES ('".$jids."', 'text', 'Deskripsi dari Tugas ".$nama_task."', 0), ('".$jids."', 'name', '".$nama_task."', 0), ('".$jids."', 'object_id', '".$jids."', 0)");
                $object_member = $this->eoffice->query("SELECT * FROM fo_contacts WHERE is_company = '0' ORDER BY object_id ASC")->result();
                foreach ($object_member as $key2) {
                    $permission_group = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '".$key2->object_id."' ORDER BY contact_id ASC")->row();
                    $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('".$permission_group->id."', '".$jids."')");
                }
				
                $this->db->query("INSERT INTO notadinas.master_task VALUES ('".$jidz."','".$rk."','" . $nama_task . "', '', '".$jids."')");
                // $a = $this->db->query("SELECT * FROM notadinas.master_task WHERE id_etask != 0 ORDER BY id_task DESC")->result();
				$yy = $_GET['w'];
				$a = $this->db->query("SELECT a.nama_task, a.id_task FROM notadinas.master_task as a, notadinas.master_ruangkrj as b  
				WHERE a.id_etask = b.id_ruang_kerja and b.id_jenissurat = $yy ORDER BY id_task DESC ")->result();
                $c = "";
                foreach ($a as $b) {
                    $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$b->id_task."'")->result();//ubah disposisi mei
					
                    if(empty($query6)){
                        $c .= "<option value='$b->id_task'>$b->nama_task</option>";
                    }else{
                    }
                }
                echo $c;
                die();
            }
        } else if ($mau_ke == "kirim") {
            $cc = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '" . $idu . "'")->row();
            $jabatan_push_notif = "";
            if ($cc->kepada == 1) {
                $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE jabatan = 1")->result();
                foreach ($mail_2 as $b) {
                    $ok = @mail($b->email, "Disposisi Surat Masuk", "Diterima surat masuk baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
                $this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 2, opened = 2, updated_at = '$upd_date' WHERE id = '$idu'");
                // }else if ($cc->kepada == 5){
                //  $this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 2, opened = 3 WHERE id = '$idu'");
                $jabatan_push_notif .= "1";
                 $idJabatanForSocket[] = "1";
            } else {
                $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE jabatan = 28")->result();
                foreach ($mail_2 as $b) {
                    $ok = @mail($b->email, "Disposisi Surat Masuk", "Diterima surat masuk baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
                $this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 2, opened = 2, updated_at = '$upd_date' WHERE id = '$idu'");
                $jabatan_push_notif .= "1,28";
                $idJabatanForSocket = [1,28];
            }

            $this->push_notification("Surat Masuk",$jabatan_push_notif);

            date_default_timezone_set('Asia/Jakarta');
			$_waktu = date('H:i:s');
            $this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,'" . $idu . "',NOW(),'" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','" . $this->session->userdata('admin_id') . "','$_waktu')");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Surat sudah terkirim. " . $this->upload->display_errors() . "</div>");
			$this->pushFirebase($jabatan_push_notif);

            $cc = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '" . $idu . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Masuk
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];
            foreach($idJabatanForSocket as $id_jabatan){
                $socketData[] = [
                    'ka_waka_setum'       => null,
                    'tgl_surat'           => date('Y-m-d'),
                    'tablenya'            => 'masuk',
                    'status'              => 1,
                    'opened'              => $cc->opened,
                    'kepada'              => $cc->kepada,
                    'id_jabatan'          => $id_jabatan,
                    'perihal'             => $cc->perihal,
                    'status_surat_keluar' => $cc->status_surat_masuk,
                    'idnya'               => $cc->id,
                    'create_by'           => $cc->create_by
                ];
            }


            $_SESSION['socketAdded'] = $socketData;

            redirect('index.php/admin/surat_masuk');
        } else if ($mau_ke == "disp") {

			if($this->session->userdata('admin_jabatan')==28 or $this->session->userdata('admin_jabatan')==1){				
				$this->db->query("UPDATE notadinas.disposisi_surat_masuk SET status = 2 WHERE id_surat_masuk = '$idu' and penerima_disposisi = " . $this->session->userdata('admin_jabatan'));
			}
            $dtdis = $this->db->query("SELECT * FROM notadinas.aksi_disposisi_surat_masuk WHERE id_disposisi_surat_masuk = '$idu'")->result();//ubah mei surmas11
            if(empty($dtdis)){//ubah mei surmas11
                $a['kondisp'] = 0;
            }else{//ubah mei surmas11
                $a['kondisp'] = 1;
            }
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();
			$def = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();
            if($this->session->userdata('admin_jabatan')==28){
				// echo "1";die();
                if($a['datpil']->opened==2){
                    $this->db->query("UPDATE notadinas.surat_masuk SET opened = 228, updated_at = '$upd_date' WHERE id = '$idu'");
                }else if($a['datpil']->opened==21){
                    $this->db->query("UPDATE notadinas.surat_masuk SET opened = 2128, updated_at = '$upd_date' WHERE id = '$idu'");
                }
            }else if($this->session->userdata('admin_jabatan')==1){
				// echo "2";die();
				// echo $def->opened;die();
                if($a['datpil']->opened==2){
                    $this->db->query("UPDATE notadinas.surat_masuk SET opened = 21, updated_at = '$upd_date'WHERE id = '$idu'");
                }else if($a['datpil']->opened==228){
                    $this->db->query("UPDATE notadinas.surat_masuk SET opened = 2281, updated_at = '$upd_date' WHERE id = '$idu'");
                }
            }
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();//ubah surat masuk mei
            $admin = $this->session->userdata('admin_jabatan');
            $a['dataksi'] = $this->db->query("SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC")->result();
            $a['datajabat'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan_view IS NOT NULL AND urutan_view != 0) ORDER BY urutan_view ASC")->result();//ubah baru lagi
			$a['diteruskan_kepada'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan_view IS NOT NULL AND urutan_view != 0) ORDER BY urutan_view ASC")->result();
            $a['query12'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj ORDER BY id_ruang_kerja ASC")->result();
            $a['page'] = "f_surat_masuk";
            $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
                $b = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_surat LIKE '%$year';")->result();
                $c = 0;
                foreach ($b as $d) {
                    $e = explode('/', $d->no_surat);
                    if ($e[0] > $c) {
                        $c = $e[0];
                    }
                }
                $max = $c + 1;
                if (strlen($max) < 4) {
                    if (strlen($max) < 3) {
                        if (strlen($max) < 2) {
                            $max = "000" . $max;
                        } else {
                            $max = "00" . $max;
                        }
                    } else {
                        $max = "0" . $max;
                    }
                }
                $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
        } else if ($mau_ke == "kadisp") {
			$a['diteruskan_kepada'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0) ORDER BY urutan ASC")->result();
            $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
                $b = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_surat LIKE '%$year';")->result();
                $c = 0;
                foreach ($b as $d) {
                    $e = explode('/', $d->no_surat);
                    if ($e[0] > $c) {
                        $c = $e[0];
                    }
                }
				if(strpos($c,'.')!==false){
					$tmp_arr = explode('.',$c);
					$c = $tmp_arr[1];
				}
                $max = $c + 1;
                if (strlen($max) < 4) {
                    if (strlen($max) < 3) {
                        if (strlen($max) < 2) {
                            $max = "000" . $max;
                        } else {
                            $max = "00" . $max;
                        }
                    } else {
                        $max = "0" . $max;
                    }
                }
                $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
			$_col = "penerima_disposisi";
			if($this->session->userdata('admin_tingkatan')==2){
				$_col = "penerima_disposisi_satuan";
				$this->pushFirebase($this->session->userdata('admin_jabatan'));
			}
            $this->db->query("UPDATE notadinas.disposisi_surat_masuk SET status = 2 WHERE id_surat_masuk = '$idu' and $_col = " . $this->session->userdata('admin_jabatan'));
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();//ubah surat masuk mei
            $admin = $this->session->userdata('admin_jabatan');
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();
            $a['tabaksi'] = $this->db->query("select c.tanggal_proses,d.nama_jabatan,b.keterangan,b.jenis,e.nama_aksi from notadinas.surat_masuk a
            join notadinas.log_proses_surat_masuk c on a.id = c.id_suratmasuk
            join notadinas.disposisi_surat_masuk b on c.id = b.id_log_proses
            join notadinas.master_jabatan d on b.penerima_disposisi = d.id
            join notadinas.master_aksi e on b.aksi = e.id
            where b.status = 1 and a.id = '$idu'")->result();
            $a['dataksi'] = $this->db->query("SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC")->result();
            $a['datasatuan'] = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab, c.nama_jabatan as nam_jab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan INNER JOIN notadinas.master_jabatan as c ON b.id_jabatan = c.id WHERE b.id_jabatan = '". $this->session->userdata('admin_jabatan') ."' AND a.tingkatan = 2 ORDER BY c.urut_jabatan ASC,id_jab ASC ,urut_subjab ASC")->result();
			$a['datajabat'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE urutan IS NOT NULL AND urutan != 0 ORDER BY urutan ASC")->result();//ubah baru lagi
            $a['query12'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj ORDER BY id_ruang_kerja ASC")->result();
            $a['page'] = "f_surat_masuk";
            $a['InfoOrAksi'] = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '$idu' and penerima_disposisi = " . $this->session->userdata('admin_jabatan'))->row();
        } else if ($mau_ke == "subdisp") {
			$a['diteruskan_kepada'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0) ORDER BY urutan ASC")->result();
            $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
                $b = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_surat LIKE '%$year';")->result();
                $c = 0;
                foreach ($b as $d) {
                    $e = explode('/', $d->no_surat);
                    if ($e[0] > $c) {
                        $c = $e[0];
                    }
                }
                $max = $c + 1;
                if (strlen($max) < 4) {
                    if (strlen($max) < 3) {
                        if (strlen($max) < 2) {
                            $max = "000" . $max;
                        } else {
                            $max = "00" . $max;
                        }
                    } else {
                        $max = "0" . $max;
                    }
                }
                $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $this->db->query("UPDATE notadinas.disposisi_surat_masuk SET status = 2 WHERE id_surat_masuk = '$idu' and penerima_disposisi = " . $this->session->userdata('admin_jabatan'));
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();//ubah surat masuk mei
            $admin = $this->session->userdata('admin_jabatan');
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();
            $a['tabaksi'] = $this->db->query("select c.tanggal_proses,d.nama_jabatan,b.keterangan,b.jenis,e.nama_aksi from notadinas.surat_masuk a
            join notadinas.log_proses_surat_masuk c on a.id = c.id_suratmasuk
            join notadinas.disposisi_surat_masuk b on c.id = b.id_log_proses
            join notadinas.master_jabatan d on b.penerima_disposisi = d.id
            join notadinas.master_aksi e on b.aksi = e.id
            where b.status = 1 and a.id = '$idu'")->result();
            $a['dataksi'] = $this->db->query("SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC")->result();
            $a['query12'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj ORDER BY id_ruang_kerja ASC")->result();
            $cekst = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '$idu' AND penerima_disposisi_satuan = '".$this->session->userdata('admin_jabatan')."' AND penerima_disposisi IS NULL")->row();
            if(empty($cekst)){
                $this->db->query("UPDATE notadinas.disposisi_surat_masuk SET disposisi = 'yes' WHERE id_surat_masuk = '$idu' AND penerima_disposisi = " . $this->session->userdata('admin_jabatan'));
                $a['datasatuan'] = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab, c.nama_jabatan as nam_jab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan INNER JOIN notadinas.master_jabatan as c ON b.id_jabatan = c.id WHERE b.id_jabatan = '". $this->session->userdata('admin_jabatan') ."' AND a.tingkatan = 2 ORDER BY c.urut_jabatan ASC,id_jab ASC ,urut_subjab ASC")->result();
            }else{
                $this->db->query("UPDATE notadinas.disposisi_surat_masuk SET disposisi = 'yes' WHERE id_surat_masuk = '$idu' AND penerima_disposisi_satuan = " . $this->session->userdata('admin_jabatan'));
                $dtjb = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan WHERE a.id = '". $this->session->userdata('admin_jabatan') ."' ORDER BY id_jab ASC, urut_subjab ASC")->row();
                $a['datasatuan'] = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan WHERE b.id_jabatan = '".$dtjb->id_jab."' ORDER BY id_jab ASC, urut_subjab ASC")->result();
            }
			
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
			
			$a['datajabat'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE urutan IS NOT NULL AND urutan != 0 ORDER BY urutan ASC")->result();//ubah baru lagi
            $a['page'] = "f_surat_masuk";
            $a['InfoOrAksi'] = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '$idu' and penerima_disposisi_satuan IS NOT NULL")->row();
        } else if ($mau_ke == "act_add") {
			$_tingkatan = $this->db->query('SELECT tingkatan,satuan FROM notadinas.master_jabatan WHERE id = ' . $kepada)->row();
			$_status_surat_masuk = 1;
			$_opened = 1;
			if($_tingkatan->tingkatan==1){
				$_status_surat_masuk = 3;
				$_opened = 3;
			}else if($_tingkatan->tingkatan==2){
				$_status_surat_masuk = 4;
				$_opened = 4;
			}
			$tasktask  = addslashes($this->input->post('tknya'));
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();

                $this->db->query("INSERT INTO notadinas.surat_masuk VALUES (DEFAULT, '$tgl_surat', '$instansi', '$no_surat', '$perihal', '$keterangan', '$kepada', '$no_setum', '$tgl_setum2', '$klasifikasi', '$derajat', '$_status_surat_masuk', '" . $this->session->userdata('admin_id') . "' ,'" . $up_data['file_name'] . "','$_opened','$ruang','$rak','$box','$baris','$jenis','0','0','0')");//ubah surat masuk mei

            } else {
                $this->db->query("INSERT INTO notadinas.surat_masuk VALUES (DEFAULT, '$tgl_surat', '$instansi', '$no_surat', '$perihal', '$keterangan', '$kepada', '$no_setum', '$tgl_setum2', '$klasifikasi', '$derajat', '$_status_surat_masuk', '" . $this->session->userdata('admin_id') . "' , 'Tidak ada Dokumen','$_opened','$ruang','$rak','$box','$baris','$jenis','0','0','0')");//ubah mei bahasa //ubah surat masuk mei
            }
			$baruinputtadi = $this->db->query('SELECT max(id) as greed FROM notadinas.surat_masuk ')->row();
			$maxsm = $baruinputtadi->greed;
			$this->db->query("UPDATE notadinas.surat_masuk SET id_taks = '$tasktask' WHERE id = '$maxsm'");
           
            date_default_timezone_set('Asia/Jakarta');
			$_waktu = date('H:i:s');
            $id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.surat_masuk")->row();
			$this->db->query("UPDATE notadinas.surat_masuk SET updated_at = '$upd_date' WHERE id = '$id->qwe'");
            $this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,$id->qwe,NOW(),'" . $this->session->userdata('admin_id') . "','$kepada','$keterangan','1','" . $this->session->userdata('admin_id') . "','$_waktu')");
            $_tmp_log_id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_masuk")->row();
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan. " . $this->upload->display_errors() . "</div>");
			$txt_jabatan_firebase = "";
			if($_tingkatan->tingkatan==1 or $_tingkatan->tingkatan==2){
				$this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,$id->qwe,NOW(),'" . $this->session->userdata('admin_id') . "','1','$keterangan','2','" . $this->session->userdata('admin_id') . "','$_waktu')");
				$this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,$id->qwe,NOW(),'" . $this->session->userdata('admin_id') . "','28','$keterangan','2','" . $this->session->userdata('admin_id') . "','$_waktu')");
				$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT,'1','$_tmp_log_id->qwe','INFORMASI','1','0','$keterangan',$id->qwe)");
				$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT,'28','$_tmp_log_id->qwe','AKSI','1','0','$keterangan',$id->qwe)");
				$this->db->query("INSERT INTO notadinas.aksi_disposisi_surat_masuk VALUES(DEFAULT,$id->qwe,2,'KOORDINASIKAN')");
				$txt_jabatan_firebase .= "28,1,";
			}
			if($_tingkatan->tingkatan==1){
				$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT,'$kepada','$_tmp_log_id->qwe','AKSI','1','0','$keterangan',$id->qwe)");
				$txt_jabatan_firebase .= "$kepada,";
			}else if($_tingkatan->tingkatan==2){
				$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT,NULL,'$_tmp_log_id->qwe','AKSI','2','0','$keterangan',$id->qwe,NULL,'$kepada')");
				$txt_jabatan_firebase .= "$kepada,";
				$qKadis = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = $_tingkatan->satuan AND tingkatan = 1")->result();
				foreach($qKadis as $qK){
					$this->db->query("INSERT INTO notadinas.disposisi_surat_masuk VALUES (DEFAULT,'$qK->id','$_tmp_log_id->qwe','INFORMASI','1','0','$keterangan',$id->qwe)");
					$txt_jabatan_firebase .= "$qK->id,";
				}
			}
			if($_tingkatan->tingkatan==1 or $_tingkatan->tingkatan==2){
				$this->pushFirebase($txt_jabatan_firebase);
			}
            redirect('index.php/admin/surat_masuk');
        } else if ($mau_ke == "act_edt") {
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();

                $this->db->query("UPDATE notadinas.surat_masuk SET tgl_surat = '$tgl_surat', instansi = '$instansi', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$keterangan', kepada = '$kepada', no_setum = '$no_setum', tgl_setum = '$tgl_setum2', klasifikasi = '$klasifikasi', id_ruang = '$ruang', id_rak = '$rak', id_box = '$box', baris = '$baris', 'id_jenis_surat_masuk' = '$jenis', 'id_workspace' = '$workspace', 'id_task' = '$tasktask', updated_at = '$upd_date' WHERE id = '$idp'");
            } else {
                $this->db->query("UPDATE notadinas.surat_masuk SET tgl_surat = '$tgl_surat', instansi = '$instansi', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$keterangan', kepada = '$kepada', no_setum = '$no_setum', tgl_setum = '$tgl_setum2', klasifikasi = '$klasifikasi', id_ruang = '$ruang', id_rak = '$rak', id_box = '$box', baris = '$baris','id_jenis_surat_masuk' = '$jenis', updated_at = '$upd_date' WHERE id = '$idp'");
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. " . $this->upload->display_errors() . "</div>");
            redirect('index.php/admin/surat_masuk');
        }else if($mau_ke == "test_jabatan"){
			$j = 1;
			$z = "";
            $data = array();
            $data = $this->input->post('isi');
            $jabatan = $this->db->query('SELECT * FROM notadinas.master_jabatan  ORDER BY urut_jabatan ASC')->result_array();
            foreach ($jabatan as $val) {

                if (isset($data['action' . $j])) {
					$z .= $data['jbtn' . $j]." ~ ";
                }

                $j++;
            }
			echo $z;
			if(strpos($z, '28')!==false){
				echo "Qos";
			}
			die();
		} else if ($mau_ke == "disp_proses") {//ubah disposisi mei
            // var_dump("Ini");
            $data = array();
            $data = $this->input->post('isi');
            $ind = $data['no'];
            // $works = $data['wrks'];
            $tasks = $data['tska'];
            $lihat = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $ind")->row();
            $idn = $lihat->id;
            // foreach ($lihat as $key) {
            //     echo $key->id."<br>";
            // }
            $admin = $this->session->userdata('admin_id');
            $jabatan = $this->db->query('SELECT * FROM notadinas.master_jabatan WHERE id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0) ORDER BY urutan ASC')->result();
            $aksi = $this->db->query('SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC')->result_array();
            $kets = $data['ket'];

            echo "data";

            //tambah disposisi mei
            date_default_timezone_set('Asia/Jakarta');
            $date_wrk_u = date('Y-m-d h:i:s');
            $userLoginu = $this->session->userdata('admin_user');
                    // var_dump($jids);
            $usefficeu = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLoginu'")->row();
            $id_usefu = $usefficeu->object_id;
            $permission_kp = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '$id_usefu'")->row();
            $per_kp = $permission_kp->id;
            $setum = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = 'setum'")->row();
            $idsetum = $setum->object_id;
            // $nama_krj = $object->nama_krj;
            $member_setum = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$idsetum'")->row();
            $member_setid = $member_setum->id;
            $idap = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                    $idaps = $idap->qwi + 1;
            $objec = $this->db->query("SELECT * FROM notadinas.master_task WHERE id_task = '$tasks'")->row();
                $object_id_t = $objec->object_id;
                $nama_task = $objec->nama_task;
            // $idapl = $idaps + 1;
            // var_dump($object_id_t);
            echo "office";
            $e = 1;
			$kapush_kadis_done = "";
            foreach ($aksi as $ke) {
                if (isset($data['aksi' . $e])) {

                    $id_ak = $data['aksi' . $e];
                    $nm_ak = $data['nam_aksi' . $e];
                    $this->db->query("INSERT INTO notadinas.aksi_disposisi_surat_masuk (id_disposisi_surat_masuk,id_aksi,aksi) VALUES ($ind,$id_ak,'$nm_ak')");
                    // echo $id_ak.', '.$nm_ak;
					$kapush_kadis_done .= $data['nam_aksi' . $e] . " ~ ";
                }

                $e++;
            }
			if(strpos($kapush_kadis_done, 'AKSI')===false){
				$this->db->query("INSERT INTO notadinas.surat_masuk_waka VALUES (DEFAULT,$ind,'Sudah Feedbak = Selesai')");
				// $this->db->query("INSERT INTO notadinas.surat_masuk_waka VALUES (DEFAULT,$ind,'Sudah Feedbak = Selesai')");
			}

            $j = 1;
                    //popos
                    $this->db->query("DELETE FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $ind and status = 1");
            date_default_timezone_set('Asia/Jakarta');
			$_waktu = date('H:i:s');
			$kapush_waka_done = "";
            foreach ($jabatan as $val) {

                if (isset($data['action' . $val->id])) {
                    $action = $data['action' . $val->id];
                    $jab = $data['jbtn' . $val->id];
					$_xCol = "penerima_disposisi";
					$checkTingkatan = $this->db->query("SELECT tingkatan FROM notadinas.master_jabatan WHERE id = $val->id")->row()->tingkatan;
					if($checkTingkatan==2){
						$_xCol = "penerima_disposisi_satuan";
					}
                    //n $this->db->query("INSERT INTO notadinas.disposisi_surat_masuk ($_xCol,id_log_proses,jenis,status,aksi,keterangan,id_surat_masuk,disposisi) VALUES ($jab,$idn,'$action',1,0,'$kets',$ind,'');");
                    $this->db->query("INSERT INTO notadinas.disposisi_surat_masuk ($_xCol,id_log_proses,jenis,status,aksi,keterangan,id_surat_masuk,disposisi) VALUES ($jab,$idn,'$action',1,0,'$kets',$ind,'');");
					$kapush_waka_done .= $data['jbtn' . $val->id]." ~ ";
                    $this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,'$ind',NOW(),'$admin',$jab,'','2','" . $this->session->userdata('admin_id') . "','$_waktu')");
                }

                $j++;
            }
			if(strpos($kapush_waka_done, '28')!==false){
				$this->db->query("INSERT INTO notadinas.surat_masuk_waka VALUES (DEFAULT,$ind,'Belum Feedback')");
			}

            $mail_1 = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $ind AND status = 1")->result();
            $mail_result = "WHERE ";
            $count = 1;
            $jabatan_push_notif = "";
            foreach ($mail_1 as $a) {
				$_penerimaDisposisi = $a->penerima_disposisi;
				if($a->penerima_disposisi==null and $a->penerima_disposisi_satuan!=null){
					$_penerimaDisposisi = $a->penerima_disposisi_satuan;					
				}
                if ($count != count($mail_1)) {
                    $or = "or ";
                    $jabatan_push_notif .= $_penerimaDisposisi . ",";
                } else {
                    $or = "";
                    $jabatan_push_notif .= $_penerimaDisposisi;
                }
                $mail_result .= "notadinas.master_user.jabatan = " . $_penerimaDisposisi . " " . $or;
                $count = $count + 1;
            }
            $this->push_notification("Surat Masuk",$jabatan_push_notif);

            $cc = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '" . $ind . "'")->row();
			if($mail_result == "WHERE "){
				$mail_result = "";
			}
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user $mail_result")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }
            $this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 3, opened = 3, id_workspace = 0, id_taks = '$tasks', updated_at = '$upd_date' WHERE id = '$ind'");//ubah surat masuk mei
            echo "surat_masuk";
            /* 
			$this->eoffice->query("DELETE FROM fo_object_members WHERE object_id = '$object_id_t' AND member_id = '$member_setid'");
            $this->eoffice->query("DELETE FROM fo_object_subscriptions WHERE object_id = '$object_id_t' AND contact_id = '$idsetum'");
            $o = 0;
            $tmp_id = "";
            foreach ($jabatan as $val) {
							$o = $val->id;
                            if (isset($data['action' . $o])) {
                                $jab = $data['jbtn' . $o];
                                $user = $this->db->query("SELECT * FROM notadinas.master_user WHERE jabatan = '$jab'")->result();
                                    foreach($user as $us_id){
                                            $usname = $us_id->username;
                                        $office_user = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$usname'")->row();
                                        $per_group = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '".$office_user->object_id."'")->row();
                                        $memberpj = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '".$office_user->object_id."'")->row();
                                        if($data['action' . $o] == 'AKSI'){
                                            $this->eoffice->query("UPDATE fo_project_tasks SET due_date = '".$cc->tgl_setum."', start_date = '".$cc->tgl_surat."', assigned_to_contact_id = '".$office_user->object_id."', assigned_on = '".$date_wrk_u."' WHERE object_id = '".$object_id_t."'");//ubah disposisi mei
                                        }
                                        $this->eoffice->query("INSERT INTO fo_object_members (object_id, member_id, is_optimization) VALUES ('".$object_id_t."', '".$memberpj->id."', '0')");
                                        $this->eoffice->query("INSERT INTO fo_object_subscriptions (object_id, contact_id) VALUES ('".$object_id_t."', '".$office_user->object_id."')");
                                        if ($tmp_id) $tmp_id .= ',';
                                        $tmp_id .= $per_group->id;
                                    }
                            }

                            // $o++;
                        }
            $tmp_id .= ','.$per_kp;
            // var_dump($tmp_id);
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idaps."', '".$id_usefu."', '".$object_id_t."', '".$nama_task."', '".$date_wrk_u."', '".$id_usefu."', 'edit', '0', '0', '', '".$tmp_id."')");//ubah disposisi mei
            echo "update_office"; 
			// */

			$this->pushFirebase($jabatan_push_notif);

            // $cc = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '" . $ind . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Masuk
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            foreach($idJabatanForSocket as $id_jabatan){
                $socketData[] = [
                    'ka_waka_setum'       => 'unchecked',
                    'tgl_surat'           => date('Y-m-d'),
                    'tablenya'            => 'masuk',
                    'status'              => 1,
                    'opened'              => $cc->opened,
                    'kepada'              => $cc->kepada,
                    'id_jabatan'          => $id_jabatan,
                    'perihal'             => $cc->perihal,
                    'status_surat_keluar' => $cc->status_surat_masuk,
                    'idnya'               => $cc->id,
                    'create_by'           => $cc->create_by
                ];
            }

            $_SESSION['socketAdded'] = $socketData;
            echo "socketIO";
            // redirect('index.php/admin/surat_masuk');
            // var_dump("Sukses");
            die();

        } else if ($mau_ke == "kadisp_proses") {
            $data = array();
            $data = $this->input->post('isi');
            $no = $data['no'];
            $jabatan = $this->db->query('SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 2')->result_array();
            $aksi = $this->db->query('SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC')->result_array();
            $lihat = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $no")->row();
            $idn = $lihat->id;
            $admin = $this->session->userdata('admin_id');
            $ket = $data['ket'];
			
			$this->db->query("INSERT INTO notadinas.surat_masuk_waka VALUES (DEFAULT,$no,'Sudah Feedbak = Selesai')");

            $e = 1;
            foreach ($aksi as $ke) {
                if (isset($data['aksi' . $e])) {

                    $id_ak = $data['aksi' . $e];
                    $nm_ak = $data['nam_aksi' . $e];

                    $this->db->query("INSERT INTO notadinas.aksi_disposisi_surat_masuk_satuan (id_surat_masuk,id_aksi,aksi) VALUES ($no,$id_ak,'$nm_ak')");
                }

                $e++;
            }


            $i = 1;
            $array_jabatan_push_notif = [];
            //popos
            $get_sub_ = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = " . $this->session->userdata('admin_satuan') . "and tingkatan = 2 and subdis IS NOT NULL")->result();
            foreach($get_sub_ as $gs){
                $this->db->query("DELETE FROM notadinas.disposisi_surat_masuk WHERE penerima_disposisi_satuan = " . $gs->subdis);
            }
            date_default_timezone_set('Asia/Jakarta');
			$_waktu = date('H:i:s');
            foreach ($jabatan as $val) {

                if (isset($data['satuan' . $i])) {
                    $action = $data['satuan' . $i];
                    $jab = $data['id_satuan' . $i];
                    $array_jabatan_push_notif[] = $jab;

                    $this->db->query("INSERT INTO notadinas.disposisi_surat_masuk (penerima_disposisi_satuan,id_log_proses,jenis,status,aksi,keterangan,id_surat_masuk,disposisi) VALUES ($jab,$idn,'$action',1,0,'$ket',$no,'');");

                    $this->db->query("INSERT INTO notadinas.log_proses_surat_masuk VALUES (DEFAULT,'$no',NOW(),'$admin',$jab,'','2','" . $this->session->userdata('admin_id') . "','$_waktu')");
                }

                $i++;
            }
            $jabatan_push_notif = "";
            for($cajpn=0; $cajpn<count($array_jabatan_push_notif); $cajpn++){
                if($cajpn == count($array_jabatan_push_notif)){
                    $koma = "";
                }else{
                    $koma = ",";
                }
                $jabs = $this->db->query("SELECT id FROM notadinas.master_jabatan WHERE id = " . $array_jabatan_push_notif[$cajpn])->row();
                $jabatan_push_notif .= $jabs->id . $koma;
            }
            $this->push_notification("Surat Masuk",$jabatan_push_notif);

            //end fore

            $this->db->query("UPDATE notadinas.disposisi_surat_masuk SET disposisi = 'yes' WHERE id_surat_masuk = $no AND penerima_disposisi = " . $this->session->userdata('admin_jabatan'));

            $data = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE penerima_disposisi IS NOT NULL and id_surat_masuk = $no");
            $co8nt = $data->num_rows();
            $count = 0;
            foreach($data->result() as $a){
                if(($a->disposisi=='yes' and $a->jenis=='AKSI') or ($a->jenis=='INFORMASI')){
                    $count = $count + 1;
                }
            }
            if($co8nt==$count){
                $this->db->query("UPDATE notadinas.surat_masuk SET status_surat_masuk = 4, opened = 4, updated_at = '$upd_date' WHERE id = '$no'");
            }
			$this->pushFirebase($jabatan_push_notif);
            //belum kekirim email

            $cc = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '" . $no . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Masuk
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            foreach($idJabatanForSocket as $id_jabatan){
                $socketData[] = [
                    'ka_waka_setum'       => 'unchecked',
                    'tgl_surat'           => date('Y-m-d'),
                    'tablenya'            => 'masuk',
                    'status'              => 1,
                    'opened'              => $cc->opened,
                    'kepada'              => $cc->kepada,
                    'id_jabatan'          => $id_jabatan,
                    'perihal'             => $cc->perihal,
                    'status_surat_keluar' => $cc->status_surat_masuk,
                    'idnya'               => $cc->id,
                    'create_by'           => $cc->create_by
                ];
            }

            $_SESSION['socketAdded'] = $socketData;

            die();
        } else {			
			$sqlZd = "SELECT notadinas.surat_masuk.*, notadinas.master_tujuan.nama AS instansi, notadinas.surat_masuk.id AS id, notadinas.disposisi_surat_masuk.penerima_disposisi_satuan AS penerima_disposisi_satuan FROM notadinas.surat_masuk INNER JOIN notadinas.master_tujuan ON notadinas.surat_masuk.instansi = notadinas.master_tujuan.id LEFT JOIN notadinas.disposisi_surat_masuk ON notadinas.surat_masuk.id = notadinas.disposisi_surat_masuk.id_surat_masuk WHERE EXTRACT(YEAR FROM tgl_surat) = '2018' AND (status_surat_masuk = '4' OR penerima_disposisi_satuan = ".$this->session->userdata('admin_jabatan').") AND penerima_disposisi_satuan IS NOT NULL ORDER BY notadinas.surat_masuk.id DESC";
			
			$sqlZ = "SELECT ";
			if($this->session->userdata('admin_satuan')==6){
				$sqlZ .= "*
					FROM notadinas.surat_masuk
				";
			}else{
				$coL = "penerima_disposisi";
				if($this->session->userdata('admin_tingkatan')==2){
					$coL = "penerima_disposisi_satuan";					
				}
				$_tmp_query = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE $coL = " . $this->session->userdata('admin_jabatan'))->result();
				$_wherein = "(";
				$_count = 1;
				foreach($_tmp_query as $tmpq){
					if(count($_tmp_query)!=$_count){$_comma=",";}else{$_comma="";}
					$_wherein .= "$tmpq->id_surat_masuk$_comma";
					$_count++;
				}
				$_wherein .= ")";
				if($_wherein=="()"){
					$_wherein = "";
				}else{
					$_wherein = "OR notadinas.surat_masuk.id IN $_wherein";
				}
				$sqlZ .= "*
					FROM notadinas.surat_masuk
					WHERE kepada = " .$this->session->userdata('admin_jabatan');
				if($this->session->userdata('admin_jabatan')==1){
					$sqlZ .= " or kepada = 28";
				}
				$sqlZ .= " $_wherein";
			}
			$sqlZ .= " ORDER BY notadinas.surat_masuk.id DESC";
			// $this->dd($sqlZ);
			$a['data'] = $this->db->query($sqlZ)->result();
            $a['jenis_surat'] = $this->db->query('SELECT * FROM notadinas.master_surat_masuk')->result();
            $a['page'] = "l_surat_masuk";
            // $a['page'] = "l_surat_masuk - Copy";
        }

        $this->load->view('admin/aaa', $a);
    }

    public function surat_keluar()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $ta = $this->session->userdata('admin_ta');
        // print_r($this->session->all_userdata());
        // die();

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta'")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, base_url() . "admin/surat_keluar/p");

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan //i think these variable will not use again anymore
        $idp = addslashes($this->input->post('idp'));
        $no_agenda = addslashes($this->input->post('no_agenda'));
        $kode = addslashes($this->input->post('kode'));
        $uraian = addslashes($this->input->post('uraian'));

        //new variable
        $dari = addslashes($this->input->post('dari'));

        $tglsurat = addslashes($this->input->post('tgl_surat'));
        $tgl_surat = date("Y-m-d", strtotime($tglsurat));

        $no_surat = addslashes($this->input->post('no_surat'));
        $perihal = addslashes($this->input->post('perihal'));
        $isi_surat = addslashes($this->input->post('isi_surat'));
        $lampiran = addslashes($this->input->post('lampiran'));
        $ket = addslashes($this->input->post('ket'));
		$perihal = str_replace('\"', '"', $perihal);
		$ket = str_replace('\"', '"', $ket);

        $cari = addslashes($this->input->post('q'));
        date_default_timezone_set('Asia/Jakarta');
        $upd_date = date("Y-m-d H:i:s");

        //upload config
        $config['upload_path'] = './upload/surat_keluar';
        $config['allowed_types'] = '*';
        $config['file_name'] = $this->input->post('no_lampiran');
		if($mau_ke == "verifikasi_submit_setum"){
			$config['file_name'] = "rev_sk_" . $this->input->post("ids");
		}
        // $config['max_size']          = '2000';
        // $config['max_width']         = '3000';
        // $config['max_height']        = '3000';

        $this->load->library('upload', $config);

        if ($mau_ke == "update_new_message") {
			$ids = $idp;
            $jabatan = $this->input->post('jabatan');
            $jenis_surat = $this->input->post('jenis_surat');
            if($jenis_surat==15){
                $year = "/" . date('Y');
            }else{
                $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            }
            $no_ag = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE jenis_surat = '".$jenis_surat."' AND no_agenda LIKE '%".$year."%'")->result();
            // $no_ags = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE jenis_surat = '".$jenis_surat."'")->result();
            $get_format = $this->db->query("SELECT * FROM notadinas.master_surat_keluar WHERE id_master_surat_keluar = '".$jenis_surat."'")->row();
            $f = [];
            if(empty($no_ag)){
                $no_urut = "0001";
                if($jenis_surat==15){
                    $no_agen = "".$get_format->format_surat_keluar."".$no_urut."".$year;
                }else{
                    $no_agen = "".$get_format->format_surat_keluar."".$no_urut."".$year;
                }
            }else{
                $m = explode('/', $get_format->format_surat_keluar);
                if(count($m) == 3){
                    foreach ($no_ag as $d) {
                        $e = explode('/', $d->no_agenda);
                        array_push($f, $e[2]);
                    }
                }else{
                    foreach ($no_ag as $d) {
                        $e = explode('/', $d->no_agenda);
                        array_push($f, $e[1]);
                    }
                }
                $dt = max($f);
                $k = floatval($dt) + 1;
                $no_urut = str_pad($k, 4, "0", STR_PAD_LEFT);
                $no_agen = "".$get_format->format_surat_keluar."".$no_urut."".$year;
            }
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');
            $isi_surat = stripslashes($isi_surat);
			// echo $isi_surat;
			// die();
            // die();/*
			$this->db->query("DELETE FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = $ids");
			$count = 0;
			if (!empty($jabatan)) {
				for ($ab = 1; $ab <= count($jabatan); $ab++) {
					$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
					$jids = $jid->qwe + 1;
					$this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('" . $jids . "','" . $jabatan[$count] . "','0','" . $keterangan_tembusan[$count] . "','" . $ids . "')");
					$count = $count + 1;
				}
			} else {
			}
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();
				$fileznya = $up_data['file_name'];
				$mast = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = $ids")->row();
				$this->db->query("UPDATE notadinas.surat_keluar SET file_attachment = '" . $fileznya . "', updated_at = '$upd_date' WHERE id = $ids");
            }
			$this->db->query("UPDATE notadinas.surat_keluar SET tgl_surat = '$tgl_surat', no_surat = '$no_surat', perihal = '$perihal', keterangan = '$ket', isi = '$isi_surat', create_by = '" . $this->session->userdata('admin_id') . "', kepada = '$dari', klasifikasi = '" . $this->input->post('klasifikasi') . "', derajat = '" . $this->input->post('derajat') . "', dari = '" . $this->session->userdata('admin_id') . "', signature = '', jenis_surat = '" . $jenis_surat . "', no_agenda = '".$no_agen."', updated_at = '$upd_date' WHERE id = $ids");

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");

            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idp . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'keluar',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => $id_jabatan,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;

            redirect('admin/surat_keluar');//*/
        }else if ($mau_ke == "edit_new_message") {
			$a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.log_proses_surat_keluar.pengirim WHERE log_proses_surat_keluar.id_suratkeluar = $idu ORDER BY notadinas.log_proses_surat_keluar.id ASC")->result();
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = $idu ORDER BY id DESC")->row();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1  ORDER BY urut_jabatan ASC")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan, notadinas.tembusan_surat_keluar.id_jabatan AS idnya_jabatan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$idu'")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
			$a['datpil100'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = '$idu' order by id desc")->row();
            $a['page'] = "e_surat_keluar";
			if($a['datpil']->status_surat_keluar==8 and $a['datpil']->opened==88 and $a['datpil']->create_by==$this->session->userdata('admin_id')){
				$this->db->query("UPDATE notadinas.surat_keluar SET opened = 89, updated_at = '$upd_date' WHERE id = '$idu'");
			}
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
        }else if ($mau_ke == "delete_new_message") {
			$this->db->query("DELETE FROM notadinas.feedback_surat_keluar WHERE id_surat_keluar = $idu");
            $this->db->query("DELETE FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = $idu");
            $this->db->query("DELETE FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = $idu");
            $this->db->query("DELETE FROM notadinas.surat_keluar WHERE id = $idu");
			redirect(base_url() . 'admin/surat_keluar');
			die();
        }else if ($mau_ke == "kirim_ke_kapushidrosal") {
            $this->db->query("UPDATE notadinas.surat_keluar SET no_surat = '" . $this->input->post('no_surat') . "', status_surat_keluar = 7, opened = 7, updated_at = '$upd_date'  WHERE id = $idu");
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE jabatan = 1")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','3','')");
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'keluar',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => null,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
            redirect(base_url() . 'admin/surat_keluar');
            //popo
        } else if ($mau_ke == "tambah_tujuan") {
            $cek_nama = $this->db->query("SELECT nama FROM notadinas.master_tujuan WHERE nama = '$_GET[q]'")->num_rows();

            if ($cek_nama > 0) {//ubah mei surmas1
                // $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">tujuan nama sudah ada.</div>");
                // $_SESSION['ka'] = "Nama Tujuan Sudah Ada.";
            }else{//ubah mei surmas1
                $this->db->query("INSERT INTO notadinas.master_tujuan (nama) VALUES('$_GET[q]');");
                $a = $this->db->query("SELECT * FROM notadinas.master_tujuan ORDER BY id DESC")->result();
                $c = "";
                foreach ($a as $b) {
                    $c .= "<option value='$b->id'>$b->nama</option>";
                }
                echo $c;
                die();
            }
        } else if ($mau_ke == "cetak_surat_keluar") {
            $a['datpil'] = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_tujuan.nama AS nama_tujuan FROM notadinas.surat_keluar JOIN notadinas.master_tujuan ON notadinas.master_tujuan.id = notadinas.surat_keluar.kepada WHERE notadinas.surat_keluar.id = '$idu'")->row();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['page'] = 'cetak_surat_keluar';
            // var_dump($a['user_n']);
            // die();
        } else if ($mau_ke == "cetak_log_surat_keluar") {
            $a['datpil'] = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_tujuan.nama AS nama_tujuan FROM notadinas.surat_keluar JOIN notadinas.master_tujuan ON notadinas.master_tujuan.id = notadinas.surat_keluar.kepada WHERE notadinas.surat_keluar.id = '$idu'")->row();
            $a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id WHERE log_proses_surat_keluar.id_suratkeluar = $idu ORDER BY notadinas.log_proses_surat_keluar.id ASC")->result();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['page'] = 'cetak_log_surat_keluar';
            // var_dump($a['user_n']);
            // die();
        } else if ($mau_ke == "verifikasi_submit_setum_setuju") {
            $kirim_kpd = $_POST['isi'];
            $komen = $_POST['keterangan'];
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','5','" .  $komen . "')");
            $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 2, opened = 2, status_tujuan = 0, kirim_ke = '".$kirim_kpd."', updated_at = '$upd_date' WHERE id = $idu");

            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'keluar',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => null,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;
			$this->pushFirebase('1,28');
            echo "Sukses";
            die();
            // redirect(base_url() . 'admin/surat_keluar');
        } else if ($mau_ke == "verifikasi_submit_setum") {
            $idu = $this->input->post("ids");

            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            if ($this->upload->do_upload('file_revisi')) {
                $up_data = $this->upload->data();               
                $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','" . $this->input->post('komentar_setum') . "','" . $up_data['file_name'] . "')");

            } else {
                $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','" . $this->input->post('komentar') . "')");
            }
            $this->db->query("UPDATE notadinas.tembusan_surat_keluar SET status = 0 WHERE id_surat_keluar = $idu");
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }
            $this->db->query("UPDATE notadinas.surat_keluar SET no_surat = '". $this->input->post('no_surat_form5') ."' ,  status_surat_keluar = 3, opened = 3, updated_at = '$upd_date' WHERE id = $idu");

            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'keluar',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => null,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;
			$createBy = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->row();
			$this->pushFirebase($createBy->jabatan);
            redirect(base_url() . 'admin/surat_keluar');
        } else if ($mau_ke == "verifikasi_submit_kapushidrosal_setuju") {
          //
          // $config['upload_path'] = './upload/surat_keluar';
          // $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
          // $config['file_name'] = $this->input->post('no_lampiran');
            
            /***********************************************
             ** Feature Signature
             ** By: Muhamad Farhan Badrussalam
             ***********************************************/ 
                             

            //Putri
            $status_ttd = $this->input->post('status_ttd');
            if($status_ttd == "1"){
                $config['upload_path']          = './upload/ttd/';
                $config['file_name']           =  "suratkeluar_".$idu.".png";
                $config['overwrite']        = TRUE;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file_ambil')) {
                    $up_data = $this->upload->data();
                }
                
            }else{
                $upload_dir = "upload/ttd/";
                $img = $this->input->post('hidden_data');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = $upload_dir ."suratkeluar_".$idu.".png";
                $success = file_put_contents($file, $data);
                print $success ? $file : 'Unable to save the file.';
            }
            
            if(file_exists("./upload/file_sementara.png")){
                unlink('./upload/file_sementara.png');
            }
            //ZAME

            // var_dump($download_img);


            // $idu = $this->input->post("id");
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "',NOW(),'" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','" . $this->input->post('komentar_kapushidrosal') . "')");
            $this->db->query("UPDATE notadinas.surat_keluar SET signature='" . $this->input->post('signature') . "', status_surat_keluar = 4, opened = 4, status_tujuan = 0, updated_at = '$upd_date' WHERE id = $idu");
            $this->db->query("UPDATE notadinas.tembusan_surat_keluar SET status = 0 WHERE id = $idu");
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }

            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'keluar',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => null,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;
            
			$data = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = 6 and tingkatan = 1")->result();
			$az = "";
			foreach($data as $a){
				$az .= "$a->id,";
			}
			$this->pushFirebase($az);
                redirect(base_url() . 'admin/surat_keluar');
        } else if ($mau_ke == "verifikasi_submit_kapushidrosal") {
            // die($cc->kepada);


            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','" . $this->input->post('komentar_kapushidrosal') . "')");
            $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 3, opened = 3, updated_at = '$upd_date' WHERE id = $idu");
            $this->db->query("UPDATE notadinas.tembusan_surat_keluar SET status = 0 WHERE id_surat_keluar = $idu");
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }

            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'keluar',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => null,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

			$createBy = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->row();
			$this->pushFirebase($createBy->jabatan);
            $_SESSION['socketNotif'] = $socketData;
            redirect(base_url() . 'admin/surat_keluar');
        } else if ($mau_ke == "verifikasi_submit") {
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $keterangan = $this->input->post('keterangan_tembusan');
            $count = 0;
            $a = "";
            $b = "";
            $c = "";
            $this->db->query("DELETE FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = $idu");
            for ($ab = 1; $ab <= count($jabatan); $ab++) {
                $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
                $jids = $jid->qwe + 1;
                if ($status[$count] == 2) {
                    $date = date('Y-m-d');
                    $this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('" . $jids . "','" . $jabatan[$count] . "','" . $status[$count] . "','" . $keterangan[$count] . "','" . $idu . "','" . $date . "')");
                    $ka_waka_setum = 'checked';
                } else {
                    $this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('" . $jids . "','" . $jabatan[$count] . "','" . $status[$count] . "','" . $keterangan[$count] . "','" . $idu . "')");
                    $ka_waka_setum = 'unchecked';
                }
                $idJabatanForSocket[] = $jabatan[$count];
                $count = $count + 1;
            }
            $check_tembusan_surat_keluar = $this->db->query("SELECT * FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = $idu")->result();
            foreach ($check_tembusan_surat_keluar as $ctsk) {
                if ($ctsk->status == 2) {
                    $a .= "2";
                } else if ($ctsk->status == 1) {
                    $a .= "1";
                } else {
                    $a .= "0";
                }
                $c .= "0";
                $b .= "2";
            }
            $d = str_split($a);
            foreach ($d as $dd) {
                if ($dd == 0) {
                    $a = $c;
                    break;
                }
            }
            // echo $a . "|" . $b . "|" . $c;
            // die();
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            if ($a == $c) {

            } else if ($a == $b) {
                $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 5,opened = 5, updated_at = '$upd_date' WHERE id = $idu");
                $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','4','')");
                $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_jabatan.satuan = 6")->result();
                foreach ($mail_2 as $b) {
                    $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
				$setum = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = 6 and tingkatan = 1")->result();
				$stm_ = "";
				foreach($setum as $stm){
					$stm_ = "$stm->id,";
				}
				$this->pushFirebase($stm_);
            } else {
                $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 8, opened = 88, updated_at = '$upd_date' WHERE id = $idu");
                $this->db->query("UPDATE notadinas.tembusan_surat_keluar SET status = 0, tanggal = NULL WHERE id_surat_keluar = $idu");
                $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','')");
				$userZ = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->row();
				$this->pushFirebase($userZ->jabatan);
            }

            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            /******************************************************
             *  Create Session for Socket Surat Keluar
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            foreach($idJabatanForSocket as $id_jabatan){
                $socketData[] = [
                    'ka_waka_setum'       => $ka_waka_setum,
                    'tgl_surat'           => date('Y-m-d'),
                    'tablenya'            => 'keluar',
                    'status'              => 1,
                    'opened'              => $cc->opened,
                    'kepada'              => $cc->kepada,
                    'id_jabatan'          => $id_jabatan,
                    'perihal'             => $cc->perihal,
                    'status_surat_keluar' => $cc->status_surat_keluar,
                    'idnya'               => $cc->id,
                    'create_by'           => $cc->create_by
                ];
            }

            $_SESSION['socketAdded'] = $socketData;

            redirect(base_url() . 'admin/surat_keluar');
        } else if ($mau_ke == "verifikasi_surat_keluar") {
			$this->db->query("UPDATE notadinas.tembusan_surat_keluar SET tanggal = '".date('Y-m-d')."' WHERE id_surat_keluar = $idu and id_jabatan = " . $this->session->userdata('admin_jabatan'));
            if ($this->session->userdata('admin_satuan') == 6) {
                $year = "/" . $this->session->userdata('admin_id') . "/" . date('Y');
                //ye
                $b = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE no_surat LIKE '%$year';")->result();
                $checkstat = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = $idu and status_surat_keluar = 5;")->row();
                $checkstat2 = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = $idu and status_surat_keluar = 4;")->row();

                if ($checkstat != NULL) {
                    $this->db->query("UPDATE notadinas.surat_keluar SET updated_at = '$upd_date', status_tujuan = 1 WHERE id = $idu");
                }elseif ($checkstat2 != NULL) {
                    $this->db->query("UPDATE notadinas.surat_keluar SET updated_at = '$upd_date', status_tujuan = 1 WHERE id = $idu");
                }

                $c = 0;
                foreach ($b as $d) {
                    $e = explode('/', $d->no_surat);
                    if ($e[0] > $c) {
                        $c = $e[0];
                    }
                }
                $max = $c + 1;
                if (strlen($max) < 4) {
                    if (strlen($max) < 3) {
                        if (strlen($max) < 2) {
                            $max = "000" . $max;
                        } else {
                            $max = "00" . $max;
                        }
                    } else {
                        $max = "0" . $max;
                    }
                }
                $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            }elseif ($this->session->userdata('admin_jabatan') == 1) {
                $checkstat = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = $idu and status_surat_keluar = 2;")->row();
                if ($checkstat != NULL) {
                   $this->db->query("UPDATE notadinas.surat_keluar SET updated_at = '$upd_date', status_tujuan = 1 WHERE id = $idu");
               }
            }//elseif(){
                //wowowo
            //}

            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan ORDER BY nama ASC")->result();
            $a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id INNER JOIN notadinas.master_user ON notadinas.log_proses_surat_keluar.pengirim = notadinas.master_user.id INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE log_proses_surat_keluar.id_suratkeluar = $idu ORDER BY notadinas.log_proses_surat_keluar.id ASC")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1 ORDER BY urut_jabatan ASC")->result();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan, notadinas.master_jabatan.id AS idnya_jabatan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$idu'")->result();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            // $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();
            $a['datpil'] = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_tujuan.nama FROM notadinas.surat_keluar JOIN notadinas.master_tujuan ON notadinas.surat_keluar.kepada = notadinas.master_tujuan.id WHERE notadinas.surat_keluar.id = '$idu'")->row();
			$a['datpil100'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = '$idu' order by id desc")->row();
            $a['page'] = "f_surat_keluar";
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
        } else if ($mau_ke == "kirim_kelain") {
            $data_tembusan = $this->db->query("SELECT id, id_jabatan from notadinas.tembusan_surat_keluar WHERE id_surat_keluar = '" . $idu . "';")->result();
			$jabatan_push_notif = "";
			foreach($data_tembusan as $d_t){
				$jabatan_push_notif .= "$d_t->id_jabatan,";
			}
            $create_by =  $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "';")->result_array();

            if (!empty($data_tembusan)) {
                $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 1, opened = 1, updated_at = '$upd_date' WHERE id = '" . $idu . "';");
                $mail_1 = $this->db->query("SELECT * FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = $idu")->result();
                $mail_result = "";
                $count = 1;
                foreach ($mail_1 as $a) {
                    if ($count != count($mail_1)) {
                        $or = "or ";
                    } else {
                        $or = "";
                    }
                    $idJabatanForSocket[] = $a->id_jabatan;
					$jabatan_push_notif .= "$a->id_jabatan,";
                    $mail_result .= "notadinas.master_user.jabatan = " . $a->id_jabatan . " " . $or;
                    $count = $count + 1;
                }
                $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE $mail_result")->result();
                foreach ($mail_2 as $b) {
                    $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
            } else {
                if($create_by[0]['create_by'] == 1){
               $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 2,opened = 2, updated_at = '$upd_date' WHERE id = $idu");
					$jabatan_push_notif .= "1,";
                } else {

                $this->db->query("UPDATE notadinas.surat_keluar SET status_surat_keluar = 5,opened = 5, updated_at = '$upd_date' WHERE id = $idu");
				$jabatan_setum = $this->db->query('SELECT id FROM notadinas.master_jabatan WHERE satuan = 6 AND tingkatan = 1')->result();
				foreach($jabatan_setum as $jstm){					
					$jabatan_push_notif .= "$jstm->id,";
				}
                }
            }
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_surat_keluar")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_surat_keluar VALUES ('" . $lpskids . "','" . $idu . "','$upd_date','" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','2','')");

        /******************************************************
         *  Create Session for Socket Surat Keluar
         *  By : Daniel D Fortuna
         ******************************************************
         */
            $socketData = [];

            foreach($idJabatanForSocket as $id_jabatan){
                $socketData[] = [
                    'ka_waka_setum'       => 'unchecked',
                    'tgl_surat'           => date('Y-m-d'),
                    'tablenya'            => 'keluar',
                    'status'              => 1,
                    'opened'              => $cc->opened,
                    'kepada'              => $cc->kepada,
                    'id_jabatan'          => $id_jabatan,
                    'perihal'             => $cc->perihal,
                    'status_surat_keluar' => $cc->status_surat_keluar,
                    'idnya'               => $cc->id,
                    'create_by'           => $cc->create_by
                ];
            }

            $_SESSION['socketAdded'] = $socketData;
            $this->db->query("UPDATE notadinas.tembusan_surat_keluar SET tanggal = NULL WHERE id_surat_keluar = $idu");
			$this->db->query("UPDATE notadinas.surat_keluar SET status_tujuan = 0 WHERE id = $idu");
			$this->pushFirebase($jabatan_push_notif."1");
			redirect(base_url() . 'admin/surat_keluar');
        } else if ($mau_ke == "cetak_input_tembusan") {
            $data = addslashes($this->input->post('data'));
            $count = addslashes($this->input->post('count'));
            $aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
            foreach ($aa as $aaa) {
                $bb = "";
                $count++;
            }
            echo $bb;
            die();
        } else if ($mau_ke == "tambah_tembusan") {
            $data = addslashes($this->input->post('data'));
            $count = addslashes($this->input->post('count'));
            $aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
            foreach ($aa as $aaa) {
                $bb = "
                <tbody>
                <tr id='remove" . $count . "' style='vertical-align:top;'>
                    <td>" . $count . "</td>
                    <td>" . $aaa->nama_jabatan . "<input id='jabatan_array_tembusan' type='text' name='jabatan[]' value='" . $aaa->id . "' readonly hidden/></td>
                    <td><!--
                        <div class='col-md-6'><a class='btn-default btn btn-xs' style='float:right;'>Setuju</a></div>
                        <div class='col-md-6'><a class='btn-default btn btn-xs' style='float:left;'>Koreksi</a></div>-->
                        <input type='text' name='status[]' value='1' readonly hidden/>
                    </td>
                    <td><!--<textarea name='keterangan_tembusan[]' class='form-control'></textarea>--></td>
                    <td><button class='btn btn-danger' onclick='removeD(" . $count . ",". $aaa->id .")'>HAPUS</button></td>
                </tr>
                </tbody>";
                $count++;
            }
            echo $bb;
            die();
        } else if ($mau_ke == "del") {
            $this->db->query("DELETE FROM notadinas.surat_keluar WHERE id = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            if ($this->session->userdata('admin_level') != "Super Admin") {
                redirect('admin/surat_keluar');
            } else {
                redirect('admin/agenda_surat_keluar');
            }
        } else if ($mau_ke == "cari") {

            $tembusan = $this->db->query("SELECT * FROM notadinas.tembusan_surat_keluar")->result();
            $array = [];
            $arr = [];
            foreach ($tembusan as $b) {
                $array[$b->id_jabatan][$b->id_surat_keluar] = "1";
                $arr[$b->id_jabatan][$b->id_surat_keluar][$b->status] = "1";
            }
            $a['tembusan'] = $array;
            $a['status_tembusan'] = $arr;
            // $a['data']       = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE perihal LIKE '%$cari%' OR tujuan LIKE '%$cari%' OR no_surat LIKE '%$cari%' ORDER BY id DESC")->result();
			$cari2 = addslashes($this->input->post('q2'));
			$cari22 = "";
			if($cari2!=""){
				$cari22 = "AND notadinas.surat_keluar.jenis_surat = $cari2";
			}
            $a['data'] = $this->db->query("SELECT *,notadinas.master_tujuan.nama AS kepada, notadinas.surat_keluar.id AS id FROM notadinas.surat_keluar INNER JOIN notadinas.master_tujuan ON notadinas.surat_keluar.kepada = notadinas.master_tujuan.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND ( notadinas.surat_keluar.perihal LIKE '%$cari%' OR notadinas.master_tujuan.nama LIKE '%$cari%' OR notadinas.surat_keluar.no_surat LIKE '%$cari%') $cari22 LIMIT $akhir OFFSET $awal")->result();
            $a['page'] = "l_surat_keluar";

        } else if ($mau_ke == "add") {
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id where level = 'Admin' order by urut_jabatan asc")->result();
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan ORDER BY nama ASC")->result();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
            $a['page'] = "f_surat_keluar";

        } else if ($mau_ke == "show") {
            $a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.log_proses_surat_keluar.pengirim WHERE log_proses_surat_keluar.id_suratkeluar = $idu ORDER BY notadinas.log_proses_surat_keluar.id ASC")->result();
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = $idu ORDER BY id DESC")->row();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1 ORDER BY urut_jabatan ASC")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan, notadinas.tembusan_surat_keluar.id_jabatan AS idnya_jabatan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$idu'")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
			$a['datpil100'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = '$idu' order by id desc")->row();
            $a['page'] = "f_surat_keluar";
			if($a['datpil']->status_surat_keluar==8 and $a['datpil']->opened==88 and $a['datpil']->create_by==$this->session->userdata('admin_id')){
				$this->db->query("UPDATE notadinas.surat_keluar SET opened = 89, updated_at = '$upd_date' WHERE id = '$idu'");
			}
        } else if ($mau_ke == "edt") {
            $a['tujuan'] = $this->db->query("SELECT * FROM notadinas.master_tujuan")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = $idu ORDER BY id DESC")->row();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1 ORDER BY urut_jabatan ASC")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_surat_keluar.*, notadinas.master_jabatan.*, notadinas.tembusan_surat_keluar.id AS idnya_tembusan, notadinas.tembusan_surat_keluar.id_jabatan AS idnya_jabatan FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE id_surat_keluar = '$idu'")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE id = '$idu'")->row();
            $a['jenis'] = $this->db->query("SELECT * FROM notadinas.master_surat_keluar ORDER BY id_master_surat_keluar ASC")->result();
			$a['datpil100'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = '$idu' order by id desc")->row();
            $a['page'] = "f_surat_keluar";
        } else if ($mau_ke == "act_add") {
            $id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.surat_keluar")->row();
            echo $ids = $id->qwe + 1;
            $jabatan = $this->input->post('jabatan');
            $jenis_surat = $this->input->post('jenis_surat');
            if($jenis_surat==15){
                $year = "/" . date('Y');
            }else{
                $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            }
            $no_ag = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE jenis_surat = '".$jenis_surat."' AND no_agenda LIKE '%".$year."%'")->result();
            // $no_ags = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE jenis_surat = '".$jenis_surat."'")->result();
            $get_format = $this->db->query("SELECT * FROM notadinas.master_surat_keluar WHERE id_master_surat_keluar = '".$jenis_surat."'")->row();
            $f = [];
            if(empty($no_ag)){
                $no_urut = "0001";
                if($jenis_surat==15){
                    $no_agen = "".$get_format->format_surat_keluar."".$no_urut."".$year;
                }else{
                    $no_agen = "".$get_format->format_surat_keluar."".$no_urut."".$year;
                }
            }else{
                $m = explode('/', $get_format->format_surat_keluar);
                if(count($m) == 3){
                    foreach ($no_ag as $d) {
                        $e = explode('/', $d->no_agenda);
                        array_push($f, $e[2]);
                    }
                }else{
                    foreach ($no_ag as $d) {
                        $e = explode('/', $d->no_agenda);
                        array_push($f, $e[1]);
                    }
                }
                $dt = max($f);
                $k = floatval($dt) + 1;
                $no_urut = str_pad($k, 4, "0", STR_PAD_LEFT);
                $no_agen = "".$get_format->format_surat_keluar."".$no_urut."".$year;
            }
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');
            $isi_surat = stripslashes($isi_surat);
            // die();/*

            $file_name = $_FILES['file_attachment']['name'];
            $ext = explode('.', $file_name);

            $coba = str_replace('/', '-', $no_agen).".".$ext[1];
            $config['file_name']           =  $coba;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_attachment')) {

                $up_data = $this->upload->data();
                $count = 0;
                if (!empty($jabatan)) {
                    for ($ab = 1; $ab <= count($jabatan); $ab++) {
                        $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
                        $jids = $jid->qwe + 1;
                        $this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('" . $jids . "','" . $jabatan[$count] . "','0','" . $keterangan_tembusan[$count] . "','" . $ids . "')");
                        $count = $count + 1;
                    }
                } else {
                }
                $this->db->query("INSERT INTO notadinas.surat_keluar VALUES ('$ids', '$tgl_surat', '', '$perihal', '$ket', '$isi_surat', '0', '" . $this->session->userdata('admin_id') . "','" . $up_data['file_name'] . "', '$dari', '" . $this->input->post('klasifikasi') . "', '" . $this->input->post('derajat') . "',0, '" . $this->session->userdata('admin_id') . "','', '" . $jenis_surat . "', null, '".$no_agen."', '$upd_date')");

            } else {
                $count = 0;
                if (!empty($jabatan)) {
                    for ($ab = 1; $ab <= count($jabatan); $ab++) {
                        $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
                        $jids = $jid->qwe + 1;
                        $this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('" . $jids . "','" . $jabatan[$count] . "','0','" . $keterangan_tembusan[$count] . "','" . $ids . "')");
                        $count = $count + 1;
                    }
                } else {
                }
                $this->db->query("INSERT INTO notadinas.surat_keluar VALUES ('$ids', '$tgl_surat', '', '$perihal', '$ket', '$isi_surat', '0', '" . $this->session->userdata('admin_id') . "','', '$dari', '" . $this->input->post('klasifikasi') . "', '" . $this->input->post('derajat') . "',0, '" . $this->session->userdata('admin_id') . "','" . $this->input->post('signature') . "', '" . $jenis_surat . "', null, '".$no_agen."','$upd_date')");

            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            redirect('admin/surat_keluar');//*/
        } else if ($mau_ke == "act_edt") {
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $jenis_surat = $this->input->post('jenis_surat');
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');
			$a['datpil100'] = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar WHERE id_suratkeluar = '$idu' order by id desc")->row();
            $isi_surat = stripslashes($isi_surat);

            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();
                $this->db->query("UPDATE notadinas.surat_keluar SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat', file_attachment = '" . $up_data['file_name'] . "', jenis_surat = '" . $jenis_surat . "', updated_at = '$upd_date'  WHERE id = '$idp'");
                // $this->db->query("UPDATE surat_keluar SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
            } else {
                $this->db->query("UPDATE notadinas.surat_keluar SET tgl_surat = '$tgl_surat', no_surat = '', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat', jenis_surat = '$jenis_surat', updated_at = '$upd_date' WHERE id = '$idp'");
                // $this->db->query("UPDATE surat_keluar SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
            }
            if (!empty($jabatan)) {
                $this->db->query("DELETE FROM notadinas.tembusan_surat_keluar WHERE id_surat_keluar = '$idp'");
                $count = 0;
                for ($ab = 1; $ab <= count($jabatan); $ab++) {
                    $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_surat_keluar")->row();
                    $jids = $jid->qwe + 1;
                    $this->db->query("INSERT INTO notadinas.tembusan_surat_keluar VALUES ('" . $jids . "','" . $jabatan[$count] . "','" . $status[$count] . "','" . $keterangan_tembusan[$count] . "','" . $idp . "')");
                    $count = $count + 1;
                }
            }
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated " . $this->upload->display_errors() . "</div>");
            if ($this->session->userdata('admin_jabatan' != 0)) {
                redirect('admin/surat_keluar');
            } else {
                redirect('admin/surat_keluar');
            }
        } else {
            $a['data_user'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan=notadinas.master_jabatan.id WHERE notadinas.master_user.id = '" . $this->session->userdata('admin_id') . "'")->row();
            $a['data'] = $this->db->query("SELECT *,notadinas.master_tujuan.nama AS kepada, notadinas.surat_keluar.id AS id FROM notadinas.surat_keluar INNER JOIN notadinas.master_tujuan ON notadinas.surat_keluar.kepada = notadinas.master_tujuan.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' ORDER BY notadinas.surat_keluar.id desc")->result();
            $a['status_kadis'] = $this->db->query("SELECT *,notadinas.master_jabatan.nama_jabatan AS nama_kadis FROM notadinas.tembusan_surat_keluar INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_surat_keluar.id_jabatan = notadinas.master_jabatan.id WHERE notadinas.tembusan_surat_keluar.status = '0' ORDER BY  notadinas.master_jabatan.urut_jabatan ASC")->result();
            /*$a['data']        = $this->db->query("SELECT notadinas.surat_keluar.*, notadinas.master_user.nama_lengkap from notadinas.surat_keluar INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.surat_keluar.kepada WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT $akhir OFFSET $awal")->result();*/
            $tembusan = $this->db->query("SELECT * FROM notadinas.tembusan_surat_keluar")->result();
            $array = [];
            $arr = [];
            foreach ($tembusan as $b) {
                $array[$b->id_jabatan][$b->id_surat_keluar] = "1";
                $arr[$b->id_jabatan][$b->id_surat_keluar][$b->status] = "1";
            }
            $a['tembusan'] = $array;
            $a['status_tembusan'] = $arr;
            $a['page'] = "l_surat_keluar";
        }

        $this->load->view('admin/aaa', $a);
    }

    public function master_kegiatan()
    {
        $idk = addslashes($this->input->post('id_keg'));
        $nmk = addslashes($this->input->post('nama_keg'));
        $nmk = str_replace('\"', '"', $nmk);
        $cari = addslashes($this->input->post('q'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        if ($aksi == "add") {
            $a['page'] = "f_master_kegiatan";
        }else if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas WHERE nama_kegiatan LIKE '%$cari%' ORDER BY id_kegiatan DESC")->result();
            $a['page'] = "l_master_kegiatan";
        } else if ($aksi == "del") {
            $this->db->query("DELETE FROM notadinas.kegiatan_dinas WHERE id_kegiatan = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('admin/master_kegiatan/m_kegiatan');
        } else if ($aksi == "m_kegiatan") {

            $a['data'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas ORDER BY id_kegiatan")->result();
            $a['page'] = "l_master_kegiatan";
        } else if ($aksi == "edt") {

            $a['datas'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas WHERE id_kegiatan = '$idu'")->row();
            $a['page'] = "f_master_kegiatan";
        } else if ($aksi == "act_edt") {
            $idp = addslashes($this->input->post('idp'));
            $nmk = addslashes($this->input->post('nama_keg'));
            $cek_user_exist = $this->db->query("SELECT nama_kegiatan FROM notadinas.kegiatan_dinas WHERE nama_kegiatan = '$nmk'")->num_rows();

             if ($cek_user_exist > 0) {
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Kegiatan Sudah Ada. Silahkan Buat Dengan Nama Yang Lain.</div>");//ganti admin mei
            }else if($nmk == ""){
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Kegiatan Tidak Boleh Kosong</div>");//ganti admin mei
            }else {
            $this->db->query("UPDATE notadinas.kegiatan_dinas SET nama_kegiatan = '$nmk' WHERE id_kegiatan = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
            }

            redirect('admin/master_kegiatan/m_kegiatan');
        } else if ($aksi == "save") {
            $cek_user_exist = $this->db->query("SELECT nama_kegiatan FROM notadinas.kegiatan_dinas WHERE nama_kegiatan = '$nmk'")->num_rows();

             if ($cek_user_exist > 0) {
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Kegiatan Sudah Ada. Silahkan Buat Dengan Nama Yang Lain.</div>");//ganti admin mei
            }else if($nmk == ""){
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Kegiatan Tidak Boleh Kosong</div>");//ganti admin mei
            }else {
            $jid = $this->db->query("SELECT MAX(id_kegiatan) AS qwe FROM notadinas.kegiatan_dinas")->row();
                    $jids = $jid->qwe + 1;
            $this->db->query("INSERT INTO notadinas.kegiatan_dinas VALUES ('".$jids."','" . $nmk . "')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            }
            redirect('admin/master_kegiatan/m_kegiatan');
        }


        $this->load->view('admin/aaa', $a);
    }

    public function manage_ruangkrj()//ubah master ruang kerja mei
    {
                    $this->eoffice = $this->load->database('eoffice', TRUE);
                    // $query = $this->eoffice->query("SELECT * FROM test")->result();
                    // var_dump($query);
                    // die();
        date_default_timezone_set('Asia/Jakarta');
        $id_ruang_kerja = addslashes($this->input->post('id_ruang_kerja'));
        $nama_krj = addslashes($this->input->post('nama_krj'));
        $nama_krj = str_replace('\"', '"', $nama_krj);
        $rk = addslashes($this->input->post('rknya'));
        $namawork = addslashes($this->input->post('namaworkspace'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $q = $this->uri->segment(4);
        if ($aksi == "add") {
			$a['jenissurat'] = $this->db->query("SELECT * FROM notadinas.master_surat_masuk ORDER BY id_master_surat_masuk")->result();
            // $a['query'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0 ORDER BY id")->result();
            // var_dump($query);
            // die();
            $a['page'] = "f_master_ruangkrj";
        } else if ($aksi == "delete") {
            $idlogind = $this->session->userdata('admin_user');
            $usefficed = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$idlogind'")->row();
            $id_usefd = $usefficed->object_id;
            $object = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$q'")->row();
            $object_id_d = $object->object_id;
            $objectd = $this->eoffice->query("SELECT * FROM fo_objects WHERE id = '$object_id_d'")->row();
                $idobjd = $objectd->name;
            $member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$object_id_d'")->row();
            $member_id_d = $member->id;
            $idapd = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                    $idapds = $idapd->qwi + 1;
            $date_wrk_d = date('Y-m-d h:i:s');
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idapds."', '".$id_usefd."', '".$object_id_d."', '".$object->idobjd."', '".$date_wrk_d."', '".$id_usefd."', 'delete', '0', '0', '".$member_id_d."', 'member deleted')");
            $this->eoffice->query("DELETE FROM fo_searchable_objects WHERE rel_object_id = $object_id_d");
            $this->eoffice->query("DELETE FROM fo_sharing_table WHERE object_id = $object_id_d");
            $this->eoffice->query("DELETE FROM fo_workspaces WHERE object_id = $object_id_d");
            $this->eoffice->query("DELETE FROM fo_member_property_members WHERE member_id = $member_id_d");
            $this->eoffice->query("DELETE FROM fo_object_members WHERE member_id = $member_id_d");
            $this->eoffice->query("DELETE FROM fo_contact_member_permissions WHERE member_id = $member_id_d");
            $this->eoffice->query("DELETE FROM fo_members WHERE object_id = $object_id_d");
            $this->eoffice->query("DELETE FROM fo_objects WHERE id = $object_id_d");
            $this->db->query("DELETE FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = $q");
            redirect('admin/manage_ruangkrj/m_ruangkrj');
        } else if ($aksi == "m_ruangkrj") {
            $a['data'] = $this->db->query("SELECT notadinas.master_ruangkrj.*,notadinas.master_surat_masuk.* FROM notadinas.master_ruangkrj LEFT JOIN notadinas.master_surat_masuk ON notadinas.master_ruangkrj.id_jenissurat = notadinas.master_surat_masuk.id_master_surat_masuk ORDER BY notadinas.master_ruangkrj.id_ruang_kerja")->result();
            $a['page'] = "l_master_ruangkrj";
        } else if ($aksi == "edt") {
			$a['jenissurat'] = $this->db->query("SELECT * FROM notadinas.master_surat_masuk ORDER BY id_master_surat_masuk")->result();
            
            $a['query'] = $query = $this->eoffice->query("SELECT * FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0 ORDER BY id")->result();
            $a['datas'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$q'")->row();
            $a['page'] = "f_master_ruangkrj";
        } else if ($aksi == "act_edt") {
			$ijs = $this->input->post('id_jenissurat');
            $cek_user_exist = $this->db->query("SELECT nama_krj FROM notadinas.master_ruangkrj WHERE nama_krj = '$nama_krj' and id_jenissurat='$ijs'")->num_rows();
            /* if ($cek_user_exist > 0) {
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Ruang Kerja Sudah Ada. Silahkan Buat Dengan Nama Yang Lain.</div>");
            }else if($nama_krj == ""){//ubah mei surmas
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Ruang Kerja Tidak Boleh Kosong</div>");//ganti admin mei
            }else { */
            $idp = addslashes($this->input->post('idp'));
            $nama_krj = addslashes($this->input->post('nama_krj'));
            $nama_krj = str_replace('\"', '"', $nama_krj);
            // $rk = addslashes($this->input->post('rknya'));

            $date_wrk_u = date('Y-m-d h:i:s');
            $userLoginu = $this->session->userdata('admin_user');
                    // var_dump($jids);
            $usefficeu = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLoginu'")->row();
            $id_usefu = $usefficeu->object_id;
            $object = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$idp'")->row();
            $object_id_u = $object->object_id;
            // $parent = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$rk'")->row();
            // $depth_up = $parent->depth + 1;
            $member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$object_id_u'")->row();
            $member_id_u = $member->id;
            $idap = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                    $idaps = $idap->qwi + 1;
            $this->eoffice->query("UPDATE fo_objects SET updated_on = '".$date_wrk_u."', updated_by_id = '".$id_usefu."', name = '".$nama_krj."' WHERE id = '".$object_id_u."'");
            // if($parent->depth=='1'){
                $this->eoffice->query("UPDATE fo_members SET parent_member_id = '".$parent->id."', depth = '".$depth_up."', name = '".$nama_krj."', color = '12' WHERE id = '".$member_id_u."'");
            // }else if($parent->depth=='2'){
            //     $this->eoffice->query("UPDATE fo_members SET parent_member_id = '".$parent->id."', depth = '".$depth_up."', name = '".$nama_krj."', color = '23' WHERE id = '".$member_id_u."'");
            // }
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idaps."', '".$id_usefu."', '".$object_id_u."', '".$nama_krj."', '".$date_wrk_u."', '".$id_usefu."', 'edit', '0', '0', '".$member_id_u."', '')");
            $this->eoffice->query("UPDATE fo_searchable_objects SET content = '".$nama_krj."' WHERE rel_object_id = '".$object_id_u."' AND column_name = 'name'");

            // $quer = $this->eoffice->query("SELECT name as namanya FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0 AND id = '$rk'")->row();
            // $namanya = $quer->namanya;
			$id_jenissurat = $_POST['id_jenissurat'];
            $this->db->query("UPDATE notadinas.master_ruangkrj SET nama_krj = '$nama_krj', id_jenissurat = '$id_jenissurat' WHERE id_ruang_kerja = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
           /* } */
            redirect('admin/manage_ruangkrj/m_ruangkrj');
        } else if ($aksi == "save") {
			$ijs = $this->input->post('id_jenissurat');
            $cek_user_exist = $this->db->query("SELECT nama_krj FROM notadinas.master_ruangkrj WHERE nama_krj = '$nama_krj' and id_jenissurat='$ijs'")->num_rows();
            if ($cek_user_exist > 0) {
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Ruang Kerja Sudah Ada. Silahkan Buat Dengan Nama Yang Lain.</div>");
            }else if($nama_krj == ""){//ubah mei surmas
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Ruang Kerja Tidak Boleh Kosong</div>");//ganti admin mei
            }else {
                $jiz = $this->db->query("SELECT MAX(id_ruang_kerja) AS qwa FROM notadinas.master_ruangkrj")->row();
                        $jidz = $jiz->qwa + 1;
                $jid = $this->eoffice->query("SELECT MAX(id) AS qwe FROM fo_objects")->row();
                        $jids = $jid->qwe + 1;
                $idal = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                        $idals = $idal->qwi + 1;
                $idmem = $this->eoffice->query("SELECT MAX(id) AS qwo FROM fo_members")->row();
                        $idmems = $idmem->qwo + 1;
                $userLogin = $this->session->userdata('admin_user');
                        // var_dump($jids);
                $useffice = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLogin'")->row();
                // $parent_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$rk'")->row();
                $id_usef = $useffice->object_id;
                // $id_parent = $parent_member->id;
                // $name_perent = $parent_member->name;
                $kpwk = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '$id_usef'")->row();//ubah disposisi mei
                    $idkpwk = $kpwk->id;
                $setum = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = 'setum'")->row();//ubah disposisi mei
                    $idsetum = $setum->object_id;
                $stm = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '$idsetum'")->row();//ubah disposisi mei
                    $idstm = $stm->id;
                $date_wrk = date('Y-m-d h:i:s');
                $property_member_id = $this->eoffice->query("SELECT * FROM fo_members WHERE dimension_id = '1' ORDER BY id ASC")->result();
                $object_member = $this->eoffice->query("SELECT * FROM fo_contacts WHERE is_company = '0' ORDER BY object_id ASC")->result();
                $this->eoffice->query("DELETE FROM fo_contact_member_cache WHERE member_id = $idmems");

                // var_dump($object_member);
                // die();
                $this->eoffice->query("INSERT INTO fo_objects (id, object_type_id, name, created_on, created_by_id, updated_on, updated_by_id, trashed_on, trashed_by_id, archived_on, archived_by_id, timezone_id, timezone_value) VALUES ('".$jids."', '1', '".$nama_krj."', '".$date_wrk."', '".$id_usef."', '".$date_wrk."', '".$id_usef."', '', '0', '', '0', '357', '25200')");

                $this->eoffice->query("INSERT INTO fo_members (id, dimension_id, object_type_id, parent_member_id, depth, name, description, object_id) VALUES ('".$idmems."', '2', '1', '0', '1', '".$nama_krj."', 'Deskripsi dari Ruang Kerja ".$nama_krj."', '".$jids."')");
                $this->eoffice->query("UPDATE fo_members SET color = '12', archived_by_id = '0' WHERE id = '".$idmems."'");

                $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals."', '".$id_usef."', '".$jids."', '".$nama_krj."', '".$date_wrk."', '".$id_usef."', 'add', '0', '0', '".$idmems."', '')");
                $this->eoffice->query("INSERT INTO fo_searchable_objects (rel_object_id, column_name, content, contact_id) VALUES ('".$jids."', 'name', '".$nama_krj."', 0), ('".$jids."', 'object_id', '".$jids."', 0)");
                $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('0', '".$jids."'), ('".$idkpwk."', '".$jids."')");//ubah disposisi mei
                $this->eoffice->query("INSERT INTO fo_workspaces (object_id, description, show_description_in_overview, color) VALUES ('".$jids."', '', '0', '0')");
                foreach ($property_member_id as $key) {
                    $idmpm = $this->eoffice->query("SELECT MAX(id) AS wer FROM fo_member_property_members")->row();
                        $idmpms = $idmpm->wer + 1;
                    $this->eoffice->query("INSERT INTO fo_member_property_members (id, association_id, member_id, property_member_id, is_active, created_on, created_by_id) VALUES ('".$idmpms."', '1', '".$idmems."', '".$key->id."', '1', '".$date_wrk."', '".$id_usef."')");
                }
                foreach ($object_member as $key2) {
                    $this->eoffice->query("INSERT INTO fo_object_members (object_id, member_id, is_optimization) VALUES ('".$key2->object_id."', '".$idmems."', '0')");
                    $this->eoffice->query("INSERT INTO fo_contact_member_cache (contact_id, member_id, parent_member_id, last_activity) VALUES ('".$key2->object_id."', '".$idmems."', '0', '')");
                    $permission_group = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '".$key2->object_id."' ORDER BY contact_id ASC")->row();
                    $this->eoffice->query("INSERT INTO fo_contact_member_permissions (permission_group_id, member_id, object_type_id, can_write, can_delete) VALUES ('".$permission_group->id."', '".$idmems."', '1', '1', '1'), ('".$permission_group->id."', '".$idmems."', '3', '1', '1'),('".$permission_group->id."', '".$idmems."', '5', '1', '1'),('".$permission_group->id."', '".$idmems."', '6', '1', '1'),('".$permission_group->id."', '".$idmems."', '9', '1', '1'),('".$permission_group->id."', '".$idmems."', '10', '1', '1'),('".$permission_group->id."', '".$idmems."', '11', '1', '1'),('".$permission_group->id."', '".$idmems."', '15', '1', '1'),('".$permission_group->id."', '".$idmems."', '17', '1', '1'),('".$permission_group->id."', '".$idmems."', '22', '1', '1')");
                }
                // die();
                // var_dump($parent_member);
                // die();
                // $quer = $this->eoffice->query("SELECT name as namanya FROM fo_objects WHERE object_type_id = 1 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0 AND id = '$rk'")->row();
                // $namanya = $quer->namanya;
                $this->db->query("INSERT INTO notadinas.master_ruangkrj VALUES ('".$jidz."','0','" . $nama_krj . "', '', '".$jids."', '".$_POST['id_jenissurat']."')");
                $a['data'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj")->result();
            }
                redirect('admin/manage_ruangkrj/m_ruangkrj');
            // var_dump($userLogin);
            // die();
        }


        $this->load->view('admin/aaa', $a);
    }

    public function ambiltugas()
    {
		$id_jenissurat = $_GET['abcd'];
		 $a['listtugasnya'] = $this->db->query("SELECT a.nama_task, a.id_task FROM notadinas.master_task as a, notadinas.master_ruangkrj as b  
		 WHERE a.id_etask = b.id_ruang_kerja and b.id_jenissurat = $id_jenissurat")->result();

        $this->load->view('admin/listtugas', $a);
	}
	
	public function ambilaja()
    {
		$id_jenissurat = $_GET['abcd'];
		 $a['listtugasnya'] = $this->db->query("SELECT a.nama_krj, a.id_ruang_kerja FROM notadinas.master_ruangkrj as a
		 WHERE a.id_jenissurat = $id_jenissurat")->result();

        $this->load->view('admin/createlangsung', $a);
	}
	
	public function manage_task()
    {
                    $this->eoffice = $this->load->database('eoffice', TRUE);
                    // $query = $this->eoffice->query("SELECT * FROM test")->result();
                    // var_dump($query);
                    // die();
        date_default_timezone_set('Asia/Jakarta');
        $id_task = addslashes($this->input->post('id_task'));
        $nama_task = addslashes($this->input->post('nama_task'));
        $rk = addslashes($this->input->post('rknya'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $q = $this->uri->segment(4);
         if ($aksi == "add") {
            $a['query'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj")->result();
            $a['page'] = "f_master_task";
        } else if ($aksi == "delete") {
            $idald = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                    $idalds = $idald->qwi + 1;
            $userLogind = $this->session->userdata('admin_user');
                    // var_dump($jids);
            $usefficed = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLogind'")->row();
                $id_usefd = $usefficed->object_id;
            $object = $this->db->query("SELECT * FROM notadinas.master_task WHERE id_task = '$q'")->row();
                $id_obj = $object->object_id;
            $objectd = $this->eoffice->query("SELECT * FROM fo_objects WHERE id = '$id_obj'")->row();
                $idobjd = $objectd->name;
            $date_wrk_d = date('Y-m-d h:i:s');
            $this->eoffice->query("UPDATE fo_objects SET trashed_on = '".$date_wrk_d."', trashed_by_id = '".$id_usefd."' WHERE id = '".$id_obj."'");
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idalds."', '".$id_usefd."', '".$id_obj."', '".$idobjd."', '".$date_wrk_d."', '".$id_usefd."', 'trash', '0', '0', '0', '')");
            // $this->eoffice->query("DELETE FROM fo_object_reminders WHERE object_id = $id_obj");
            $this->db->query("DELETE FROM notadinas.master_task WHERE id_task = $q");
            redirect('admin/manage_task/m_task');
        } else if ($aksi == "m_task") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_task ORDER BY id_task ASC")->result();
            $a['data2'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj ORDER BY id_ruang_kerja ASC")->result();
            $a['page'] = "l_master_task";
        } else if ($aksi == "edt") {
            $a['query'] = $this->db->query("SELECT * FROM notadinas.master_ruangkrj")->result();
            $a['datas'] = $this->db->query("SELECT * FROM notadinas.master_task WHERE id_task = '$q'")->row();
            $a['page'] = "f_master_task";
        } else if ($aksi == "act_edt") {
            $idp = addslashes($this->input->post('idp'));
            $nama_task = addslashes($this->input->post('nama_task'));
            $nama_task = str_replace('\"', '"', $nama_task);
            $rk = addslashes($this->input->post('rknya'));
            $idal = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                    $idals = $idal->qwi + 1;
            $userLoginu = $this->session->userdata('admin_user');
                    // var_dump($jids);
            $usefficeu = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLoginu'")->row();
                $id_usefu = $usefficeu->object_id;
            $works_obj = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$rk'")->row();
                $idobjworks = $works_obj->object_id;
            $object = $this->db->query("SELECT * FROM notadinas.master_task WHERE id_task = '$idp'")->row();
                $object_id_u = $object->object_id;
            $setum = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = 'setum'")->row();
                $idsetum = $setum->object_id;
            $setum_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$idsetum'")->row();
                $id_memsetum = $setum_member->id;
            $log_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$id_usefu'")->row();
                $id_memlog = $log_member->id;
            $member_works = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '".$idobjworks."'")->row();
                $id_memworks = $member_works->id;
            $logdat = $idsetum.",".$id_usefu;
            $date_wrk_e = date('Y-m-d h:i:s');
            $this->eoffice->query("UPDATE fo_objects SET updated_on = '".$date_wrk_e."', updated_by_id = '".$id_usefu."', name = '".$nama_task."' WHERE id = '".$object_id_u."'");
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals."', '".$id_usefu."', '".$object_id_u."', '".$nama_task."', '".$date_wrk_e."', '".$id_usefu."', 'edit', '0', '0', '0', '".$logdat."')");
            $this->eoffice->query("UPDATE fo_project_tasks SET text = 'Deskripsi dari Tugas ".$nama_task."' WHERE object_id = '".$object_id_u."'");
            $this->eoffice->query("UPDATE fo_searchable_objects SET content = '".$nama_task."' WHERE rel_object_id = '".$object_id_u."' AND column_name = 'name'");
            $this->eoffice->query("UPDATE fo_searchable_objects SET content = 'Deskripsi dari Tugas ".$nama_task."' WHERE rel_object_id = '".$object_id_u."' AND column_name = 'text'");
            $this->eoffice->query("DELETE FROM fo_object_members WHERE object_id = $object_id_u");
            $this->eoffice->query("INSERT INTO fo_object_members (object_id, member_id, is_optimization) VALUES ('".$object_id_u."', '".$id_memsetum."', '0'), ('".$object_id_u."', '".$id_memlog."', '0'), ('".$object_id_u."', '".$id_memworks."', '0')");


            // $quer = $this->eoffice->query("SELECT name as namanya FROM fo_objects WHERE object_type_id = 5 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0 AND id = '$rk'")->row();
            // $namanya = $quer->namanya;
            $this->db->query("UPDATE notadinas.master_task SET id_etask = '$rk', nama_task = '$nama_task' WHERE id_task = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
            redirect('admin/manage_task/m_task');
        } else if ($aksi == "save") {
            $jid = $this->eoffice->query("SELECT MAX(id) AS qwe FROM fo_objects")->row();
                    $jids = $jid->qwe + 1;
            $jiz = $this->db->query("SELECT MAX(id_task) AS qwo FROM notadinas.master_task")->row();
                    $jidz = $jiz->qwo + 1;
            $orid = $this->eoffice->query("SELECT MAX(id) AS qwu FROM fo_object_reminders")->row();
                    $idor = $orid->qwu + 1;
            $idal = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
                    $idals = $idal->qwi + 1;
                    $idals2 = $idals + 1;
            $idmem = $this->eoffice->query("SELECT MAX(id) AS qwa FROM fo_members")->row();
                    $idmems = $idmem->qwa + 1;
            $userLogin = $this->session->userdata('admin_user');
            $useffice = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLogin'")->row();
            $id_usef = $useffice->object_id;
            $setum = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = 'setum'")->row();
                $idsetum = $setum->object_id;
            $setum_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$idsetum'")->row();
                $id_memsetum = $setum_member->id;
            $log_member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$id_usef'")->row();
                $id_memlog = $log_member->id;
            $member_workspace = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$rk'")->row();
            $member_works = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '".$member_workspace->object_id."'")->row();
                $id_memworks = $member_works->id;
            $date_wrk = date('Y-m-d h:i:s');
            $date_ts = date('Y-m-d');
            $idsub = $idsetum.', '.$id_usef;
            $this->eoffice->query("DELETE FROM fo_object_members WHERE object_id = $jids");//ubah mei surmas
            $this->eoffice->query("INSERT INTO fo_objects (id, object_type_id, name, created_on, created_by_id, updated_on, updated_by_id, trashed_on, trashed_by_id, archived_on, archived_by_id, timezone_id, timezone_value) VALUES ('".$jids."', '5', '".$nama_task."', '".$date_wrk."', '".$id_usef."', '".$date_wrk."', '".$id_usef."', '', '0', '', '0', '357', '25200')");
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals."', '".$id_usef."', '".$jids."', '".$nama_task."', '".$date_wrk."', '".$id_usef."', 'subscribe', '0', '1', '0', '".$idsub."')");
            $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals2."', '".$id_usef."', '".$jids."', '".$nama_task."', '".$date_wrk."', '".$id_usef."', 'add', '0', '0', '0', '')");
            $this->eoffice->query("INSERT INTO fo_object_members (object_id, member_id, is_optimization) VALUES ('".$jids."', '".$id_memsetum."', '0'), ('".$jids."', '".$id_memlog."', '0'), ('".$jids."', '".$id_memworks."', '0')");
             $this->eoffice->query("INSERT INTO fo_object_reminders (id, object_id, contact_id, type, context, minutes_before, date) VALUES ('".$idor."', '".$jids."', '0', 'reminder_email', 'due_date', 1440, '".$date_ts."')");
            $this->eoffice->query("INSERT INTO fo_object_subscriptions (object_id, contact_id) VALUES ('".$jids."', '".$id_usef."'), ('".$jids."', '".$idsetum."')");
            $this->eoffice->query("INSERT INTO fo_project_tasks (object_id, parent_id, parents_path, depth, text, due_date, start_date, assigned_to_contact_id, assigned_on, assigned_by_id, time_estimate, completed_on, completed_by_id, started_on, started_by_id, priority, state, milestone_id, is_template, from_template_id, from_template_object_id, repeat_end, repeat_forever, repeat_num, repeat_d, repeat_m, repeat_y, repeat_by, object_subtype, percent_completed, use_due_time, use_start_time, original_task_id, instantiation_id, type_content, total_worked_time) VALUES ('".$jids."', '0', '', '0', 'Deskripsi dari Tugas ".$nama_task."', '".$date_ts."', '".$date_ts."', '".$idsetum."', '".$date_wrk."', '".$id_usef."', '0', '', '0', '', '0', '200', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '0', 'html', '0')");
            // $this->eoffice->query("UPDATE fo_project_tasks SET order = '6' WHERE object_id = '".$jids."'");
            $this->eoffice->query("INSERT INTO fo_searchable_objects (rel_object_id, column_name, content, contact_id) VALUES ('".$jids."', 'text', 'Deskripsi dari Tugas ".$nama_task."', 0), ('".$jids."', 'name', '".$nama_task."', 0), ('".$jids."', 'object_id', '".$jids."', 0)");
            $object_member = $this->eoffice->query("SELECT * FROM fo_contacts WHERE is_company = '0' ORDER BY object_id ASC")->result();
            foreach ($object_member as $key2) {
                $permission_group = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '".$key2->object_id."' ORDER BY contact_id ASC")->row();
                $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('".$permission_group->id."', '".$jids."')");
            }
            // $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('17', '".$jids."')");
            // $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('18', '".$jids."')");
            // $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('27', '".$jids."')");
            // for($u = 43; $u<=77; $u++){
            //     if ($u!=44 AND $u!=53 AND $u!=68) {
            //         $this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('".$u."', '".$jids."')");
            //         // echo $u;
            //     }
            // }
            // $quer = $this->eoffice->query("SELECT name as namanya FROM fo_objects WHERE object_type_id = 5 AND trashed_on = '0000-00-00 00:00:00' AND trashed_by_id = 0 AND id = '$rk'")->row();
            // $namanya = $quer->namanya;
            $this->db->query("INSERT INTO notadinas.master_task VALUES ('".$jidz."','".$rk."','" . $nama_task . "', '', '".$jids."')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_task")->result();
            redirect('admin/manage_task/m_task');
        }


        $this->load->view('admin/aaa', $a);
    }

     public function nota_dinas()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $ta = $this->session->userdata('admin_ta');
        // print_r($this->session->all_userdata());
        // die();

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta'")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, base_url() . "admin/nota_dinas/p");

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        $kegiatan_id = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan //i think these variable will not use again anymore
        $idp = addslashes($this->input->post('idp'));
        $no_agenda = addslashes($this->input->post('no_agenda'));
        $kode = addslashes($this->input->post('kode'));
        $uraian = addslashes($this->input->post('uraian'));
        $nama_tujuan = addslashes($this->input->post('nama_tujuan'));

        //new variable
        $dari = addslashes($this->input->post('dari'));
        $keg_id = addslashes($this->input->post('kegiatan'));
        // $keg_id = 0;
        $staf_id = addslashes($this->input->post('staf_tugas'));
        $tglsurat = addslashes($this->input->post('tgl_surat'));
        $tgl_surat = date("Y-m-d", strtotime($tglsurat));
        $no_surat = addslashes($this->input->post('no_surat'));
        $perihal = addslashes($this->input->post('perihal'));
        $isi_surat = addslashes($this->input->post('isi'));
        $lampiran = addslashes($this->input->post('lampiran'));
        $ket = addslashes($this->input->post('ket'));
        $file_lam = addslashes($this->input->post('no_lampiran'));

        $cari = addslashes($this->input->post('q'));

        $perihal = str_replace('\"', '"', $perihal);
        $ket = str_replace('\"', '"', $ket);
        $isi_surat = str_replace('\"', '"', $isi_surat);
        date_default_timezone_set('Asia/Jakarta');
        $upd_date = date("Y-m-d H:i:s");

        //upload config
        $config['upload_path'] = './upload/nota_dinas';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['file_name'] = $file_lam;
        // $config['max_size']          = '2000';
        // $config['max_width']         = '3000';
        // $config['max_height']        = '3000';

        $this->load->library('upload', $config);

        if ($mau_ke == "cetak_nota_dinas") {

            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
            $a['tembusan'] = $this->db->query("SELECT notadinas.master_jabatan.nama_jabatan, notadinas.tembusan_nota_dinas.keterangan FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE notadinas.tembusan_nota_dinas.id_notadinas = $idu")->result();
            $a['page'] = 'cetak_nota_dinas';
            // var_dump($a['tembusan']);
            // die();
        } else if ($mau_ke == "verifikasi_submit_setum") {
            if ($this->input->post('no_surat') != "") {
                $this->db->query("UPDATE notadinas.nota_dinas SET tgl_setum = '" . date('Y-m-d') . "', no_agenda = '" . $this->input->post('no_surat') . "',no_surat = '" . $this->input->post('no_surat') . "', status_notadinas = 5, opened = 5, updated_at = '$upd_date' WHERE id = '" . $idu . "'");
            }
            redirect(base_url() . 'admin/nota_dinas');
        } else if ($mau_ke == "verifikasi_submit_kapushidrosal_setuju") {
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = $idu")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('" . $lpskids . "','" . $idu . "',NOW(),'" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','4','" . $this->input->post('komentar_kapushidrosal') . "')");
            $this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 4, opened = 4, updated_at = '$upd_date' WHERE id = $idu");
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_jabatan.satuan = 6")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Masuk", "Diterima surat masuk baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }

            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = $idu")->row();
            /******************************************************
             *  Create Session for Socket Nota Dinas
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'nota',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => $id_jabatan,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;
            redirect(base_url() . 'admin/nota_dinas');
        } elseif ($mau_ke == "verifikasi_submit_kapushidrosal") {
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '" . $idu . "'")->row();
            $this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('" . $lpskids . "','" . $idu . "','NOW()','" . $this->session->userdata('admin_id') . "','" . $cc->create_by . "','" . $cc->keterangan . "','1','" . $this->input->post('komentar_kapushidrosal') . "')");
            $this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 5, updated_at = '$upd_date' WHERE id = $idu");

            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = $idu")->row();
            /******************************************************
             *  Create Session for Socket Nota Dinas
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];

            $socketData[] = [
                'ka_waka_setum'       => 'unchecked',
                'tgl_surat'           => date('Y-m-d'),
                'tablenya'            => 'nota',
                'status'              => 1,
                'opened'              => $cc->opened,
                'kepada'              => $cc->kepada,
                'id_jabatan'          => $id_jabatan,
                'perihal'             => $cc->perihal,
                'status_surat_keluar' => $cc->status_surat_keluar,
                'idnya'               => $cc->id,
                'create_by'           => $cc->create_by
            ];

            $_SESSION['socketNotif'] = $socketData;
            redirect(base_url() . 'admin/nota_dinas');
        } elseif ($mau_ke == "getDetailKegiatan") {
            $a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas INNER JOIN notadinas.master_proses_nota_dinas ON notadinas.log_proses_nota_dinas.id_proses = notadinas.master_proses_nota_dinas.id WHERE log_proses_nota_dinas.id_notadinas = $idu")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas WHERE id_notadinas = $idu ORDER BY id DESC")->row();
            $a['log'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas where id_proses = 1 and id_notadinas = $idu")->row();
            $a['keg_nota'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.kegiatan_dinas.nama_kegiatan, notadinas.master_user.nama_lengkap from ((notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by) INNER JOIN notadinas.kegiatan_dinas on notadinas.kegiatan_dinas.id_kegiatan = notadinas.nota_dinas.kegiatan_id) where notadinas.nota_dinas.status_notadinas >= 2 AND notadinas.nota_dinas.kegiatan_id = $kegiatan_id;")->result();
            $a['keg_notas'] = $this->db->query("SELECT * from notadinas.kegiatan_dinas where id_kegiatan = $kegiatan_id")->result();
            $a['page'] = "notadinas/kegiatan_notadinas";
        }elseif ($mau_ke == "getDetailSendiri") {
           $a['status_kadis'] = $this->db->query("SELECT *,notadinas.master_jabatan.nama_jabatan AS nama_kadis, notadinas.nota_dinas.id AS id_nota FROM notadinas.nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.nota_dinas.kepada = notadinas.master_jabatan.id WHERE notadinas.nota_dinas.status_notadinas = '4'")->result();
            $a['status_tembus'] = $this->db->query("SELECT *,notadinas.master_jabatan.nama_jabatan AS nama_kadis, notadinas.tembusan_nota_dinas.id_notadinas AS id_tembus FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE notadinas.tembusan_nota_dinas.status = '1'")->result();
            if($this->session->userdata('admin_jabatan') == 1){
            $a['keg_nota'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.nota_dinas.create_by = 2 LIMIT 10 OFFSET $awal")->result();

            }else{
            $a['keg_nota'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.nota_dinas.create_by = 29 LIMIT 10 OFFSET $awal")->result();

            }
			// $this->dd($a['keg_nota']);
            $a['page'] = "notadinas/list_notpus";
        } else if ($mau_ke == "verifikasi_submit") {
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $keterangan = $this->input->post('keterangan_tembusan');
            $count = 0;
            $a = "";
            $b = "";
            for ($l = 0; $l < count($status); $l++) {
                if ($status[$l] == 2) {
                    $a .= "2";
                }
                $b .= "2";
            }
            // var_dump($keterangan);
            // die();
            $this->db->query("DELETE FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = $idu");
            for ($ab = 1; $ab <= count($jabatan); $ab++) {
                $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
                $jids = $jid->qwe + 1;
                $this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('" . $jids . "','" . $jabatan[$count] . "',1,'" . $keterangan[$count] . "','" . $idu . "')");
                $count = $count + 1;
            }
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '" . $idu . "'")->row();
            if ($a == $b) {
                $mail_1 = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = $idu")->result();
                $mail_result = "";
                $count = 1;
                foreach ($mail_1 as $a) {
                    if ($count != count($mail_1)) {
                        $or = "or ";
                    } else {
                        $or = "";
                    }
                    $mail_result .= "notadinas.master_user.jabatan = " . $a->id_jabatan . " " . $or;
                    $count = $count + 1;
                }
                if ($mail_result == "") {
                    $or = "";
                } else {
                    $or = "or";
                }
                $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE $mail_result $or notadinas.master_user.jabatan = 1")->result();
                foreach ($mail_2 as $b) {
                    $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
                $this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 2, opened = 2, updated_at = '$upd_date' WHERE id = $idu");
                $this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('" . $lpskids . "','" . $idu . "',NOW(),'" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','3','')");
            } else {
                $this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 0, opened = 0, updated_at = '$upd_date' WHERE id = $idu");
                $this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('" . $lpskids . "','" . $idu . "',NOW(),'" . $this->session->userdata('admin_id') . "','" . $cc->kepada . "','" . $cc->keterangan . "','1','')");
            }
            redirect(base_url() . 'admin/nota_dinas');
        } else if ($mau_ke == "verifikasi_nota_dinas") { // qaz
            $reqnya = $this->uri->segment(5);
            if ($reqnya == 'kepada') {
				$this->db->query("UPDATE notadinas.nota_dinas SET updated_at = '$upd_date', status_tujuan = 1 WHERE id = $idu");
            } elseif ($reqnya == 'tembusan') {
                $this->db->query("UPDATE notadinas.tembusan_nota_dinas SET status = 100 WHERE id_notadinas = $idu AND id_jabatan = " . $this->session->userdata('admin_jabatan'));
            }
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
			if ($reqnya == "kapush" or $this->session->userdata('admin_jabatan') == 1) {
                $variable_kapush = str_replace("1", "4", $a['datpil']->ka_waka_setum);
                $this->db->query("UPDATE notadinas.nota_dinas SET ka_waka_setum = '$variable_kapush', updated_at = '$upd_date' WHERE id = $idu");
            } else if ($reqnya == 'setum' or $this->session->userdata('admin_jabatan') == 2) {
                $variable_kapush = str_replace("2", "5", $a['datpil']->ka_waka_setum);
                $this->db->query("UPDATE notadinas.nota_dinas SET ka_waka_setum = '$variable_kapush', updated_at = '$upd_date' WHERE id = $idu");
            } else if ($reqnya == "waka" or $this->session->userdata('admin_jabatan') == 28) {
                $variable_kapush = str_replace("3", "6", $a['datpil']->ka_waka_setum);
                $this->db->query("UPDATE notadinas.nota_dinas SET ka_waka_setum = '$variable_kapush', updated_at = '$upd_date' WHERE id = $idu");
            }
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
            $this->db->query("UPDATE notadinas.feedback_nota_dinas SET baca = '1' WHERE id_nota_dinas = '$idu' AND penerima = '".$this->session->userdata('admin_jabatan')."'");
			$status = $this->db->query("SELECT status FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = '$idu' AND status = 100")->num_rows();
			$tembus = $this->db->query("SELECT id_notadinas FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = '$idu'")->num_rows();
			if($status == $tembus and $a['datpil']->status_tujuan==1){ // check if all user has been open the document
				$this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 5, updated_at = '$upd_date' WHERE id = $idu"); // do finish
			}
            $asd = $this->db->query("SELECT * from notadinas.tembusan_nota_dinas WHERE id_notadinas = $idu")->result();
            $array = [];
            foreach ($asd as $sd) {
                $array[$sd->id_notadinas][$sd->id_jabatan] = 1;
            }
            $a['tembusan'] = $array;
            $a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas INNER JOIN notadinas.master_proses_nota_dinas ON notadinas.log_proses_nota_dinas.id_proses = notadinas.master_proses_nota_dinas.id WHERE log_proses_nota_dinas.id_notadinas = $idu")->result();
			$a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE (id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0)) ORDER BY urutan ASC")->result();
            $a['user_n'] = $a['data'];
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_nota_dinas.*, notadinas.master_jabatan.*, notadinas.tembusan_nota_dinas.id AS idnya_tembusan FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE id_notadinas = '$idu' ORDER BY notadinas.master_jabatan.urut_jabatan")->result();
            $a['log'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas where id_proses = 1 and id_notadinas = '$idu'")->result();
            $a['kegiatan'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
            $a['page'] = "f_nota_dinas";
			$this->pushFirebase($this->session->userdata('admin_jabatan'));
        } else if ($mau_ke == "kirim_kelain") {
            $this->db->query("UPDATE notadinas.nota_dinas SET status_notadinas = 4, opened = 4 WHERE id = '" . $idu . "';");
            $lpskid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.log_proses_nota_dinas")->row();
            $lpskids = $lpskid->qwe + 1;
            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '" . $idu . "'")->row();
            $mail_1 = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = $idu")->result();
            $mail_result = "";
            $count = 1;
            $jabatan_push_notif = $cc->kepada . ",";
            foreach ($mail_1 as $a) {
                if ($count != count($mail_1)) {
                    $or = "or ";
                } else {
                    $or = "";
                }
                $jabatan_push_notif .= $a->id_jabatan . ",";
                $mail_result .= "notadinas.master_user.jabatan = " . $a->id_jabatan . " " . $or;
                $idJabatanForSocket[] = $a->id_jabatan;
                $count = $count + 1;
            }
            $jabatan_push_notif .= "1,2,28";
            $this->push_notification("Nota Dinas",$jabatan_push_notif);
            if ($mail_result == "") {
                $or = "";
            } else {
                $or = "or";
            }
            $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE $mail_result $or notadinas.master_user.jabatan = 1")->result();
            foreach ($mail_2 as $b) {
                $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
            }
            $this->db->query("INSERT INTO notadinas.log_proses_nota_dinas VALUES ('" . $lpskids . "','" . $idu . "','NOW()','" . $this->session->userdata('admin_id') . "','" . $cc->create_by . "','" . $cc->keterangan . "','2','')");
			$this->pushFirebase($jabatan_push_notif);

            $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = $idu")->row();
            /******************************************************
             *  Create Session for Socket Nota Dinas
             *  By : Daniel D Fortuna
             ******************************************************
             */
            $socketData = [];
            foreach($idJabatanForSocket as $id_jabatan){
                $socketData[] = [
                    'ka_waka_setum'       => 'unchecked',
                    'tgl_surat'           => date('Y-m-d'),
                    'tablenya'            => 'nota',
                    'status'              => 1,
                    'opened'              => $cc->opened,
                    'kepada'              => $cc->kepada,
                    'id_jabatan'          => $id_jabatan,
                    'perihal'             => $cc->perihal,
                    'status_surat_keluar' => $cc->status_surat_keluar,
                    'idnya'               => $cc->id,
                    'create_by'           => $cc->create_by
                ];
            }

            $_SESSION['socketAdded'] = $socketData;

            redirect(base_url() . 'admin/nota_dinas');
        } else if ($mau_ke == "cetak_input_tembusan") {
            $data = addslashes($this->input->post('data'));
            $count = addslashes($this->input->post('count'));
            $aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
            foreach ($aa as $aaa) {
                $bb = "
                    <input type='text' id='idjabatantembusan" . $aaa->id . "' name='jabatan[]' value='" . $aaa->id . "' readonly hidden/>
                    <input type='text' name='status[]' id='idstatustembusan" . $aaa->id . "' value='1' readonly hidden/>";
                $count++;
            }
            echo $bb;
            die();
        } else if ($mau_ke == "tambah_tembusan") {
           $data = addslashes($this->input->post('data'));
            $count = addslashes($this->input->post('count'));
            $aa = $this->db->query("SELECT * FROM notadinas.master_jabatan where id = '$data';")->result();
            foreach ($aa as $aaa) {
                $bb = "
                <tbody>
                <tr id='remove" . $count . "' style='vertical-align:top;'>
                    <td>" . $count . "</td>
                    <td>" . $aaa->nama_jabatan . "
                    </td>
                    <td>

                    </td>
                    <td><a class='btn btn-danger' onclick='removeD(". $count .",". $aaa->id .")'>HAPUS</a></td>
                </tr>
                </tbody>";
                $count++;
            }
            echo $bb;
            die();
        } else if ($mau_ke == "del") {
            $this->db->query("DELETE FROM notadinas.nota_dinas WHERE id = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/nota_dinas');
        } else if ($mau_ke == "cari") {
            $a['status_kadis'] = $this->db->query("SELECT *,notadinas.master_jabatan.nama_jabatan AS nama_kadis, notadinas.nota_dinas.id AS id_nota FROM notadinas.nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.nota_dinas.kepada = notadinas.master_jabatan.id WHERE notadinas.nota_dinas.status_notadinas = '4'")->result();
            $a['data_user'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan=notadinas.master_jabatan.id WHERE notadinas.master_user.id = '" . $this->session->userdata('admin_id') . "'")->row();
            // $a['data']      = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND (notadinas.nota_dinas.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.nota_dinas.no_surat LIKE '%$cari%') LIMIT $akhir OFFSET $awal")->result();
            // $total_row      = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND (notadinas.nota_dinas.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.nota_dinas.no_surat LIKE '%$cari%')")->num_rows();
            $a['data'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.master_user.jabatan FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND ((notadinas.nota_dinas.instansi='" . $this->session->userdata('admin_id') . "' and notadinas.nota_dinas.create_by=" . $this->session->userdata('admin_id') . ") or (notadinas.nota_dinas.kepada=" . $this->session->userdata('admin_jabatan') . ")) AND (notadinas.nota_dinas.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.nota_dinas.no_surat LIKE '%$cari%') UNION SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.tembusan_nota_dinas.id_jabatan FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by INNER JOIN notadinas.tembusan_nota_dinas ON notadinas.tembusan_nota_dinas.id_notadinas= notadinas.nota_dinas.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.tembusan_nota_dinas.id_jabatan = " . $this->session->userdata('admin_jabatan') . "AND (notadinas.nota_dinas.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.nota_dinas.no_surat LIKE '%$cari%') ORDER BY tgl_surat DESC LIMIT 10 OFFSET $awal")->result();
            $total_row = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.master_user.jabatan FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND ((notadinas.nota_dinas.instansi='" . $this->session->userdata('admin_id') . "' and notadinas.nota_dinas.create_by=" . $this->session->userdata('admin_id') . ") or (notadinas.nota_dinas.kepada=" . $this->session->userdata('admin_jabatan') . ")) AND (notadinas.nota_dinas.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.nota_dinas.no_surat LIKE '%$cari%') UNION SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.tembusan_nota_dinas.id_jabatan FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by INNER JOIN notadinas.tembusan_nota_dinas ON notadinas.tembusan_nota_dinas.id_notadinas= notadinas.nota_dinas.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.tembusan_nota_dinas.id_jabatan = " . $this->session->userdata('admin_jabatan') . "AND (notadinas.nota_dinas.perihal LIKE '%$cari%' OR notadinas.master_user.nama_lengkap LIKE '%$cari%' OR notadinas.nota_dinas.no_surat LIKE '%$cari%')")->num_rows();
            $asd = $this->db->query("SELECT * from notadinas.tembusan_nota_dinas")->result();
            $array = [];
            foreach ($asd as $sd) {
                $array[$sd->id_notadinas][$sd->id_jabatan] = 1;
            }
            $a['tembusan'] = $array;
            $a['keg'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.kegiatan_dinas.* FROM notadinas.nota_dinas INNER JOIN notadinas.kegiatan_dinas ON notadinas.nota_dinas.kegiatan_id = notadinas.kegiatan_dinas.id_kegiatan where notadinas.nota_dinas.status_notadinas >= 2;")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
            $a['page'] = "l_nota_dinas";
        } else if ($mau_ke == "add") {
            $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            $b = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE no_surat LIKE '%$year';")->result();
            $c = 0;
            foreach ($b as $d) {
                $e = explode('/', $d->no_surat);
                if ($e[1] > $c) {
                    $c = $e[1];
                }
            }
            if (!ctype_digit($c)) {
            if(isset($matches)){
            preg_match_all('!\d+!', $c, $matches);
            $max = $matches[0][0] + 1;
            // var_dump($matches);
            // die();
            }
            $max = $c+1;
            }else{

            $max = $c+1;
            }
            if (strlen($max) < 4) {
                if (strlen($max) < 3) {
                    if (strlen($max) < 2) {
                        $max = "000" . $max;
                    } else {
                        $max = "00" . $max;
                    }
                } else {
                    $max = "0" . $max;
                }
            }
            // $a['generated_no_surat'] = $max . "/" . $this->session->userdata('admin_id') . "/" . date('Y');
            $a['generated_no_surat'] = $max . "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            $a['kegiatan'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
            $a['aksiss'] = $this->db->query('SELECT * FROM notadinas.master_aksi ORDER BY urutan ASC')->result_array();
			$a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE (id = 1 OR id = 28 OR (urutan IS NOT NULL AND urutan != 0)) AND id != ". $this->session->userdata("admin_jabatan") ." ORDER BY urutan ASC")->result();
            $a['user_n'] = $a['data'];
            //$a['kegiatan']    = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
            $a['page'] = "f_nota_dinas";
        } else if ($mau_ke == "edt") {
            $a['log_surat_keluarnya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas INNER JOIN notadinas.master_proses_nota_dinas ON notadinas.log_proses_nota_dinas.id_proses = notadinas.master_proses_nota_dinas.id WHERE log_proses_nota_dinas.id_notadinas = $idu")->result();
            $a['lognya'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas WHERE id_notadinas = $idu ORDER BY id DESC")->row();
            $a['log'] = $this->db->query("SELECT * FROM notadinas.log_proses_nota_dinas where id_proses = 1 and id_notadinas = $idu")->row();
            $a['user_n'] = $this->db->query("SELECT * FROM notadinas.master_user where level = 'Admin'")->result();
            $a['kegiatan'] = $this->db->query("SELECT * FROM notadinas.kegiatan_dinas")->result();
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1  ORDER BY urut_jabatan ASC")->result();
            $a['datpil_tembusan'] = $this->db->query("SELECT notadinas.tembusan_nota_dinas.*, notadinas.master_jabatan.*, notadinas.tembusan_nota_dinas.id AS idnya_tembusan FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE id_notadinas = '$idu'")->result();
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '$idu'")->row();
            $a['page'] = "f_nota_dinas";
        } else if ($mau_ke == "act_add") { // qaz
            $id = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.nota_dinas")->row();
            $ids = $id->qwe + 1;
            $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
            $no_ag = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE no_agenda LIKE '%".$year."%'")->result();

            $f = [];
            if(empty($no_ag)){
                $no_urut = "0001";
            }else{
                foreach ($no_ag as $d) {
                    $e = explode('/', $d->no_agenda);
                    array_push($f, $e[1]);
                }
                $dt = max($f);
                $k = floatval($dt) + 1;
                $no_urut = str_pad($k, 4, "0", STR_PAD_LEFT);
            }
            $no_agn = "ND/".$no_urut."".$year;
            $jabatan = $this->input->post('jabatan');
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');

			$filez = "Tidak ada Dokumen";
			if($_FILES['file_attachment']['name']!=""){
				$file_name = $_FILES['file_attachment']['name'];
				$ext = explode('.', $file_name);
				$coba = str_replace('/', '-', $no_agn).".".$ext[1];
				$config['file_name']           =  $coba;
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file_attachment')) {
					$up_data = $this->upload->data();
					$filez = $up_data['file_name'];
				}
			}
			$count = 0;
			$pushFirebase = "1,2,28,$dari,";
			for ($ab = 1; $ab <= count($jabatan); $ab++) {
				$jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
				$jids = $jid->qwe + 1;
				$this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('" . $jids . "','" . $jabatan[$count] . "','1','" . $keterangan_tembusan[$count] . "','" . $ids . "')");
				$pushFirebase .= "$jabatan[$count],";
				$count = $count + 1;
			}
			$this->db->query("INSERT INTO notadinas.nota_dinas VALUES ('" . $ids . "', '" . $tgl_surat . "', '" . $this->session->userdata('admin_id') . "', '" . $this->input->post('no_surat') . "', '" . $perihal . "', '" . $ket . "', '" . $dari . "', '" . $isi_surat . "', '" . $this->input->post('klasifikasi') . "', '" . $this->input->post('derajat') . "', '4', '" . $this->session->userdata('admin_id') . "','".$filez."', '" . $keg_id . "',null,'100',null,'$no_agn','','" . 1 . "', '" . date("Y-m-d H:i", strtotime($this->input->post('tgl_mulai_tugas'))) . "', '" . date("Y-m-d H:i", strtotime($this->input->post('tgl_akhir_tugas'))) . "', '1-2-3', '" . $nama_tujuan . "', '$upd_date')");

			$this->pushFirebase($pushFirebase);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            //namvanka begin
            if ($this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28 ) {
                redirect('admin/nota_dinas/getDetailSendiri');
            }else{
                redirect('admin/nota_dinas');//*/
            }
            //end
        } else if ($mau_ke == "act_edt") {
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $keterangan_tembusan = $this->input->post('keterangan_tembusan');
            if ($this->session->userdata('admin_jabatan') == 1) {
                $st = 3;
                $cc = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE id = '" . $idp . "'")->row();
                $mail_2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $cc->create_by")->result();
                foreach ($mail_2 as $b) {
                    $ok = @mail($b->email, "Disposisi Surat Keluar", "Diterima surat keluar baru untuk ditindak lanjuti, dengan perihal $cc->perihal .", "From: pushidrosal.mail@gmail.com", "-f " . "pushidrosal.mail@gmail.com");
                }
            } else {
                $st = 1;
            }
            if ($this->upload->do_upload('file_attachment')) {
                $up_data = $this->upload->data();
                //edit juga saya bikin 1 jenis suratnya karna di form select nya dihilangkan
                $this->db->query("UPDATE notadinas.nota_dinas SET klasifikasi = '" . $this->input->post('klasifikasi') . "', drajat = '" . $this->input->post('derajat') . "', tgl_surat = '$tgl_surat', no_surat = '" . $this->input->post('no_surat') . "', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat', kegiatan_id = '" . $keg_id . "', jenis_surat = '1', tgl_mulai_tugas = '" . date("Y-m-d H:i", strtotime($this->input->post('tgl_mulai_tugas'))) . "', tgl_akhir_tugas = '" . date("Y-m-d H:i", strtotime($this->input->post('tgl_akhir_tugas'))) . "', file_attachment = '" . $up_data['file_name'] . "', updated_at = '$upd_date' WHERE id = '$idp'");
                // $this->db->query("UPDATE nota_dinas SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '".$up_data['file_name']."' WHERE id = '$idp'");
            } else {
                $this->db->query("UPDATE notadinas.nota_dinas SET klasifikasi = '" . $this->input->post('klasifikasi') . "', drajat = '" . $this->input->post('derajat') . "', tgl_surat = '$tgl_surat', no_surat = '" . $this->input->post('no_surat') . "', perihal = '$perihal', keterangan = '$ket', kepada = '$dari', isi = '$isi_surat', kegiatan_id = '" . $keg_id . "', jenis_surat = '1', tgl_mulai_tugas = '" . date("Y-m-d H:i", strtotime($this->input->post('tgl_mulai_tugas'))) . "', tgl_akhir_tugas = '" . date("Y-m-d H:i", strtotime($this->input->post('tgl_akhir_tugas'))) . "', updated_at = '$upd_date' WHERE id = '$idp'");
                // $this->db->query("UPDATE nota_dinas SET no_agenda = '$no_agenda', kode = '$kode', perihal = '$uraian', tujuan = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
            }
            $this->db->query("DELETE FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = '$idp'");
            $count = 0;
            for ($ab = 1; $ab <= count($jabatan); $ab++) {
                $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.tembusan_nota_dinas")->row();
                $jids = $jid->qwe + 1;
                $this->db->query("INSERT INTO notadinas.tembusan_nota_dinas VALUES ('" . $jids . "','" . $jabatan[$count] . "',1,'" . $keterangan_tembusan[$count] . "','" . $idp . "')");
                $count = $count + 1;
            }
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated " . $this->upload->display_errors() . "</div>");
            redirect('admin/nota_dinas');
        } else {
            $a['status_kadis'] = $this->db->query("SELECT *,notadinas.master_jabatan.nama_jabatan AS nama_kadis, notadinas.nota_dinas.id AS id_nota FROM notadinas.nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.nota_dinas.kepada = notadinas.master_jabatan.id WHERE notadinas.nota_dinas.status_notadinas = '4'")->result();
            $a['status_tembus'] = $this->db->query("SELECT *,notadinas.master_jabatan.nama_jabatan AS nama_kadis, notadinas.tembusan_nota_dinas.id_notadinas AS id_tembus FROM notadinas.tembusan_nota_dinas INNER JOIN notadinas.master_jabatan ON notadinas.tembusan_nota_dinas.id_jabatan = notadinas.master_jabatan.id WHERE notadinas.tembusan_nota_dinas.status = '1'")->result();
            $a['data_user'] = $this->db->query("SELECT * FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan=notadinas.master_jabatan.id WHERE notadinas.master_user.id = '" . $this->session->userdata('admin_id') . "'")->row();
            if ($this->session->userdata('admin_jabatan') == 28  or $this->session->userdata('admin_jabatan') == 1) {
                $a['data'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' LIMIT 10 OFFSET $awal")->result();
            } else if ($this->session->userdata('admin_tingkatan') == 1 or $this->session->userdata('admin_tingkatan') == 2) {
				if($this->session->userdata('admin_satuan')==6){
					$reqzx = (isset($_GET['r']))?$_GET['r']:1;
					if($reqzx==1){
						$sqlZ = "SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.master_jabatan.satuan = 6  ORDER BY id DESC";
					}elseif($reqzx==2){
						$sqlZ = "SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.master_jabatan.tingkatan IS NOT NULL ORDER BY id DESC";
					}elseif($reqzx==3){
						$sqlZ = "SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.master_jabatan.id = 1 OR notadinas.master_jabatan.id = 28 ORDER BY id DESC";
					}
				}else{
					$sqlZ = "SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.master_user.jabatan FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND ((notadinas.nota_dinas.instansi='" . $this->session->userdata('admin_id') . "' and notadinas.nota_dinas.create_by=" . $this->session->userdata('admin_id') . ") or (notadinas.nota_dinas.kepada=" . $this->session->userdata('admin_jabatan') . ")) UNION SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap, notadinas.tembusan_nota_dinas.id_jabatan FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by INNER JOIN notadinas.tembusan_nota_dinas ON notadinas.tembusan_nota_dinas.id_notadinas= notadinas.nota_dinas.id WHERE EXTRACT(YEAR FROM tgl_surat) = '$ta' AND notadinas.tembusan_nota_dinas.id_jabatan = " . $this->session->userdata('admin_jabatan') . " ORDER BY id DESC";
				}
				$a['data'] = $this->db->query($sqlZ ." LIMIT 10 OFFSET $awal")->result();
				$total_row = $this->db->query($sqlZ)->num_rows();
            }
			// $this->dd($a['data']); // qaz
            $a['keg'] = $this->db->query("SELECT * from notadinas.kegiatan_dinas")->result();
            $a['page'] = "l_nota_dinas";
        }
        $a['pagi'] = _page($total_row, 10, 4, base_url() . "admin/nota_dinas/p");

        $this->load->view('admin/aaa', $a);
    }

    public function surat_disposisi()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }


        //ambil variabel URL
        $mau_ke = $this->uri->segment(4);
        $idu1 = $this->uri->segment(3);
        $idu2 = $this->uri->segment(5);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $id_surat = addslashes($this->input->post('id_surat'));
        $kpd_yth = addslashes($this->input->post('kpd_yth'));
        $isi_disposisi = addslashes($this->input->post('isi_disposisi'));
        $sifat = addslashes($this->input->post('sifat'));
        $batas_waktu = addslashes($this->input->post('batas_waktu'));
        $catatan = addslashes($this->input->post('catatan'));

        $cari = addslashes($this->input->post('q'));

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM t_disposisi WHERE id_surat = '$idu1'")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, base_url() . "admin/surat_disposisi/" . $idu1 . "/p");

        $a['judul_surat'] = gval("notadinas.surat_masuk", "id", "perihal", $idu1);

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM t_disposisi WHERE id = '$idu2'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/surat_disposisi/' . $idu1);
        } else if ($mau_ke == "add") {
            $a['page'] = "f_surat_disposisi";
        } else if ($mau_ke == "edt") {
            $a['datpil'] = $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu2'")->row();
            $a['page'] = "f_surat_disposisi";
        } else if ($mau_ke == "act_add") {
            $this->db->query("INSERT INTO t_disposisi VALUES (NULL, '$id_surat', '$kpd_yth', '$isi_disposisi', '$sifat', '$batas_waktu', '$catatan')");

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            redirect('admin/surat_disposisi/' . $id_surat);
        } else if ($mau_ke == "act_edt") {
            $this->db->query("UPDATE t_disposisi SET kpd_yth = '$kpd_yth', isi_disposisi = '$isi_disposisi', sifat = '$sifat', batas_waktu = '$batas_waktu', catatan = '$catatan' WHERE id = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");
            redirect('admin/surat_disposisi/' . $id_surat);
        } else {
            $a['data'] = $this->db->query("SELECT * FROM t_disposisi WHERE id_surat = '$idu1' LIMIT $awal, $akhir ")->result();
            $a['page'] = "l_surat_disposisi";
        }

        $this->load->view('admin/aaa', $a);
    }

    public function pengguna()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $nama = addslashes($this->input->post('nama'));
        $alamat = addslashes($this->input->post('alamat'));
        $kepsek = addslashes($this->input->post('kepsek'));
        $nip_kepsek = addslashes($this->input->post('nip_kepsek'));

        $cari = addslashes($this->input->post('q'));

        //upload config
        $config['upload_path'] = './upload';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['max_size'] = '2000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';

        $this->load->library('upload', $config);

        if ($mau_ke == "act_edt") {
            if ($this->upload->do_upload('logo')) {
                $up_data = $this->upload->data();

                $this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kepsek = '$kepsek', nip_kepsek = '$nip_kepsek', logo = '" . $up_data['file_name'] . "' WHERE id = '$idp'");

            } else {
                $this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kepsek = '$kepsek', nip_kepsek = '$nip_kepsek' WHERE id = '$idp'");
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");
            redirect('admin/pengguna');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM tr_instansi WHERE id = '1' LIMIT 1")->row();
            $a['page'] = "f_pengguna";
        }

        $this->load->view('admin/aaa', $a);
    }

    public function agenda_surat_masuk()
    {
        $a['page'] = "f_config_cetak_agenda";
        $a['data'] = $this->db->query("SELECT * FROM notadinas.surat_masuk ORDER BY id asc")->result();
        $this->load->view('admin/aaa', $a);
    }

    public function agenda_surat_keluar()
    {
        $a['page'] = "f_config_cetak_agenda";
        $a['data'] = $this->db->query("SELECT notadinas.surat_keluar.* from notadinas.surat_keluar ORDER BY id asc")->result();
        $this->load->view('admin/aaa', $a);
    }

    public function agenda_nota_dinas()
    {
        $a['page'] = "f_config_cetak_agenda";
        $a['data'] = $this->db->query("SELECT notadinas.nota_dinas.*, notadinas.master_user.id as user_id, notadinas.master_user.nama_lengkap FROM notadinas.nota_dinas INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.nota_dinas.create_by ORDER BY id asc")->result();
        $this->load->view('admin/aaa', $a);
    }

    public function cetak_agenda()
    {
        $jenis_surat = $this->input->post('tipe');
        $tgl_start = $this->input->post('tgl_start');
        $tgl_end = $this->input->post('tgl_end');

        $a['tgl_start'] = $tgl_start;
        $a['tgl_end'] = $tgl_end;

        if ($jenis_surat == "agenda_surat_masuk") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
            $this->load->view('admin/agenda_surat_masuk', $a);
        } else if ($jenis_surat == "agenda_surat_keluar") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.surat_keluar WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
            $this->load->view('admin/agenda_surat_keluar', $a);
        } else if ($jenis_surat == "agenda_nota_dinas") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.nota_dinas WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
            $this->load->view('admin/agenda_nota_dinas', $a);
        }
    }
//prima
   public function manage_admin()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $username = addslashes($this->input->post('username'));
        $password = addslashes($this->input->post('password'));
        $password2 = md5(addslashes($password));
        $nama_lengkap = addslashes($this->input->post('nama_lengkap'));
        $email = addslashes($this->input->post('email'));
        $level = addslashes($this->input->post('level'));
        $jabatan = addslashes($this->input->post('jabatan'));
        $jenis = 1;
        $no_telp = addslashes($this->input->post('no_telp'));

        $cari = addslashes($this->input->post('q'));

        $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.master_user")->row();
        $jids = $jid->qwe + 1;
        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM notadinas.master_user WHERE id = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/manage_admin');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_user WHERE nama_lengkap LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "l_manage_admin";
        } else if ($mau_ke == "add") {
            $a['groups1'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1 ORDER BY urut_jabatan ASC")->result();
            $a['groups2'] = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab, c.nama_jabatan as nam_jab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan INNER JOIN notadinas.master_jabatan as c ON b.id_jabatan = c.id WHERE a.tingkatan = 2 ORDER BY c.urut_jabatan ASC,id_jab ASC ,urut_subjab ASC")->result();
            $a['page'] = "f_manage_admin";
        } else if ($mau_ke == "edt") {
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = '$idu'")->row();
            $a['groups1'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE tingkatan = 1 ORDER BY urut_jabatan ASC")->result();
            $a['groups2'] = $this->db->query("SELECT a.*, b.id_jabatan as id_jab, b.urut_subjabatan as urut_subjab, c.nama_jabatan as nam_jab FROM notadinas.master_jabatan as a INNER JOIN notadinas.master_subjabatan as b ON a.subdis = b.id_subjabatan INNER JOIN notadinas.master_jabatan as c ON b.id_jabatan = c.id WHERE a.tingkatan = 2 ORDER BY c.urut_jabatan ASC,id_jab ASC ,urut_subjab ASC")->result();
            $a['page'] = "f_manage_admin";
        } else if ($mau_ke == "act_add") {
            $cek_user_exist = $this->db->query("SELECT username FROM notadinas.master_user WHERE username = '$username'")->num_rows();

             if ($cek_user_exist > 0) {
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Username telah dipakai. Silahkan Ganti dengan Username yang lain.</div>");//ganti admin mei
            }else if($username == ""){
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Username Tidak Boleh Kosong</div>");//ganti admin mei
            }else {
                $this->db->query("INSERT INTO notadinas.master_user (id,username,password,nama_lengkap,email,no_telp,level,jabatan,status_jabatan) VALUES ('$jids', '$username', '$password2', '$nama_lengkap', '$email','$no_telp', '$level','$jabatan','$jenis')");
                $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            }

            // $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            redirect('admin/manage_admin');
        } else if ($mau_ke == "act_edt") {//ubah mei admin
                if($password == "-"){
                    $this->db->query("UPDATE notadinas.master_user SET username = '$username', nama_lengkap = '$nama_lengkap', email = '$email', level = '$level', no_telp = '$no_telp', jabatan = '$jabatan' WHERE id = '$idp'");    //ubah mei admin
                    // echo $password;
                }else{
                // $this->db->query("UPDATE notadinas.master_user SET nama_lengkap = '$nama_lengkap', email = '$email' WHERE id = '$idp'");
                $this->db->query("UPDATE notadinas.master_user SET username = '$username', password = '$password2', nama_lengkap = '$nama_lengkap', email = '$email', level = '$level', no_telp = '$no_telp', jabatan = '$jabatan' WHERE id = '$idp'");//ubah mei admin
                    // echo "ngga ada";
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");
            redirect('admin/manage_admin');
            die();
        } else {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_user")->result();
            $a['page'] = "l_manage_admin";
        }

        $this->load->view('admin/aaa', $a);

    }


//prima
    public function manage_jabatan()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(5);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $nama = addslashes($this->input->post('nama_jabatan'));
        $satuan = addslashes($this->input->post('satuan'));
        $tingkatan = addslashes($this->input->post('tingkatan'));
        $subdis = addslashes($this->input->post('subdis'));
        $statusada = addslashes($this->input->post('statusada'));
        $subjab = addslashes($this->input->post('subjab'));


        $cari = addslashes($this->input->post('q'));

        $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.master_jabatan")->row();
        $jids = $jid->qwe + 1;
        $subj = $this->db->query("SELECT MAX(id_subjabatan) AS qwa FROM notadinas.master_subjabatan")->row();
        $subjs = $subj->qwa + 1;
        if ($mau_ke == "del") {
            $ting = $this->uri->segment(4);
			$ting2 = $this->uri->segment(5);
			// echo $ting2;die();
            if($ting==1){
                // $jbtn = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = '$idp'")->row();
                // $sati = $jbtn->satuan;
                $this->db->query("DELETE FROM notadinas.master_jabatan WHERE id = '$ting2'");
            }else{
                $jbtn = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = '$idu'")->row();
                $subid = $jbtn->subdis;
                $this->db->query("DELETE FROM notadinas.master_subjabatan WHERE id_subjabatan = '$subid'");
                $this->db->query("DELETE FROM notadinas.master_jabatan WHERE id = '$idu'");
            }
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/manage_jabatan');
        } else if ($mau_ke == "cari") {
            //dirubah cari by intan kamelia
            $a['data'] = $this->db->query("select *, notadinas.master_jabatan.id as ids from notadinas.master_jabatan inner join notadinas.master_satuan on notadinas.master_jabatan.satuan = notadinas.master_satuan.id WHERE notadinas.master_jabatan.tingkatan = '1' and notadinas.master_jabatan.nama_jabatan like '%$cari%' ORDER BY urut_jabatan ASC")->result();
            $a['data2'] = $this->db->query("select *, notadinas.master_jabatan.id as ids from notadinas.master_jabatan inner join notadinas.master_satuan on notadinas.master_jabatan.satuan = notadinas.master_satuan.id WHERE notadinas.master_jabatan.tingkatan = '2' and notadinas.master_jabatan.nama_jabatan like '%$cari%' ORDER BY urut_jabatan ASC")->result();
            $a['page'] = "l_manage_jabatan";
        } else if ($mau_ke == "add") {
            $a['groups1'] = $this->db->query("SELECT * FROM notadinas.master_satuan ORDER BY urut_satuan ASC")->result();
            $a['groups2'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan IS NOT NULL and id NOT IN (29, 31) ORDER BY id ASC, urut_jabatan ASC")->result();
            $a['page'] = "f_manage_jabatan";
        } else if ($mau_ke == "edt") {
            $ting = $this->uri->segment(4);
            if($ting==1){
                $a['datpil'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = '$idu'")->row();
            }else{
                $a['datpil'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = '$idu'")->row();
            }
            $a['groups1'] = $this->db->query("SELECT * FROM notadinas.master_satuan ORDER BY urut_satuan ASC")->result();
            $a['groups2'] = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan IS NOT NULL and id NOT IN (29, 31) ORDER BY id ASC, urut_jabatan ASC")->result();
            $a['page'] = "f_manage_jabatan";
        } else if ($mau_ke == "act_add") {
            if($tingkatan == 1){
                $cek_user_exist = $this->db->query("SELECT nama_jabatan FROM notadinas.master_jabatan WHERE nama_jabatan = '$nama'")->num_rows();
                if ($cek_user_exist > 0) {
                    $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Jabatan Sudah Ada.</div>");
                }else if($nama == ""){
                    $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Jabatan Tidak Boleh Kosong !</div>");
                }else {
                    $idsat = $this->db->query("SELECT MAX(id) AS qwa FROM notadinas.master_satuan")->row();
                    $idsats = $idsat->qwa + 1;
                    $ursat = $this->db->query("SELECT MAX(urut_satuan) AS qwe FROM notadinas.master_satuan")->row();
                    $urisat = $ursat->qwe + 1;
                    $this->db->query("INSERT INTO notadinas.master_satuan (id,nama_satuan, urut_satuan) VALUES ('$idsats', '$nama', '$urisat')");
                    $urid = $this->db->query("SELECT MAX(urut_jabatan) AS qwo FROM notadinas.master_jabatan")->row();
                    $urids = $urid->qwo + 1;
					$uv = $this->input->post('urutan_view');
                    $this->db->query("INSERT INTO notadinas.master_jabatan (id,nama_jabatan,satuan,tingkatan,grup,urutan, urut_jabatan, urutan_view) VALUES ('$jids', '$nama', '$idsats', '$tingkatan', '2','0', '$urids','$uv')");
                    $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
                }
            }else{
                        $cek_user_exist = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE nama_jabatan = '$nama' AND satuan = '$satuan'")->num_rows();
                        if ($cek_user_exist > 0) {
                            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Sub Jabatan Sudah Ada.</div>");
                        }else if($nama == ""){
                            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Sub Jabatan Tidak Boleh Kosong !</div>");
                        }else {
                            $jab_id = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = '$satuan' AND tingkatan = '1'")->row();
                            $jabs_id = $jab_id->id;
                            $uridsub = $this->db->query("SELECT MAX(urut_subjabatan) AS qwi FROM notadinas.master_subjabatan WHERE id_jabatan = '$jabs_id'")->row();
                            $uridsubs = $uridsub->qwi + 1;
                            $this->db->query("INSERT INTO notadinas.master_subjabatan (id_subjabatan,nama_subjabatan,id_jabatan,urut_subjabatan) VALUES ('$subjs', '$nama', '$jabs_id', '$uridsubs')");
                            $urid = $this->db->query("SELECT MAX(urut_jabatan) AS qwo FROM notadinas.master_jabatan")->row();
                            $urids = $urid->qwo + 1;

                            $this->db->query("INSERT INTO notadinas.master_jabatan (id,nama_jabatan,satuan,tingkatan,grup,urutan, subdis,urut_jabatan, urutan_view) VALUES ('$jids', '$nama', '$satuan', '$tingkatan', '2','0', '$subjs','$urids','$uv')");
                            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
                        }
            }

            // $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
            redirect('admin/manage_jabatan');
        } else if ($mau_ke == "act_edt") {
            $disatuan = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = '$idp'")->row();
            $ting = $disatuan->tingkatan;
            if($ting == $tingkatan){
                if($tingkatan == 1){
					// echo "1";die();
					$urutan_view = $_POST['urutan_view'];
                    $idsati = $disatuan->satuan;
                    $this->db->query("UPDATE notadinas.master_jabatan SET urutan_view = '$urutan_view', urutan = '$urutan_view', nama_jabatan = '$nama' WHERE id = '$idp'");
                    $this->db->query("UPDATE notadinas.master_satuan SET nama_satuan = '$nama' WHERE id = '$idsati'");
                }else{
					// echo "2";die();
					$urutan_view = $_POST['urutan_view'];
                    $this->db->query("UPDATE notadinas.master_jabatan SET urutan_view = '$urutan_view', urutan = '$urutan_view', nama_jabatan = '$nama', satuan = '$satuan' WHERE id = '$idp'");
                    $jbtn = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = '$idp'")->row();
                    $subjb = $jbtn->subdis;
                    $jbtn2 = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = '$satuan' AND tingkatan = '1'")->row();
                    $jb1 = $jbtn2->id;
                    $uridsub = $this->db->query("SELECT MAX(urut_subjabatan) AS qwi FROM notadinas.master_subjabatan WHERE id_jabatan = '$jb1'")->row();
                    $ursub = $uridsub->qwi + 1;
                    $this->db->query("UPDATE notadinas.master_subjabatan SET nama_subjabatan = '$nama', id_jabatan = '$jb1', urut_subjabatan = '$ursub' WHERE id_subjabatan = '$subjb'");
                }
            }else{
                if($tingkatan == 1){
                    $jbsub = $disatuan->subdis;
                    $this->db->query("DELETE FROM notadinas.master_subjabatan WHERE id_subjabatan = '$jbsub'");
                    $idsat = $this->db->query("SELECT MAX(id) AS qwa FROM notadinas.master_satuan")->row();
                    $idsats = $idsat->qwa + 1;
                    $ursat = $this->db->query("SELECT MAX(urut_satuan) AS qwe FROM notadinas.master_satuan")->row();
                    $urisat = $ursat->qwe + 1;
                    $this->db->query("INSERT INTO notadinas.master_satuan (id,nama_satuan, urut_satuan) VALUES ('$idsats', '$nama', '$urisat')");
                    $this->db->query("UPDATE notadinas.master_jabatan SET nama_jabatan = '$nama', satuan = '$idsats', tingkatan = '$tingkatan', subdis = null WHERE id = '$idp'");
                }else{
                    $satjb = $disatuan->satuan;
                    $idsub = $this->db->query("SELECT MAX(id_subjabatan) AS qwa FROM notadinas.master_subjabatan")->row();
                    $idsubs = $idsub->qwa + 1;
                    $jb4 = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE satuan = '$satuan' AND tingkatan = '1'")->row();
                    $jb4s = $jb4->id;
                    $uridsub = $this->db->query("SELECT MAX(urut_subjabatan) AS qwi FROM notadinas.master_subjabatan WHERE id_jabatan = '$jb4s'")->row();
                    $uridsubs = $uridsub->qwi + 1;
                    $this->db->query("INSERT INTO notadinas.master_subjabatan (id_subjabatan,nama_subjabatan,id_jabatan,urut_subjabatan) VALUES ('$idsubs', '$nama', '$jb4s', '$uridsubs')");
                    // $this->db->query("INSERT INTO notadinas.master_satuan (id,nama_satuan, urut_satuan) VALUES ('$idsats', '$nama', '$urisat')");
                    $this->db->query("UPDATE notadinas.master_jabatan SET nama_jabatan = '$nama', satuan = '$satuan', tingkatan = '$tingkatan', subdis = '$idsubs' WHERE id = '$idp'");
                    $this->db->query("DELETE FROM notadinas.master_satuan WHERE id = '$satjb'");
                }
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");
            redirect('admin/manage_jabatan');
        } else {
            $a['data'] = $this->db->query("select *, notadinas.master_jabatan.id as ids from notadinas.master_jabatan inner join notadinas.master_satuan on notadinas.master_jabatan.satuan = notadinas.master_satuan.id WHERE notadinas.master_jabatan.tingkatan = '1' ORDER BY urut_jabatan ASC")->result();
            // $a['data2'] = $this->db->query("select *, notadinas.master_jabatan.id as ids, notadinas.master_jabatan.urut_jabatan as urut_jab, notadinas.master_jabatan.nama_jabatan as nam_jab from notadinas.master_subjabatan inner join notadinas.master_jabatan on notadinas.master_subjabatan.id_jabatan = notadinas.master_jabatan.id ORDER BY urut_jab ASC, urut_subjabatan ASC")->result();
            $a['data2'] = $this->db->query("select *, notadinas.master_jabatan.id as ids from notadinas.master_jabatan inner join notadinas.master_satuan on notadinas.master_jabatan.satuan = notadinas.master_satuan.id WHERE notadinas.master_jabatan.tingkatan = '2' ORDER BY urut_jabatan ASC")->result();
            $a['page'] = "l_manage_jabatan";
        }

        $this->load->view('admin/aaa', $a);

    }

    public function manage_satker()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $nama = addslashes($this->input->post('nama_satuan'));

        $jid = $this->db->query("SELECT MAX(id) AS qwe FROM notadinas.master_satuan")->row();
        $jids = $jid->qwe + 1;
        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM notadinas.master_satuan WHERE id = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/manage_satker');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_satuan WHERE nama_satuan LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "l_manage_satker";
        } else if ($mau_ke == "add") {
            $a['page'] = "f_manage_satker";
        } else if ($mau_ke == "edt") {
            $a['datpil'] = $this->db->query("SELECT * FROM notadinas.master_satuan WHERE id = '$idu'")->row();
            $a['page'] = "f_manage_satker";
        } else if ($mau_ke == "act_add") {
            if($nama==""){
                $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Satuan Tidak Boleh Kosong !</div>");
            }else{
                $cek_user_exist = $this->db->query("SELECT nama_satuan FROM notadinas.master_satuan WHERE nama_satuan = '$nama'")->num_rows();

                 if ($cek_user_exist > 0) {
                    $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Satuan Sudah Ada</div>");
                }else {
                    $urid = $this->db->query("SELECT MAX(urut_satuan) AS qwo FROM notadinas.master_satuan")->row();
                    $urids = $urid->qwo + 1;
                    $this->db->query("INSERT INTO notadinas.master_satuan (id,nama_satuan, urut_satuan) VALUES ('$jids', '$nama', '$urids')");
                    $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data sudah ditambahkan</div>");
                }
            }
            redirect('admin/manage_satker');
        } else if ($mau_ke == "act_edt") {
            $this->db->query("UPDATE notadinas.master_satuan SET nama_satuan = '$nama' WHERE id = '$idp'");

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");
            redirect('admin/manage_satker');
        } else {
            $a['data'] = $this->db->query("select * FROM notadinas.master_satuan ORDER BY urut_satuan ASC")->result();
            $a['page'] = "l_manage_satker";
        }

        $this->load->view('admin/aaa', $a);

    }

    public function get_klasifikasi()
    {
        $kode = $this->input->post('kode', TRUE);

        $data = $this->db->query("SELECT id, kode, nama FROM ref_klasifikasi WHERE kode LIKE '%$kode%' ORDER BY id ASC")->result();

        $klasifikasi = array();
        foreach ($data as $d) {
            $json_array = array();
            $json_array['value'] = $d->kode;
            $json_array['label'] = $d->kode . " - " . $d->nama;
            $klasifikasi[] = $json_array;
        }

        echo json_encode($klasifikasi);
    }

    public function get_instansi_lain()
    {
        $kode = $this->input->post('dari', TRUE);

        $data = $this->db->query("SELECT dari FROM notadinas.surat_masuk WHERE dari LIKE '%$kode%' GROUP BY dari")->result();

        $klasifikasi = array();
        foreach ($data as $d) {
            $klasifikasi[] = $d->dari;
        }

        echo json_encode($klasifikasi);
    }

    public function cek_usernameoffice()//ganti admin mei
    {
        $this->eoffice = $this->load->database('eoffice', TRUE);
        $kode = $this->input->post('user', TRUE);

        $data = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$kode'")->row();
        if($kode!=null){
            if(empty($data)){
                echo json_encode("0");
            }else{
                echo json_encode($data->first_name);
            }
        }else{
            echo json_encode("1");
        }
    }

    public function disposisi_cetak()
    {
        $idu = $this->uri->segment(3);
        $a['datpil1'] = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id = '$idu'")->row();
        $a['datpil2'] = $this->db->query("SELECT kpd_yth FROM t_disposisi WHERE id_surat = '$idu'")->result();
        $a['datpil3'] = $this->db->query("SELECT isi_disposisi, sifat, batas_waktu FROM t_disposisi WHERE id_surat = '$idu'")->result();
        $this->load->view('admin/f_disposisi', $a);
    }

    public function passwod()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $ke = $this->uri->segment(3);
        $id_user = $this->session->userdata('admin_id');

        //var post
        $p1 = md5($this->input->post('p1'));
        $p2 = md5($this->input->post('p2'));
        $p3 = md5($this->input->post('p3'));

        /***********************************************
         ** Feature Rubah Password user
         ** By: Muhamad Farhan Badrussalam
         ***********************************************/
        if ($ke == "simpan") {
            $cek_password_lama = $this->db->query("SELECT password FROM notadinas.master_user WHERE id = $id_user")->row();
            //echo

            if ($cek_password_lama->password != $p1) {
                $this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Lama tidak sama</div>');
                redirect('admin/passwod');
            } else if ($p2 != $p3) {
                $this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Baru 1 dan 2 tidak cocok</div>');
                redirect('admin/passwod');
            } else {
                $this->db->query("UPDATE notadinas.master_user SET password = '$p3' WHERE id = " . $id_user . "");
                $this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-success">Password berhasil diperbaharui</div>');
                redirect('admin/passwod');
            }
        } else {
            $a['page'] = "f_passwod";
        }

        $this->load->view('admin/aaa', $a);
    }
	
	public function log(){
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $a['page'] = "log";

        $this->load->view('admin/aaa', $a);
    }
	
	public function master_aksi(){
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }

        $a['page'] = "master_aksi";

        $this->load->view('admin/aksi', $a);
    }
	public function aksi_data(){
		$_REQUEST = $_GET;
		$length = $_REQUEST['length']; //limit data per page
		$search = $_REQUEST['search']['value']; //filter keyword
		$start = $_REQUEST['start']; //offset data
		$draw = $_REQUEST['draw'];
		// query
		$search_query = "";
		if($search!=null and $search!=""){ //if filter is on
			$search_query = " WHERE notadinas.master_aksi.nama_aksi ILIKE '%$search%'";
		}
		$query = "SELECT notadinas.master_aksi.id, notadinas.master_aksi.nama_aksi, notadinas.master_aksi.urutan FROM notadinas.master_aksi ".$search_query." ORDER BY notadinas.master_aksi.urutan ASC";
		$recordsTotal = $this->db->query($query)->num_rows(); //count all data by id sub category
		$perpage = " OFFSET $start LIMIT $length";
		$query = $this->db->query($query . $perpage)->result();
		$recordsFiltered = $recordsTotal;
		//response
		$data = '{
			"draw": '.$draw.',
			"recordsTotal": '.$recordsTotal.',
			"recordsFiltered": '.$recordsFiltered.',
			"data": [';
		$i = 1;
		foreach($query as $a){ //loop
			$data .= '[
			  "'.($i+$start).'",
			  "'.$a->nama_aksi.'",
			  "<center>'.$a->urutan.'</center>",
			  "'.$this->aksi_link($a->id).'"
			]';
			if($i!=count($query)){
				$data .= ',';
			}
			$i++;
		}
		$data .= ']}';
		echo $data;
	}
	
	public function aksi_link($id){
		//$data = $this->db->query("SELECT notadinas.master_aksi.nama_aksi, notadinas.master_aksi.urutan FROM notadinas.master_aksi WHERE notadinas.master_aksi.id = $id")->row();
		
					/*<a href="<?php echo base_URL(); ?>admin/manage_admin/edt/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>
					//<a href="<?php echo base_URL(); ?>admin/manage_admin/del/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hap</a><!--ubah mei bahasa-->	
				// </div> */	
		$a = "<center><div class='btn-group'>";
		$a .= "<a href='".base_URL()."admin/edit_aksi/".$id."' class='btn btn-success btn-sm' title='Edit Data'><i class='icon-edit icon-white'> </i> Edt</a>";
		$a .= "<a href='".base_URL()."admin/hapus_aksi/".$id."' class='btn btn-warning btn-sm' title='Hapus Data' onclick='return confirm('Anda Yakin..?')'><i class='icon-trash icon-remove'>  </i> Hps</a>";
		$a .= "</div></center>";
		
		return $a;
	}
	
	public function edit_aksi($id){
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
		$a['idnya'] = $id;
		$a['data'] = $this->db->query("SELECT notadinas.master_aksi.nama_aksi, notadinas.master_aksi.urutan FROM notadinas.master_aksi WHERE notadinas.master_aksi.id = $id")->result();
        $a['page'] = "edit_aksi";

        $this->load->view('admin/aksi', $a);
    }
	
	public function tambahaksi(){
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
		//$a['idnya'] = $id;
		// $a['data'] = $this->db->query("SELECT notadinas.master_aksi.nama_aksi, notadinas.master_aksi.urutan FROM notadinas.master_aksi WHERE notadinas.master_aksi.id = $id")->result();
        $a['page'] = "tambah_aksi";

        $this->load->view('admin/aksi', $a);
    }
	
	public function aksi_update(){
		 $idp = $_POST['idp'];
		 $nama_aksi = $_POST['nama_aksi'];
		 $urutan = $_POST['urutan'];
		 $this->db->query("UPDATE notadinas.master_aksi SET nama_aksi = '".$nama_aksi."', urutan = '".$urutan."'  WHERE id = '".$idp."'");
		redirect(base_url() . 'admin/master_aksi');
		// echo $nama_aksi."ada";die();
	}
	
	public function aksi_simpan(){
		 $nama_aksi = $_POST['nama_aksi'];
		 $urutan = $_POST['urutan'];
		// $this->db->query("UPDATE notadinas.master_aksi SET nama_aksi = '".$nama_aksi."', urutan = '".$urutan."'  WHERE id = '".$idp."'");
		 $this->db->query("INSERT INTO notadinas.master_aksi (nama_aksi, urutan) VALUES ('".$nama_aksi."', '".$urutan."')");     
		redirect(base_url() . 'admin/master_aksi');
		// echo $nama_aksi."ada";die();
	}
	
	public function hapus_aksi($id){
		 
		 $this->db->query("delete from notadinas.master_aksi where id='".$id."'");     
		redirect(base_url() . 'admin/master_aksi');
		// echo $nama_aksi."ada";die();
	}
	
	public function log_data(){
		$_REQUEST = $_GET;
		$length = $_REQUEST['length']; //limit data per page
		$search = $_REQUEST['search']['value']; //filter keyword
		$start = $_REQUEST['start']; //offset data
		$draw = $_REQUEST['draw'];
		// query
		$search_query = "";
		if($search!=null and $search!=""){ //if filter is on
			$search_query = " WHERE notadinas.master_user.nama_lengkap ILIKE '%$search%'";
		}
		$query = "SELECT notadinas.log_user.user, notadinas.master_user.nama_lengkap, notadinas.log_user.datetime FROM notadinas.log_user INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.log_user.user".$search_query." ORDER BY notadinas.log_user.datetime DESC";
		$recordsTotal = $this->db->query($query)->num_rows(); //count all data by id sub category
		$perpage = " OFFSET $start LIMIT $length";
		$query = $this->db->query($query . $perpage)->result();
		$recordsFiltered = $recordsTotal;
		//response
		$data = '{
			"draw": '.$draw.',
			"recordsTotal": '.$recordsTotal.',
			"recordsFiltered": '.$recordsFiltered.',
			"data": [';
		$i = 1;
		foreach($query as $a){ //loop
			$data .= '[
			  "'.($i+$start).'",
			  "'.$a->nama_lengkap.'",
			  "'.$a->datetime.'",
			  "'.$this->log_link($a->user,$a->datetime).'"
			]';
			if($i!=count($query)){
				$data .= ',';
			}
			$i++;
		}
		$data .= ']}';
		echo $data;
	}
	
	public function log_link($id,$datetime){
		$data = $this->db->query("SELECT notadinas.master_user.nama_lengkap, notadinas.master_user.username, notadinas.master_jabatan.nama_jabatan, notadinas.master_satuan.nama_satuan, notadinas.master_tingkatan.nama_tingkatan FROM notadinas.master_user LEFT JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id = notadinas.master_user.jabatan LEFT JOIN notadinas.master_satuan ON notadinas.master_jabatan.satuan = notadinas.master_satuan.id LEFT JOIN notadinas.master_tingkatan ON notadinas.master_jabatan.tingkatan = notadinas.master_tingkatan.id WHERE notadinas.master_user.id = $id")->row();
		$a = "<a class='btn btn-info btn-sm' onclick='f(this)' title='Rincian'>";
		$a .= "<span class='fa fa-external-link'></span>";
		$a .= "<span class='_dataNama' hidden>$data->nama_lengkap</span>";
		$a .= "<span class='_dataUsername' hidden>$data->username</span>";
		$a .= "<span class='_dataJabatan' hidden>$data->nama_jabatan</span>";
		$a .= "<span class='_dataSatuan' hidden>$data->nama_satuan</span>";
		$a .= "<span class='_dataTingkatan' hidden>$data->nama_tingkatan</span>";
		$a .= "<span class='_dataDatetime' hidden>$datetime</span>";
		$a .= "</a>";
		return $a;
	}

    public function login()
    {
        $this->load->view('admin/login');
    }

    public function do_login()
    {
        $u = $this->security->xss_clean($this->input->post('u'));
        $ta = $this->security->xss_clean($this->input->post('ta'));
        $p = md5($this->security->xss_clean($this->input->post('p')));


        $q_cek = $this->db->query("SELECT notadinas.master_user.*, notadinas.master_jabatan.tingkatan, notadinas.master_jabatan.satuan FROM notadinas.master_user JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id = notadinas.master_user.jabatan WHERE notadinas.master_user.username = '" . $u . "' AND notadinas.master_user.password = '" . $p . "'");
        $j_cek = $q_cek->num_rows();
        $d_cek = $q_cek->row();
        //echo $this->db->last_query();

        if ($j_cek == 1) {
            $data = array(
                'admin_id' => $d_cek->id,
                'admin_user' => $d_cek->username,
                'admin_nama' => $d_cek->nama_lengkap,
                'admin_ta' => $ta,
                'admin_jabatan' => $d_cek->jabatan,
                'admin_status' => $d_cek->status_jabatan,
                'admin_level' => $d_cek->level,
                'admin_valid' => true,
                'admin_tingkatan' => $d_cek->tingkatan,
                'admin_satuan' => $d_cek->satuan
            );
            $this->session->set_userdata($data);
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date("d-m-Y H:i:s");
			$this->db->query("INSERT INTO notadinas.log_user VALUES(DEFAULT,".$this->session->userdata('admin_id').",'$datetime');");
            redirect('admin');
        } else {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
            redirect('admin/login');
        }
    }

    public function do_login_()
    {
        $u = $this->security->xss_clean($this->input->get('u'));
        $ta = $this->security->xss_clean($this->input->get('ta'));
        $link = $this->security->xss_clean($this->input->get('l'));
        $p = $this->security->xss_clean($this->input->get('p'));

        $q_cek = $this->db->query("SELECT notadinas.master_user.*, notadinas.master_jabatan.tingkatan, notadinas.master_jabatan.satuan FROM notadinas.master_user JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id = notadinas.master_user.jabatan WHERE notadinas.master_user.username = '" . $u . "' AND notadinas.master_user.password = '" . $p . "'");
        $j_cek = $q_cek->num_rows();
        $d_cek = $q_cek->row();
        //echo $this->db->last_query();

        if ($j_cek == 1) {
            $data = array(
                'admin_id' => $d_cek->id,
                'admin_user' => $d_cek->username,
                'admin_nama' => $d_cek->nama_lengkap,
                'admin_ta' => $ta,
                'admin_jabatan' => $d_cek->jabatan,
                'admin_status' => $d_cek->status_jabatan,
                'admin_level' => $d_cek->level,
                'admin_valid' => true,
                'admin_tingkatan' => $d_cek->tingkatan,
                'admin_satuan' => $d_cek->satuan
            );
            $this->session->set_userdata($data);
			if($link=="notadinas"){
				redirect('admin/nota_dinas/nota_dinas');
			}else if($link=="suratmasuk"){
				redirect('admin/surat_masuk');
			}else{
				redirect('admin');
			}
        } else {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
            redirect('admin/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    public function generate_filename()
    {

        if ($this->input->get('q') == 1) {
            $q = "surat_keluar";
        } else if ($this->input->get('q') == 2) {
            $q = "surat_masuk";
        } else if ($this->input->get('q') == 21) {
            $q = "surat_antar_kadis";
        } else {
            $year = "-" . $this->angka_romawi(date('n')) . "-" . date('Y');
            $q = "nota_dinas WHERE file_attachment ILIKE '%".$year."%';";
        }
        $a = $this->db->query("select max(file_attachment) from notadinas.$q")->row();
        $b = explode(".", $a->max);
        $c = explode("-", $b[0]);
        if (!isset($c[1])) {
            $c[1] = 0;
        }
        $d = $c[1] + 1;
        if (strlen($d) < 4) {
            if (strlen($d) < 3) {
                if (strlen($d) < 2) {
                    if (strlen($d) < 1) {
                    } else {
                        echo "000" . $d;
                    }
                } else {
                    echo "00" . $d;
                }
            } else {
                echo "0" . $d;
            }
        } else {
            echo $d;
        }
    }

    /***********************************************
     ** Feature Cetak nomer surat keluar
     ** By: Muhamad Farhan Badrussalam
     ***********************************************/
    public function cetak_no_lampiran($a, $b, $c, $d)
    {
        if($d!="null"){
            $asd = ['a' => $a . "-" . $b . "-" . $c . "-" . $d ];
        }else{
            $asd = ['a' => $a . "-" . $b . "-" . $c ];
        }
        $this->load->view('admin/notadinas/cetak_nolampiran', $asd);
    }

    public function cetak_no_lampiran_sm($a, $b, $c, $d = NULL)//ubah mei surmas8
    {
        $asd = ['a' => $a . "-" . $b . "-" . $c . "-" . $d];
        $this->load->view('admin/notadinas/cetak_nolampiran', $asd);
    }

    public function set_nosetum()//ubah mei surmas5
    {
        $year = "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
        $b = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE no_setum LIKE '%$year';")->result();//coba ganti mei
        $c = 0;
        $idis = $_POST['id'];
        $f = [];
        if(empty($b)){
            $l = "0001";
        }else{
            if($idis==1){
                $a = "B";
                foreach ($b as $d) {
                    $e = explode('/', $d->no_setum);
                    $h = stripos($e[1], ".");
                    if($e[0]==$a && $h==false){
                        $g = $e[0];
                        array_push($f, $e[1]);
                    }
                }
            }else if($idis==2){
                $a = "R";
                foreach ($b as $d) {
                    $e = explode('/', $d->no_setum);
                    $h = stripos($e[1], ".");
                    if($e[0]==$a && $h==false){
                        $g = $e[0];
                        array_push($f, $e[1]);
                    }
                }
            }else if($idis==3){
                $a = "Tgmb";
                foreach ($b as $d) {
                    $e = explode('/', $d->no_setum);
                    $h = stripos($e[1], ".");
                    if($e[0]==$a && $h==false){
                        $g = $e[0];
                        array_push($f, $e[1]);
                    }
                }
            }else if($idis==4){
                $a = "Tgmr";
                foreach ($b as $d) {
                    $e = explode('/', $d->no_setum);
                    $h = stripos($e[1], ".");
                    if($e[0]==$a && $h==false){
                        $g = $e[0];
                        array_push($f, $e[1]);
                    }
                }
            }else if($idis==5){
                $a = "B";
                foreach ($b as $d) {
                    $e = explode('/', $d->no_setum);
                    $h = stripos($e[1], ".");
                    if($e[0]==$a && $h==true){
                        $j = explode('.', $e[1]);
                        if($j[0]=="Lua"){
                            $g = $e[0];
                            array_push($f, $j[1]);
                        }
                    }
                }
            }else if($idis==6){
                $a = "B";
                foreach ($b as $d) {
                    $e = explode('/', $d->no_setum);
                    $h = stripos($e[1], ".");
                    if($e[0]==$a && $h==true){
                        $j = explode('.', $e[1]);
                        if($j[0]=="Und"){
                            $g = $e[0];
                            array_push($f, $j[1]);
                        }
                    }
                }
            }
            if(!empty($f)){
                $dt = max($f);
                $k = floatval($dt) + 1;
                $l = str_pad($k, 4, "0", STR_PAD_LEFT);
            }else{
                $l = "0001";
            }
        }
        $m = $l . "/" . $this->angka_romawi(date('n')) . "/" . date('Y');
        echo $m;
        die();
    }

    public function master_doktrin()
    {
        $id_buku = addslashes($this->input->post('id_buku'));
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $id_kategori = addslashes($this->input->post('id_kategori'));
        $judul_peraturan = addslashes($this->input->post('judul_peraturan'));
        $deskripsi_peraturan = addslashes($this->input->post('deskripsi_peraturan'));
        $nama_buku = addslashes($this->input->post('nama_buku'));
        $pengarang = addslashes($this->input->post('pengarang'));
        $judul_halaman = addslashes($this->input->post('judul_halaman'));
        $terbit = addslashes($this->input->post('terbit'));
        $cari = addslashes($this->input->post('q'));

		$id_buku = str_replace('\"', '"', $id_buku);
		$tanggal = str_replace('\"', '"', $tanggal);
		$id_kategori = str_replace('\"', '"', $id_kategori);
		$judul_peraturan = str_replace('\"', '"', $judul_peraturan);
		$deskripsi_peraturan = str_replace('\"', '"', $deskripsi_peraturan);
		$nama_buku = str_replace('\"', '"', $nama_buku);
		$pengarang = str_replace('\"', '"', $pengarang);
		$judul_halaman = str_replace('\"', '"', $judul_halaman);
		$terbit = str_replace('\"', '"', $terbit);


        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $id_doktrin = $this->uri->segment(4);
//        echo $id_doktrin;die();
        if ($aksi == "add") {
            $a['kategori'] = $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
            $a['page'] = "f_master_doktrin";
        }
        /***********************************************
         ** Feature Cari
         ** By: Muhamad Farhan Badrussalam
         ***********************************************/
        else if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_doktrin WHERE judul_peraturan LIKE '%$cari%' ORDER BY id_doktrin DESC")->result();
            $a['page'] = "l_master_doktrin";
        }
         else if ($aksi == "m_doktrin") {

            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_doktrin")->result();
            $a['page'] = "l_master_doktrin";
        } else if ($aksi == "save") {
            if ($_FILES['file']) {
                $config['upload_path'] = './upload/master_doktrin/';
                $config['allowed_types'] = '*';
                $config['max_size'] = "500000000";  //500MB
                $config['overwrite'] = FALSE;

                if (is_file($config['upload_path'] = './upload/master_doktrin/')) {
                    chmod($config['upload_path'] = './upload/master_doktrin/', 777);
                }

                // Initialize config for file
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $files = array();
                if (!$this->upload->do_upload('file')) {
                    $files[0] = "";
                } else {
                    $file = $this->upload->data();
                    $files[0] = $file['file_name'];
                }
            }

            if ($_FILES['file_cover']) {
                $config['upload_path'] = './upload/master_doktrin/cover';
                $config['allowed_types'] = 'jpg|jpeg|png|bmp';
                $config['max_size'] = "500000000";  //500MB
                $config['overwrite'] = FALSE;

                if (is_file($config['upload_path'] = './upload/master_doktrin/cover/')) {
                    chmod($config['upload_path'] = './upload/master_doktrin/cover/', 777);
                }

                // Initialize config for file
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $files_cover = array();
                if (!$this->upload->do_upload('file_cover')) {
                    $files_cover[0] = "";
                } else {
                    $file_cover = $this->upload->data();
                    $files_cover[0] = $file_cover['file_name'];
                }
            }


            $this->db->query("INSERT INTO notadinas.master_doktrin (id_buku,tanggal, id_kategori, judul_peraturan, deskripsi_peraturan, nama_buku, pengarang, judul_halaman, terbit, file, file_cover) VALUES ('" . $id_buku . "','" . $tanggal . "','" . $id_kategori . "','" . $judul_peraturan . "','" . $deskripsi_peraturan . "','" . $nama_buku . "','" . $pengarang . "','" . $judul_halaman . "','" . $terbit . "','" . $files[0] . "','" . $files_cover[0] . "')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_doktrin")->result();
            redirect('admin/master_doktrin/m_doktrin');
        } else if ($aksi == "edit") {
            $a['page'] = "u_master_doktrin";
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_doktrin where id_doktrin = '$id_doktrin'")->result();
            $a['kategori'] = $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
        } else if ($aksi == "update") {
            if ($_FILES['file']) {
                $config['upload_path'] = './upload/master_doktrin/';
                $config['allowed_types'] = '*';
                $config['max_size'] = "500000000";  //500MB
                $config['overwrite'] = FALSE;

                if (is_file($config['upload_path'] = './upload/master_doktrin/')) {
                    chmod($config['upload_path'] = './upload/master_doktrin/', 777);
                }

                // Initialize config for file
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $files = array();
                if (!$this->upload->do_upload('file')) {
                    $files[0] = $this->input->post('file_hidden');
                } else {
                    $file = $this->upload->data();
                    $files[0] = $file['file_name'];
                }
            }

            if ($_FILES['file_cover']) {
                $config['upload_path'] = './upload/master_doktrin/cover';
                $config['allowed_types'] = 'jpg|jpeg|png|bmp';
                $config['max_size'] = "500000000";  //500MB
                $config['overwrite'] = FALSE;

                if (is_file($config['upload_path'] = './upload/master_doktrin/cover/')) {
                    chmod($config['upload_path'] = './upload/master_doktrin/cover/', 777);
                }

                // Initialize config for file
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $files_cover = array();
                if (!$this->upload->do_upload('file_cover')) {
                    $files_cover[0] = $this->input->post('file_cover_hidden');;
                } else {
                    $file_cover = $this->upload->data();
                    $files_cover[0] = $file_cover['file_name'];
                }
            }
            $id_doktrin = addslashes($this->input->post('id_doktrin'));


            $this->db->query("UPDATE notadinas.master_doktrin SET id_buku = '" . $id_buku . "', tanggal = '" . $tanggal . "', id_kategori = '" . $id_kategori . "', judul_peraturan = '" . $judul_peraturan . "', nama_buku = '" . $nama_buku . "', deskripsi_peraturan = '" . $deskripsi_peraturan . "', pengarang = '" . $pengarang . "', file = '" . $files[0] . "', judul_halaman = '" . $judul_halaman . "', terbit = '" . $terbit . "', file_cover = '" . $files_cover[0] . "' where id_doktrin = '" . $id_doktrin . "' ");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_doktrin")->result();
            redirect('admin/master_doktrin/m_doktrin');
        } else if ($aksi == "delete") {
            $this->db->query("DELETE FROM notadinas.master_doktrin where id_doktrin = '$id_doktrin'");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_doktrin")->result();
            redirect('admin/master_doktrin/m_doktrin');
        }

        $a['kategori'] = $this->db->query("SELECT * FROM notadinas.master_kategori")->result();
        $this->load->view('administrator/master_doktrin', $a);
    }

    public function detail_peraturan($id_doktrin)
    {
        $a['peraturan'] = $this->db->query("SELECT * FROM notadinas.master_doktrin where id_doktrin = '$id_doktrin'")->result();
        $a['page'] = "detail_peraturan_content";
        $this->load->view('administrator/detail_peraturan', $a);
    }

    public function view_peraturan($id_doktrin)
    {
        $a['peraturan'] = $this->db->query("SELECT * FROM notadinas.master_doktrin where id_doktrin = '$id_doktrin'")->result();
        $a['page'] = "view_peraturan_content";
        $this->load->view('administrator/detail_peraturan', $a);
    }

    public function get_surat_template()
    {
        $jenis_surat = $this->input->post('jenis_surat', TRUE);

        $query = $this->db->query("select isi_surat_keluar from notadinas.master_surat_keluar where id_master_surat_keluar = '$jenis_surat'")->result();

        if (!empty($query)) {
            $result = $query[0]->isi_surat_keluar;
            echo json_encode($result);
        }
    }

    public function download_signature()
    {
      $data_image = $this->input->post('hidden_data');
       echo "<script>console.log('waaawwwww');</script>";
      //echo "waawwwww";
      $upload_dir = "http://localhost:8080/notadinas_pushidrosal/aset";
      $img = $data_image;
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $file = $upload_dir . mktime() . ".png";
      $success = file_put_contents($file, $data);
      print $success ? $file : 'Unable to save the file.';
    }

    public function master_ruang()
    {
        $idr = addslashes($this->input->post('id_ruang'));
        $nama_ruang = addslashes($this->input->post('nama_ruang'));
        $nama_ruang = str_replace('\"', '"', $nama_ruang);
        $cari = addslashes($this->input->post('q'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        if ($aksi == "add") {
            $a['page'] = "f_master_ruangs";
        }else if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_ruang WHERE nama_ruang LIKE '%$cari%' ORDER BY id_ruang DESC")->result();
            $a['page'] = "l_master_ruangs";
        } else if ($aksi == "del") {
            $this->db->query("DELETE FROM notadinas.master_ruang WHERE id_ruang = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('admin/master_ruang/m_ruang');
        } else if ($aksi == "m_ruang") {

            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_ruang ORDER BY id_ruang")->result();
            $a['page'] = "l_master_ruangs";
        } else if ($aksi == "edt") {

            $a['datas'] = $this->db->query("SELECT * FROM notadinas.master_ruang WHERE id_ruang = '$idu'")->row();
            $a['page'] = "f_master_ruangs";
        } else if ($aksi == "act_edt") {
            $idp = addslashes($this->input->post('idp'));
            $nmk = addslashes($this->input->post('nama_ruang'));
            $this->db->query("UPDATE notadinas.master_ruang SET nama_ruang = '$nmk' WHERE id_ruang = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
            redirect('admin/master_ruang/m_ruang');
        } else if ($aksi == "save") {
            $jid = $this->db->query("SELECT MAX(id_ruang) AS qwe FROM notadinas.master_ruang")->row();
                    $jids = $jid->qwe + 1;
            $this->db->query("INSERT INTO notadinas.master_ruang VALUES ('".$jids."','" . $nama_ruang . "')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_ruang")->result();
            redirect('admin/master_ruang/m_ruang');
        }


        $this->load->view('admin/aaa', $a);
    }

     public function master_lemari()
    {
        $idr = addslashes($this->input->post('id_lemari'));
        $nama_lemari = addslashes($this->input->post('nama_lemari'));
        $nama_lemari = str_replace('\"', '"', $nama_lemari);
        $rk = addslashes($this->input->post('rknya'));
        $cari = addslashes($this->input->post('q'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        if ($aksi == "add") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_ruang ORDER BY id_ruang")->result();
            $a['page'] = "f_master_lemaris";
        }else if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_lemari WHERE nama_lemari LIKE '%$cari%' ORDER BY id_lemari DESC")->result();
            $a['page'] = "l_master_lemaris";
        } else if ($aksi == "del") {
            $this->db->query("DELETE FROM notadinas.master_lemari WHERE id_lemari = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('admin/master_lemari/m_lemari');
        } else if ($aksi == "m_lemari") {

            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_lemari inner join notadinas.master_ruang on notadinas.master_ruang.id_ruang = notadinas.master_lemari.id_ruang ORDER BY id_lemari")->result();
            $a['page'] = "l_master_lemaris";
        } else if ($aksi == "edt") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_ruang ORDER BY id_ruang")->result();
            $a['datas'] = $this->db->query("SELECT * FROM notadinas.master_lemari WHERE id_lemari = '$idu'")->row();
            $a['page'] = "f_master_lemaris";
        } else if ($aksi == "act_edt") {
            $idp = addslashes($this->input->post('idp'));
            $nmk = addslashes($this->input->post('nama_lemari'));
            $rk = addslashes($this->input->post('rknya'));
            $this->db->query("UPDATE notadinas.master_lemari SET nama_lemari = '$nmk', id_ruang = '$rk' WHERE id_lemari = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
            redirect('admin/master_lemari/m_lemari');
        } else if ($aksi == "save") {
            $jid = $this->db->query("SELECT MAX(id_lemari) AS qwe FROM notadinas.master_lemari")->row();
                    $jids = $jid->qwe + 1;
            $this->db->query("INSERT INTO notadinas.master_lemari VALUES ('".$jids."','" . $nama_lemari . "','" . $rk . "')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_lemari")->result();
            redirect('admin/master_lemari/m_lemari');
        }


        $this->load->view('admin/aaa', $a);
    }

    public function master_rak()
    {
        $idr = addslashes($this->input->post('id_rak'));
        $nama_rak = addslashes($this->input->post('nama_rak'));
        $nama_rak = str_replace('\"', '"', $nama_rak);
        $rk = addslashes($this->input->post('rknya'));
        $cari = addslashes($this->input->post('q'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        if ($aksi == "add") {
            $a['data'] = $this->db->query("SELECT *, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.master_lemari INNER JOIN notadinas.master_ruang ON notadinas.master_lemari.id_ruang = notadinas.master_ruang.id_ruang ORDER BY id_lemari")->result();
            $a['page'] = "f_master_raks";
        }else if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_rak WHERE nama_rak LIKE '%$cari%' ORDER BY id_rak DESC")->result();
            $a['page'] = "l_master_raks";
        } else if ($aksi == "del") {
            $this->db->query("DELETE FROM notadinas.master_rak WHERE id_rak = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('admin/master_rak/m_rak');
        } else if ($aksi == "m_rak") {

            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_rak inner join notadinas.master_lemari on notadinas.master_lemari.id_lemari = notadinas.master_rak.id_lemari ORDER BY id_rak")->result();
            $a['page'] = "l_master_raks";
        } else if ($aksi == "edt") {
            $a['data'] = $this->db->query("SELECT *, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.master_lemari INNER JOIN notadinas.master_ruang ON notadinas.master_lemari.id_ruang = notadinas.master_ruang.id_ruang ORDER BY id_lemari")->result();
            $a['datas'] = $this->db->query("SELECT * FROM notadinas.master_rak WHERE id_rak = '$idu'")->row();
            $a['page'] = "f_master_raks";
        } else if ($aksi == "act_edt") {
            $idp = addslashes($this->input->post('idp'));
            $nmk = addslashes($this->input->post('nama_rak'));
            $rk = addslashes($this->input->post('rknya'));
            $this->db->query("UPDATE notadinas.master_rak SET nama_rak = '$nmk', id_lemari = '$rk' WHERE id_rak = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
            redirect('admin/master_rak/m_rak');
        } else if ($aksi == "save") {
            $jid = $this->db->query("SELECT MAX(id_rak) AS qwe FROM notadinas.master_rak")->row();
                    $jids = $jid->qwe + 1;
            $this->db->query("INSERT INTO notadinas.master_rak VALUES ('".$jids."','" . $nama_rak . "','" . $rk . "')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_rak")->result();
            redirect('admin/master_rak/m_rak');
        }


        $this->load->view('admin/aaa', $a);
    }

    public function master_box()
    {
        $idr = addslashes($this->input->post('id_box'));
        $nama_box = addslashes($this->input->post('nama_box'));
        $nama_box = str_replace('\"', '"', $nama_box);
        $rk = addslashes($this->input->post('rknya'));
        $cari = addslashes($this->input->post('q'));

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            redirect("admin/login");
        }
        $aksi = $this->uri->segment(3);
        $idu = $this->uri->segment(4);
        if ($aksi == "add") {
            $a['data'] = $this->db->query("SELECT *, notadinas.master_lemari.nama_lemari as nam_lem, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.master_rak INNER JOIN notadinas.master_lemari ON notadinas.master_rak.id_lemari = notadinas.master_lemari.id_lemari INNER JOIN notadinas.master_ruang ON notadinas.master_lemari.id_ruang = notadinas.master_ruang.id_ruang ORDER BY id_rak")->result();
            $a['page'] = "f_master_boxs";
        }else if ($aksi == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_box WHERE nama_box LIKE '%$cari%' ORDER BY id_rak DESC")->result();
            $a['page'] = "l_master_boxs";
        } else if ($aksi == "del") {
            $this->db->query("DELETE FROM notadinas.master_box WHERE id_box = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('admin/master_box/m_box');
        } else if ($aksi == "m_box") {

            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_box inner join notadinas.master_rak on notadinas.master_rak.id_rak = notadinas.master_box.id_rak ORDER BY id_box")->result();
            $a['page'] = "l_master_boxs";
        } else if ($aksi == "edt") {
            $a['data'] = $this->db->query("SELECT *, notadinas.master_lemari.nama_lemari as nam_lem, notadinas.master_ruang.nama_ruang as nam_ru FROM notadinas.master_rak INNER JOIN notadinas.master_lemari ON notadinas.master_rak.id_lemari = notadinas.master_lemari.id_lemari INNER JOIN notadinas.master_ruang ON notadinas.master_lemari.id_ruang = notadinas.master_ruang.id_ruang ORDER BY id_rak")->result();
            $a['datas'] = $this->db->query("SELECT * FROM notadinas.master_box WHERE id_box = '$idu'")->row();
            $a['page'] = "f_master_boxs";
        } else if ($aksi == "act_edt") {
            $idp = addslashes($this->input->post('idp'));
            $nmk = addslashes($this->input->post('nama_box'));
            $rk = addslashes($this->input->post('rknya'));
            $this->db->query("UPDATE notadinas.master_box SET nama_box = '$nmk', id_rak = '$rk' WHERE id_box = '$idp'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data telah di update </div>");
            redirect('admin/master_box/m_box');
        } else if ($aksi == "save") {
            $jid = $this->db->query("SELECT MAX(id_box) AS qwe FROM notadinas.master_box")->row();
                    $jids = $jid->qwe + 1;
            $this->db->query("INSERT INTO notadinas.master_box VALUES ('".$jids."','" . $nama_box . "','" . $rk . "')");
            $a['data'] = $this->db->query("SELECT * FROM notadinas.master_box")->result();
            redirect('admin/master_box/m_box');
        }


        $this->load->view('admin/aaa', $a);
    }

    /***********************************************
     ** Get Link for Socket New Notification
     ** By: Daniel D Fortuna
     ***********************************************/

    public function getLinkForNewNotification()
    {
        $ka_waka_setum       = $this->input->post('ka_waka_setum');
        $tipe                = $this->input->post('tablenya');
        $status              = $this->input->post('status');
        $opened              = $this->input->post('opened');
        $kepada              = $this->input->post('kepada');
        $id_jabatan          = $this->input->post('id_jabatan');
        $status_surat_keluar = $this->input->post('status_surat_keluar');
        $idnya               = $this->input->post('idnya');
        $create_by           = $this->input->post('create_by');
        if($tipe=="keluar"){
            if($ka_waka_setum=='unchecked' and $status_surat_keluar==0 and $this->session->userdata('admin_id')==$create_by and $opened==1){
                $link = '/surat_keluar/edt/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($ka_waka_setum=='unchecked' and $status_surat_keluar==1 and $this->session->userdata('admin_jabatan')==$id_jabatan and $opened==1){
                $link = '/surat_keluar/verifikasi_surat_keluar/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==1 and $opened==2){
                $link = '/surat_keluar/verifikasi_surat_keluar/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==3 and $this->session->userdata('admin_id')==$create_by and $opened==3){
                $link = '/surat_keluar/verifikasi_surat_keluar/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==4 and $this->session->userdata('admin_satuan')==6 and $opened==4){
                $link = '/surat_keluar/verifikasi_surat_keluar/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==5 and $this->session->userdata('admin_satuan')==6 and $opened==5){
                $link = '/surat_keluar/verifikasi_surat_keluar/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==6 and $this->session->userdata('admin_jabatan')==1 and $opened==6){
                $link = '/surat_keluar/verifikasi_surat_keluar/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }
        }else if($tipe=="masuk"){
            if($this->session->userdata('admin_tingkatan')==2 and $status_surat_keluar==4 and $ka_waka_setum=="subdis" and $id_jabatan==$user_subjabatan->id and $opened==4){
                $check_asjdk = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $idnya and penerima_disposisi_satuan = $user_subjabatan->id")->row();
                if($check_asjdk->disposisi!="yes"){
                    $link = '/surat_masuk/subdisp/';
                    $result[] = [
                        'link' => $link
                    ];

                    echo json_encode($result);
                }
            }else if($status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==1 /* and $kepada!=28 */ and ($opened==2 or $opened==228)){
                $link = '/surat_masuk/disp/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==28 and $kepada==28 and ($opened==2 or $opened==21)){
                $link = '/surat_masuk/disp/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }else if($status_surat_keluar==3 and $this->session->userdata('admin_jabatan')==$id_jabatan and $status==1 and $opened==3){
                $link = '/surat_masuk/kadisp/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            } else if($status_surat_keluar==4 and $this->session->userdata('admin_jabatan')==$id_jabatan and $status==2 and $opened==4){
                $link = '/surat_masuk/subdisp/';
                $result[] = [
                    'link' => $link
                ];

                echo json_encode($result);
            }
        }else if($tipe=="nota"){
            // if($status_notadinas==1 and $this->session->userdata('admin_jabatan')==$id_jabatan and $opened!=100){
                // $link = '/nota_dinas/verifikasi_nota_dinas/';
                // $zxc = $zxc + 1;
                // $notif['nota'][$idnya] = true;
            // }else
            if($status_surat_keluar==4 and ((($this->session->userdata('admin_jabatan')==$id_jabatan and $status!=100) or ($this->session->userdata('admin_jabatan')==$kepada and $opened!=100)) or ($this->session->userdata('admin_jabatan')==1 or $this->session->userdata('admin_jabatan')==2 or $this->session->userdata('admin_jabatan')==28))){
                if($this->session->userdata('admin_jabatan')==$id_jabatan and $status!=100){
                    $pplkasaso = 'tembusan';
                    $link = '/nota_dinas/verifikasi_nota_dinas/';
                    $result[] = [
                        'link' => $link,
                        'req' => $pplkasaso
                    ];

                    echo json_encode($result);
                }elseif($this->session->userdata('admin_jabatan')==$kepada and $opened!=100){
                    $pplkasaso = 'kepada';
                    $link = '/nota_dinas/verifikasi_nota_dinas/';
                    $result[] = [
                        'link' => $link,
                        'req' => $pplkasaso
                    ];

                    echo json_encode($result);
                }elseif($this->session->userdata('admin_jabatan')==1 and strpos($ka_waka_setum, '1') !== false){
                    $pplkasaso = 'kapush';
                    $link = '/nota_dinas/verifikasi_nota_dinas/';
                    $result[] = [
                        'link' => $link,
                        'req' => $pplkasaso
                    ];

                    echo json_encode($result);
                }elseif($this->session->userdata('admin_jabatan')==2 and strpos($ka_waka_setum, '2') !== false){
                    $pplkasaso = 'setum';
                    $link = '/nota_dinas/verifikasi_nota_dinas/';
                    $result[] = [
                        'link' => $link,
                        'req' => $pplkasaso
                    ];

                    echo json_encode($result);
                }elseif($this->session->userdata('admin_jabatan')==28 and strpos($ka_waka_setum, '3') !== false){
                    $pplkasaso = 'waka';
                    $link = '/nota_dinas/verifikasi_nota_dinas/';
                    $result[] = [
                        'link' => $link,
                        'req' => $pplkasaso
                    ];

                    echo json_encode($result);
                }
            }else if($status_surat_keluar==0 and $this->session->userdata('admin_jabatan')==$id_jabatan and $status!=100){
                $link = '/nota_dinas/verifikasi_nota_dinas/';
                $result[] = [
                    'link' => $link,
                ];

                echo json_encode($result);
            }
            // else{
            // $link = '/nota_dinas/edt/');
                // $zxc = $zxc + 1;
                // $notif['nota'][$idnya] = true;
            // }
            echo json_encode(['status' => 'null']);
        }
    }

    /*
    ||  Fungsi validasi ID berdasarkan database
    ||  Putri Dewi Punamasari
    */
    public function validasi_id()
    {
        //Menerima inputan dari ajax dan di assign ke variable
        $id =  addslashes($this->input->post('id'));
        $table =  addslashes($this->input->post('table'));
        $id_surat = addslashes($this->input->post('id_surat'));

        //Pengecekan pertama
        $valid = $this->db->query("SELECT * FROM notadinas.$table WHERE no_surat = '$id'")->num_rows();

        //Jika value valid ditemukan, cek lagi apakah itu dirinya sendiri atau bukan. Ini untuk handling edit.
        if ($valid > 0) {
            $check = $this->db->query("SELECT * FROM notadinas.$table WHERE no_surat = '$id' AND id = '$id_surat'")->num_rows();
            //Kalau value check ditemukan, artinya record itu berasal dari dirinya sendiri. Masih dibilang valid.
            if ($check > 0) {
                $valid = 0;
            }else{
                $valid = 1;
            }
        }
       echo $valid;
    }
	public function test(){
		$TemBusanz = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = 2 AND id_jabatan = 6")->row();
		echo $TemBusanz->id_jabatan;
		$this->dd($TemBusanz);
	}
	
	function getabx(){
		$a = 3333.3;
		$b = 1111.1;
		// echo $a + $b;die();
		$tembusanZ = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_jabatan = " . $this->session->userdata('admin_jabatan') . " AND id_notadinas = $bl->idnya")->row();
				if($this->session->userdata('admin_jabatan')==$bl->kepada and $bl->opened==100 and $bl->tujuan_status == 0){
				}
		
	}
}
