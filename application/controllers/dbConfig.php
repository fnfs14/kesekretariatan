<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dbConfig extends CI_Controller {

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
	
	
	
	
	
	public function updateEmail(){die();
		$data = $this->db->query("SELECT * FROM notadinas.master_user")->result();
		foreach($data as $a){
			$email = $a->username . '@gmail.com';
			$this->db->query("
				UPDATE notadinas.master_user
				SET email = '$email'
				WHERE id = $a->id
			");
		}
	}
	public function deleteRuangKerja(){die();
		$idlogind = 'setum';
		$this->eoffice = $this->load->database('eoffice', TRUE);
		$data = $this->db->query("SELECT * FROM notadinas.master_ruangkrj")->result();
		foreach($data as $dt){
			$q = $dt->id_ruang_kerja;
			$usefficed = $this->eoffice->query("SELECT * FROM fo_contacts WHERE username = '$idlogind'")->row();
			if($usefficed!=NULL){
				$id_usefd = $usefficed->object_id;
				$object = $this->db->query("SELECT * FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = '$q'")->row();
				if($object!=NULL){
					$object_id_d = $object->object_id;
					$member = $this->eoffice->query("SELECT * FROM fo_members WHERE object_id = '$object_id_d'")->row();
					if($member!=null){				
						$member_id_d = $member->id;
					}else{
						echo "member - $q - $object_id_d<br>";
					}
					if($member!=null){	
						// $date_wrk_d = date('Y-m-d h:i:s');
						// $idapd = $this->eoffice->query("SELECT MAX(id) AS qwi FROM fo_application_logs")->row();
						// $idapds = $idapd->qwi + 1;
						// $objectd = $this->eoffice->query("SELECT * FROM fo_objects WHERE id = '$object_id_d'")->row();
						// $idobjd = $objectd->name;
						// $this->eoffice->query("INSERT INTO fo_application_logs (id, taken_by_id, rel_object_id, object_name, created_on, created_by_id, action, is_private, is_silent, member_id, log_data) VALUES ('".$idapds."', '".$id_usefd."', '".$object_id_d."', '".$object->idobjd."', '".$date_wrk_d."', '".$id_usefd."', 'delete', '0', '0', '".$member_id_d."', 'member deleted')");
					}
					$this->eoffice->query("DELETE FROM fo_searchable_objects WHERE rel_object_id = $object_id_d");
					$this->eoffice->query("DELETE FROM fo_sharing_table WHERE object_id = $object_id_d");
					$this->eoffice->query("DELETE FROM fo_workspaces WHERE object_id = $object_id_d");
					if($member!=null){				
						$this->eoffice->query("DELETE FROM fo_member_property_members WHERE member_id = $member_id_d");
						$this->eoffice->query("DELETE FROM fo_object_members WHERE member_id = $member_id_d");
						$this->eoffice->query("DELETE FROM fo_contact_member_permissions WHERE member_id = $member_id_d");
					}
					$this->eoffice->query("DELETE FROM fo_members WHERE object_id = $object_id_d");
					$this->eoffice->query("DELETE FROM fo_objects WHERE id = $object_id_d");
					$this->db->query("DELETE FROM notadinas.master_ruangkrj WHERE id_ruang_kerja = $q");
				}else{
					die('object - ' . $q);
				}
			}else{
				die('usefficed - ' . $q);
			}
		}
	}
	public function masterJabatan(){die();
		$array = [[ 'id' => 142, 'view' => 0 ],[ 'id' => 0, 'view' => 0 ],[ 'id' => 1, 'view' => 0 ],[ 'id' => 90, 'view' => 0 ],[ 'id' => 91, 'view' => 0 ],[ 'id' => 92, 'view' => 0 ],[ 'id' => 93, 'view' => 0 ],[ 'id' => 94, 'view' => 0 ],[ 'id' => 35, 'view' => 0 ],[ 'id' => 36, 'view' => 0 ],[ 'id' => 37, 'view' => 0 ],[ 'id' => 38, 'view' => 0 ],[ 'id' => 39, 'view' => 0 ],[ 'id' => 40, 'view' => 0 ],[ 'id' => 42, 'view' => 0 ],[ 'id' => 43, 'view' => 0 ],[ 'id' => 44, 'view' => 0 ],[ 'id' => 45, 'view' => 0 ],[ 'id' => 27, 'view' => 0 ],[ 'id' => 95, 'view' => 0 ],[ 'id' => 96, 'view' => 0 ],[ 'id' => 46, 'view' => 0 ],[ 'id' => 47, 'view' => 0 ],[ 'id' => 48, 'view' => 0 ],[ 'id' => 49, 'view' => 0 ],[ 'id' => 50, 'view' => 0 ],[ 'id' => 51, 'view' => 0 ],[ 'id' => 52, 'view' => 0 ],[ 'id' => 53, 'view' => 0 ],[ 'id' => 55, 'view' => 0 ],[ 'id' => 56, 'view' => 0 ],[ 'id' => 57, 'view' => 0 ],[ 'id' => 58, 'view' => 0 ],[ 'id' => 59, 'view' => 0 ],[ 'id' => 60, 'view' => 0 ],[ 'id' => 61, 'view' => 0 ],[ 'id' => 118, 'view' => 0 ],[ 'id' => 62, 'view' => 0 ],[ 'id' => 63, 'view' => 0 ],[ 'id' => 64, 'view' => 0 ],[ 'id' => 65, 'view' => 0 ],[ 'id' => 66, 'view' => 0 ],[ 'id' => 67, 'view' => 0 ],[ 'id' => 68, 'view' => 0 ],[ 'id' => 89, 'view' => 0 ],[ 'id' => 70, 'view' => 0 ],[ 'id' => 71, 'view' => 0 ],[ 'id' => 72, 'view' => 0 ],[ 'id' => 73, 'view' => 0 ],[ 'id' => 74, 'view' => 0 ],[ 'id' => 75, 'view' => 0 ],[ 'id' => 76, 'view' => 0 ],[ 'id' => 77, 'view' => 0 ],[ 'id' => 78, 'view' => 0 ],[ 'id' => 79, 'view' => 0 ],[ 'id' => 80, 'view' => 0 ],[ 'id' => 81, 'view' => 0 ],[ 'id' => 82, 'view' => 0 ],[ 'id' => 85, 'view' => 0 ],[ 'id' => 86, 'view' => 0 ],[ 'id' => 87, 'view' => 0 ],[ 'id' => 88, 'view' => 0 ],[ 'id' => 97, 'view' => 0 ],[ 'id' => 98, 'view' => 0 ],[ 'id' => 99, 'view' => 0 ],[ 'id' => 100, 'view' => 0 ],[ 'id' => 101, 'view' => 0 ],[ 'id' => 104, 'view' => 0 ],[ 'id' => 105, 'view' => 0 ],[ 'id' => 106, 'view' => 0 ],[ 'id' => 107, 'view' => 0 ],[ 'id' => 108, 'view' => 0 ],[ 'id' => 109, 'view' => 0 ],[ 'id' => 110, 'view' => 0 ],[ 'id' => 111, 'view' => 0 ],[ 'id' => 112, 'view' => 0 ],[ 'id' => 144, 'view' => 0 ],[ 'id' => 145, 'view' => 0 ],[ 'id' => 146, 'view' => 0 ],[ 'id' => 147, 'view' => 0 ],[ 'id' => 148, 'view' => 0 ],[ 'id' => 149, 'view' => 0 ],[ 'id' => 153, 'view' => 0 ],[ 'id' => 154, 'view' => 0 ],[ 'id' => 155, 'view' => 0 ],[ 'id' => 156, 'view' => 0 ],[ 'id' => 157, 'view' => 0 ],[ 'id' => 158, 'view' => 0 ],[ 'id' => 159, 'view' => 0 ],[ 'id' => 160, 'view' => 0 ],[ 'id' => 41, 'view' => 0 ],[ 'id' => 150, 'view' => 0 ],[ 'id' => 151, 'view' => 0 ],[ 'id' => 152, 'view' => 0 ],[ 'id' => 122, 'view' => 0 ],[ 'id' => 161, 'view' => 0 ],[ 'id' => 163, 'view' => 0 ],[ 'id' => 164, 'view' => 0 ],[ 'id' => 165, 'view' => 0 ],[ 'id' => 166, 'view' => 0 ],[ 'id' => 167, 'view' => 0 ],[ 'id' => 168, 'view' => 0 ],[ 'id' => 169, 'view' => 0 ],[ 'id' => 170, 'view' => 0 ],[ 'id' => 171, 'view' => 0 ],[ 'id' => 172, 'view' => 0 ],[ 'id' => 113, 'view' => 0 ],[ 'id' => 54, 'view' => 0 ],[ 'id' => 69, 'view' => 0 ],[ 'id' => 83, 'view' => 0 ],[ 'id' => 102, 'view' => 0 ],[ 'id' => 103, 'view' => 0 ],[ 'id' => 114, 'view' => 0 ],[ 'id' => 115, 'view' => 0 ],[ 'id' => 116, 'view' => 0 ],[ 'id' => 117, 'view' => 0 ],[ 'id' => 29, 'view' => 0 ],[ 'id' => 31, 'view' => 0 ],[ 'id' => 119, 'view' => 0 ],[ 'id' => 120, 'view' => 0 ],[ 'id' => 121, 'view' => 0 ],[ 'id' => 123, 'view' => 0 ],[ 'id' => 124, 'view' => 0 ],[ 'id' => 125, 'view' => 0 ],[ 'id' => 126, 'view' => 0 ],[ 'id' => 127, 'view' => 0 ],[ 'id' => 128, 'view' => 0 ],[ 'id' => 129, 'view' => 0 ],[ 'id' => 130, 'view' => 0 ],[ 'id' => 131, 'view' => 0 ],[ 'id' => 132, 'view' => 0 ],[ 'id' => 133, 'view' => 0 ],[ 'id' => 134, 'view' => 0 ],[ 'id' => 135, 'view' => 0 ],[ 'id' => 136, 'view' => 0 ],[ 'id' => 137, 'view' => 0 ],[ 'id' => 138, 'view' => 0 ],[ 'id' => 139, 'view' => 0 ],[ 'id' => 140, 'view' => 0 ],[ 'id' => 141, 'view' => 0 ],[ 'id' => 173, 'view' => 0 ],[ 'id' => 143, 'view' => 0 ],[ 'id' => 28, 'view' => 2 ],[ 'id' => 6, 'view' => 3 ],[ 'id' => 7, 'view' => 4 ],[ 'id' => 8, 'view' => 5 ],[ 'id' => 9, 'view' => 6 ],[ 'id' => 10, 'view' => 7 ],[ 'id' => 11, 'view' => 8 ],[ 'id' => 12, 'view' => 9 ],[ 'id' => 30, 'view' => 10 ],[ 'id' => 26, 'view' => 11 ],[ 'id' => 17, 'view' => 12 ],[ 'id' => 18, 'view' => 13 ],[ 'id' => 19, 'view' => 14 ],[ 'id' => 20, 'view' => 15 ],[ 'id' => 21, 'view' => 16 ],[ 'id' => 3, 'view' => 17 ],[ 'id' => 22, 'view' => 18 ],[ 'id' => 23, 'view' => 19 ],[ 'id' => 24, 'view' => 20 ],[ 'id' => 32, 'view' => 21 ],[ 'id' => 34, 'view' => 22 ],[ 'id' => 13, 'view' => 23 ],[ 'id' => 14, 'view' => 24 ],[ 'id' => 15, 'view' => 25 ],[ 'id' => 5, 'view' => 26 ],[ 'id' => 16, 'view' => 27 ],[ 'id' => 174, 'view' => 28 ],[ 'id' => 84, 'view' => 29 ],[ 'id' => 162, 'view' => 31 ],[ 'id' => 2, 'view' => NULL]];
		foreach($array as $a){
			$this->db->query("UPDATE notadinas.master_jabatan SET urutan_view = $a[view] WHERE id = $a[id]");
		}
	}
	public function logUser(){die();
		$array = [[ 'id' => 1, 'user' => 1, 'datetime' => '28-12-2018 13:49:23' ],[ 'id' => 2, 'user' => 1, 'datetime' => '28-12-2018 13:49:37' ],[ 'id' => 3, 'user' => 2, 'datetime' => '28-12-2018 13:52:39' ],[ 'id' => 4, 'user' => 1, 'datetime' => '28-12-2018 13:53:28' ],[ 'id' => 5, 'user' => 1, 'datetime' => '28-12-2018 14:31:31' ],[ 'id' => 6, 'user' => 29, 'datetime' => '28-12-2018 14:32:30' ],[ 'id' => 7, 'user' => 2, 'datetime' => '28-12-2018 14:34:36' ],[ 'id' => 8, 'user' => 2, 'datetime' => '28-12-2018 14:41:39' ],[ 'id' => 9, 'user' => 23, 'datetime' => '28-12-2018 14:43:02' ],[ 'id' => 10, 'user' => 2, 'datetime' => '28-12-2018 14:46:57' ],[ 'id' => 11, 'user' => 1, 'datetime' => '28-12-2018 14:56:29' ],[ 'id' => 12, 'user' => 29, 'datetime' => '28-12-2018 14:58:01' ],[ 'id' => 13, 'user' => 1, 'datetime' => '28-12-2018 15:17:16' ],[ 'id' => 14, 'user' => 29, 'datetime' => '28-12-2018 15:20:36' ],[ 'id' => 15, 'user' => 1, 'datetime' => '28-12-2018 15:53:30' ],[ 'id' => 16, 'user' => 2, 'datetime' => '28-12-2018 16:06:22' ],[ 'id' => 17, 'user' => 18, 'datetime' => '31-12-2018 06:41:29' ],[ 'id' => 18, 'user' => 18, 'datetime' => '31-12-2018 08:38:31' ],[ 'id' => 19, 'user' => 23, 'datetime' => '31-12-2018 14:06:06' ],[ 'id' => 20, 'user' => 18, 'datetime' => '02-01-2019 06:38:03' ],[ 'id' => 21, 'user' => 18, 'datetime' => '02-01-2019 08:07:12' ],[ 'id' => 22, 'user' => 18, 'datetime' => '02-01-2019 15:45:53' ],[ 'id' => 23, 'user' => 18, 'datetime' => '03-01-2019 08:05:35' ],[ 'id' => 24, 'user' => 23, 'datetime' => '03-01-2019 09:42:16' ],[ 'id' => 25, 'user' => 1, 'datetime' => '03-01-2019 10:50:49' ],[ 'id' => 26, 'user' => 1, 'datetime' => '03-01-2019 10:55:59' ],[ 'id' => 27, 'user' => 2, 'datetime' => '03-01-2019 10:56:29' ],[ 'id' => 28, 'user' => 1, 'datetime' => '03-01-2019 10:58:01' ],[ 'id' => 29, 'user' => 1, 'datetime' => '03-01-2019 10:58:32' ],[ 'id' => 30, 'user' => 29, 'datetime' => '03-01-2019 10:59:04' ],[ 'id' => 31, 'user' => 2, 'datetime' => '03-01-2019 11:00:40' ],[ 'id' => 32, 'user' => 1, 'datetime' => '03-01-2019 11:04:14' ],[ 'id' => 33, 'user' => 1, 'datetime' => '03-01-2019 11:07:47' ],[ 'id' => 34, 'user' => 1, 'datetime' => '03-01-2019 11:08:34' ],[ 'id' => 35, 'user' => 2, 'datetime' => '03-01-2019 11:16:24' ],[ 'id' => 36, 'user' => 2, 'datetime' => '03-01-2019 11:16:58' ],[ 'id' => 37, 'user' => 29, 'datetime' => '03-01-2019 11:17:05' ],[ 'id' => 38, 'user' => 2, 'datetime' => '03-01-2019 11:19:38' ],[ 'id' => 39, 'user' => 1, 'datetime' => '03-01-2019 11:23:47' ],[ 'id' => 40, 'user' => 1, 'datetime' => '03-01-2019 11:34:44' ],[ 'id' => 42, 'user' => 1, 'datetime' => '2019-02-15 13:18:10' ],[ 'id' => 43, 'user' => 2, 'datetime' => '2019-02-15 13:18:28' ],[ 'id' => 44, 'user' => 7, 'datetime' => '2019-02-15 13:20:42' ]];
		foreach($array as $a){
			$time = explode(' ',$a['datetime']);
			$e = explode('-',$time[0]);
			$year = $e[0];
			$month = $e[1];
			$day = $e[2];
			$time = $time[1];
			if(strlen($year)<4){
				$year = $e[2];
				$month = $e[1];
				$day = $e[0];
			}
			$datetime = $year."-".$month."-".$day." $time";
			$this->db->query("INSERT INTO notadinas.log_user VALUES($a[id], $a[user], '$datetime');");
		}
	}
	public function inputRuangKerja(){die();
		$this->eoffice = $this->load->database('eoffice', TRUE);
		$dataQ = $this->arrayInputRuangKerja();
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
	public function arrayInputRuangKerja(){
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
	public function InputKegiatan(){die();
		$array = ['KEPUTUSAN/PERATURAN KAPUSHIDROSAL','KEPUTUSAN/PERATURAN KASAL','KEPUTUSAN/PERATURAN MENTERI','KEPUTUSAN/PERATURAN PRESIDEN','LAPORAN KEGIATAN','LAPORAN KEJADIAN/KECELAKAAN','LAPORAN LAIN-LAIN','LAPORAN RAPAT','LAPORAN SURVEI','LUAR NEGERI-EAHC','LUAR NEGERI-IHO','LUAR NEGERI-IMO','LUAR NEGERI-JHA','LUAR NEGERI-SWPHC','LUAR NEGERI-UKHO','PERJANJIAN KERJASAMA (PKS) INSTANSI LAIN','PERJANJIAN KERJASAMA (PKS) KEMENTERIAN/LEMBAGA','PERJANJIAN KERJASAMA (PKS) LUAR NEGERI','PERJANJIAN KERJASAMA (PKS) PERGURUAN TINGGI/FAKULTAS','PERMOHONAN ANGGARAN','PERMOHONAN ASISTENSI','PERMOHONAN DATA/PETA','PERMOHONAN LAIN-LAIN','PERMOHONAN NARASUMBER','PERMOHONAN PERSONEL','PERMOHONAN SURVEI (LO/SO/TO)','PRAKTEK KERJA LAPANGAN MAHASISWA','PRAKTEK KERJA LAPANGAN SMU/SMK','PRAKTEK KERJA LAPANGAN TNI/TNI AL','RENCANA GARIS BESAR (RGB) HARI HIDROGRAFI','RENCANA GARIS BESAR (RGB) LATSURTA','SURAT PERINTAH INSPEKSI/SURVEI','SURAT PERINTAH LUAR NEGERI','SURAT PERINTAH MUTASI KELUAR','SURAT PERINTAH MUTASI MASUK','SURAT PERINTAH PENEMPATAN','SURAT PERINTAH TIM POKJA','UNDANGAN RAPAT FGD','UNDANGAN RAPAT INTERN','UNDANGAN RAPAT KEMENTERIAN/LEMBAGA','UNDANGAN RAPAT TNI/TNI AL','UNDANGAN SERTIJAB/PISAH SAMBUT','UNDANGAN SIDANG KENKAT','UNDANGAN SIDANG PATJAB','UNDANGAN UPACARA/PERESMIAN'];
		$id = 0;
		foreach($array as $a){
			$id = $id + 1;
			if($id!=7){				
				$this->db->query("DELETE FROM notadinas.kegiatan_dinas WHERE id_kegiatan = $id");
				$this->db->query("INSERT INTO notadinas.kegiatan_dinas VALUES($id, '$a')");
			}else{
				$this->db->query("UPDATE notadinas.kegiatan_dinas SET nama_kegiatan = '$a' WHERE id_kegiatan = $id");
			}
		}
	}
}
