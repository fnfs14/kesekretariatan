<html >
    <head>
        <style>
            @media print {
                @page { margin: 0; }
                body { margin: 1.6cm; }
            }
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
                    #first {
                        width : 100%;
                        margin-top : 40px;
                    }
                    #first tr:first-child td {
                        border : 1px solid black;
                        padding : 10px;
                        font-weight : bold;
                        background-color: black !important;
                        -webkit-print-color-adjust: exact; 
                        /* font-size : 130%; */
                        color : white;
                        border-radius : 3px;
                    }
            #second {
                margin-top : 25px;
                width : 100%;
                border : 1px solid black;
                border-radius : 3px;
                background-color: whitesmoke !important;
                -webkit-print-color-adjust: exact; 
            }
            #second tr td {
                padding : 10px;
                width : 50%;
                vertical-align : top !important;
            }
                    #second tr:first-child td:first-child table  {
                        width : 100%;
                        border : 1px solid black;
                        padding : 10px;
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
                border : 1px solid black;
                border-radius : 3px;
                background-color: whitesmoke !important;
                -webkit-print-color-adjust: exact; 
                padding : 10px 20px 10px 20px;
            }
            #fourth tr td {
                padding : 5px;
                font-size : 80%;
            }
            #fourth tr td input {
                width : 50px;
            }
                    #fourth tr td table {
                        background-color: white !important;
                        -webkit-print-color-adjust: exact; 
                    }
            #fourth tr td h4 {
                text-align : left;
                font-size : 130%;
				margin-bottom : 5px;
            }
                    a {
                        color : black;
                    }
        </style>
    </head>
    <body onload="window.print()">
    <!-- <body> -->
        <h4>TENTARA NASIONAL INDONESIA ANGKATAN LAUT</h4>
        <h4>PUSAT HIDROGRAFI DAN OSEANOGRAFI</h4>
        <h4>NOTA DINAS</h4>
        <table id="first">
            <tr>
                <td>Detail Surat</td>
            </tr>
        </table>
        <table id="second">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">Agenda SETUM</td>
                        </tr>
                        <tr>
                            <td>No. Agenda</td>
                            <td>:&nbsp;<label><?php echo $data->no_agenda; ?></label></td>
                        </tr>
                        <tr>
                            <td>Tanggal SETUM</td>
                            <td>:&nbsp;<label><?php $date = new DateTime($data->tgl_surat); echo $date->format("d-m-Y"); ?></label></td>
                        </tr><!-- 
                        <tr>
                            <td>Klasifikasi</td>
                            <td>:&nbsp;<label><?php echo $data->klasifikasi; ?></label></td>
                        </tr> -->
                        <!-- <tr>
                            <td>Derajat</td>
                            <td>:&nbsp;<label><?php echo $data->drajat; ?></label></td>
                        </tr> -->
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">Detail Surat</td>
                        </tr>
                        <tr>
                            <td>Dari</td>
                            <td>:&nbsp;<label><?php
				foreach($user_n as $a){
					if($a->id == $data->create_by){
						echo "$a->nama_lengkap";
					}
				}
			?></label></td>
                        </tr>
                        <tr>
                            <td>Nomor Surat</td>
                            <td>:&nbsp;<label><?php echo $data->no_surat; ?></label></td>
                        </tr>
                        <tr>
                            <td>Tanggal Surat</td>
                            <td>:&nbsp;<label><?php $date = new DateTime($data->tgl_surat); echo $date->format("d-m-Y"); ?></label></td>
                        </tr>
                        <tr>
                            <td>Kegiatan</td>
                            <td>:&nbsp;<label><?php echo $data->nama_kegiatan; ?></label></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:&nbsp;<label><?php echo $data->perihal; ?></label></td>
                        </tr>
                        <tr>
                            <td>Diteruskan Kepada</td>
                            <td>:&nbsp;<label><?php echo $jabatan->nama_jabatan; ?></label></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:&nbsp;<label><?php echo $data->keterangan; ?></label></td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td><b><a href="<?= site_url(); ?>upload/nota_dinas/<?= $data->file_attachment; ?>"><?= $data->file_attachment; ?></a></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <table class="fourth">
            <tr class="fourth">
                <td>
                    <h3><?php echo $data->isi; ?></h3>
                </td>
            </tr>
        </table>
        <table class="fourth">            
             
             <br>
             <br>
             <br>
                    <table id="first">
                        <tr>
                            <td><center>Feedback</center></td>
                        </tr>
                    </table>
                    <br>
                   <?php

                    $id = $this->uri->segment(3);

                    $getme = $id; 
                    
                    $chat = $this->db->query("SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_nota_dinas a, notadinas.master_jabatan b where a.pengirim = b.id AND id_nota_dinas ='".$getme."' AND a.penerima = '".$this->session->userdata("admin_jabatan")."' ORDER BY a.id_feednota")->result(); 


                 
                    ?>


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
    </body>
</html>