<template>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<form @submit.prevent="simpanData">
						<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
							EDIT PASSWORD
						</div>
						<div class="row" v-if="loading">
							<div class="col-md-12 text-center p-5">
							  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
							</div>
						</div>
						<div class="row" v-if="!loading">
							<div class="col-md-12">
								<base-input type="password" label="Password" v-model="password" placeholder="Kosongkan jika tidak ingin ubah password"></base-input>
							</div>
							<button type="submit" class="btn btn-fill btn-block btn-info">SIMPAN</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import { email, required } from 'vuelidate/lib/validators';
import Card from "./../themeComponents/Cards/Card.vue";
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
import Swal from 'sweetalert2';
import $axios from '../../api.js';

export default {
	name: "profil",
    components: {
        Card,
    },
    data() {
        return {
			loading: false,
			password: null
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	computed: {
		...mapGetters(['isAuth']) //MENGAMBIL GETTERS isAuth DARI VUEX
	},
    methods: {
		simpanData(){
			if(this.password != null){
			  $axios
				.post('/profil', { 'password' : this.password })
				.then((response)=> {
				  var res = response.data;
				  this.modalBox('Berhasil', 'Data berhasil disimpan!', 'success');
				})
				.catch(error => {
				  this.modalBox('Gagal', 'Data gagal tersimpan, silakan coba lagi!', 'warning');
				});
			} else {
				this.modalBox('Gagal', 'Masukkan password terlebih dahulu!', 'warning');
			}
		},
		modalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		}
    },
};
</script>

<style scope>
.is-invalid : {
	border-color: #f79483;
}

.col-width: 100px;
</style>
