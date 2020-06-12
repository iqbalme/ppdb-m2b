<template>
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-primary" style="font-size:1.5rem;font-weight:bold" v-if="!isEdit">
					INPUT DATA PENDAFTAR
				</div>
				<div class="alert alert-primary" style="font-size:1.5rem;font-weight:bold" v-if="isEdit">
					EDIT DATA PENDAFTAR
				</div>
			</div>
		</div>
		<div class="row p-5" v-if="loadingState">
            <div class="col-md text-center">
				<b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
			</div>
		</div>
		<!--form @submit.prevent="validateAll"-->
        <div class="row" v-show="!loadingState">
            <div class="col-md">				
				<regis-data-diri @on-validate="mergePartialModels" ref="step1" @invalidValidation="warningBox"></regis-data-diri>
				<regis-data-sekolah @on-validate="mergePartialModels" ref="step2" @invalidValidation="warningBox"></regis-data-sekolah>
				<regis-data-wali @on-validate="mergePartialModels" ref="step3" @invalidValidation="warningBox"></regis-data-wali>
				<regis-data-nilai @on-validate="mergePartialModels" ref="step4" @invalidValidation="warningBox"></regis-data-nilai>
				<regis-data-konfirmasi @on-validate="mergePartialModels" ref="step5" @invalidValidation="warningBox"></regis-data-konfirmasi>
            </div>
        </div>
		<div class="row">
            <div class="col-md">
				<b-button variant="primary" class="btn-block btn-fill" type="button" @click="validateAll" :disabled="loadingState"><i class="fas fa-file-export"></i>&nbsp;&nbsp;SIMPAN</b-button>
			</div>
		</div>
		<!--/form-->
    </div>
</div>
</template>

<script>

import 'pe7-icon/dist/dist/pe-icon-7-stroke.css'
import RegisInfo from './RegistrasiTemplate/RegisInfo.vue';
import RegisDataDiri from './RegistrasiTemplate/RegisDataDiri.vue';
import RegisDataSekolah from './RegistrasiTemplate/RegisDataSekolah.vue';
import RegisDataWali from './RegistrasiTemplate/RegisDataWali.vue';
import RegisDataNilai from './RegistrasiTemplate/RegisDataNilai.vue';
import RegisDataKonfirmasi from './RegistrasiTemplate/RegisDataKonfirmasi.vue';
import Card from "./../themeComponents/Cards/Card.vue";
import $axios from '../../api.js';
import Swal from 'sweetalert2'
import { mapState } from 'vuex';

export default {
    components: {
        Card,
		RegisInfo,
        RegisDataDiri,
		RegisDataSekolah,
		RegisDataWali,
		RegisDataNilai,
		RegisDataKonfirmasi
    },
	props: ['no_reg'],
    data() {
        return {
			//no_reg: 'WODQYO15ILN2JXA0', //for testing only
			circle : 'circle',
			//loading: false,
			dataModel: {},
			dataForEdit: null
		}
	},
	computed: {
		...mapState(['registrationStatus', 'loadingState', 'isEdit'])
	},
	watch: {
		// registrationStatus: function(){
			// if(this.registrationStatus!='running'){
				// this.$router.push({ name: 'invalidRegistration' })
			// }
		// }
	},
	created(){
		if(this.no_reg != null){
			this.$store.commit('SET_EDIT_STATE', true);
			this.getDataPendaftar();
		} else {
			this.$store.commit('SET_EDIT_STATE', false);
		}		
		// if(this.registrationStatus!='running'){
			// this.$router.push({ name: 'invalidRegistration' })
		// }
	},
    methods: {
		submitRegistration(){
			if(this.isEdit){
				this.dataModel = Object.assign({}, this.dataModel, {id: this.dataForEdit.id})
			} else {
				this.dataModel = Object.assign({}, this.dataModel, {id: null})
			}
			this.$store.commit('SET_LOADING_STATE', true);
			$axios.post('/registrasi', this.dataModel)
			.then((response)=> {
				this.$store.commit('SET_LOADING_STATE', false);
				var res = response.data;
				if(res.status =='error'){
					this.modalBox('Gagal', 'Registrasi gagal, silakan coba lagi!', 'warning');
				} else {
					this.modalBox('Berhasil', 'Data telah tersimpan', 'success');
					this.$router.push({ name: 'successReg', params: {nama: res.data.pendaftar, no_reg: res.data.no_reg, pin: res.data.pin}});
				}
			})
			.catch(error => {
				this.$store.commit('SET_LOADING_STATE', false);
				this.modalBox('Gagal', 'Registrasi gagal, silakan coba lagi!', 'warning');
			});
		},
	    validateStep(name) {
		  var refToValidate = this.$refs[name];
		  return refToValidate.validate();
		},
		appendValueToChild(name, val) {
		  var refToValidate = this.$refs[name];
		  return refToValidate.appendValueFromParent(val);
		},
		async validateAll(){
			var error = 0;
			var result = await Promise.all([
				this.validateStep('step1'),
				this.validateStep('step2'),
				this.validateStep('step3'),
				this.validateStep('step4'),
				this.validateStep('step5')
			]);
			console.log(result);
			for(var i=0;i<result.length;i++){
				if(result[i]!=true){
					error++;
				}
			}
			if(error==0){
				this.konfirmasiSimpan();
			}
		},
		getDataPendaftar(){
			this.dataForEdit = null;
			$axios.post('/afterregistrationsuccess', {no_registrasi: this.no_reg})
			.then((response)=> {
				this.$store.commit('SET_LOADING_STATE', false);
				var res = response.data;
				// var tt = {
					// 'response' : res.data
				// };
				//console.log(tt);
				if(res.status == 'success'){
					this.dataForEdit = res.data;
					this.editForm();
				} else {
					console.log('gagal3');
					this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
					//this.$router.push({name: 'Home'});
				}
			})
			.catch(error => {
				console.log('gagal4 : ' + error);
				this.$store.commit('SET_LOADING_STATE', false);
				this.modalBox('Gagal', 'Silakan coba lagi!', 'warning');
				this.$router.push({name: 'Home'});
			});
		},
		editForm(){
			this.$store.commit('SET_LOADING_STATE', true);
			this.appendValueToChild('step1',
				{
					nama_lengkap : this.dataForEdit.nama_lengkap,
					nis_lokal : this.dataForEdit.nis_lokal,
					nisn : this.dataForEdit.nisn,
					nik : this.dataForEdit.nik,
					tempat_lahir : this.dataForEdit.tempat_lahir,
					tanggal_lahir : this.dataForEdit.tanggal_lahir,
					agama : this.dataForEdit.agama_id,
					jenis_kelamin : this.dataForEdit.jenis_kelamin,
					hobi : this.dataForEdit.hobi_id,
					cita_cita : this.dataForEdit.cita_cita_id,
					jml_saudara : this.dataForEdit.jumlah_saudara,
					anak_ke : this.dataForEdit.anak_ke,
					jenis_tempat_tinggal : this.dataForEdit.data_pendaftar.jenis_tempat_tinggal_id,
					alamat_tinggal : this.dataForEdit.data_pendaftar.alamat,
					propinsi: this.dataForEdit.data_pendaftar.kel_id.substr(0,2),
					kabupaten: this.dataForEdit.data_pendaftar.kel_id.substr(0,4),
					kecamatan: this.dataForEdit.data_pendaftar.kel_id.substr(0,6),
					kelurahan : this.dataForEdit.data_pendaftar.kel_id,
					kodepos : this.dataForEdit.data_pendaftar.kode_pos,
					transportasi : this.dataForEdit.data_pendaftar.transportasi_id,
					jarak_rumah_madrasah : this.dataForEdit.data_pendaftar.jarak_rumah_madrasah_id,
					no_kip : this.dataForEdit.data_pendaftar.no_kip
				}
			);
			this.appendValueToChild('step2',
				{
					nama_sekolah_asal: this.dataForEdit.data_pendaftar.nama_sekolah_asal,
					status_sekolah_asal: this.dataForEdit.data_pendaftar.status_sekolah_asal,
					npsn_sekolah_asal: this.dataForEdit.data_pendaftar.npsn_sekolah_asal,
					lokasi_sekolah_asal: this.dataForEdit.data_pendaftar.lokasi_sekolah_asal
				}
			);
			this.appendValueToChild('step3',
				{
					no_kk : this.dataForEdit.data_pendaftar.no_kk,
					nama_ayah : this.dataForEdit.data_pendaftar.nama_ayah,
					nik_ayah : this.dataForEdit.data_pendaftar.nik_ayah,
					pekerjaan_ayah : this.dataForEdit.data_pendaftar.pekerjaan_ayah_id,
					pendidikan_ayah : this.dataForEdit.data_pendaftar.pendidikan_ayah_id,
					no_hp_ayah : this.dataForEdit.data_pendaftar.no_hp_ayah,
					nama_ibu : this.dataForEdit.data_pendaftar.nama_ibu_kandung,
					nik_ibu : this.dataForEdit.data_pendaftar.nik_ibu_kandung,
					pekerjaan_ibu : this.dataForEdit.data_pendaftar.pekerjaan_ibu_id,
					pendidikan_ibu : this.dataForEdit.data_pendaftar.pendidikan_ibu_id,
					no_hp_ibu : this.dataForEdit.data_pendaftar.no_hp_ibu_kandung,
					penghasilan_perbulan : this.dataForEdit.data_pendaftar.penghasilan_id,
					nama_lengkap_wali : this.dataForEdit.data_pendaftar.nama_wali,
					tanggal_lahir_wali : this.dataForEdit.data_pendaftar.tanggal_lahir_wali,
					nik_wali : this.dataForEdit.data_pendaftar.nik_wali,
					no_hp_wali : this.dataForEdit.data_pendaftar.no_hp_wali,
					pendidikan_wali : this.dataForEdit.data_pendaftar.pendidikan_wali_id,
					pekerjaan_wali : this.dataForEdit.data_pendaftar.pekerjaan_wali_id,
					hubungan_dengan_wali : this.dataForEdit.data_pendaftar.hubungan_wali_id,
					agama_ayah : this.dataForEdit.data_pendaftar.agama_ayah_id,
					agama_ibu : this.dataForEdit.data_pendaftar.agama_ibu_id,
					agama_wali : this.dataForEdit.data_pendaftar.agama_wali_id
				}
			);
			var nilai_akademik_data = [];
			var prestasi = [];
			for(var i=0;i<this.dataForEdit.nilai_akademik.length;i++){
				nilai_akademik_data.push({
					id  :  this.dataForEdit.nilai_akademik[i].mapel_id,
					mapel  :  this.dataForEdit.nilai_akademik[i].mapel.nama_mapel,
					keterangan  :  this.dataForEdit.nilai_akademik[i].keterangan,
					nilai  :  {
						id: this.dataForEdit.nilai_akademik[i].id,
						semester1  :  this.dataForEdit.nilai_akademik[i].semester1,
						semester2  :  this.dataForEdit.nilai_akademik[i].semester2,
						semester3  :  this.dataForEdit.nilai_akademik[i].semester3,
						semester4  :  this.dataForEdit.nilai_akademik[i].semester4,
						semester5  :  this.dataForEdit.nilai_akademik[i].semester5
					}
				});
			};
			for(var i=0;i<this.dataForEdit.prestasi_non_akademik.length;i++){
				prestasi.push({
					id: this.dataForEdit.prestasi_non_akademik[i].id,
					jenis_lomba : this.dataForEdit.prestasi_non_akademik[i].jenis_lomba,
					tempat_pelaksanaan : this.dataForEdit.prestasi_non_akademik[i].tempat_pelaksanaan,
					tingkat : this.dataForEdit.prestasi_non_akademik[i].tingkat,
					peringkat_juara : this.dataForEdit.prestasi_non_akademik[i].peringkat_juara
				});
			}
			this.appendValueToChild('step4',
				{
					no_peserta_un: this.dataForEdit.data_pendaftar.no_peserta_un,
					total_nilai_un: this.dataForEdit.data_pendaftar.total_nilai_un,
					tanggal_kelulusan: this.dataForEdit.data_pendaftar.tanggal_kelulusan,
					nilai_akademik: nilai_akademik_data,
					prestasi_non_akademik: prestasi
				}
			);
			var lampiranpath = [];
			var filelampiraninfo = []
			for(var i=0;i<this.dataForEdit.lampiran.length;i++){
				filelampiraninfo.push({
					url: this.dataForEdit.lampiran[i].path.replace('public', 'storage'),
					nama_file : this.dataForEdit.lampiran[i].nama_file,
					jenis_file : this.dataForEdit.lampiran[i].jenis_file,
					keterangan : this.dataForEdit.lampiran[i].keterangan,
					file: null
				});
			}
			this.appendValueToChild('step5',
				{
					fileFoto: {
						file: null,
						url: this.dataForEdit.foto_path.replace('public', 'storage')
					},
					fileLampiran: filelampiraninfo,
					email: this.dataForEdit.email,
					uploadList: [],
					deleteList: [],
					peminatan: this.dataForEdit.peminatan
				}
			);
			this.$store.commit('SET_LOADING_STATE', false);
		},
		mergePartialModels(model, isValid) {
		  if (isValid) {
			// merging each step model into the final model
			this.dataModel = Object.assign({}, this.dataModel, model)
		  }		  
		},
		warningBox(){
			Swal.fire(
			  'Gagal',
			  'Data belum lengkap, silakan coba lagi!',
			  'warning'
			)
		},
		modalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		},
		konfirmasiSimpan(){
			Swal.fire({
			  title: 'Konfirmasi Data',
			  text: "Apakah Anda yakin ingin menyimpan data ini?",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Simpan Data!',
			  cancelButtonText: 'Batalkan'
			}).then((result) => {
			  if (result.value) {
				  this.submitRegistration();
			  }
			});
		}
    }
};
</script>