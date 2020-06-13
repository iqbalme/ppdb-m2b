<template>
	<div>
		<card>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning" style="font-size:1.5rem;font-weight:bold">
					Data Diri
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Nama Lengkap" v-model="siswa.nama_lengkap" :validatedClass="$v.siswa.nama_lengkap.$error"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<base-input type="text" label="NIS Lokal" v-model="siswa.nis_lokal" :validatedClass="$v.siswa.nis_lokal.$error"></base-input>
			</div>
			<div class="col-md-4">
				<base-input type="text" label="NISN" v-model="siswa.nisn" maxLength="10" :validatedClass="$v.siswa.nisn.$error"></base-input>
			</div>
			<div class="col-md-4">
				<base-input type="text" label="NIK" v-model="siswa.nik" maxLength="16" :validatedClass="$v.siswa.nik.$error"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<base-input type="text" label="Tempat Lahir" v-model="siswa.tempat_lahir" :validatedClass="$v.siswa.tempat_lahir.$error"></base-input>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<label class="control-label">
					Tanggal Lahir
				</label>
					<input aria-describedby="addon-right addon-left" type="text" class="form-control" v-model="siswa.tanggal_lahir" v-pikaday="datepickerData.dateOption" :class="{'is-invalid': $v.siswa.tanggal_lahir.$invalid}">
				</div>
			</div>                        
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Agama</label>
					<b-form-select v-model="siswa.agama" :options="options.list_agama" :class="{'is-invalid': $v.siswa.agama.$error}" @click.native="getAgama"></b-form-select>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Jenis Kelamin</label>
					<b-form-select v-model="siswa.jenis_kelamin" :options="options.list_jenis_kelamin" :class="{'is-invalid': $v.siswa.jenis_kelamin.$error}" @click.native="getHobi"></b-form-select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Hobi</label>
					<b-form-select v-model="siswa.hobi" :options="options.list_hobi" :class="{'is-invalid': $v.siswa.hobi.$error}" @click.native="getHobi"></b-form-select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Cita-cita</label>
					<b-form-select v-model="siswa.cita_cita" :options="options.list_cita_cita" :class="{'is-invalid': $v.siswa.cita_cita.$error}" @click.native="getCita"></b-form-select>
				</div>
			</div>
			<div class="col-md-2">
				<base-input type="text" label="Jumlah saudara"v-model="siswa.jml_saudara" :validatedClass="$v.siswa.jml_saudara.$error" maxlength="2"></base-input>
			</div>
			<div class="col-md-2">
				<base-input type="text" label="Anak ke" v-model="siswa.anak_ke" :validatedClass="$v.siswa.anak_ke.$error"maxlength="2"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
				<label class="control-label">Jenis tempat tinggal</label>
					<b-form-select v-model="siswa.jenis_tempat_tinggal" :options="options.list_jenis_tinggal" :class="{'is-invalid': $v.siswa.jenis_tempat_tinggal.$error}" @click.native="getJenisTinggal"></b-form-select>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Alamat tinggal</label>
					<textarea rows="3" class="form-control border-input" v-model="siswa.alamat_tinggal" :class="{'is-invalid': $v.siswa.alamat_tinggal.$error}"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Propinsi</label>
					<b-form-select v-model="siswa.propinsi" :options="options.list_propinsi" :class="{'is-invalid': $v.siswa.propinsi.$error}" @change="changePropinsi" @click.native="changePropinsi"></b-form-select>
				</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Kabupaten</label>
				<b-form-select v-model="siswa.kabupaten" :options="options.list_kabupaten" :class="{'is-invalid': $v.siswa.kabupaten.$error}" @change="changeKabupaten"></b-form-select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
			<div class="form-group">
				<label class="control-label">Kecamatan</label>
				<b-form-select v-model="siswa.kecamatan" :options="options.list_kecamatan" :class="{'is-invalid': $v.siswa.kecamatan.$error}" @change="changeKecamatan"></b-form-select>
				</div>
			</div>
			<div class="col-md-5">
			<div class="form-group">
				<label class="control-label">Kelurahan</label>
				<b-form-select v-model="siswa.kelurahan" :options="options.list_kelurahan" :class="{'is-invalid': $v.siswa.kelurahan.$error}"></b-form-select>
				</div>
			</div>
			<div class="col-md-2">
				<base-input type="text" label="Kode pos" v-model="siswa.kodepos" :validatedClass="$v.siswa.kodepos.$error" maxLength="5"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Transportasi</label>
				<b-form-select v-model="siswa.transportasi" :options="options.list_transportasi" :class="{'is-invalid': $v.siswa.transportasi.$error}" @click.native="getTransportasi"></b-form-select>
				</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Jarak rumah dengan madrasah</label>
				<b-form-select v-model="siswa.jarak_rumah_madrasah" :options="options.list_jarak" :class="{'is-invalid': $v.siswa.jarak_rumah_madrasah.$error}" @click.native="getJarak"></b-form-select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="No KIP (Jika ada)" v-model="siswa.no_kip" :validatedClass="$v.siswa.no_kip.$error"></base-input>
			</div>
		</div>
		</card>
	</div>
</template>

<script>

import { required, minLength, maxLength, numeric, maxValue } from 'vuelidate/lib/validators';
import V_Pikaday from 'vue-pikaday-directive';
import { tanggal, maxValueAnakKe } from './../../../customValidator';
import { dateOption } from './../../../datePickerSetting';
import $axios from '../../../api.js';
import { mapState } from 'vuex';

export default {
	name: "regis-data-diri",
    components: {

    },
	directives: {
         'pikaday': V_Pikaday
     },
    data() {
        return {
			datepickerData : {
				dateOption: dateOption
			},
            siswa: {
                nama_lengkap: '',
                nis_lokal: '',
                nisn: '',
                nik: '',
                tempat_lahir: '',
                tanggal_lahir: '2005-12-31',
                agama: null,
                jenis_kelamin: null,
                hobi: null,
                cita_cita: null,
                jml_saudara: 0,
                anak_ke: 1,
                jenis_tempat_tinggal: null,
                alamat_tinggal: '',
                propinsi: null,
                kabupaten: null,
                kecamatan: null,
                kelurahan: null,
                kodepos: '',
                transportasi: null,
                jarak_rumah_madrasah: null,
				no_kip: '',
            },
            options: {
				list_hobi: [],
				list_cita_cita: [],
				list_propinsi: [],
				list_kabupaten: [],
				list_kecamatan: [],
				list_kelurahan: [],
				list_jarak: [],
				list_transportasi: [],
				list_jenis_tinggal: [],
				list_agama: [],
                list_jenis_kelamin: [{
                        value: 'L',
                        text: "Laki-laki"
                    },
                    {
                        value: 'P',
                        text: "Perempuan"
                    }
                ],
                opt_status_sekolah_asal: [{
                        value: 'negeri',
                        text: 'Negeri'
                    },
                    {
                        value: 'swasta',
                        text: 'Swasta'
                    }
                ]
            },
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		siswa : {
			nama_lengkap: { required },
			nis_lokal: {
				required,
				numeric 
			},
			nisn: {
				required, 
				numeric,
				minLength: minLength(10),
				maxLength: maxLength(10)
			},
			tempat_lahir: { required },
			agama: { required },
			jenis_kelamin: { required },
			hobi: { required },
			cita_cita: { required },
			jenis_tempat_tinggal: { required },
			alamat_tinggal: { required },
			propinsi: { required },
			kabupaten: { required },
			kecamatan: { required },
			kelurahan: { required },
			transportasi: { required },
			jarak_rumah_madrasah: { required },
			no_kip: { numeric },
			kodepos: { numeric, maxLength: maxLength(5) },
			tanggal_lahir: { tanggal },
			nik : {
				required,
				numeric,
				minLength: minLength(16),
				maxLength: maxLength(16)
			},
			jml_saudara : {
				required,
				numeric,
				maxLength: maxLength(2)
			},
			anak_ke : {
				required,
				numeric,
				maxLength: maxLength(2),
				//maxValue: maxValue(maxAnakKe)
			},
			//$each : { //ini untuk memvalidasi langsung semua elemen
			//	required,
			//}
		},
	},
	mounted() {
		this.getHobi(),
		this.getCita(),
		this.getAgama(),
		this.getPropinsi(),
		this.getTransportasi(),
		this.getJarak(),
		this.getJenisTinggal()
	},
	computed: {
		...mapState(['isEdit', 'loadingState']),
		maxValue_anakKe: function() {
		  return parseInt(this.siswa.jml_saudara) + 1;
		}
	},
	watch: {
	},
    methods: {
        validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) {
				this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
				return false;
			} else {
				this.$emit('on-validate', this.siswa, true)
				return true
			}			
		},
		appendValueFromParent(val){
			this.siswa = val;
			this.getKabupaten(this.siswa.propinsi);
			this.getKecamatan(this.siswa.kabupaten);
			this.getKelurahan(this.siswa.kecamatan);
		},
		getTransportasi() {
			if(this.options.list_transportasi.length == 0){
			  $axios
				.get('/transportasi')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_transportasi = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_transportasi.push({
						value : items[i].id,
						text: items[i].transportasi
					});
				  }
				});
			}
		},
		getJarak() {
			if(this.options.list_jarak.length == 0){
				
			  $axios
				.get('/jarak')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_jarak = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_jarak.push({
						value : items[i].id,
						text: items[i].jarak
					});
				  }
				  
				});
			}
		},
		getHobi() {
			if(this.options.list_hobi.length == 0){
				
			  $axios
				.get('/hobi')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_hobi = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_hobi.push({
						value : items[i].id,
						text: items[i].hobi
					});
				  }
				  
				});
			}
		},
		getCita() {
			if(this.options.list_cita_cita.length == 0){
				
			  $axios
				.get('/cita_cita')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_cita_cita = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_cita_cita.push({
						value : items[i].id,
						text: items[i].cita_cita
					});
				  }
				  
				});
			}
		},
		getAgama() {
			if(this.options.list_agama.length == 0){
				
			  $axios
				.get('/agama')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_agama = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_agama.push({
						value : items[i].id,
						text: items[i].agama
					});
				  }
				  
				});
			}
		},
		getPropinsi() {
			if(this.options.list_propinsi.length == 0){
				
			  $axios
				.get('/propinsi')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_propinsi = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_propinsi.push({
						value : items[i].kode,
						text: items[i].nama
					});
				  }
				  
				});
			}
		},
		getKabupaten(id) {
			
		  $axios
			.get('/kabupaten/'+id)
			.then((response)=> {
			  var items = response.data;
			  this.options.list_kabupaten = [];
			  for (var i = 0; i < items.length; i++) {
				this.options.list_kabupaten.push({
					value : items[i].kode,
					text: items[i].nama
				});
			  }
			  
			});
		},
		getKecamatan(id) {
			
		  $axios
			.get('/kecamatan/'+id)
			.then((response)=> {
			  var items = response.data;
			  this.options.list_kecamatan = [];
			  for (var i = 0; i < items.length; i++) {
				this.options.list_kecamatan.push({
					value : items[i].kode,
					text: items[i].nama
				});
			  }
			  
			});
		},
		getKelurahan(id) {
			if((id != null) || (id != undefined)){			
			  $axios
				.get('/kelurahan/'+id)
				.then((response)=> {
				  var items = response.data;
				  this.options.list_kelurahan = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_kelurahan.push({
						value : items[i].kode,
						text: items[i].nama
					});
				  }
				  
				});
			}
		},
		getJenisTinggal(id) {
			if(this.options.list_jenis_tinggal.length == 0){
				
			  $axios
				.get('/jenis_tinggal')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_jenis_tinggal = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_jenis_tinggal.push({
						value : items[i].id,
						text: items[i].jenis_tempat_tinggal
					});
				  }
				  
				});
			}
		},
		changePropinsi(){
			this.getPropinsi();
			this.siswa.kabupaten = null;
			this.siswa.kecamatan = null;
			this.siswa.kelurahan = null;
			this.options.list_kabupaten = [];
			this.options.list_kecamatan = [];
			this.options.list_kelurahan = [];
			this.getKabupaten(this.siswa.propinsi);
		},
		changeKabupaten(){
			this.siswa.kecamatan = null;
			this.siswa.kelurahan = null;
			this.options.list_kecamatan = [];
			this.options.list_kelurahan = [];
			this.getKecamatan(this.siswa.kabupaten);
		},
		changeKecamatan(){
			this.siswa.kelurahan = null;
			this.options.list_kelurahan = [];
			this.getKelurahan(this.siswa.kecamatan);
		}
    }
};
</script>

<style>
.is-invalid : {
	border-color: #f79483;
}
</style>
