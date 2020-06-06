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
					<div class="row" v-if="!loading && failed">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="danger" class="btn-block btn-fill" @click="makeDokumenPendaftar()">REFRESH</b-button>
							</div>
						</div>
						<div  v-if="!loading">
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
			informasi: ''
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
		
	},
    methods: {
		cetakKartu(){
			if(this.no_reg==null){
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			} else {
				
			}
		},
		cetakSuratPernyataan(){
			if(this.no_reg==null){
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			} else {
				if(!this.email==null){ //jika tidak ada emailnya
					
				} else {
					
				}
			}
		},
		getSuratPernyataanSiswa(no_reg) {
		  $axios
			.post('/afterregistrationsuccess', {no_registrasi: no_reg})
			.then((response)=> {
			  var res = response.data;
				if(res.status=='success'){
					this.modalBox('Berhasil', 'Update data berhasil!', 'success');
				}
			})
			.catch(error => {
			  this.modalBox('Gagal', 'Gagal update kelas. Silakan coba lagi!', 'warning');
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