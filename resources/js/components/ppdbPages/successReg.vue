<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
                    <div class="row">
						<div class="col-md-12">
							<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
								REGISTRASI BERHASIL
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<p>SELAMAT <font style="font-weight:bold;color:blue;">{{ nama | upper }}</font>, ANDA BERHASIL TERDAFTAR DALAM SISTEM PENDAFTARAN ONLINE PENERIMAAN SISWA BARU MAN 2 BULUKUMBA.</p>
							<p>Berikut info pendaftaran Anda:</p>
							<b-alert show variant="dark" style="color:black;font-weight:bold;padding-left:25px;">NO. REGISTRASI : {{ no_reg }}</b-alert>
							<b-alert show variant="dark" style="color:black;font-weight:bold;padding-left:25px;">PIN : {{ pin }}</b-alert>
							<p>Silakan cetak dan unduh dokumen di bawah ini.</p>
						</div>
					</div>
					<div class="row" v-if="loading">
						<div class="col-md-12 text-center p-5">
						  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
						</div>
					</div>
					<div class="row" v-if="!loading && failed">
						<div class="col-md-10 offset-md-1 text-center mb-3">
							<b-button variant="danger" class="btn-block btn-fill" @click="makeDokumenPendaftar()">REFRESH</b-button>
						</div>
					</div>
					<div  v-if="!loading & !failed">
						<div class="row">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="danger" class="btn-block btn-fill" @click="forceFileDownload('kartu_reg')">CETAK KARTU REGISTRASI</b-button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="secondary" class="btn-block btn-fill" @click="forceFileDownload('surat_pernyataan_siswa')">CETAK SURAT PERNYATAAN SISWA</b-button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="warning" class="btn-block btn-fill" @click="forceFileDownload('surat_pernyataan_wali')">CETAK SURAT PERNYATAAN WALI</b-button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<br>
							<p>Selanjutnya silakan membawa dokumen ini serta dokumen pendukung lainnya ke sekolah untuk verifikasi data.</p>
							<p>Catatan: jika kehilangan data ini, silakan cek di status pendaftaran dan mencari nama atau no registrasi, selanjutnya Anda bisa cetak dokumen dengan memasukkan PIN..</p>
						</div>
					</div>
                </card>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Card from "./../themeComponents/Cards/Card.vue";
import $axios from '../../api.js';
import Swal from 'sweetalert2';

export default {
    components: {
        Card,
    },
	props: ['nama', 'no_reg', 'pin', 'email'],
    data() {
        return {
			informasi: '',
			loading: false,
			failed: false
		}
    },
	filters: {
		upper(value){
			if(!value) return ''
				value = value.toString()
			return value.toUpperCase()
		},
		lower(value){
			if(!value) return ''
				value = value.toString()
			return value.toLowerCase()
		}
	},
	created(){
		this.makeDokumenPendaftar();
		//console.log('base url : ' + process.env.MIX_APP_URL);
	},
    methods: {
		forceFileDownload(tipe){
			var kartu_reg = 'Kartu_Registrasi_No_' + this.no_reg;
			var surat_pernyataan_siswa = 'Surat_Pernyataan_Siswa_NoRegistrasi_' + this.no_reg;
			var surat_pernyataan_wali = 'Surat_Pernyataan_Wali_NoRegistrasi_' + this.no_reg;
			var file = '';
			if(tipe == 'kartu_reg'){
				file = kartu_reg;
			} else if(tipe== 'surat_pernyataan_siswa'){
				file = surat_pernyataan_siswa;
			} else {
				file = surat_pernyataan_wali;
			}
			//const url = window.URL.createObjectURL(new Blob([response.data]))
			const link = document.createElement('a')
			link.href = process.env.MIX_APP_URL + '/storage/attachment/'+file+'.pdf' //mau diubah base urlnya
			link.setAttribute('download', file+'.pdf') //or any other extension
			document.body.appendChild(link)
			link.click()
		},
		makeDokumenPendaftar(){
			this.loading = true;
			$axios.post('/afterregistrationsuccesspdf', {no_registrasi: this.no_reg})
			.then((response)=> {
				this.loading = false;
				var res = response.data;
				if(res.status == 'success'){
					this.failed = false
				} else {
					this.failed = true
				}
			})
			.catch(error => {
				this.loading = false;
				this.failed = true;
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			});
		},
		modalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		},
		// getInfo() {
		  // $axios.get('/informasi')
			// .then((response)=> {
			  // var data = response.data;
			  // this.informasi = data.informasi;
			// });
		// },
    }
};
</script>