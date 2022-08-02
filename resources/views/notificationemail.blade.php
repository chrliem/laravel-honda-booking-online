<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/app.css">
        <title>Online Booking Service Baru di {{$data['nama_dealer']}}</title>
    </head>
    <body>
        <table style="width: 100%;">
    <tbody>
    <tr>
        <td colspan="2"><center><strong>Online Booking Service | {{$data['nama_dealer']}}</strong></center></td>
    </tr>
    <tr>
        <td colspan="2"><center><img src="./asset/Logo Honda.jpg" width="30%" /></center></td>
    </tr>
    <tr style="background-color:black">
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr class="border-bottom">
        <td colspan="2"><strong><center>Data Booking</center></strong></td>
    </tr>
    <tr>
        <td><strong>Kode Booking        :</strong> {{$data['kode_booking']}} <br>
            <strong>Nama Lengkap        : </strong> {{$data['nama_customer']}}<br>
            <strong>Alamat Email        : </strong> {{$data['email_customer']}}<br>
            <strong>No Handphone        :</strong>  {{$data['no_handphone']}}<br>
            <strong>No Polisi           : </strong> {{$data['no_polisi']}}<br>
            <strong>Model Kendaraan     :</strong>  {{$data['model_kendaraan']}}<br>
            <strong>Jenis Transmisi     :</strong>  {{$data['jenis_transmisi']}}<br>
            <strong>Tanggal Service    : </strong> {{$data['tgl_service']}}<br>
            <strong>Jenis Pekerjaan     :</strong>  {{$data['jenis_pekerjaan']}}<br>
            <strong>Jenis Layanan       : </strong> {{$data['jenis_layanan']}}<br>
            <strong>Keterangan          :</strong> <br> {{$data['keterangan_customer']}}
        </td>
        
    </tr>
    <tr style="background-color:black">
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><center><button type="button" class="btn btn-primary">Dashboard 🡲 </button></center>
        </td>
    </tr>
    </tbody>
    </table>
</body>    
</html>

<style>
    tr.border-bottom td {
  border-bottom: 1px solid black;
}
td.border-bottom-1{
    border-bottom: 1px solid black;
}
body {
    font-family: 'Roboto Condensed';
}

</style>