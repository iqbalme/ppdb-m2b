<template>
<div>
	<card>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning" style="font-size:1.5rem;font-weight:bold">
					Data Keluarga
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="No KK" v-model="wali.no_kk" :validatedClass="$v.wali.no_kk.$error" maxLength="16"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Rata-rata penghasilan per bulan</label>
				<b-form-select v-model="wali.penghasilan_perbulan" :options="options.list_penghasilan" :class="{'is-invalid': $v.wali.penghasilan_perbulan.$error}" @click.native="getPenghasilan"></b-form-select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Data Ayah
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Nama Ayah" v-model="wali.nama_ayah" :validatedClass="$v.wali.nama_ayah.$error"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="NIK Ayah" v-model="wali.nik_ayah" :validatedClass="$v.wali.nik_ayah.$error" maxLength="16" :disabled="ayah_is_almarhum"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Agama Ayah</label>
				<b-form-select v-model="wali.agama_ayah" :options="options.list_agama" :class="{'is-invalid': $v.wali.agama_ayah.$error}" @click.native="getAgama"></b-form-select>
				</div>
			</div>
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Pekerjaan Ayah</label>
				<b-form-select v-model="wali.pekerjaan_ayah" :options="options.list_pekerjaan" :class="{'is-invalid': $v.wali.pekerjaan_ayah.$error}" @click.native="getPekerjaan"></b-form-select>
				</div>
			</div>
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Pendidikan Ayah</label>
				<b-form-select v-model="wali.pendidikan_ayah" :options="options.list_pendidikan" :class="{'is-invalid': $v.wali.pendidikan_ayah.$error}" @click.native="getPendidikan"></b-form-select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="No HP Ayah" v-model="wali.no_hp_ayah" :validatedClass="$v.wali.no_hp_ayah.$error" maxLength="16" :disabled="ayah_is_almarhum"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Data Ibu
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Nama Ibu" v-model="wali.nama_ibu" :validatedClass="$v.wali.nama_ibu.$error"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="NIK Ibu" v-model="wali.nik_ibu" :validatedClass="$v.wali.nik_ibu.$error"  maxLength="16" :disabled="ibu_is_almarhum"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Agama Ibu</label>
				<b-form-select v-model="wali.agama_ibu" :options="options.list_agama" :class="{'is-invalid': $v.wali.agama_ibu.$error}" @click.native="getAgama"></b-form-select>
				</div>
			</div>
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Pekerjaan Ibu</label>
				<b-form-select v-model="wali.pekerjaan_ibu" :options="options.list_pekerjaan" :class="{'is-invalid': $v.wali.pekerjaan_ibu.$error}"  @click.native="getPekerjaan"></b-form-select>
				</div>
			</div>
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Pendidikan Ibu</label>
				<b-form-select v-model="wali.pendidikan_ibu" :options="options.list_pendidikan" :class="{'is-invalid': $v.wali.pendidikan_ibu.$error}"  @click.native="getPendidikan"></b-form-select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="No HP Ibu" v-model="wali.no_hp_ibu" :validatedClass="$v.wali.no_hp_ibu.$error" maxLength="16" :disabled="ibu_is_almarhum"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Data Wali
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-secondary pl-15 pr-15">
					<div class="">
						<div class="form-group">
							<label class="control-label">
								Hubungan dengan Wali
							</label>
							<b-form-select v-model="wali.hubungan_dengan_wali" :options="options.list_hubungan" :class="{'is-invalid': $v.wali.hubungan_dengan_wali.$error}" @click.native="getHubungan"></b-form-select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Nama Lengkap Wali" v-model="wali.nama_lengkap_wali" :validatedClass="$v.wali.nama_lengkap_wali.$error" :disabled="disableWaliGrup"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">
					Tanggal Lahir Wali
				</label>
				<input aria-describedby="addon-right addon-left" type="text" class="form-control" v-model.trim.lazy="wali.tanggal_lahir_wali" v-pikaday="datepickerData.dateOption" :class="{'is-invalid': $v.wali.tanggal_lahir_wali.$invalid}">
			</div>
		</div>
			<div class="col-md-5">
				<base-input type="text" label="NIK Wali" v-model="wali.nik_wali" :validatedClass="$v.wali.nik_wali.$error" maxLength="16":disabled="disableWaliGrup"></base-input>
			</div>
		<div class="col-md-5">
				<div class="form-group">
					<label class="control-label">Agama Wali</label>
					<b-form-select v-model="wali.agama_wali" :options="options.list_agama" :class="{'is-invalid': $v.wali.agama_wali.$error}" @click.native="getAgama" :disabled="disableWaliGrup"></b-form-select>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Pekerjaan Wali</label>
				<b-form-select v-model="wali.pekerjaan_wali" :options="options.list_pekerjaan" :class="{'is-invalid': $v.wali.pekerjaan_wali.$error}" :disabled="disableWaliGrup"  @click.native="getPekerjaan"></b-form-select>
				</div>
			</div>
			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Pendidikan Wali</label>
				<b-form-select v-model="wali.pendidikan_wali" :options="options.list_pendidikan" :class="{'is-invalid': $v.wali.pendidikan_wali.$error}" :disabled="disableWaliGrup"  @click.native="getPendidikan"></b-form-select>
				</div>
			</div>
			<div class="col-md-4">
				<base-input type="text" label="No HP Wali" v-model="wali.no_hp_wali" :validatedClass="$v.wali.no_hp_wali.$error" :disabled="disableWaliGrup" maxLength="16"></base-input>
			</div>
		</div>
		</card>
	</div>
</template>

<script>

import { required, minLength, maxLength, numeric } from 'vuelidate/lib/validators';
import { tanggal } from './../../../customValidator';
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';
import V_Pikaday from 'vue-pikaday-directive';
import Card from "./../../themeComponents/Cards/Card.vue";
import { dateOption } from './../../../datePickerSetting';
import $axios from '../../../api.js';
import { mapState } from 'vuex';

export default {
	name: "regis-data-wali",
    components: {
        Card,
		FormWizard,
		TabContent
    },
	directives: {
         'pikaday': V_Pikaday
     },
    data() {
        return {
			datepickerData : {
				dateOption: dateOption
			},
            wali: {
                no_kk: null,
                nama_ayah: '',
                nik_ayah: '',
                pekerjaan_ayah: null,
                pendidikan_ayah: null,
                no_hp_ayah: '',
                nama_ibu: '',
                nik_ibu: '',
                pekerjaan_ibu: null,
                pendidikan_ibu: null,
                no_hp_ibu: '',
                penghasilan_perbulan: null,
                nama_lengkap_wali: '',
                tanggal_lahir_wali: '1980-01-01',
                nik_wali: '',
				no_hp_wali: '',
                pendidikan_wali: null,
                pekerjaan_wali: null,
				hubungan_dengan_wali: null,
				agama_ayah: null,
				agama_ibu: null,
				agama_wali: null
            },
			disableWaliGrup: false,
			wali_is_ayah : false,
			wali_is_ibu : false,
			ayah_is_almarhum : false,
			ibu_is_almarhum : false,
			options: {
				list_pekerjaan: [],
				list_pendidikan: [],
				list_penghasilan: [],
				list_hubungan: [],
				list_agama: []
			}
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		wali : {
			no_kk: {
				numeric,
				minLength: minLength(16),
				maxLength: maxLength(16)
			},
			nama_ayah: { required },
			nik_ayah: {
				numeric,
				minLength: minLength(16),
				maxLength: maxLength(16)
			},
			pekerjaan_ayah: {},
			agama_ayah: { required },
			pendidikan_ayah: { },
			no_hp_ayah: {
				numeric,
				maxLength: maxLength(16)
			},
			nama_ibu: { required },
			nik_ibu: {
				numeric,
				minLength: minLength(16),
				maxLength: maxLength(16)
			},
			pekerjaan_ibu: {},
			agama_ibu: { required },
			pendidikan_ibu: { },
			no_hp_ibu: {
				numeric,
				maxLength: maxLength(16)
			},
			penghasilan_perbulan: { required },
			nama_lengkap_wali: { required },
			nik_wali: {
				numeric,
				minLength: minLength(16),
				maxLength: maxLength(16)
			},
			agama_wali: { required },
			pendidikan_wali: { required },
			pekerjaan_wali: { required },
			hubungan_dengan_wali: { required },
			tanggal_lahir_wali: {
				tanggal 
			},
			no_hp_wali: {
				numeric,
				maxLength: maxLength(16)
			},
		},
	},
	created() {
		this.getAgama();
		this.getPekerjaan();
		this.getPendidikan();
		this.getPenghasilan();
		this.getHubungan();	
	},
	beforeUpdate(){
		
	},
	watch: {
		comp_nama_ayah(){
			if(this.wali_is_ayah){
				this.wali.nama_lengkap_wali = this.wali.nama_ayah;
			}
		},
		comp_nik_ayah(){
			if(this.wali_is_ayah){
				this.wali.nik_wali = this.wali.nik_ayah;
			}
		},
		comp_pekerjaan_ayah(){
			if(this.options.list_pekerjaan.length>0){
				var index = this.getIndexPekerjaan('Almarhum');
				console.log('index ayah ' + this.getIndexHubungan('Ayah'));
				if(this.wali.pekerjaan_ayah == this.options.list_pekerjaan[index].value){
					this.options.list_hubungan[this.getIndexHubungan('Ayah')].disabled = true
					this.wali.nik_ayah = ''
					this.wali.no_hp_ayah = ''
					this.wali_is_ayah = false
					this.ayah_is_almarhum = true;
					this.resetWaliElement()
				} else {
					this.ayah_is_almarhum = false;
					this.options.list_hubungan[this.getIndexHubungan('Ayah')].disabled = false
					if(this.wali_is_ayah){
						this.wali.pekerjaan_wali = this.wali.pekerjaan_ayah
					}
				}					
			}
		},
		comp_pendidikan_ayah(){
			if(this.wali_is_ayah){
				this.wali.pendidikan_wali = this.wali.pendidikan_ayah;
			}
		},
		comp_agama_ayah(){
			if(this.wali_is_ayah){
				this.wali.agama_wali = this.wali.agama_ayah;
			}
		},
		comp_no_hp_ayah(){
			if(this.wali_is_ayah){
				this.wali.no_hp_wali = this.wali.no_hp_ayah;
			}
		},
		comp_nama_ibu(){
			if(this.wali_is_ibu){
				this.wali.nama_lengkap_wali = this.wali.nama_ibu;
			}
		},
		comp_nik_ibu(){
			if(this.wali_is_ibu){
				this.wali.nik_wali = this.wali.nik_ibu;
			}
		},
		comp_pekerjaan_ibu(){
			if(this.options.list_pekerjaan.length>0){
				var index = this.getIndexPekerjaan('Almarhum');
				if (this.wali.pekerjaan_ibu == this.options.list_pekerjaan[index].value){
					this.options.list_hubungan[this.getIndexHubungan('Ibu')].disabled = true
					this.wali.nik_ibu=''
					this.wali.no_hp_ibu=''
					this.wali_is_ibu=false
					this.ibu_is_almarhum = true
					this.resetWaliElement()
				} else {
					this.ibu_is_almarhum = false
					this.options.list_hubungan[this.getIndexHubungan('Ibu')].disabled = false;
					if(this.wali_is_ibu){
						this.wali.pekerjaan_wali = this.wali.pekerjaan_ibu
					}
				}
			}
		},
		comp_pendidikan_ibu(){
			if(this.wali_is_ibu){
				this.wali.pendidikan_wali = this.wali.pendidikan_ibu;
			}
		},
		comp_agama_ibu(){
			if(this.wali_is_ibu){
				this.wali.agama_wali = this.wali.agama_ibu;
			}
		},
		comp_no_hp_ibu(){
			if(this.wali_is_ibu){
				this.wali.no_hp_wali = this.wali.no_hp_ibu;
			}
		},
		comp_hubungan_wali(){
			if(this.wali.hubungan_dengan_wali==this.options.list_hubungan[this.getIndexHubungan('Ayah')].value){
				this.wali.nama_lengkap_wali = this.wali.nama_ayah;
				this.wali.nik_wali = this.wali.nik_ayah;
				this.wali.pekerjaan_wali = this.wali.pekerjaan_ayah;
				this.wali.pendidikan_wali = this.wali.pendidikan_ayah;
				this.wali.no_hp_wali = this.wali.no_hp_ayah;
				this.wali.agama_wali = this.wali.agama_ayah;
				this.wali_is_ayah = true;
				this.wali_is_ibu = false;
				this.disableWaliGrup = true;
			} else if(this.wali.hubungan_dengan_wali==this.options.list_hubungan[this.getIndexHubungan('Ibu')].value){
				this.wali.nama_lengkap_wali = this.wali.nama_ibu;
				this.wali.nik_wali = this.wali.nik_ibu;
				this.wali.pekerjaan_wali = this.wali.pekerjaan_ibu;
				this.wali.pendidikan_wali = this.wali.pendidikan_ibu;
				this.wali.no_hp_wali = this.wali.no_hp_ibu;
				this.wali.agama_wali = this.wali.agama_ibu;
				this.wali_is_ibu = true;
				this.wali_is_ayah = false;
				this.disableWaliGrup = true;
			} else {
				this.wali_is_ibu = false;
				this.wali_is_ayah = false;
				this.resetWaliElement();
				this.disableWaliGrup = false;
			}
		}
	},
	computed: {
		...mapState(['loadingState']),
		comp_nama_ayah(){
			return this.wali.nama_ayah;
		},
		comp_nik_ayah(){
			return this.wali.nik_ayah;
		},
		comp_pekerjaan_ayah(){
			return this.wali.pekerjaan_ayah;
		},
		comp_pendidikan_ayah(){
			return this.wali.pendidikan_ayah;
		},
		comp_agama_ayah(){
			return this.wali.agama_ayah;
		},
		comp_no_hp_ayah(){
			return this.wali.no_hp_ayah;
		},
		comp_nama_ibu(){
			return this.wali.nama_ibu;
		},
		comp_nik_ibu(){
			return this.wali.nik_ibu;
		},
		comp_pekerjaan_ibu(){
			return this.wali.pekerjaan_ibu;
		},
		comp_pendidikan_ibu(){
			return this.wali.pendidikan_ibu;
		},
		comp_agama_ibu(){
			return this.wali.agama_ibu;
		},
		comp_no_hp_ibu(){
			return this.wali.no_hp_ibu;
		},
		comp_hubungan_wali(){
			if(this.wali.hubungan_dengan_wali != null){
				return this.wali.hubungan_dengan_wali;
			}			
		}
	},
    methods: {
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
			var isValid = !this.$v.wali.$invalid
			this.$emit('on-validate', this.wali, true)
			return true
		},
		appendValueFromParent(val){
			//if(!this.loadingState){
				this.wali = val;
			//}
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
				})
				.catch(error => {
				  console.log(error);
				});
			}
		},
		getPekerjaan() {
			if(this.options.list_pekerjaan.length==0){
			  $axios
				.get('/pekerjaan')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_pekerjaan = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_pekerjaan.push({
						value : items[i].id,
						text: items[i].pekerjaan
					});
				  }
				})
				.catch(error => {
				  console.log(error);
				});
			}
		},
		getPendidikan() {
			if(this.options.list_pendidikan.length==0){
			  $axios
				.get('/pendidikan')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_pendidikan = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_pendidikan.push({
						value : items[i].id,
						text: items[i].pendidikan
					});
				  }
				})
				.catch(error => {
				  console.log(error);
				});
			}
		},
		getPenghasilan() {
			if(this.options.list_penghasilan.length==0){
			  $axios
				.get('/penghasilan')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_penghasilan = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_penghasilan.push({
						value : items[i].id,
						text: items[i].penghasilan
					});
				  }
				})
				.catch(error => {
				  console.log(error);
				});
			}
		},
		getHubungan() {
			if(this.options.list_hubungan.length==0){
			  $axios
				.get('/hubungan')
				.then((response)=> {
				  var items = response.data;
				  this.options.list_hubungan = [];
				  for (var i = 0; i < items.length; i++) {
					this.options.list_hubungan.push({
						value : items[i].id,
						text: items[i].hubungan,
						disabled: false
					});
				  }
				})
				.catch(error => {
				  console.log(error);
				});
			}
		},
		getIndexPekerjaan(val){
			//this.showForm = true;)
			var index = this.options.list_pekerjaan.map(function(o){ return o.text.includes(val) }).indexOf(true);
			return index;
		},
		getIndexHubungan(val){
			if(this.options.list_hubungan.length>0){
				var index = this.options.list_hubungan.map(function(o){ return o.text.includes(val) }).indexOf(true);
				return index;
			}			
		},
		resetWaliElement(){
			this.wali.nama_lengkap_wali = '';
			this.wali.nik_wali = '';
			this.wali.hubungan_dengan_wali = null;
			this.wali.pekerjaan_wali = null;
			this.wali.pendidikan_wali = null;
			this.wali.agama_wali = null;
			this.wali.no_hp_wali = '';
			this.wali.tanggal_lahir_wali = '1980-01-01';
		}
    }
};
</script>

<style>
.is-invalid : {
	border-color: #f79483;
}
</style>