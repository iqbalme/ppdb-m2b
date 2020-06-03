<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cetak Kartu Registrasi</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<!--link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /-->
		<!--script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script-->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bitter:ital,wght@0,400;0,700;1,400&family=Martel+Sans:wght@300;700&family=Roboto:ital,wght@0,100;0,300;0,500;0,700;1,100;1,300&display=swap" rel="stylesheet">
        <!-- Styles -->
        <style>
		@media print {
			@page {
				size: auto;
			}
		}
		
		.pp1 p {
			line-height:0.6em;
			margin-bottom:0.6em;
			font-family:Roboto, Martel, Bitter;
		}
		
		.img_logo {
			max-height:90px;
			max-width:90px;
			width:auto;
			height:auto;
		}
		
		.foto {
			max-height:120px;
			max-width:160px;
			width:auto;
			height:auto;
			border: solid 3px #000;
		}
		
		.float-right {
			float:right;
		}
		
		.float-left {
			float:left;
		}
		
		.flex-container {
		  display: flex;
		}
        </style>
    </head>
    <body>
		<div style="max-width:679px">
			<div id="content">
				<div class="row align-items-center c-bottom-border">
					<div class="col-md-2">
						<img src="http://ppdb.ccom/uploads/kemenag.png" class="img_logo">
					</div>
					<div class="col-md-8">
						<p class="kop_p text-center mt-2">KEMENTERIAN AGAMA REPUBLIK INDONESIA</p>
						<p class="kop_p text-center">KANTOR KEMENTERIAN AGAMA KABUPATEN BULUKUMBA</p>
						<p class="kop_p text-center">MADRASAH ALIYAH NEGERI 2 BULUKUMBA</p>
						<p class="lokasi text-center">Jl. Matahari No. 21 Bulukumba, Telp 0413-81118</p>
					</div>
					<div class="col-md-2">
						<img src="http://ppdb.ccom/uploads/m2b.png" class="img_logo">
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
