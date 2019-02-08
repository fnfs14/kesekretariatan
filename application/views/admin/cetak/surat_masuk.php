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
    </body>
</html>