<body style="background-color:#FFFFFF">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
           width="100%" bgcolor="white">
        <tbody>
            <tr>
                <td align="center">
                    <table align="center" border="0" cellpadding="0"
                           cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td align="center" style="background-color: #CC0000;
                                           height: 50px;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr style="height: 120px;">
                <td align="center" style="border: none;
                           border-bottom: 2px solid #CC0000; 
                           padding-right: 20px;padding-left:20px">
   
                    <p style="font-weight: bolder;font-size: 24px;
                              letter-spacing: 0.025em;
                              color:black;">
                        {{$data['nama_dealer']}}
                        <br> Online Booking Service Terbaru
                    </p>
                </td>
            </tr>
   
            <tr>
                <td style="align-items: center;">
                    <h2 style="text-align: center;
                               align-items: center;">
                        Data Booking
                   </h2>
            </td>
</tr>
                   <tr><td>
                    <p style="text-align: center;"><strong>Kode Booking        :</strong> {{$data['kode_booking']}} <br></p>
                    <p style="text-align: center;"><strong>Nama Lengkap        : </strong> {{$data['nama_customer']}}<br>
                    <p style="text-align: center;"><strong>Alamat Email        : </strong> {{$data['email_customer']}}<br>
                    <p style="text-align: center;"><strong>No Handphone        :</strong>  {{$data['no_handphone']}}<br>
                    <p style="text-align: center;"><strong>No Polisi           : </strong> {{$data['no_polisi']}}<br>
                    <p style="text-align: center;"><strong>Model Kendaraan     :</strong>  {{$data['model_kendaraan']}}<br>
                    <p style="text-align: center;"><strong>Jenis Transmisi     :</strong>  {{$data['jenis_transmisi']}}<br>
                    <p style="text-align: center;"><strong>Tanggal Service    : </strong> {{$data['tgl_service']}}<br>
                    <p style="text-align: center;"><strong>Jenis Pekerjaan     :</strong>  {{$data['jenis_pekerjaan']}}<br>
                    <p style="text-align: center;"><strong>Jenis Layanan       : </strong> {{$data['jenis_layanan']}}<br>
                    <p style="text-align: center;"><strong>Keterangan          :</strong> <br> {{$data['keterangan_customer']}}                        
                    </td></tr>
                <!-- <button type="button" href="http://localhost:8080/admin/dashboard"
                    style="text-decoration: none; 
                    background-color:#1976D2; 
                    color: white;
                    padding: 10px 30px;
                    font-weight: bold;
                    margin-left: 40%;"> 
                    Dashboard
                </button> -->
            <tr style="border: none; 
            background-color: #CC0000; 
            height: 40px; 
            color:white; 
            padding-bottom: 20px;">
            </tr>
        </tbody>
    </table>
</body>

  
