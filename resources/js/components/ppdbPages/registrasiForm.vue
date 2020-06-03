<template>
<div class="content">
    <div class="container-fluid">
		<div class="row" v-if="loading">
            <div class="col-md text-center">
				<b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
			</div>
		</div>
        <div class="row" v-if="!loading">
            <div class="col-md">
				<form-wizard shape="square" color="#3498db" 
					title="Form Registrasi Siswa" 
					subtitle="Formulir registrasi calon siswa MAN 2 Bulukumba"
					:shape="circle"
					back-button-text="Kembali"
					next-button-text="Lanjutkan"
					finish-button-text="Registrasi"
					@on-complete="onRegistrationSubmit">					
						<tab-content title="Informasi" icon="pe-7s-config" :before-change="()=>validateStep('step1')">
							<regis-info ref="step1" @invalidValidation="warningBox"></regis-info>
						</tab-content>
						<tab-content title="Data diri" icon="nc-icon nc-single-02" :before-change="()=>validateStep('step2')">
							<regis-data-diri @on-validate="mergePartialModels" ref="step2" @invalidValidation="warningBox"></regis-data-diri>
						</tab-content>
						<tab-content title="Data Sekolah" icon="nc-icon nc-bank" :before-change="()=>validateStep('step3')">
							<regis-data-sekolah @on-validate="mergePartialModels" ref="step3" @invalidValidation="warningBox"></regis-data-sekolah>
						</tab-content>
						<tab-content title="Data Wali" icon="pe-7s-users" :before-change="()=>validateStep('step4')">
							<regis-data-wali @on-validate="mergePartialModels" ref="step4" @invalidValidation="warningBox"></regis-data-wali>
						</tab-content>
						<tab-content title="Nilai dan Prestasi" icon="pe-7s-cup" :before-change="()=>validateStep('step5')">
							<regis-data-nilai @on-validate="mergePartialModels" ref="step5" @invalidValidation="warningBox"></regis-data-nilai>
						</tab-content>
						<tab-content title="Konfirmasi" icon="pe-7s-note2" :before-change="()=>validateStep('step6')">
							<regis-data-konfirmasi @on-validate="mergePartialModels" ref="step6" @invalidValidation="warningBox"></regis-data-konfirmasi>
						</tab-content>
				</form-wizard>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
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
		RegisDataKonfirmasi,
		FormWizard,
		TabContent
    },
    data() {
        return {
			circle : 'circle',
			loading: false,
			finalModel: {},	
		}
	},
	computed: {
		...mapState(['registrationStatus'])
	},
	watch: {
		registrationStatus: function(){
			if(this.registrationStatus!='running'){
				this.$router.push({ name: 'invalidRegistration' })
			}
		}
	},
	created(){
		if(this.registrationStatus!='running'){
			this.$router.push({ name: 'invalidRegistration' })
		}
	},
    methods: {
		onRegistrationSubmit: function(){
			this.submitRegistration();
		},
		submitRegistration(){
			this.loading = true;
			$axios.post('/registrasi', this.finalModel)
			.then((response)=> {
				this.loading=false;
				var res = response.data;
				if(res.status =='error'){
					this.modalBox('Gagal', 'Registrasi gagal, silakan coba lagi!', 'warning');
				} else {
					this.modalBox('Berhasil', 'Registrasi sukses, anda sudah terdaftar secara online', 'success');
					this.$router.push({ name: 'successReg', params: {nama: res.data.pendaftar, no_reg: res.data.no_reg, pin: reg.data.pin}});
				}
			})
			.catch(error => {
				this.loading=false;
				this.modalBox('Gagal', 'Registrasi gagal, silakan coba lagi!', 'warning');
			});
		},
	    validateStep(name) {
		  var refToValidate = this.$refs[name];
		  return refToValidate.validate();
		},
		mergePartialModels(model, isValid) {
		  if (isValid) {
			// merging each step model into the final model
			this.finalModel = Object.assign({}, this.finalModel, model)
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
		}
    }
};
</script>