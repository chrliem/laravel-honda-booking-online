<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="color-scheme" content="light">
        <meta name="supported-color-schemes" content="light">
<style>
@media  only screen and (max-width: 600px) {
.inner-body {
    width: 100% !important;
}

.footer {
    width: 100% !important;
}
}

@media  only screen and (max-width: 500px) {
.button {
    width: 100% !important;
}
}
</style>
    </head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;"><tr>
    <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
    <tr>
        <td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center;">
            <!-- <a href="https://markdownmail.com" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 #ffffff; display: inline-block;"> -->
            <!-- <img src="https://hondasukunmalang.co.id/wp-content/uploads/2022/07/HSM.png" class="logo" alt="Honda Logo" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; max-width: 25%; border: none;"></a> -->
            <!-- <a href="{!! URL::to('/') !!}"> -->
                <!-- <img src="/asset/Honda.png" /> -->
            <!-- </a> -->
            <h1> Honda Bintang Group Online Booking Service </h1>
        </td>
    </tr>
<!-- Email Body --><tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
            <!-- Body content -->
            <tr>
                <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                    <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">{{$data['nama_dealer']}}</h1>
                    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Halo, {{$nama}}, terdapat booking terbaru di {{$data['nama_dealer']}} dengan kode booking {{$data['kode_booking']}}</p>
                    <h2 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 16px; font-weight: bold; margin-top: 0; text-align: left;">Data Booking</h2>
                    <div class="table" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <table style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                            <tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Nama Customer</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['nama_customer']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Email Customer</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['email_customer']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>No Handphone</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['no_handphone']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>No Polisi</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['no_polisi']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Model Kendaraan</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['model_kendaraan']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Nomor Rangka</strong></td>
                                @if(is_null($data['no_rangka']))
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">https://be.bintang-group.co.id/storage/no_rangka_image/{{$data['no_rangka_image']}}</td>
                                @else
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['no_rangka']}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Dealer</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['nama_dealer']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Tanggal Service</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['tgl_service']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Jenis Pekerjaan</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['jenis_pekerjaan']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Jenis Layanan</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['jenis_layanan']}}</td>
                            </tr>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;"><strong>Keterangan Customer</strong></td>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{$data['keterangan_customer']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                        <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;"><tr>
                            <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;"><tr>
                                    <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;"><tr>
                                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                <a href="http://booking.bintang-group.co.id/admin/dashboard" class="button button-blue" target="http://booking.bintang-group.co.id/admin/dashboard" rel="noopener" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097d1; border-top: 10px solid #3097d1; border-right: 18px solid #3097d1; border-bottom: 10px solid #3097d1; border-left: 18px solid #3097d1;">Dashboard</a>
                                            </td>
                                            </tr>
                                        </table>            
                                    </td>
                                </tr></table>
                            </td>
                            </tr></table>
                            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Terima kasih,<br>
                            Honda Bintang Group Online Booking Service</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;"><tr>
                <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                </td>
            </tr></table>
        </td>
    </tr>
</table>
</td>
</tr></table>
</body>
</html>