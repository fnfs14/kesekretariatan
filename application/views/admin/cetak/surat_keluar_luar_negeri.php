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
                    <h4>PUSAT HIDROGRAFI DAN OSEANOGRAFI TNI-AL</h4>
                    Jl.Pantai Kuta V Jakarta 14430<br>Indonesia<br>
					telp.(62)(021)64714809 Fax.(62)(021)64714809<br>Email : infohid@dishidros.go.id
                </center></td>
                
            </tr>

            <tr>
                <td colspan="2"><hr></td> 
            </tr>
			<tr class="fourth">
                <td>No. B/<?= $q->no_surat; ?></td>
				<td align="right">Jakarta, <?=$q->tgl_surat;?></td>
            </tr>
			<tr class="fourth">
				<td><?= $q->kepadanya; ?></td>
            </tr>
			<tr class="fourth">
				<td colspan="2"><?= $q->isi; ?></td>
            </tr>
			<tr class="third">
                <td>
                    <table>
                        <tr>
                            <td>Sincerely Yours,</td>
                            <td><hr></td>
                        </tr>
                        <tr>
                            <td><?php if( $q->signature != ""  ||  $q->signature = null) { ?>
                                    <img src="data:image/png;base64,<?= $q->signature ?>"/>
                                <?php } else { ?>
                                     <br><br><br><br>
                                <?php } ?> 
                                <p>First Admiral Harjo Susmoro</p>
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
                            <td>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>