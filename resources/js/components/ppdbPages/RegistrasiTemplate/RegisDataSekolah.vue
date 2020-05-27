<template>
<div>
	<card>
    <div class="row">
		<div class="col-md-12">
			<base-input type="text" label="Nama sekolah" v-model="sekolah.nama_sekolah_asal" :validatedClass="$v.sekolah.nama_sekolah_asal.$error"></base-input>
		</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Status sekolah</label>
                                    <b-form-select v-model="sekolah.status_sekolah_asal" :options="options.opt_status_sekolah_asal" :class="{'is-invalid' : $v.sekolah.status_sekolah_asal.$error}"></b-form-select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <base-input type="text" label="NPSN sekolah" v-model="sekolah.npsn_sekolah_asal" :validatedClass="$v.sekolah.npsn_sekolah_asal.$error" maxLength="8"></base-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lokasi sekolah</label>
                                    <textarea rows="3" class="form-control border-input" v-model="sekolah.lokasi_sekolah_asal" :class="{'is-invalid' : $v.sekolah.lokasi_sekolah_asal.$error}"></textarea>
                                </div>
                            </div>
                        </div>
                </card>
            </div>
        </div>
    </div>
	</card>
</div>
</template>

<script>

import { required, minLength, maxLength, numeric } from 'vuelidate/lib/validators';
import Card from "./../../themeComponents/Cards/Card.vue";

export default {
	name: "regis-data-sekolah",
    components: {
        Card,
    },
    data() {
        return {
            sekolah: {
                nama_sekolah_asal: '',
                status_sekolah_asal: '',
                npsn_sekolah_asal: '',
                lokasi_sekolah_asal: '',
            },
            options: {
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
		sekolah : {
			nama_sekolah_asal: { required },
			status_sekolah_asal: { required },
			npsn_sekolah_asal: {
				required, numeric, 
				minLength: minLength(8),
				maxLength: maxLength(8) 
			},
			lokasi_sekolah_asal: { required }
		},
	},
	mounted() {
		//console.log(this.$v.sekolah);
	},
    methods: {
        validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
			var isValid = !this.$v.sekolah.$invalid
			this.$emit('on-validate', this.sekolah, isValid)
			return isValid
		}
    }
};
</script>

<style>
.is-invalid : {
	border-color: #f79483;
}
</style>
