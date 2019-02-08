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
                    <h4>PUSAT HIDROGRAFI DAN OSEANOGRAFI TNI AL</h4>
                    <h4>SEKRETARIAT UMUM</h4>
                </td>
                
            </tr>

            <tr>
                <td><hr></td> 
            </tr>
            <br>
            
            <tr class="fifth">
                <td >
                    
                    <table>
                        <tr>
                            <td>
                            <centar>
                            <p><br></p>
                            <p>NOTA DINAS<br>
                                Nomor B/ND/<?= $q->no_surat ?></p>
                            </centar>
                        </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="second">
                <td>
                    <table>
                        <tr>
                            <td>Kepada Yth. </td>
                            <td>:</td>
                            <td > <?= $q->kepadanya; ?></td>
                           
                            
                        </tr>
                        <tr>
                            <td>Dari</td>
                            <td>:</td>
                            <td> <?= $w->nama_lengkap ?></td>
                        </tr>
                        
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td> <?= $q->perihal; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><hr width="70%"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="third">
                <td></td>
                <td>
                    <table>
                        <tr>
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
                                
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <p> Jakarta, &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
                                <p> Kasetum,</p>
                                <br>
                                <?php if( $q->signature != ""  ||  $q->signature = null) { ?>
                                    <img src="data:image/png;base64,<?= $q->signature ?>"/>
                                <?php } else { ?>
                                     <br><br><br><br>
                                <?php } ?>     
                                <br>
                                <p>Harjo Susmoro</p>
                                <p>Laksamana Muda TNI</p>
                            </td>
                       
            </td>
        </table>
    </body>
</html>