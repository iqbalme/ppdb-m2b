<template>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
						<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
							PENGATURAN LAINNYA
						</div>
						<div class="row">
							<div class="col-md-12">
							<button type="submit" class="btn btn-fill btn-block btn-info" @click="bersihkanDbPendaftar" :disabled="!isAuth">BERSIHKAN DATA PENDAFTAR</button>
							</div>
						</div>
						<div class="row"><br>
						</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import { email, required } from 'vuelidate/lib/validators';
import Card from "./../themeComponents/Cards/Card.vue";
import Swal from 'sweetalert2';
import $axios from '../../api.js';
import { mapGetters } from 'vuex';

export default {
	name: "profil",
    components: {
        Card,
    },
    data() {
        return {
			loading: false,
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	computed: {
		...mapGetters(['isAuth']) //MENGAMBIL GETTERS isAuth DARI VUEX
	},
    methods: {
		bersihkanDbPendaftar(){
			  $axios
				.post('/bersihkanData')
				.then((response)=> {
				  this.modalBox('Berhasil', 'Semua data telah dihapus!', 'success');
				})
				.catch(error => {
				  this.modalBox('Gagal', 'Data gagal dihapus, silakan coba lagi!', 'warning');
				});
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
