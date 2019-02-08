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
                <td align="left">
                    <h4>[ cap perusahaan ]</h4>
                </td>
				<td align="right">
                    <img style=" height: 100px;" src="<?php echo base_url(); ?>aset/img/pushidros.png">
                </td>
            </tr>
			<tr class="fourth">
                <td colspan="2"><center>
				KONTRAK KERJA<br>
				ANTARA <br> [ PIHAK 1 ]<br>
				DAN <br> [ PIHAK 2 ]<br><br>
				TENTANG <br>
				<?= $q->perihal; ?>
				</center></td>
            </tr>
            <tr>
                <td colspan="2"><hr></td> 
            </tr>
            <br>
			<tr class="fourth">
                <td align="center">Nomor : </td>
				<td align="left">PKS/<?= $q->no_surat; ?> <br> KTR/<?= $q->no_surat; ?> </td>
            </tr>
			<tr class="fourth">
                <td colspan="2"><?= $q->isi; ?></td>
            </tr>
            
        </table>
        <table id="second">
            <tr class="fifth">
                <td>
                    <table>
                        <tr align="center">
                            <td>
                                <p>PIHAK KEDUA</p>
								[ pihak kedua ]
                                <br><br><br><br><br><br>
                                <p>[ nama pihak kedua ]</p>
                            </td>
                            <td>
                                <p>PIHAK PERTAMA</p>
								[ pihak pertama ]
                                <br><br><br><br><br><br>
                                <p>[ nama pihak pertama ]</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>