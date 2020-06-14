<template>
	<div class="container">
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
						<img src="https://ppdb.man2bulukumba.sch.id/uploads/m2b.png" class="img_logo">
					</div>
				</div>
			</div>
			<button class="btn btn-fill btn-primary" @click="tessuksespage">Buat PDF</button>
		</div>
	
	</div>
</template>

<script>

import Card from "./../themeComponents/Cards/Card.vue";
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import html2canvas from "html2canvas"

export default {
    components: {
		Card
    },
    data() {
        return {
			
		}
	},
    methods: {
		tessuksespage(){
			this.$router.push({ name: 'successReg', params: {nama: 'Muhammad Iqbal', no_reg: 'HO807BKGKG364FJ', pin: '61632'}})
		},
		initpdf(){
			// var doc = new jsPDF({
			  // orientation: 'portrait',
			  // unit: 'mm',
			  // format: [210, 297]
			// });
			//const contentHtml = this.$refs.content.innerHTML;
			// doc.fromHTML(
				// contentHtml
				// , 15 // x start coord
				// , 15 // y start coord
				// , {
					// 'width':210 // max width of content on PDF
					// , 'elementHandlers': {} // <- empty object
				// }
			// );
			var canvasElement = document.createElement('canvas');
			html2canvas(document.getElementById('content'),{
				scrollX: 0,
				scrollY: 0,
				scale:3,
				logging:true
			}).then(function (canvas) {
				const img = canvas.toDataURL('image/jpeg', 1);
				//document.body.appendChild(canvas);
				var doc = new jsPDF();
				doc.addImage(img,'PNG',15,15, 179,24.6);
				doc.save('tespdf.pdf');
			});
		}
	}
};
</script>
<style scoped>
	@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bitter:ital,wght@0,400;0,700;1,400&family=Martel+Sans:wght@300;700&family=Roboto:ital,wght@0,100;0,300;0,500;0,700;1,100;1,300&family=Titillium+Web:wght@200&display=swap');
	
	.img_logo {
		max-height:88px;
		max-width:88px;
		width:auto;
		height:auto;
	}
	.kop {
		padding: 0 10px;
		text-align: center;
	}
	.kop_p {
		line-height: 1.1;
		margin-bottom: 5px;
		font-family:Roboto, Martel, Bitter;
		font-weight:bold;
		font-size:16px;
	}
	
	.lokasi {
		font-size: 13px;
		font-family: 'Titillium Web', sans-serif;
		line-height: 1.1;
		margin-bottom: 5px;
	}
	
	c-bottom-border {
		border-bottom: 1px solid #000000;
	}
	
</style>