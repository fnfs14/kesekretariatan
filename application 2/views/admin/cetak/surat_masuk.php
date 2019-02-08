<!-- 
***********************
****Edited By Irvan****
***********************
-->

<html>
    <head>
        <style>
            @media print {
                @page { margin: 0; }
                body { margin: 1.6cm; font-size: 12px; }
                .page-break { display: block; page-break-before: always; }                                
            }
            
            div.page { page-break-after: always }
        
            body {
                display : none;
            }
            @media print {
                body {
                    display : block
                }
            }
            h4 {
                margin : 0px;
                text-align : center;
            }

            #title {
                float: left;
                border-bottom: 0.5px solid black;
            }

            #first {
                width : 100%;
                /*margin-top : 20px;*/
                /*font-weight : bold;*/
                text-align: center;
                /*text-decoration: underline;
                border-bottom: 0.5px solid black;*/
            }
            #firstt {
                width : 100%;
                /*margin-top : 20px;*/
                /*font-weight : bold;*/
                text-align: center;
                /*text-decoration: underline;
                border-bottom: 0.5px solid black;*/
            }
            #first tr:first-child td {
                /*border : 1px solid black;*/
                /*padding : 10px;
                font-weight : bold;
                */background-color: black !important;
                -webkit-print-color-adjust: exact;
                /* font-size : 130%; */
                color : white;
                border-radius : 3px;
                text-align: center;
                text-decoration: none;
            }            

            #second {
                margin-top : 25px;
                width : 100%;
                /*border : 1px solid black;
                border-radius : 3px;*/
                border-bottom: 0.5px solid black;
                /*background-color: whitesmoke !important;*/
                -webkit-print-color-adjust: exact; 
            }
            #second tr td {
                padding : 5px;/* ubah mei surmas4 */
                /*width : 10%;*/
                vertical-align : top !important;
            }
                    #second tr:first-child td:first-child table  {
                        width : 100%;
                        /*border : 1px solid black;*/
                        padding : 10px;
                        /*ini yang dikanan*/
                    }
                    #second tr:first-child td:first-child table tr td {
                        padding : 0px 0px 0px 5px;
                    }
                    #second tr:first-child td:first-child table tr:first-child td {
                        padding : 5px;
                        font-size : 125%;
                    }
            #second tr:first-child td:nth-child(2) table  {
                width : 100%;
                /* border : 1px solid black; */
                padding : 0px 10px 10px 10px;
                margin-top : 0px !important;
            }
            #second tr:first-child td:nth-child(2) table tr td {
                padding : 0px 0px 0px 5px;
            }
            #second tr:first-child td:nth-child(2) table tr:first-child td {
                padding : 5px;
                font-size : 125%;
            }
                    input,
                    textarea {
                        width : 100%;
                    }
            #fourth {
                margin-top : 25px;
                width : 100%;
                /*
                border-radius : 3px;*/
                /*background-color: whitesmoke !important;*/
                -webkit-print-color-adjust: exact; 
                padding : 10px 20px 10px 20px;
            }
            #fourth tr td {
                padding : 5px;
                font-size : 80%;
            }
            #fourth tr td input {
                width : 15px;
                float: left;
            }
			
			#fourthx {
               
                width : 100%;
                /*
                border-radius : 3px;*/
                /*background-color: whitesmoke !important;*/
                -webkit-print-color-adjust: exact; 
            }
            #fourthx tr td {
                padding : 5px;
                font-size : 80%;
            }
            #fourthx tr td input {
                width : 15px;
                float: left;
            }
             /*       #fourth tr td table {
                        border : 1px solid black;
                        background-color: white !important;
                        -webkit-print-color-adjust: exact; 
                        border-radius : 10px;
                        width : 100%;
                        padding : 10px;
                    }
                    #fourth tr td table tr:first-child td {
                        text-align : center;
                        font-size : 110%;
                    }
                    #fourth .first {
                        
                    }
                    #fourth .second {
                        text-align : left;
                        width : 30% !important;
                    }
            #fourth tr td h4 {
                text-align : left;
                font-size : 130%;
            }
                    a {
                        color : black;
                    }

            .tss li{
                float:left !important;
                padding: 0;
                text-decoration: none;
                margin: 0;
            }*/
        </style>
    </head>
    <body onload="window.print()">
    <!-- <body> -->
        <div id="title" >
            <h4>TENTARA NASIONAL INDONESIA ANGKATAN LAUT</h4>
            <h4>PUSAT HIDROGRAFI DAN OSEANOGRAFI</h4>                           
        </div>          
        <!-- <table id="first">
            <tr>
                <td>LEMBAR DISPOSISI</td>
            </tr>
        </table> -->
        <table id="second">
            <tr>
                <td style="width: 65%;"><!-- ubah mei surmas4 -->
                    <table style="font-size: 13px !important;"><!-- ubah mei surmas4 -->
                        <tr>
                            <!-- <td colspan="2">Detil Surat</td> -->
                            <td id="first" colspan="2"><b><u>LEMBAR-DISPOSISI</u></b><br></td>                            
                        </tr>                        
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Dari</td>
                            <td>:&nbsp;<label><?php echo $data->nama_instansi; ?></label></td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:&nbsp;<label><?php echo $data->no_surat; ?></label></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:&nbsp;<label>
                                <?php 
                                $date2=date_create($data->tgl_surat);
                                echo date_format($date2,"d-m-Y");
                                ?>
                            </label></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:&nbsp;
                                <label><?php echo $data->perihal; ?></label>                                    
                            </td>
                        </tr>
                        <tr>
                            <td>Didisposisikan</td>
                            <td>:&nbsp;
                                <label><?php
									$disp_=date_create($disposisi);
									echo date_format($disp_,"d-m-Y");
								?></label>                                    
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>Diteruskan Kepada</td>
                            <td>:&nbsp;<label></?php echo $jabatan->nama_jabatan; ?></label></td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>:&nbsp; <b><a style="font-size: 11px;" href="</?= site_url(); ?>upload/surat_masuk/</?= $data->file_attachment; ?>"></?= //$data->file_attachment; ?></a></b></td>
                        </tr> -->
                    </table>                    
                </td>                
                <td>
                    <table style="font-size: 13px !important; border-collapse: collapse;" border="1px"><!-- ubah mei surmas4 -->
                        <tr>
                            <td colspan="2" style="text-align: center; font-size: 11px !important;">
                                NASKAH TERLAMPIR SETELAH DIAKSI OLEH PARA PEJABAT YANG BERWENANG AGAR SEGERA DISERAHKAN KEMBALI KE SETUM
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;"><b>Agenda SETUM<b></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                NO : <label><?php echo $data->no_setum; ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                TGL : <label>
                                <?php 
                                $date=date_create($data->tgl_setum);
                                echo date_format($date,"d-m-Y");
                                ?>
                            </label>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>No. Agenda</td>
                            <td>:&nbsp;<label></?php echo $data->no_setum; ?></label></td>
                        </tr>
                        <tr>
                            <td>Tanggal SETUM</td>
                            <td>:&nbsp;<label>
                                </?php 
                                $date=date_create($data->tgl_setum);
                                echo date_format($date,"d-m-Y");
                                ?>
                            </label></td>
                        </tr> -->
                        <tr>
                            <td>Klasifikasi</td>
                            <td>:&nbsp;<label><?php echo $data->klasifikasi; ?></label></td>
                        </tr>
                        <tr>
                            <td>Derajat</td>
                            <td>:&nbsp;<label><?php echo $data->drajat; ?></label></td>
                        </tr>
                    </table>    
                </td>
            </tr>
        </table>
<?php // echo $this->session->userdata('admin_jabatan'); ?>
        <table id="firstt">
            <tr>
                <td style="text-align: left; text-decoration: none"><b>DITERUSKAN KEPADA :</b></td>                
            </tr>
            <tr>
                <td style="text-align: left; text-decoration: none">YTH. <label><?php echo $jabatan->nama_jabatan; ?></label></td>
            </tr>
        </table>
		<?php 
		$ijb = $this->session->userdata('admin_jabatan');
		$abb12 = $this->db->query('SELECT * FROM notadinas.master_jabatan WHERE id = '.$ijb)->result_array();
		$tingkatanz = $abb12[0]['tingkatan'];  
		?>
		
		<?php if($tingkatanz != 2) { ?>
        <table id="fourth" style="font-size: 11px; border-collapse: collapse;">
            <tr>
                <td>
                    <table style="border-collapse: collapse; border-top: 0.5px solid black; border-bottom: 0.5px solid black; width: 100%;">
                        <tr>
                            <td style="width: 8%">
                                <b style="text-align:left">A</b>
                                <b style="float:right">I</b>
                            </td>
                            <td style="text-align: center; width: 80%">
                               <center><b>ALAMAT AKSI</b></center>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td style="padding:0px;padding-right:15px;padding-left:15px;">                               
                            </td>
                        </tr> -->
                    </table>

                    <table style="border-collapse: collapse;">
                    <?php
                       
                        $count_alamat_aksi = 1;
                        $numbering = 1;
                        foreach($alamat_aksi as $key => $c){
                            if($c->urutan != NULL){
                            if($count_alamat_aksi==1){
                                echo "<tr>";
                            }
                           

                            $checked = "";
                            $checkeds = "";

                            $keysp = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idbut)->result();//ubah mei surmas5

                            $penerima = array();
                            $aks = array();
                            foreach ($keysp as $key => $vs) {
                                $penerima = $vs->penerima_disposisi;
                                $aks = $vs->jenis; 

                                if($penerima == $c->id){
                                    if($aks == 'AKSI'){
                                      $checked = "checked";
                                    }

                                    if($aks == 'INFORMASI'){
                                      $checkeds = "checked";
                                    }
                                }
                            }


                            echo '<td class="first">

                            
                            <input disabled type="checkbox" name="" id="" class=""'. $checked .'> 
                            
                            <input disabled type="checkbox" name="" id="" class=""'. $checkeds .'> 
                           
                            </td><td class="second"><label style="font-size:11px !important;">'.$c->nama_jabatan .'</label></td>';
                            if($count_alamat_aksi==4){
                                echo "</tr>";
                                $count_alamat_aksi = 0;
                            }
                            $count_alamat_aksi = $count_alamat_aksi + 1;
                            $numbering += 1;
                        }}
                    ?>
                    </table>
                    <br>

                    <table style="width: 100%; border-collapse: collapse; border-top: 0.5px solid black; border-bottom: 0.5px solid black;">                        
                        <tr>
                            <td style="width: 8%">&nbsp;</td>
                            <td colspan="6" style="text-align: center; width: 80%">
                               <b>AKSI</b>
                            </td>
                        </tr>
                    </table>
                    <table style="font-size: 11px;">
                        <?php
                            $count_aksinya = 1;
                            $selectednya = "";
                            foreach($aksinya as $abc){
                                if($count_aksinya==1){
                                    echo "<tr>";
                                }
                               
                                 $selected = "";
                                    $param = array();
                                    $table_aksi = $this->db->query('SELECT * FROM notadinas.aksi_disposisi_surat_masuk WHERE id_disposisi_surat_masuk = '.$idbut)->result();//ubah mei surmas5

                                    foreach ($table_aksi as $key => $svs) {
                                        $param = $svs->id_aksi;

                                        if($param == $abc->id){
                                            $selected = "checked";
                                        }

                                }

                                echo '<td class="first"><input disabled type="checkbox" name="" id="" class=""'. $selected .'></td><td class="second"><label style="font-size:11px !important;"> '. $abc->nama_aksi .'</label></td>';
                                if($count_aksinya==4){
                                    echo "</tr>";
                                    $count_aksinya = 0;
                                }
                                $count_aksinya = $count_aksinya + 1;
                            }
                        ?>
                    </table>
                   
                </td>
            </tr>
        </table>

        <table class="fourth">
             <br>             
                    <table id="first">
                        <tr bgcolor="#FF0000" style="color: white; text-decoration: none">
                            <td><center>Disposisi/Catatan</center></td>
                        </tr>
                    </table>
                    <br>
                   <?php

                    $id = $idbut;//ubah mei surmas5

                    $get = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.id_surat_masuk ='".$id."' order by id asc")->result_array();

                 
                    ?>


                    <table class="fourth">
                        <tr>
                            <td>
                                <?php if(!empty($get)){//ubah mei surmas5
                                    echo $get[0]['keterangan'];                                    
                                }else{
                                    
                                }?>
                            </td>
                        </tr>
                    </table>

        </table>
        <?php 
        if (strlen($get[0]['keterangan']) > 350) {
        echo "<div class='page-break'></div>";
        }
    
        ?>        
        <table class="fourth">
             <br> 
             <br>  
                <?php 
                    if(strlen($get[0]['keterangan']) > 350) {
                        echo $data->no_setum;;
                    }                            
                ?>

                    <table id="first">
                        <tr>
                            <td><center>Feedback</center></td>
                        </tr>
                    </table>
                    <br>
                   <?php

                    $id = $idbut;//ubah mei surmas5

                    $get = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$id  )->result_array();

                     $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk a, notadinas.master_jabatan b, notadinas.surat_masuk c  where a.pengirim = b.id AND a.id_surat_masuk = c.id AND id_surat_masuk ='.$id.' ORDER BY a.id_feedback')->result(); 

                 
                    ?>


                    <table id="fourth">
                        <tr>
                            <td>
                              

                                 
                            <?php  foreach ($chat as $key => $res) {
                            if($res->penerima == $this->session->userdata('admin_jabatan')){
                            if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                          
                               
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p> 
                                <?php }  else { ?>
                                  <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p>     
                                <?php } ?>
                          
                            
                                <p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <br> <sub style="color: #555";>&nbsp; <?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></sub> </p>
                           

                            <?php }else{ ?>

                          
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"></span> </p> 

                                  <?php }  else { ?>
                                  <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p>     
                                <?php } ?>

                                <p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <sub style="color: #555";>&nbsp;  <?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></sub> </p>
                         

                            <?php }  }} ?>

                            </table>
                            </td>
                        </tr>
                    </table>
                                    
        <?php } ?>
    <?php if($this->session->userdata('admin_jabatan') != 1 && $this->session->userdata('admin_jabatan') != 2 && $this->session->userdata('admin_jabatan') != 28){ ?>
<div style="display:block;">
        <table id="first">
            <tr>
                <td>Disposisi Kasubdis</td>
            </tr>
        </table>
        <table id="fourth" style="font-size: 11px;">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td colspan="6">
                               <center> <b>ALAMAT AKSI</b> </center>
                            </td>
                        </tr>

                    


                    <?php
                       
                        $count_alamat_aksi = 1;
                        foreach($alamat_aksi_sub as $key => $c){
                           
                            if($count_alamat_aksi==1){
                                echo "<tr>";
                            }
                           

                            $checked = "";
                            $checkeds = "";

                            $keysp = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idbut)->result();//ubah mei surmas5

                            $penerima = array();
                            $aks = array();
                            foreach ($keysp as $key => $vs) {
                                $penerima = $vs->penerima_disposisi_satuan;
                                $aks = $vs->jenis; 

                                if($penerima == $c->id_subjabatan){
                                    if($aks == 'AKSI'){
                                      $checked = "checked";
                                    }

                                    if($aks == 'INFORMASI'){
                                      $checkeds = "checked";
                                    }
                                }
                            }


                            echo '<td class="first">

                            
                            <input disabled type="checkbox" name="" id="" class=""'. $checked .'> 
                            
                            <input disabled type="checkbox" name="" id="" class=""'. $checkeds .'> 
                           
                            </td><td class="second"><label style="font-size:11px !important;">'. $c->nama_subjabatan .'</label></td>';
                            if($count_alamat_aksi==3){
                                echo "</tr>";
                                $count_alamat_aksi = 0;
                            }
                            $count_alamat_aksi = $count_alamat_aksi + 1;
                        }
                    ?>
                    </table>
                    <br>
                    
                         <table style="font-size: 11px;">
                        <tr>
                            <td colspan="6">
                               <center>  <b>AKSI</b> </center>
                            </td>
                        </tr>
                        <?php
                            $count_aksinya = 1;
                            $selectednya = "";
                            foreach($aksinya as $abc){
                                if($count_aksinya==1){
                                    echo "<tr>";
                                } 
                               
                                 $selected = "";
                                    $param = array();
                                    $table_aksi = $this->db->query('SELECT * FROM notadinas.aksi_disposisi_surat_masuk_satuan WHERE notadinas.aksi_disposisi_surat_masuk_satuan.id_surat_masuk = '.$idbut)->result();//ubah mei surmas5

                                    foreach ($table_aksi as $key => $svs) {
                                        $param = $svs->id_aksi;

                                        if($param == $abc->id){
                                            $selected = "checked";
                                            // echo $param;
                                        }

                                }

                                echo '<td class="first"><input disabled type="checkbox" name="" id="" class=""'. $selected .'></td><td class="second"><label style="font-size:11px !important;"> '. $abc->nama_aksi .'</label></td>';
                                if($count_aksinya==3){
                                    echo "</tr>";
                                    $count_aksinya = 0;
                                }
                                $count_aksinya = $count_aksinya + 1;
                            }
                        ?>  
                    </table>
                   
                </td>
            </tr>
        </table>


          <table class="fourth">
             <br>
             <br>
             <br>
             <br>
             <br>
             <br>
                    <table id="first">
                        <tr>
                            <td><center>Disposisi/Catatan</center></td>
                        </tr>
                    </table>
                    <br>
                   <?php

                    $id = $idbut;//ubah mei surmas5

                    $get = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.penerima_disposisi IS NULL AND  notadinas.disposisi_surat_masuk.id_surat_masuk = '.$id)->result_array();

                 
                    ?>


                    <table class="fourth">
                        <tr>
                            <td>
                                <?php if(isset($get[0]['keterangan'])){   
                                echo $get[0]['keterangan']; 
                                } ?>
                            </td>
                        </tr>
                    </table>

        </table>

        <table class="fourth">
             <br>
             <br>
             <br>
             <br>
             <br>
             <br>
                    <div class="page">
                    <table id="first">
                        <tr>
                            <td><center>Feedback</center></td>
                        </tr>
                    </table>
					
					

                            <?php $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk_satuan a, notadinas.master_jabatan b where a.pengirim = b.id AND id_surat_masuk ='.$id.' ORDER BY a.id_feedback')->result(); 

                                foreach ($chat as $key => $res) {
                                 
                            ?>
							<table id="fourthx">
                        <tr>
                            <td>
                              

                            <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                          
                                <?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p> <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 
                                <?php } ?>
								
                                <p style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                           

                            <?php }else{ ?>

                           
                                <?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span></p> 
								b
                                <?php } ?>
                                <p  style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                           

                            <?php } ?>

                            
                            </td>
                        </tr>
                    </table>

                         
                          <div class="media2-body">

                            

                          </div>
                          
                             
                           
                           

                            <?php } ?>
                       

                
                    <br>
                   <?php

                    $id = $idbut;//ubah mei surmas5

                    $get = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$id  )->result_array();

                     $chat = $this->db->query('SELECT  a.pengirim, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk a, notadinas.master_jabatan b, notadinas.surat_masuk c  where a.pengirim = b.id AND a.id_surat_masuk = c.id AND id_surat_masuk ='.$id.' ORDER BY a.id_feedback')->result(); 

                 
                    ?>

				<?php /*
                    <table id="fourth">
                        <tr>
                            <td>
                              

                                 
                            <?php  foreach ($chat as $key => $res) {
                            if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                          
                               
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p> 
                                <?php }  else { ?>
                                  <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p>     
                                <?php } ?>
                          
                            
                                <p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <sub style="color: #555";>&nbsp; <?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></sub> </p>
                           

                            <?php }else{ ?>

                          
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"></span> </p> 

                                  <?php }  else { ?>
                                  <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p>     
                                <?php } ?>

                                <p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <sub style="color: #555";>&nbsp;  <?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></sub> </p>
                         

                            <?php }  } ?>

                            </table>
                            </td>
                        </tr>
                    </table>
					*/ ?>
                    </div>

        </table>
</div>
        <?php } ?>

    </body>
</html>