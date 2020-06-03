<template>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<card>
						<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
							CETAK DOKUMEN
						</div>
						
						<div class="row"  v-if="loading">
							<div class="col-md-12 text-center">
							  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
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
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
import $axios from '../../api.js';

export default {
	name: "Status",
    components: {
        Card,
    },
	props: ['no_reg'],
    data() {
        return {
			loading: false,
			failed: false
        };
    },
	computed: {
		...mapGetters(['isAuth']) //MENGAMBIL GETTERS isAuth DARI VUEX
	},
	mounted(){
		this.makeDokumenPendaftar();
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
			link.href = 'http://ppdb.ccom/storage/attachment/'+file+'.pdf'
			link.setAttribute('download', file+'.pdf') //or any other extension
			document.body.appendChild(link)
			link.click()
		},
		makeDokumenPendaftar(){
			this.loading = true;
			$axios.post('/afterregistrationsuccess', {no_registrasi: this.no_reg})
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
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			});
		},
    },
};
</script>
