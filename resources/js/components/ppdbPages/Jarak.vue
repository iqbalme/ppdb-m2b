<template>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
						<form @submit.prevent="validate">
						<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
							EDIT JARAK
						</div>
						<div class="row" v-if="loading">
							<div class="col-md-12 text-center p-5">
							  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
							</div>
						</div>
						<div class="row" v-if="!loading">
						<div class="col-md-12">
						<base-input type="text" label="" v-model="jarak.value" :validatedClass="$v.jarak.$error" placeholder="Masukkan jarak di sini"></base-input>
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
	name: "jarak",
    components: {
        Card,
    },
    data() {
        return {
			loading: false,
			jarak: {
				id: null,
				value: null
			},
			data: [],
			kolom: ['no', 'jarak', {key:'aksi', label:''}],
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		jarak: {
			value: { required }
		},
	},
	computed: {
		...mapGetters(['isAuth']) //MENGAMBIL GETTERS isAuth DARI VUEX
	},
	mounted(){
		this.getjarak();
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
			this.jarak.value = this.data[id].jarak;
			this.jarak.id = this.data[id].id;
		},
		hapusData(id){
			if(this.data.length > 0){
				if(this.jarak.id != null){
					this.data.splice(id,1);
				}
				$axios
				.delete('/jarak/' + this.data[id].id)
				.then((response)=> {
				  var res = response.data;
				  if(res == 1){
					this.modalBox('Berhasil', 'Data telah terhapus!', 'success');
					this.getjarak();  
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
			if(this.jarak.value != null){
			  $axios
				.post('/jarak', { 'jarak' : this.jarak.value, 'id' : this.jarak.id })
				.then((response)=> {
				  var res = response.data;
				  this.modalBox('Berhasil', 'Data berhasil disimpan!', 'success');
				  this.getjarak();
				})
				.catch(error => {
				  this.modalBox('Gagal', 'Data gagal tersimpan, silakan coba lagi!', 'warning');
				});
			}
			this.clearForm();
		},
		clearForm(){
			this.jarak.value = null;
			this.jarak.id = null;
			this.$v.$reset();
		},
		getjarak() {
			  $axios
				.get('/jarak')
				.then((response)=> {
				  var items = response.data;
				  this.data = [];
				  for (var i = 0; i < items.length; i++) {
					this.data.push({
						id : items[i].id,
						jarak: items[i].jarak
					});
				  }
				})
				.catch(error => {
					if(this.data.length==0){
						this.getjarak();
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
