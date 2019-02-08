<html>
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
                width : 80%;
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
                    tr.fifth td table table td:nth-child(3) {
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
                <td>
                    <p>Jakarta, 03 Mei 2017</p>
                </td>
            <tr>
            <tr>
                <td><hr></td>
            </tr>
            <tr class="second">
                <td>
                    <table>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td> <?= $q->no_surat; ?></td>
                        </tr>
                        <tr>
                            <td>Klasifikasi</td>
                            <td>:</td>
                            <td> <?= $q->klasifikasi; ?></td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>:</td>
                            <td> <?= $q->file_attachment; ?></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td> <?= $q->perihal; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="third">
                <td></td>
                <td>
                    <table>
                        <tr>
                            <td>Kepada</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Yth. <?= $q->kepadanya; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>di</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Jakarta</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="fourth">
                <td colspan="2"><?= $q->isi; ?></td>
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
                                    </tr>
                                    <?php
                                        $count = 0;
                                        foreach($r as $a){
                                            echo "
                                            <tr>
                                                <td>".$count."</td>
                                                <td>".$t['t'.$a->id_jabatan]."</td>
                                                <td>Pada Draft</td>
                                            </tr>
                                            ";
                                            $count++;
                                        }
                                    ?>
                                </table>
                            </td>
                            <td>
                                <p>Kuasa Pengguna Anggaran</p>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <p><?= $w->nama_lengkap; ?></p>
                                <p><?= $e->nama_jabatan; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>