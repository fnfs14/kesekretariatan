<html>
    <head>
        <style>
            @media print {
                @page { margin: 0; }
                body { margin: 1.6cm; font-size: 12px; }
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
                        margin-top : 20px;
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
                border-collapse: collapse;
                background-color: whitesmoke !important;
                -webkit-print-color-adjust: exact; 
                padding : 10px 20px 10px 20px;
            }
            #fourth tr td {
                border: 1px solid #ddd;
    padding: 8px;
                
                font-size : 100%;
            }
            #fourth tr td input {
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
        <h4>TENTARA NASIONAL INDONESIA ANGKATAN LAUT</h4>
        <h4>PUSAT HIDROGRAFI DAN OSEANOGRAFI</h4>
        <h4>KESEKRETARIATAN</h4>

       <!--  <table id="first">
            <tr>
                <td>Detil Log Proses Surat</td>
            </tr>
        </table>
        <table id="fourth" >
            
                 <!--  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Proses</th>
                            <th>Keterangan</th>
                            <th>Komentar</th>
                            <th>Proses</th>
                        </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        <?php $azx = 1;
                        foreach ($log_surat_keluarnya as $m) {
                            echo "<tr>
                        <td>$azx</td>
                        <td>$m->tanggal_proses</td>
                        <td>$m->Keterangan</td>
                        <td>$m->komentar</td>
                        <td>$m->nama_proses</td>
                    </tr>";
                            $azx += 1;
                        } ?>
                        </tbody>
                   <!--  </table> 
               
        </table> -->

        <table id="first">
            <tr>
                <td>Detil Tembusan</td>
            </tr>
        </table>
        <table id="fourth" >
            
                 <!--  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
                        <thead>
                        <tr>
                             <td>No</td>
                             <td>Tanggal Proses</td>
                             <td>Jabatan</td>
                             <td>Status</td>
                             <td>Komentar</td>

                        </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        <?php $azx = 1;
                        foreach ($datpil_tembusan as $aa) {
                            echo "<tr>
                        <td>$azx</td>
                        <td>$aa->tanggal</td>
                        <td>$aa->nama_jabatan</td>
                        <td>
                        <div class='col-md-12'><a class='btn-default btn btn-xs status_tembusan_setuju status_tembusan_setuju" . $aa->idnya_tembusan . "'  status_tembusan='" . $aa->idnya_tembusan . "'>Setuju</a></div>
                        </td>
                        <td>$aa->keterangan</td>
                        
                    </tr>";
                            $azx += 1;
                        } ?>
                        </tbody>
                   <!--  </table> -->
               
        </table>
        

       

        

    </body>
</html>