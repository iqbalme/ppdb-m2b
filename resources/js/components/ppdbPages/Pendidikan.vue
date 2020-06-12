<template>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
						<form @submit.prevent="validate">
						<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
							EDIT PENDIDIKAN
						</div>
						<div class="row" v-if="loading">
							<div class="col-md-12 text-center p-5">
							  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
							</div>
						</div>
						<div class="row" v-if="!loading">
						<div class="col-md-12">
						<base-input type="text" label="" v-model="pendidikan.value" :validatedClass="$v.pendidikan.$error" placeholder="Masukkan Pendidikan di sini"></base-input>
						<button type="submit" class="btn btn-fill btn-block btn-info">SIMPAN</button>
						</div>
						</div>
						</form>
					</card>
				</div>
			</div>
				
			
			<div class="alert alert-danger text-center" style="font-size:1.5rem;font-weight:bold" v-if="(data.length==0)">
				Tidak ada data
			</div>
			
			<div class="row" v-if="data.length>0">
				<div class="col-md-12">
					<b-table hover striped :items="data" :fields="kolom" responsive="sm">
						<template v-slot:cell(no)="data">
							<div class=""> 
								{{ data.index + 1 }}
							</div>
						</template>
						<template v-slot:cell(aksi)="data">
							<div class="" :key="data.item.id">
								<b-button variant="primary" class="" @click="editData(data.index)" v-if="isAuth"><i class="fas fa-edit"></i></b-button>
								<b-button variant="primary" class="btn-fill" @click="konfirmasiHapus(data.index)" v-if="isAuth"><i class="fas fa-trash"></i></b-button>
							</div>
						</template>
					</b-table>
				</div>
				</div>
		</div>
	</div>
</template>

<script>

import { required } from 'vuelidate/lib/validators';
import Card from "./../themeComponents/Cards/Card.vue";
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
import Swal from 'sweetalert2';
import $axios from '../../api.js';

export default {
	name: "pendidikan",
    components: {
        Card,
    },
    data() {
        return {
			loading: false,
			pendidikan: {
				id: null,
				value: null
			},
			data: [],
			kolom: ['no', 'pendidikan', {key:'aksi', label:''}],
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		pendidikan: {
			value: { required }
		},
	},
	computed: {
		...mapGetters(['isAuth']) //MENGAMBIL GETTERS isAuth DARI VUEX
	},
	mounted(){
		this.getPendidikan();
	},
	watch: {
	},
    methods: {
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) {
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
				return;
			} else {
				this.simpanData();
			}
		},
		editData(id){
			this.pendidikan.value = this.data[id].pendidikan;
			this.pendidikan.id = this.data[id].id;
		},
		hapusData(id){
			if(this.data.length > 0){
				if(this.pendidikan.id != null){
					this.data.splice(id,1);
				}
				$axios
				.delete('/pendidikan/' + this.data[id].id)
				.then((response)=> {
				  var res = response.data;
				  if(res == 1){
					this.modalBox('Berhasil', 'Data telah terhapus!', 'success');
					this.getPendidikan();  
				  } else {
					this.modalBox('Gagal', 'Data gagal dihapus, silakan coba lagi!', 'warning');
				  }				  
				})
				.catch(error => {
				  this.modalBox('Gagal', 'Data gagal dihapus, silakan coba lagi!', 'warning');
				});
			}
			this.clearForm();
		},
		simpanData(){
			if(this.pendidikan.value != null){
			  $axios
				.post('/pendidikan', { 'pendidikan' : this.pendidikan.value, 'id' : this.pendidikan.id })
				.then((response)=> {
				  var res = response.data;
				  this.modalBox('Berhasil', 'Data berhasil disimpan!', 'success');
				  this.getPendidikan();
				})
				.catch(error => {
				  this.modalBox('Gagal', 'Data gagal tersimpan, silakan coba lagi!', 'warning');
				});
			}
			this.clearForm();
		},
		clearForm(){
			this.pendidikan.value = null;
			this.pendidikan.id = null;
			this.$v.$reset();
		},
		getPendidikan() {
			  $axios
				.get('/pendidikan')
				.then((response)=> {
				  var items = response.data;
				  this.data = [];
				  for (var i = 0; i < items.length; i++) {
					this.data.push({
						id : items[i].id,
						pendidikan: items[i].pendidikan
					});
				  }
				})
				.catch(error => {
					if(this.data.length==0){
						this.getPendidikan();
					}
				});
		},
		konfirmasiHapus(id){
			Swal.fire({
			  title: 'Konfirmasi Data',
			  text: "Apakah Anda yakin ingin menghapus data ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus Data!',
			  cancelButtonText: 'Batalkan'
			}).then((result) => {
			  if (result.value) {
				  this.hapusData(id);
			  }
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
