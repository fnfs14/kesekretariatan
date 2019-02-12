<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	function dd($var, $pretty = false){
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
	public function inputKegiatan(){
		$this->eoffice = $this->load->database('eoffice', TRUE);
		$dataQ = $this->arrayZ();
		foreach($dataQ as $q => $wq){
			foreach($wq as $z => $zx){
				$id_jenissurat = $q;
				$nama_krj = $zx;
				
				$jiz = $this->db->query("SELECT MAX(id_ruang_kerja) AS qwa FROM notadinas.master_ruangkrj")->row();
				$jidz = $jiz->qwa + 1;
				
				$jid = $this->eoffice->query("SELECT MAX(id) AS qwe FROM fo_objects")->row();
				$jids = $jid->qwe + 1;
				
				$idal = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
				$idals = $idal->qwi + 1;
				
				$idmem = $this->eoffice->query("SELECT MAX(id) AS qwo FROM fo_members")->row();
				$idmems = $idmem->qwo + 1;
				
				$userLogin = 'setum';
				$useffice = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$userLogin'")->row();
				$id_usef = $useffice->object_id;
				
				$kpwk = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '$id_usef'")->row();
				$idkpwk = $kpwk->id;
				
				$setum = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = 'setum'")->row();
				$idsetum = $setum->object_id;
				
				$stm = $this->eoffice->query("SELECT * FROM fo_permission_groups WHERE contact_id = '$idsetum'")->row();
				$idstm = $stm->id;
				
				$date_wrk = date('Y-m-d h:i:s');
				$property_member_id = $this->eoffice->query("SELECT * FROM fo_members WHERE dimension_id = '1' ORDER BY id ASC")->result();
				$object_member = $this->eoffice->query("SELECT * FROM fo_contacts WHERE is_company = '0' ORDER BY object_id ASC")->result();
				$this->eoffice->query("DELETE FROM fo_contact_member_cache WHERE member_id = $idmems");

				$this->eoffice->query("INSERT INTO fo_objects (id, object_type_id, name, created_on, created_by_id, updated_on, updated_by_id, trashed_on, trashed_by_id, archived_on, archived_by_id, timezone_id, timezone_value) VALUES ('".$jids."', '1', '".$nama_krj."', '".$date_wrk."', '".$id_usef."', '".$date_wrk."', '".$id_usef."', '', '0', '', '0', '357', '25200')");

				$this->eoffice->query("INSERT INTO fo_members (id, dimension_id, object_type_id, parent_member_id, depth, name, description, object_id) VALUES ('".$idmems."', '2', '1', '0', '1', '".$nama_krj."', 'Deskripsi dari Ruang Kerja ".$nama_krj."', '".$jids."')");
				$this->eoffice->query("UPDATE fo_members SET color = '12', archived_by_id = '0' WHERE id = '".$idmems."'");

				$this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idals."', '".$id_usef."', '".$jids."', '".$nama_krj."', '".$date_wrk."', '".$id_usef."', 'add', '0', '0', '".$idmems."', '')");
				$this->eoffice->query("INSERT INTO fo_searchable_objects (rel_object_id, column_name, content, contact_id) VALUES ('".$jids."', 'name', '".$nama_krj."', 0), ('".$jids."', 'object_id', '".$jids."', 0)");
				$this->eoffice->query("INSERT INTO fo_sharing_table (group_id, object_id) VALUES ('0', '".$jids."'), ('".$idkpwk."', '".$jids."')");
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
				
				$this->db->query("INSERT INTO notadinas.master_ruangkrj VALUES ('".$jidz."','0','" . $nama_krj . "', '', '".$jids."', '".$id_jenissurat."')");
			}
		}
	}
	public function arrayZ(){
		$array = [
			1=>[
				'PERMOHONAN ANGGARAN',
				'PERMOHONAN DATA/PETA',
				'PERMOHONAN SURVEI (LO/SO/TO)',
				'PERMOHONAN PERSONEL',
				'PERMOHONAN ASISTENSI',
				'PERMOHONAN NARASUMBER',
				'PERMOHONAN LAIN-LAIN',
				'LAPORAN RAPAT',
				'LAPORAN SURVEI',
				'LAPORAN KEGIATAN',
				'LAPORAN KEJADIAN/KECELAKAAN',
				'LAPORAN LAIN-LAIN',
				'PERJANJIAN KERJASAMA (PKS) KEMENTERIAN/LEMBAGA',
				'PERJANJIAN KERJASAMA (PKS) PERGURUAN TINGGI/FAKULTAS',
				'PERJANJIAN KERJASAMA (PKS) LUAR NEGERI',
				'PERJANJIAN KERJASAMA (PKS) INSTANSI LAIN',
				'RENCANA GARIS BESAR (RGB) HARI HIDROGRAFI',
				'RENCANA GARIS BESAR (RGB) LATSURTA',
				'SURAT PERINTAH TIM POKJA',
				'SURAT PERINTAH INSPEKSI/SURVEI',
				'SURAT PERINTAH LUAR NEGERI',
				'SURAT PERINTAH MUTASI MASUK',
				'SURAT PERINTAH MUTASI KELUAR',
				'SURAT PERINTAH PENEMPATAN',
				'PRAKTEK KERJA LAPANGAN TNI/TNI AL',
				'PRAKTEK KERJA LAPANGAN MAHASISWA',
				'PRAKTEK KERJA LAPANGAN SMU/SMK',
				'KEPUTUSAN/PERATURAN PRESIDEN',
				'KEPUTUSAN/PERATURAN MENTERI',
				'KEPUTUSAN/PERATURAN KASAL',
				'KEPUTUSAN/PERATURAN KAPUSHIDROSAL'
			],
			2=>[
				'PERMOHONAN ANGGARAN',
				'PERMOHONAN DATA/PETA',
				'PERMOHONAN SURVEI (LO/SO/TO)',
				'PERMOHONAN PERSONEL',
				'PERMOHONAN ASISTENSI',
				'PERMOHONAN NARASUMBER',
				'PERMOHONAN LAIN-LAIN',
				'LAPORAN RAPAT',
				'LAPORAN SURVEI',
				'LAPORAN KEGIATAN',
				'LAPORAN KEJADIAN/KECELAKAAN',
				'LAPORAN LAIN-LAIN'
			],
			5=>[
				'LUAR NEGERI-IHO',
				'LUAR NEGERI-UKHO',
				'LUAR NEGERI-EAHC',
				'LUAR NEGERI-IMO',
				'LUAR NEGERI-JHA',
				'LUAR NEGERI-SWPHC'
			],
			6=>[
				'UNDANGAN RAPAT KEMENTERIAN/LEMBAGA',
				'UNDANGAN RAPAT TNI/TNI AL',
				'UNDANGAN RAPAT FGD',
				'UNDANGAN RAPAT INTERN',
				'UNDANGAN UPACARA/PERESMIAN',
				'UNDANGAN SERTIJAB/PISAH SAMBUT',
				'UNDANGAN SIDANG PATJAB',
				'UNDANGAN SIDANG KENKAT'
			]
		];
		return $array;
	}
	
}
