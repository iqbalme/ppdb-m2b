<template>
	<div class="content">
		<div class="container-fluid">
		
		<div>
<b-card no-body>
    <b-tabs
		pills 
		class="mt-3"
		active-nav-item-class="font-weight-bold text-uppercase text-primary"
		active-tab-class="font-weight-bold text-success"
		content-class="mt-3"
		align="center">
	  <b-tab title="Waktu" active>
        <registrationTime></registrationTime>
      </b-tab>
	  <b-tab title="Info">
        <editInfo></editInfo>
      </b-tab>
      <b-tab title="Pendidikan">
		<pendidikan></pendidikan>
      </b-tab>
      <b-tab title="Pekerjaan" lazy>
        <pekerjaan></pekerjaan>
      </b-tab>
	  <b-tab title="Hobi" lazy>
        <hobi></hobi>
      </b-tab>
	  <b-tab title="Cita-cita" lazy>
        <cita_cita></cita_cita>
      </b-tab>
	  <b-tab title="Transportasi" lazy>
        <transportasi></transportasi>
      </b-tab>
	  <b-tab title="Jarak" lazy>
        <jarak></jarak>
      </b-tab>
	  <b-tab title="Penghasilan" lazy>
        <penghasilan></penghasilan>
      </b-tab>
	  <b-tab title="Mata Pelajaran" lazy>
        <mapel></mapel>
      </b-tab>
	  <b-tab title="Peminatan">
        <peminatan></peminatan>
      </b-tab>
	  <b-tab title="Kelas">
        <kelas></kelas>
      </b-tab>
	  <b-tab title="Tahun Ajaran">
        <tahun_ajaran></tahun_ajaran>
      </b-tab>
	  <!--b-tab title="Lainnya">
        <setting></setting>
      </b-tab-->
    </b-tabs>
	</b-card>
</div>			
		</div>
	</div>
</template>

<script>

import { required } from 'vuelidate/lib/validators';
import Card from "./../themeComponents/Cards/Card.vue";
import registrationTime from "./registrationTime.vue";
import editInfo from "./editInfo.vue";
import pendidikan from "./Pendidikan.vue";
import pekerjaan from "./Pekerjaan.vue";
import cita_cita from "./CitaCita.vue";
import transportasi from "./Transportasi.vue";
import hobi from "./Hobi.vue";
import jarak from "./Jarak.vue";
import mapel from "./Mapel.vue";
import kelas from "./Kelas.vue";
import peminatan from "./Peminatan.vue";
import tahun_ajaran from "./TahunAjaran.vue";
import penghasilan from "./Penghasilan.vue";
import setting from "./Setting.vue";
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
import Swal from 'sweetalert2';
import $axios from '../../api.js';

export default {
	name: "Status",
    components: {
        Card,
		registrationTime,
		editInfo,
		pendidikan,
		pekerjaan,
		hobi,
		cita_cita,
		transportasi,
		jarak,
		penghasilan,
		mapel,
		peminatan,
		kelas,
		tahun_ajaran,
		setting
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
.bg-grey {
	background-color: #ccc;
}
.black-color {
	color: #000;
}
</style>
