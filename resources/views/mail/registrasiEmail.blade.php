<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div style="text-align: justify;">
				<h3>Assalamu 'alaikum warahmatullahi wa barakatuh</h3>
				<p>Halo, <b>{{ $nama }}</b>, Selamat Anda berhasil terdaftar pada Aplikasi PPDB Online MAN 2 Bulukumba.</p>
				<ul>
					<li>
						<p style="color:blue;font-weight:bold;">No Registrasi : {{ $no_registrasi }}</p>
					</li>
					<li>
						<p style="color:blue;font-weight:bold;">PIN : {{ $pin }}</p>
					</li>
				</ul>
				<p>Ini adalah langkah pertama. Langkah selanjutnya adalah melakukan verifikasi data dan kelanjutan proses pendaftaran yang dilakukan langsung di lokasi sekolah.</p>
				<p>Berikut kami lampirkan bukti pendaftaran serta surat pernyataan. Silakan <font style="color:red">diprint</font> dan dibawa serta bersama syarat dokumen lainnya ke sekolah.</p>
				<br>
				<br>
				<br>
				<p><font style="text-decoration:underline;font-weight:bold">Catatan:</font> Jika sewaktu-waktu Anda kehilangan bukti registrasi ini, silakan cek status Anda di situs <a href="https://ppdb.man2bulukumba.sch.id/status">PPDB MAN 2 Bulukumba</a> dan Anda bisa melakukan print kembali dengan memasukkan PIN Anda.</p>
				<br>
				<br>
				<br>
				<p>Salam hormat kami,</p>
				<p>Panitia PPDB MAN 2 Bulukumba</p>
            </div>
        </div>
    </body>
</html>
