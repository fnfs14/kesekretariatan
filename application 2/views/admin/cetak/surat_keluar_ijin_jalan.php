<html>
    <head>
        <style>
            body {
                display : none;
            }
            @media print {
                body {
                    display : block
                }
            }
            #main {
                width : 100%;
            }
            hr {
                margin : 0px;
            }
                    tr.first td {
                        padding : 30px 30px 0px 30px;
                        text-align : center;
                    }
                    tr.first td h4 {
                        margin : 0px;
                    }
            tr.second td table tr:first-child td {
                padding : 20px 0px 0px 00px;
            }
            tr.second td table tr td:first-child {
                width : 20%;
            }
            tr.second td table tr td:nth-child(2) {
                width : 5%;
                text-align : center;
            }
            tr.second td table {
                width : 100%;
            }
                    tr.third td table {
                        text-align : center;
                    }
                    tr.third td table tr:first-child td {
                        padding : 20px 0px 0px 00px;
                    }
            tr.fourth td {
                padding : 20px 0px 30px 0px;
            }
                    table#second {
                        width : 100%;
                        position : absolute;
                        bottom : 40px;
                    }
                    tr.fifth td table {
                        width : 100%;
                    }
                    tr.fifth td table td:last-child {
                        text-align : center;
                    }
                    tr.fifth td table table {
                        border-spacing : 0px;
                        width : 80%;
                    }
                    tr.fifth td table table td {
                        border : 1px solid black;
                        border-bottom-color : white;
                        border-right-color : white;
                        padding : 5px;
                    }
                    tr.fifth td table table td:nth-child(4) {
                        border-right-color : black;
                    }
                    tr.fifth td table table tr:last-child td {
                        border-bottom-color : black;
                    }
        </style>
    </head>
    <body onload="window.print()"><!--  -->
        <table id="main">
            <tr class="fourth">
				<td align="center">
					<img style=" height: 100px;" src="<?php echo base_url(); ?>aset/img/pushidros.png">
				</td>
                <td><center>
                    <h4>THE INDONESIAN NAVY</h4>
                    <h4>HYDROGRAPHIC AND OCEANOGRAPHIC CENTER</h4>
                    Jl.Pantai Kuta V Jakarta 14430<br>
                    <h4> INDONESIA </h4>
					Email : infohid@dishidros.go.id
                </center></td>
                
            </tr>

            <tr>
                <td colspan="2"><hr></td> 
            </tr>
			<tr class="fourth">
                <td>Reference:  B/<?= $q->no_surat; ?></td>
				<td align="right">Jakarta, &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
            </tr>
			<tr class="fourth">
				<td>Kepada Yth.<br>
                    <?= $q->kepadanya; ?></td>
            </tr>
			<tr class="fourth">
				<td colspan="2"><?= $q->isi; ?></td>
            </tr>


			<table width="100%">
            <tr class="fifth">
                <td>
                    <table>
                        <tr>
                           <td>
                                <p> Pengemudi</p>
                                <br>
                                
                                     <br><br><br><br> <br>
                                    
                                <br>
                                <p> Kopral Yos Edi</p>
                            </td>
                            <td>
                                <p>Pengirim</p>
                                <br>
                                <?php if( $q->signature != ""  ||  $q->signature = null) { ?>
                                    <img height="100px" src="data:image/png;base64,<?= $q->signature ?>"/>
                                <?php } else { ?>
                                     <br><br><br><br>
                                <?php } ?>     
                                <br>
                                <p>Adm. Nindya</p>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    Barang Telah diterima pada tanggal : <?= $q->tgl_surat ?>

                    <br>
                                <p>Pengirim</p>
                                <br>
                                <?php if( $q->signature != ""  ||  $q->signature = null) { ?>
                                    <img height="100px" src="data:image/png;base64,<?= $q->signature ?>"/>
                                <?php } else { ?>
                                     <br><br><br><br>
                                <?php } ?>     
                                <br>
                                <p>Adm. Nindya</p>
                            
                </td>
            
        </table>
            
        </table>

    </body>
</html>