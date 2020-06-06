<template>
<div>
	<card>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning" style="font-size:1.5rem;font-weight:bold">
					Nilai dan Prestasi
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<base-input type="text" label="No peserta UN" placeholder="" v-model="nilai.no_peserta_un" maxLength="16":validatedClass="$v.nilai.no_peserta_un.$error"></base-input>
			</div>
			<div class="col-md-2">
				<base-input type="text" label="Total Nilai UN" placeholder="" v-model="nilai.total_nilai_un" :validatedClass="$v.nilai.total_nilai_un.$error" maxLength="3"></base-input>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				<label class="control-label">
					Tanggal Kelulusan
				</label>
				<input aria-describedby="addon-right addon-left" type="text" class="form-control" v-model.trim.lazy="nilai.tanggal_kelulusan" v-pikaday="datepickerData.dateOption" :class="{'is-invalid': $v.nilai.tanggal_kelulusan.$invalid}">
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Nilai Akademik
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div v-if="nilai.nilai_akademik.length==0" class="mb-10">
					<button type="button" class="btn btn-block btn-fill btn-primary" @click="getMapel">Isi Nilai Akademik</button>
					<br>
				</div>
				<b-table hover fixed striped :items="nilai.nilai_akademik" :fields="fieldsNilai" responsive="sm" v-if="nilai.nilai_akademik.length>0">
					<!--template v-slot:cell(keterangan)="data">
					<div class="col-md-2">
						<input type="text" v-model="$data['options.keterangan_id'+data.item.id]">
					</div>
					</template-->
					<template v-slot:cell(edit)="data">
					<div class="col-md-2" :key="data.item.id">
						<b-button variant="primary" class="btn-fill" @click="openFormNilaiAkademik(data.item.id)"><b-icon icon="pencil"></b-icon></b-button>
					</div>
					</template>
				</b-table>
				<b-modal id="form-nilai_akademik"
				:header-bg-variant="headerBgVariant"
				:header-text-variant="headerTextVariant"
				:footer-bg-variant="footerBgVariant">
					<template v-slot:modal-header="{ close }">
						<p style="font-size:1.5rem;font-weight:bold">Data Akademik</p>
						<!--div class="alert alert-info col-md-12" style="font-size:1.5rem;font-weight:bold">
							Data Akademik
						</div-->
					</template>
					<template v-slot:default="{ hide }">
					<card>
						<b-alert show variant="warning" style="color:black;">Mata Pelajaran : {{ modal_nilai_akademik.mapel }}</b-alert>
						<b-alert show variant="secondary" style="color:black;">Nilai Semester</b-alert>
					<div class="row">
						<div class="col-md-4">
							<base-input type="text" label="Ke-1" v-model="modal_nilai_akademik.nilai.semester1" :validatedClass="$v.modal_nilai_akademik.nilai.$each.$iter.semester1.$error" maxlength="2"></base-input>
						</div>
						<div class="col-md-4">
							<base-input type="text" label="Ke-2" v-model="modal_nilai_akademik.nilai.semester2" :validatedClass="$v.modal_nilai_akademik.nilai.$each.$iter.semester2.$error" maxlength="2"></base-input>
						</div>
						<div class="col-md-4">
							<base-input type="text" label="Ke-3" v-model="modal_nilai_akademik.nilai.semester3" :validatedClass="$v.modal_nilai_akademik.nilai.$each.$iter.semester3.$error" maxlength="2"></base-input>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<base-input type="text" label="Ke-4" v-model="modal_nilai_akademik.nilai.semester4" :validatedClass="$v.modal_nilai_akademik.nilai.$each.$iter.semester4.$error" maxlength="2"></base-input>
						</div>
						<div class="col-md-6">
							<base-input type="text" label="Ke-5" v-model="modal_nilai_akademik.nilai.semester5" :validatedClass="$v.modal_nilai_akademik.nilai.$each.$iter.semester5.$error" maxlength="2"></base-input>
						</div>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea rows="2" class="form-control border-input" v-model="modal_nilai_akademik.keterangan"></textarea>
					</div>
					</card>
					</template>
					
					<template v-slot:modal-footer="{ cancel }">
						<div class="w-100 pt-2">
					  <b-button class="float-right btn-fill" size="md" variant="primary" @click="validateModalAkademik()">
						Simpan
					  </b-button>
					  <b-button class="float-right btn-fill mr-2" size="md" variant="danger" @click="cancel()">
						Cancel
					  </b-button>
					  </div>
					</template>
				</b-modal>
				<b-modal id="form-prestasi-non-akademik"
				:header-bg-variant="headerBgVariant"
				:header-text-variant="headerTextVariant"
				:footer-bg-variant="footerBgVariant">
					<template v-slot:modal-header="{ close }">
						<p style="font-size:1.5rem;font-weight:bold">Prestasi Non Akademik</p>
					</template>
					<template v-slot:default="{ hide }">
					<card>
					<div class="row">
						<div class="col-md-12">
							<base-input type="text" label="Jenis Lomba/Kompetisi" v-model="modal_prestasi.jenis_lomba" :validatedClass="$v.modal_prestasi.jenis_lomba.$error"></base-input>
						</div>
					</div>
					<div class="form-group">
						<label>Tempat Pelaksanaan</label>
						<textarea rows="2" class="form-control border-input" v-model="modal_prestasi.tempat_pelaksanaan"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<base-input type="text" label="Tingkat" v-model="modal_prestasi.tingkat"></base-input>
						</div>
						<div class="col-md-6">
							<base-input type="text" label="Peringkat Juara" v-model="modal_prestasi.peringkat_juara" :validatedClass="$v.modal_prestasi.peringkat_juara.$error" maxLength="2"></base-input>
						</div>
					</div>
					</card>
					</template>
					
					<template v-slot:modal-footer="{ cancel }">
						<div class="w-100 pt-2">
					  <b-button class="float-right btn-fill" size="md" variant="primary" @click="validateModalPrestasi()">
						Simpan
					  </b-button>
					  <b-button class="float-right btn-fill mr-2" size="md" variant="danger" @click="cancelPrestasi()">
						Cancel
					  </b-button>
					  </div>
					</template>
				</b-modal>
			</div>
		</div>		
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Prestasi Non Akademik
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<b-button variant="dark" class="btn-fill" @click="openFormPrestasi()">Input Prestasi</b-button>
			</div>
		</div>
		<hr v-if="nilai.prestasi_non_akademik.length>0">
		<div class="row" v-if="nilai.prestasi_non_akademik.length>0">
			<div class="col-md-12">
				<b-table hover fixed striped :items="nilai.prestasi_non_akademik" :fields="fieldsPrestasi" responsive="sm" stacked="md">
					<template v-slot:cell(no)="data">
					<div class="col-md-2">
					{{ data.index + 1 }}
					</div>
					</template>
					<template v-slot:cell(edit)="data">
					<div :key="data.index">
						<b-button variant="primary" class="btn-fill" @click="editPrestasi(data.index)"><b-icon icon="pencil"></b-icon></b-button>
						<b-button variant="danger" class="btn-fill" @click="removePrestasi(data.index)"><b-icon icon="trash-fill"></b-icon></b-button>
					</div>
					</template>
				</b-table>
			</div>
		</div>
		<!--b-button variant="danger" class="btn-fill" @click="validate()">Testing</b-button-->
		</card>
	</div>
</template>

<script>

import { required, minValue, maxValue, minLength, maxLength, numeric } from 'vuelidate/lib/validators';
import { tanggal_kelulusan } from './../../../customValidator';
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';
import V_Pikaday from 'vue-pikaday-directive';
import LTable from './../../themeComponents/Table.vue';
import Card from "./../../themeComponents/Cards/Card.vue";
import Swal from 'sweetalert2';
import $axios from '../../../api.js';
import { mapState } from 'vuex';

export default {
	name: "regis-data-nilai",
    components: {
        Card,
        LTable,
		FormWizard,
		TabContent
    },
	directives: {
         'pikaday': V_Pikaday
     },
    data() {
        return {
			headerBgVariant: 'primary',
			headerTextVariant: 'light',
			footerBgVariant: 'dark',
			datepickerData : {
				dateOption: {
					i18n: {
						previousMonth : 'Bulan lalu',
						nextMonth     : 'Bulan depan',
						months        : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'],
						weekdays      : ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
						weekdaysShort : ['Min','Sen','Sel','Rab','Kam','Jum','Sab']
					}
				}
			},
			nilaiErrorIdentifier: 0,
			fieldsPrestasi: ['no', {key: 'jenis_lomba', label: 'Jenis Lomba/Kompetisi'}, 'tingkat', {key: 'tempat_pelaksanaan', label: 'Tempat Pelaksanaan'}, {key: 'peringkat_juara', label: 'PeringkatJuara'}, {key:'edit', label:''}],
			fieldsNilai: [{key:'mapel', label: 'Mata Pelajaran'}, {key: 'nilai.semester1', label: 'Semester 1', tdClass: 'col-width'}, {key: 'nilai.semester2', label: 'Semester 2'}, {key: 'nilai.semester3', label: 'Semester 3'}, {key: 'nilai.semester4', label: 'Semester 4'}, {key: 'nilai.semester5', label: 'Semester 5'},{key:'keterangan', label: 'Keterangan'}, {key:'edit', label:''}],
            nilai: {
                no_peserta_un: '',
                total_nilai_un: null,
                tanggal_kelulusan: '2020-04-01',
				prestasi_non_akademik: [],
				nilai_akademik: []
            },
			modal_nilai_akademik : {
				id : null,
				mapel: '',
				nilai: {
					semester1: '',
					semester2: '',
					semester3: '',
					semester4: '',
					semester5: '',
				},
				keterangan: ''
			},
			modal_prestasi: {
				id: null,
				jenis_lomba: '',
				tingkat: '',
				tempat_pelaksanaan: '',
				peringkat_juara: ''
			}
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		nilai : {
			no_peserta_un: {
				numeric,
				minLength: minLength(14),
				maxLength: maxLength(16)
			},
			total_nilai_un: {
				numeric,
				maxValue: maxValue(100)
			},
			tanggal_kelulusan: {
				required,
				tanggal_kelulusan
			}
		},
		modal_nilai_akademik: {
			nilai: {
				$each: {
					required,
					numeric,
					minValue: minValue(10),
					maxValue: maxValue(99)
				}
			}
		},
		modal_prestasi: {
			jenis_lomba: {
				required
			},
			peringkat_juara: {
				required,
				numeric
			}
		}
	},
	mounted() {
	},
	beforeMount() {
	},
	computed: {
		...mapState(['loadingState']),
	},
	created() {
		this.getMapel();
	},
    methods: {
		validate() {
			this.$v.nilai.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.nilai.$error){
				this.$emit('invalidValidation')
				return false
			} else if (!this.validateNilaiCollection()) {
				this.warningBox()
				return false
			} else {
				var isValid = !this.$v.nilai.$invalid
				this.$emit('on-validate', this.nilai, true)
				return true
			}
		},
		appendValueFromParent(val){
			this.nilai = val;		
		},
		validateModalPrestasi(){
			this.$v.modal_prestasi.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.modal_prestasi.$error) return; //APABILA ERROR MAKA STOP
			this.inputPrestasi();
		},
		validateModalAkademik(){
			this.$v.modal_nilai_akademik.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.modal_nilai_akademik.$error) return; //APABILA ERROR MAKA STOP
			this.inputNilaiAkademik();
		},
		validateNilaiCollection(){
			var totalError = 0;
			this.nilai.nilai_akademik.map(function(o) {
				if((o.nilai.semester1 < 10) || (o.nilai.semester1 == null)){
					totalError = totalError + 1;
				} else if((o.nilai.semester2 < 10) || (o.nilai.semester2 == null)){
					totalError = totalError + 1;
				} else if((o.nilai.semester3 < 10) || (o.nilai.semester3 == null)){
					totalError = totalError + 1;
				} else if((o.nilai.semester4 < 10) || (o.nilai.semester4 == null)){
					totalError = totalError + 1;
				} else if((o.nilai.semester5 < 10) || (o.nilai.semester5 == null)){
					totalError = totalError + 1;
				}
			});
			if(totalError > 0){
				return false;
			} else {
				return true;
			}
		},
		openFormPrestasi(){
			this.$bvModal.show('form-prestasi-non-akademik');
		},
		removePrestasi(id){
			this.nilai.prestasi_non_akademik.splice(id,1);
		},
		editPrestasi(id){
			this.modal_prestasi.id = id;
			this.modal_prestasi.jenis_lomba = this.nilai.prestasi_non_akademik[id].jenis_lomba;
			this.modal_prestasi.tingkat = this.nilai.prestasi_non_akademik[id].tingkat;
			this.modal_prestasi.peringkat_juara = this.nilai.prestasi_non_akademik[id].peringkat_juara;
			this.modal_prestasi.tempat_pelaksanaan = this.nilai.prestasi_non_akademik[id].tempat_pelaksanaan;
			this.openFormPrestasi();
		},
		openFormNilaiAkademik(mapel_id){
			var mapel_index = this.getIndexNilai(mapel_id);
			this.modal_nilai_akademik.id = this.nilai.nilai_akademik[mapel_index].id;
			this.modal_nilai_akademik.mapel = this.nilai.nilai_akademik[mapel_index].mapel;
			this.modal_nilai_akademik.keterangan = this.nilai.nilai_akademik[mapel_index].keterangan;
			this.modal_nilai_akademik.nilai.semester1 = this.nilai.nilai_akademik[mapel_index].nilai.semester1;
			this.modal_nilai_akademik.nilai.semester2 = this.nilai.nilai_akademik[mapel_index].nilai.semester2;
			this.modal_nilai_akademik.nilai.semester3 = this.nilai.nilai_akademik[mapel_index].nilai.semester3;
			this.modal_nilai_akademik.nilai.semester4 = this.nilai.nilai_akademik[mapel_index].nilai.semester4;
			this.modal_nilai_akademik.nilai.semester5 = this.nilai.nilai_akademik[mapel_index].nilai.semester5;
			this.$bvModal.show('form-nilai_akademik');
		},
		inputPrestasi(){
			//input the value
			if(this.modal_prestasi.id==null){
			this.nilai.prestasi_non_akademik.push({
				jenis_lomba: this.modal_prestasi.jenis_lomba,
				tempat_pelaksanaan: this.modal_prestasi.tempat_pelaksanaan,
				tingkat: this.modal_prestasi.tingkat,
				peringkat_juara: this.modal_prestasi.peringkat_juara
			});
			} else {
				this.nilai.prestasi_non_akademik[this.modal_prestasi.id].jenis_lomba = this.modal_prestasi.jenis_lomba;
				this.nilai.prestasi_non_akademik[this.modal_prestasi.id].tempat_pelaksanaan = this.modal_prestasi.tempat_pelaksanaan;
				this.nilai.prestasi_non_akademik[this.modal_prestasi.id].peringkat_juara = this.modal_prestasi.peringkat_juara;
				this.nilai.prestasi_non_akademik[this.modal_prestasi.id].tingkat = this.modal_prestasi.tingkat;
			};
			this.resetPrestasiForm();
			//then close the modal box
			this.$bvModal.hide('form-prestasi-non-akademik');
		},
		cancelPrestasi(){
			this.resetPrestasiForm();
			//then close the modal box
			this.$bvModal.hide('form-prestasi-non-akademik');
		},
		resetPrestasiForm(){
			//then clear the form first
			this.modal_prestasi.id = null;
			this.modal_prestasi.jenis_lomba = '';
			this.modal_prestasi.tempat_pelaksanaan = '';
			this.modal_prestasi.tingkat = '';
			this.modal_prestasi.peringkat_juara = '';
			//then reset the validation
			this.$v.modal_prestasi.$reset();
		},
		inputNilaiAkademik(){
			var mapel_index = this.getIndexNilai(this.modal_nilai_akademik.id);
			this.nilai.nilai_akademik[mapel_index].mapel = this.modal_nilai_akademik.mapel;
			this.nilai.nilai_akademik[mapel_index].nilai.semester1 = this.modal_nilai_akademik.nilai.semester1;
			this.nilai.nilai_akademik[mapel_index].nilai.semester2 = this.modal_nilai_akademik.nilai.semester2;
			this.nilai.nilai_akademik[mapel_index].nilai.semester3 = this.modal_nilai_akademik.nilai.semester3;
			this.nilai.nilai_akademik[mapel_index].nilai.semester4 = this.modal_nilai_akademik.nilai.semester4;
			this.nilai.nilai_akademik[mapel_index].nilai.semester5 = this.modal_nilai_akademik.nilai.semester5;
			this.nilai.nilai_akademik[mapel_index].keterangan = this.modal_nilai_akademik.keterangan;
			//then reset the validation
			this.$v.modal_nilai_akademik.$reset();
			this.$bvModal.hide('form-nilai_akademik');
		},
		getIndexNilai(val){
			//this.showForm = true;
			var index = this.nilai.nilai_akademik.map(function(o) { return o.id; }).indexOf(val);
			//console.log(index);
			return index;
		},
		getMapel() {
			if(this.nilai.nilai_akademik.length == 0){
			  $axios.get('/mapel')
				.then((response)=> {
				  var items = response.data;
				  this.nilai.nilai_akademik = [];
				  for (var i = 0; i < items.length; i++) {
					this.nilai.nilai_akademik.push({
						id : items[i].id,
						mapel: items[i].nama_mapel,
						nilai: {
							//semester1: (Math.round(Math.random() * 99)),
							semester1: null,
							semester2: null,
							semester3: null,
							semester4: null,
							semester5: null
						},
						keterangan: ''
					});
					// var nama_model1 = 'nilai_semester1_id'+items[i].id;
					// var obj1 = {};
					// obj1[nama_model1] = '0';
					// Object.assign(this.$data, obj1);
					// this.options = Object.assign({}, this.options, obj6);
					// this.$set({}, this.options, obj6);
				  }
				})
				.catch(error => {
				  console.log(error);
				});
			}
		},
		warningBox(){
			Swal.fire(
			  'Gagal',
			  'Data nilai belum benar, silakan coba lagi!',
			  'warning'
			)
		}
    }
};
</script>

<style scope>
.is-invalid : {
	border-color: #f79483;
}

.col-width: 100px;
</style>
