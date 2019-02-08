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
            <tr class="first">
                <td>
                    <h4>TENTARA NASIONAL INDONESIA ANGKATAN LAUT</h4>
                    <h4>PUSAT HIDROGRAFI DAN OSEANOGRAFI</h4>
                </td>
                
            </tr>

            <tr>
                <td><hr></td> 
            </tr>
            <br>
			<tr class="fourth">
                <td colspan="2"><center>
				<img style=" height: 50px;" src="<?php echo base_url(); ?>aset/img/Logo-TNI-AL.jpg"><br>
				Surat Edaran<br>
				Nomor : Kep/<?= $q->no_surat; ?><br><br>
				Tentang <br>
				<?= $q->perihal; ?><br>
				</center></td>
            </tr>
			<tr class="fourth">
                <td colspan="2"><?= $q->isi; ?></td>
            </tr>
			<tr class="third">
                <td></td>
                <td>
                    <table>
                        <tr>
                            <td>Dikeluarkan di Jakarta<br>pada tanggal <?=$q->tgl_surat;?></td>
                            <td><hr></td>
                        </tr>
                        <tr>
                            <td><br> Kepala Pushidrosal </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?php if( $q->signature != ""  ||  $q->signature = null) { ?>
                                    <img src="data:image/png;base64,<?= $q->signature ?>"/>
                                <?php } else { ?>
                                     <br><br><br><br>
                                <?php } ?> 
                                <p>Harjo Susmoro<br>Laksamana Muda TNI</p>
							</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>
        <table id="second">
            <tr class="fifth">
                <td>
                    <table>
                        <tr>
                            <td>
                                Kepada Yth : <br><?= $q->kepadanya; ?>
                            </td>
                            <td>
								<table>
                                    <tr>
                                        <td>No</td>
                                        <td>Jabatan</td>
                                        <td>Paraf</td>
                                        <td>Tanggal</td>
                                    </tr>
                                    <?php
                                        $count = 1;

                                        foreach($r as $a){
                                            echo "
                                            <tr>
                                                <td>".$count++ ."</td>
                                                <td>".$t['t'.$a->id_jabatan]."</td>
                                                <td>Pada Draft</td>
                                                <td>".$a->tanggal."</td>
                                            </tr>
                                            ";
                                        }
                                        echo "
                                            
                                            <tr>
                                                <td>".$count++ ."</td>
                                                <td>SETUM</td>
                                                <td>Pada Draft</td>
                                                <td>".$q->tgl_surat."</td>
                                            </tr>
                                            ";
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
			<tr class="fourth">
                <td colspan="2"> Tembusan : <br><?= $q->kepadanya; ?></td>
			</tr>
        </table>
    </body>
</html>