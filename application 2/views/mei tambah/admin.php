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
        $satuan = addslashes($this->input->post('satuan'));

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
                $cek_user_exist = $this->db->query("SELECT nama_jabatan FROM notadinas.master_satuan WHERE nama_satuan = '$nama'")->num_rows();

                 if ($cek_user_exist > 0) {
                    $this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">Nama Satuan Sudah Ada</div>");
                }else {
                    $urid = $this->db->query("SELECT MAX(urut_jabatan) AS qwo FROM notadinas.master_satuan")->row();
                    $urids = $urid->qwo + 1;
                    $this->db->query("INSERT INTO notadinas.master_satuan (id,nama_satuan, urut_satuan) VALUES ('$jids', '$nama', '$urids')");
                    $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
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