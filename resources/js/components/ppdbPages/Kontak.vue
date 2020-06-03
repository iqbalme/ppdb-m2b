<template>
	<div class="content">
		<div class="container-fluid">
		<card>		
			<div class="row" v-if="loading">
				<div class="col-md-12 text-center">
				  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="alert alert-primary" style="font-size:1.5rem;font-weight:bold">
							HUBUNGI KAMI
					</div>
				</div>
			</div>
			<div v-if="!loading">
			<div class="row">
				<div class="col-md-12">
				<label>
				Nama Lengkap
				</label>
					<base-input type="text" v-model="nama_pengirim" :validatedClass="$v.nama_pengirim.$error" addonRightIcon="fas fa-user"></base-input>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<label>
					Email (Optional)
				</label>
					<base-input type="text" v-model="email" :validatedClass="$v.email.$error" addonRightIcon="fas fa-envelope-open-text"></base-input>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label>
						Subjek
					</label>
					<base-input type="text" v-model="subjek" :validatedClass="$v.subjek.$error" addonRightIcon="fas fa-comments"></base-input>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Pesan</label>
						<textarea rows="3" class="form-control border-input" v-model="konten" :class="{'is-invalid': $v.konten.$error}"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-fill btn-block btn-info" @click="validate">KIRIM</button>
				</div>
			</div>
			</div>
		</card>
	</div>
	</div>
</template>

<script>

import { required, email } from 'vuelidate/lib/validators';
import Swal from 'sweetalert2';
import $axios from '../../api.js';

export default {
	name: "Kontak",
    components: {

    },
    data() {
        return {
			loading: false,
			nama_pengirim: '',
			email: '',
			subjek: '',
			konten: ''
        }
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		nama_pengirim: { required },
		email: { email },
		subjek: { required },
		konten: { required }
	},
    methods: {
        validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error){
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			} else {
				this.kirimEmail();
			}
		},
		kirimEmail() {
			this.loading = true;
			$axios.post('/kirimpesan', {
				nama_pengirim: this.nama_pengirim,
				email: this.email,
				subjek: this.subjek,
				konten: this.konten
			})
			.then((response)=> {
				this.loading = false;
				var items = response.data;
				if(items.status=='success'){
					this.modalBox('Berhasil', 'Pesan Anda telah terkirim', 'success');
					this.nama_pengirim = '';
					this.email = '';
					this.subjek = '';
					this.konten = '';
					this.$v.$reset();
				} else {
					this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
				}				
			})
			.catch(error => {
				this.loading = false;
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			});
		},
		modalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		}
    }
};
</script>

<style>
.is-invalid : {
	border-color: #f79483;
}
</style>
