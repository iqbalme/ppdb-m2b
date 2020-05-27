<template>
	<div>
		<card>
		<div class="row"><div class="col-md-12"><div class="ck-content p-4"><p style="text-align:center;"><strong>Selamat Datang di PPDB Online MAN 2 Bulukumba</strong></p><p><strong>Ini adalah formulir pendaftaran Online.</strong></p><p><strong>Silakan mengisi formulir dengan benar.</strong></p><h4><span style="color:hsl(240,75%,60%);font-family:'Trebuchet MS', Helvetica, sans-serif;"><strong><u>Syarat Pendaftaran</u></strong></span></h4><ul class="todo-list"><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Bebas tes bagi siswa yang berperestasi Akademik, Seni, Keagamaan dan Olah Raga dibuktikan dengan sertifikat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></label></li><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Pas photo 3 x 4 Cm, 5 lembar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></label></li><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Foto Copy rapor semester I s/d V yang telah dilegalisir &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></label></li><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Foto Copy Kartu Keluarga (KK) 2 lembar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></label></li><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Foto Copy IjazahSMP/MTs, SD/MI 1 lembar ( tidak perlu dilegalisir) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></label></li><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Foto Copy Kartu Indonesia Pintar (KIP) bagi yang memiliki &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></label></li><li><label class="todo-list__label"><input type="checkbox" disabled="disabled" checked="checked"><span class="todo-list__label__description">Foto Copy Akta Kelahiran</span></label></li></ul></div></div></div>
		<div class="row">
			<div class="col-md-12">
			<b-alert show variant="info">
					<b-form-checkbox
					  v-model="persetujuan"
					  name="cb_persetujuan"
					  value="setuju"
					  unchecked-value="tidak_setuju">
					  <strong>Saya mengerti dengan syarat dan ketentuan tersebut</strong>
					</b-form-checkbox>
				</b-alert>
			</div>
		</div>
		</card>
	</div>
</template>

<script>

import { sameAs } from 'vuelidate/lib/validators';

export default {
	name: "regis-info",
    data() {
        return {
			persetujuan : 'tidak_setuju'
		}
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		persetujuan : {
			sameAs: val => val === 'setuju'
		}
	},
	mounted(){
		//console.log(this.$v.persetujuan);
	},
	watch: {
		// persetujuan: function() {
			// console.log(this.$v.persetujuan.$invalid);
		// }
	},
    methods: {
        validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.persetujuan.$invalid) this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
			var isValid = !this.$v.persetujuan.$invalid
			//this.$emit('on-validate', this.$data, isValid)
			return isValid
		}
    }
};
</script>