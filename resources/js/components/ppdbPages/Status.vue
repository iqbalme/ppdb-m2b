<template>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<card>
						<form @submit.prevent="validate">
						<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
							CEK STATUS
						</div>
						<div class="row" v-if="loading">
							<div class="col-md-12 text-center p-5">
							  <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
							</div>
						</div>
						<div class="row" v-if="!loading">
						<div class="col-md-12">
						<label>Masukkan Nama / No Registrasi</label>
						<base-input type="text" label="" v-model="pencarian" :validatedClass="$v.pencarian.$error" addonRightIcon="fab fa-searchengin" placeholder="Masukkan nama atau no registrasi"></base-input>
						<button type="submit" class="btn btn-fill btn-block btn-info">CARI</button>
						</div>
						</div>
						</form>
					</card>
				</div>
			</div>
				
			
			<div class="alert alert-danger text-center" style="font-size:1.5rem;font-weight:bold" v-if="(hasil_pencarian.length==0) && search">
				Tidak ada data
			</div>
			
			<card v-if="hasil_pencarian.length>0">
			<div class="row">
				<div class="col-md-12">
					<b-table hover striped :items="hasil_pencarian" :fields="kolomPencarian" responsive="sm">
						<template v-slot:cell(no)="data">
							<div class="col-md-2"> 
								{{ data.index + 1 }}
							</div>
						</template>
						<template v-slot:cell(nama)="data">
							<div class="col-md-12">{{ data.item.nama }}</div>
						</template>
						<template v-slot:cell(status)="data">
							<div class="col-md-12" v-if="data.item.status==1"><b-badge variant="secondary">Online</b-badge></div>
							<div class="col-md-12" v-if="data.item.status==2"><b-badge variant="primary">Verifikasi</b-badge></div>
							<div class="col-md-12" v-if="data.item.status==3"><b-badge variant="success">Lulus</b-badge></div>
							<div class="col-md-12" v-if="data.item.status==4"><b-badge variant="danger">Tidak Lulus</b-badge></div>
						</template>
						<template v-slot:cell(ttl)="data">
							<div class="col-md-12">{{ data.item.ttl }}</div>
						</template>
						<template v-slot:cell(aksi)="data">
							<div class="" :key="data.item.id">
								<b-button variant="secondary" class="btn-fill" @click="editPendaftar(data.index)" v-if="isAuth"><i class="pe-7s-pen"></i></b-button>
								<b-button variant="warning" class="btn-fill" @click="editStatus(data.index)" v-if="isAuth"><i class="fas fa-info-circle"></i></b-button>
								<b-button variant="primary" class="btn-fill" @click="cetakKartu(data.index)" v-if="isAuth"><i class="pe-7s-print"></i></b-button>
								<b-button variant="primary" class="btn-fill" @click="inputPIN(data.index)" v-if="!isAuth"><i class="pe-7s-print"></i></b-button>
							</div>
						</template>
					</b-table>
					<b-modal id="cetakRegistrasi"
					:header-bg-variant="headerBgVariant"
					:header-text-variant="headerTextVariant"
					:footer-bg-variant="footerBgVariant">
						<template v-slot:modal-header="{ close }">
							<p style="font-size:1.5rem;font-weight:bold">Cetak Kartu Registrasi</p>
						</template>
						<template v-slot:default="{ hide }">
						<card>
						<div class="row" v-if="loading">
							<div class="col-md-12">
								<div class="form-group text-center">
									<b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
								</div>
							</div>
						</div>
						<div class="row" v-if="!loading">
							<div class="col-md-12">
								<base-input type="password" label="Masukkan PIN" v-model="pin" :validatedClass="$v.pin.$error"></base-input>
							</div>
						</div>
						</card>
						</template>
						<template v-slot:modal-footer="{ cancel }">
							<div class="w-100 pt-2">
							  <b-button class="float-right btn-fill" size="md" variant="primary" @click="cetakDenganPIN()">
								Cetak
							  </b-button>
							  <b-button class="float-right btn-fill mr-2" size="md" variant="danger" @click="closePIN">
								Cancel
							  </b-button>
						  </div>
						</template>
					</b-modal>
					<b-modal id="editPendaftar"
					:header-bg-variant="headerBgVariant"
					:header-text-variant="headerTextVariant"
					:footer-bg-variant="footerBgVariant">
						<template v-slot:modal-header="{ close }">
							<p style="font-size:1.5rem;font-weight:bold">Edit status pendaftar</p>
						</template>
						<template v-slot:default="{ hide }">
						<card>
						<div class="row" v-if="loading">
							<div class="col-md-12">
								<div class="form-group text-center">
									<b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
								</div>
							</div>
						</div>
						<b-alert show variant="secondary" style="color:black;">
							Nama         : <b>{{ pickStudent.nama }}</b><br>
							No Registrasi: <b>{{ pickStudent.no_registrasi }}</b>
						</b-alert>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">STATUS</label>
									<b-form-select v-model="temp_status" :options="list_status"></b-form-select>
								</div>
							</div>
						</div>
						<div class="row" v-if="temp_status==3">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">KELAS</label>
									<b-form-select v-model="kelas_pendaftar" :options="list_kelas" @click.native="getKelas"></b-form-select>
								</div>
							</div>
						</div>
						<div class="row" v-if="temp_status==3">
							<div class="col-md-12">
								<base-input type="text" label="NIS" v-model="nis"></base-input>
							</div>
						</div>
						</card>
						</template>
						<template v-slot:modal-footer="{ cancel }">
							<div class="w-100 pt-2">
							  <b-button type="submit" class="float-right btn-fill" size="md" variant="primary" @click="updateStatus(pickStudent.id)">
								Update
							  </b-button>
							  <b-button class="float-right btn-fill mr-2" size="md" variant="danger" @click="closePendaftar">
								Cancel
							  </b-button>
						  </div>
						</template>
					</b-modal>
				</div>
				</div>
			</card>
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
	name: "Status",
    components: {
        Card,
    },
    data() {
        return {
			loading: false,
			headerBgVariant: 'primary',
			headerTextVariant: 'light',
			footerBgVariant: 'dark',
			pin: null,
			pencarian: null,
			cetakIndexPin: null,
			hasil_pencarian: [],
			kolomPencarian: ['no', {key: 'nama', label: 'Nama Lengkap'}, 'ttl', {key: 'no_registrasi', label: 'No Registrasi'}, 'status', {key:'aksi', label:''}],
			search: false,
			temp_status: null,
			kelas_pendaftar: null,
			nis: null,
			list_status: [
				{value: 1, text: 'Online'},
				{value: 2, text: 'Verifikasi'},
				{value: 3, text: 'Lulus'},
				{value: 4, text: 'Tidak Lulus'},
			],
			list_kelas: [],
			pickStudent: null
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		pencarian: { required },
		pin: { required },
	},
	computed: {
		...mapGetters(['isAuth']) //MENGAMBIL GETTERS isAuth DARI VUEX
	},
	mounted(){
		this.getKelas();
	},
	watch: {
		temp_status: function(){
			if(this.temp_status!=3){
				this.kelas_pendaftar = null;
			}
		}
	},
    methods: {
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.pencarian.$error) {
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			} else {
				this.cekStatus();
			}
		},
		cekStatus(){
			this.loading = true;
			$axios.post('/cekstatus', {pencarian: this.pencarian})
			.then((response)=> {
				this.loading = false;
			  var items = response.data;
			  this.hasil_pencarian = [];
			  for (var i = 0; i < items.length; i++) {
				this.hasil_pencarian.push({
					id: items[i].id,
					nama: items[i].nama_lengkap,
					ttl: items[i].tempat_lahir + ', ' + items[i].tanggal_lahir,
					no_registrasi: items[i].noRegistrasi,
					status: items[i].status
				});
			  }
			  this.search = true;
			  this.pencarian = null;
			  this.$v.pencarian.$reset();
			})
			.catch(error => {
				this.loading = false;
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			});
		},
		inputPIN(val){
			this.pin = null;
			this.$v.pin.$reset();
			this.$bvModal.show('cetakRegistrasi');
			this.cetakIndexPin = val;
		},
		cetakDenganPIN(){
			this.isPinValid(this.pin);
		},
		isPinValid(pin){
			this.loading = true;
			var no_reg = this.hasil_pencarian[this.cetakIndexPin].no_registrasi;
			$axios.post('/ispinvalid', {pin: pin, no_reg: no_reg})
			.then((response)=> {
				this.loading = false;
				var res = response.data;
				if(res.status=='success'){
					this.cetakKartu(this.cetakIndexPin);
				} else {
					this.loading = false;
					this.modalBox('Gagal', 'Cek PIN Anda! Silakan coba lagi!', 'warning');
				}
			})
			.catch(error => {
				this.loading = false;
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
			});
		},
		editPendaftar(index){
			//buka input form
			var no_reg = this.hasil_pencarian[index].no_registrasi;
			this.$router.push({ name: 'inputEditPendaftar', params: {no_reg: no_reg}});
		},
		editStatus(index){
			this.pickStudent = {
				index: index,
				id: this.hasil_pencarian[index].id,
				nama: this.hasil_pencarian[index].nama,
				no_registrasi: this.hasil_pencarian[index].no_registrasi
			};
			this.temp_status = this.hasil_pencarian[index].status;
			if(this.temp_status==3){
				this.cekKelas(this.hasil_pencarian[index].id);
			}
			this.$bvModal.show('editPendaftar');
		},
		closePendaftar(){
			this.$bvModal.hide('editPendaftar');
			// this.temp_status = null;
			// this.pickStudent = null;	
		},
		updateStatus(id){
			this.loading = true;
			  $axios.post('/updatestatus', {id: id, status: this.temp_status})
				.then((response)=> {
				this.loading = false;
					var items = response.data;
					if(items.status=='success'){
						if(this.temp_status==3){
							if(this.kelas_pendaftar == null){
								this.modalBox('Berhasil', 'Update data berhasil!', 'success');
							} else {
								this.setKelas(id);
							}							
						} else {
							$axios.post('/deletekelasPendaftar', {id: id});
							this.modalBox('Berhasil', 'Update data berhasil!', 'success');
						}						
						this.hasil_pencarian[this.pickStudent.index].status = this.temp_status;
						this.closePendaftar();
					} else {
						this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
					}
				})
				.catch(error => {
					this.loading = false;
					this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
				});
		},
		getKelas() {
			if(this.list_kelas.length==0){
			  $axios
				.get('/kelas')
				.then((response)=> {
				  var items = response.data;
				  this.list_kelas = [];
				  for (var i = 0; i < items.length; i++) {
					this.list_kelas.push({
						value : items[i].id,
						text: items[i].nama_kelas
					});
				  }
				});
			}
		},
		cekKelas(id) {
			  $axios
				.post('/cekKelasPendaftar', {id: id})
				.then((response)=> {
				  var res = response.data;
				  if(res.status == 'success'){
					this.kelas_pendaftar = res.data.kelas_id;
					this.nis = res.data.nis;
				  }
				});
		},
		setKelas(id) {
			this.loading = true;
		  $axios
			.post('/kelasPendaftar', {id: id, kelas_id: this.kelas_pendaftar, nis: this.nis})
			.then((response)=> {
			this.loading = false;
			  var res = response.data;
				if(res.status=='success'){
					this.modalBox('Berhasil', 'Update data berhasil!', 'success');
				}
			})
			.catch(error => {
				this.loading = false;
			  this.modalBox('Gagal', 'Gagal update kelas. Silakan coba lagi!', 'warning');
			});
		},
		closePIN(val){
			this.$bvModal.hide('cetakRegistrasi');
			this.cetakIndexPin = null;
		},
		cetakKartu(index){
			var no_reg = this.hasil_pencarian[index].no_registrasi;
			this.$router.push({ name: 'Cetak', params: {no_reg: no_reg}});
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
