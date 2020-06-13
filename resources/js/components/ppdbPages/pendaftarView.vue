<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
					<div class="row" v-show="loading">
						<div class="col-md-12 text-center">
							<b-spinner style="width: 5rem; height: 5rem;" label="Loading..."></b-spinner>
						</div>
					</div>
					<div class="row" v-show="loading">
						<div class="col-md-12 text-center">
							<br>
						</div>
					</div>
					<div class="row" v-show="loading">
						<div class="col-md-12 text-center">
							<b-alert variant="info" show>Loading ... Harap tunggu<br>
							Sedang mempersiapkan dokumen registrasi</b-alert>
						</div>
					</div>
					<div v-show="!loading">
                    <div class="row">
						<div class="col-md-12">
							<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
								DATA REGISTRASI CALON PESERTA DIDIK
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<p>BERIKUT INFO PENDAFTARAN ANDA:</p>
							<b-alert show variant="dark" style="color:black;font-weight:bold;padding-left:25px;">NAMA LENGKAP : <font style="font-weight:bold;color:blue;">{{ nama | upper }}</font></b-alert>
							<b-alert show variant="dark" style="color:black;font-weight:bold;padding-left:25px;">NO. REGISTRASI : {{ no_reg }}</b-alert>
							<p>Silakan cetak dan unduh dokumen di bawah ini.</p>
						</div>
					</div>
					<div class="row" v-if="!loading && failed">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="danger" class="btn-block btn-fill" @click="makeDokumenPendaftar()">REFRESH</b-button>
							</div>
						</div>
						<div  v-if="!loading && !failed">
						<div class="row">
							<div class="col-md-10 offset-md-1" v-if="!isAuth">
								<base-input type="text" label="Masukkan PIN" v-model="pin" :validatedClass="$v.pin.$error"maxlength="5"></base-input>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="danger" class="btn-block btn-fill" @click="forceFileDownload('kartu_reg')" :disabled="(!isAuth && pin==null) || (!isAuth && pin == '')">CETAK KARTU REGISTRASI</b-button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="secondary" class="btn-block btn-fill" @click="forceFileDownload('surat_pernyataan_siswa')" :disabled="(!isAuth && pin==null) || (!isAuth && pin == '')">CETAK SURAT PERNYATAAN SISWA</b-button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 offset-md-1 text-center mb-3">
								<b-button variant="warning" class="btn-block btn-fill" @click="forceFileDownload('surat_pernyataan_wali')" :disabled="(!isAuth && pin==null) || (!isAuth && pin == '')">CETAK SURAT PERNYATAAN WALI</b-button>
							</div>
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
import { mapGetters } from 'vuex';
import { requiredIf } from 'vuelidate/lib/validators';

export default {
    components: {
        Card,
    },
	props: ['no_reg'],
    data() {
        return {
			nama: null,
			loading: true,
			failed: false,
			pin: null
		}
    },
	validations() {
		return {
			pin: {
				requiredIf: requiredIf(function() { return !this.isAuth })
			}
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
		this.getInfoPendaftar()
	},
	computed:{
		...mapGetters(['isAuth'])
	},
    methods: {
		forceFileDownload(tipe){
			if(this.isAuth){
				this.generateDocs(tipe);
			} else {
				if(this.pin == null){
					this.$v.$touch();
					this.modalBox('Gagal', 'Masukkan PIN untuk melanjutkan!', 'warning');
				} else {
					this.$v.$reset();
					this.cekPin(tipe);
				}				
			}
		},
		generateDocs(tipe){
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
		cekPin(tipe) {
			this.loading = true;
		  $axios
			.post('/cekpin', {'no_registrasi': this.no_reg, 'pin': this.pin})
			.then((response)=> {
				this.loading = false;
			  var res = response.data;
				if(res.status=='success'){
					this.generateDocs(tipe);
				} else {
					this.modalBox('Gagal', 'PIN Salah, silahkan coba lagi!', 'warning');
					this.pin = null;
				}
			})
			.catch(error => {
				this.loading = false;
				this.modalBox('Gagal', 'Gagal validasi PIN. Silakan coba lagi!', 'warning');
			});
		},
		getInfoPendaftar() {
			this.loading = true;
		  $axios
			.post('/cekpendaftar', {no_registrasi: this.no_reg})
			.then((response)=> {
			this.loading = false;
			  var res = response.data;
				if(res.status=='success'){
					this.nama = res.data;
					this.makeDokumenPendaftar();
				} else {
					this.modalBox('Gagal', 'Data tidak terdaftar!', 'warning');
					this.$router.push({name: 'Registrasi'});
				}
			})
			.catch(error => {
				this.loading = false;
				this.modalBox('Gagal', 'Gagal mendapatkan data. Silakan coba lagi!', 'warning');
				this.$router.push({name: 'pendaftarView'});
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