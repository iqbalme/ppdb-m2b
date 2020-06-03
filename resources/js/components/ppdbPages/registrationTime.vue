<template>
	<div class="content">
		<div class="container-fluid">
			<card>
					<form @submit.prevent="setWaktu">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="alert alert-primary" style="font-size:1.5rem;font-weight:bold">
								PENGATURAN WAKTU
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label">
							WAKTU MULAI
						</label>
						<div class="form-group input-group">
							<input aria-describedby="addon-right addon-left" type="text" class="form-control" v-model="waktu_mulai" v-pikaday="datepickerData.dateOption">
							<span class="input-group-append">
								<div class="input-group-text">
									<i class="far fa-calendar-alt"></i>
								</div>
							</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
								WAKTU AKHIR
							</label>
							<div class="form-group input-group">
								<input aria-describedby="addon-right addon-left" type="text" class="form-control" v-model="waktu_akhir" v-pikaday="datepickerData.dateOption">
								<span class="input-group-append">
									<div class="input-group-text">
										<i class="fas fa-calendar-alt"></i>
									</div>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-fill btn-block btn-info">SIMPAN</button>
					</div>
				</div>
				</form>
			</card>
		</div>
	</div>
</template>

<script>

import { required, email } from 'vuelidate/lib/validators';
import Swal from 'sweetalert2';
import $axios from '../../api.js';
import V_Pikaday from 'vue-pikaday-directive';
import { tanggal } from '../../customValidator';
import { dateOption2 } from '../../datePickerSetting';
import { mapGetters, mapState} from 'vuex';
import moment from 'moment';

export default {
	name: "registrationTime",
    components: {

    },
	directives: {
         'pikaday': V_Pikaday
     },
    data() {
        return {
			datepickerData : {
				dateOption: dateOption2
			},
			temp_waktu_mulai: null,
			temp_waktu_akhir: null
        }
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		//waktu_mulai: {},
		//waktu_akhir: {}
	},
	computed: {
		...mapState(['waktu']),
		waktu_mulai: {
			// getter
			get: function () {
			  return moment(this.waktu.mulai).format("YYYY-MM-DD")
			},
			// setter
			set: function (newValue) {
				this.temp_waktu_mulai = newValue
			}
		},
		waktu_akhir: {
			// getter
			get: function () {
			  return moment(this.waktu.akhir).format("YYYY-MM-DD")
			},
			// setter
			set: function (newValue) {
				this.temp_waktu_akhir = newValue
			}
		}
	},
    methods: {
		setWaktu(){
			var waktu_mulai = null;
			var waktu_akhir = null;
			if(this.temp_waktu_mulai == null){
				waktu_mulai = moment(this.waktu.mulai).format("YYYY-MM-DD")
			} else {
				waktu_mulai = this.temp_waktu_mulai
			}
			if(this.temp_waktu_akhir == null){
				waktu_akhir = moment(this.waktu.akhir).format("YYYY-MM-DD")
			} else {
				waktu_akhir = this.temp_waktu_akhir
			}
			$axios.post('/setwaktu', {waktu_mulai: waktu_mulai, waktu_akhir: waktu_akhir})
			.then((response)=> {
				var res = response.data;
				if(res.status == 'success'){
					this.modalBox('Berhasil', 'Update data berhasil!', 'success');
					this.$store.commit('SET_WAKTU', {
						mulai: res.data.waktu_mulai,
						akhir: res.data.waktu_akhir
					});
				} else {
					this.modalBox('Gagal', 'Update data gagal!', 'warning');
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
    }
};
</script>

<style>
.is-invalid : {
	border-color: #f79483;
}
</style>
