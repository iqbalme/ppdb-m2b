<template>
	<div>
		<card>
		<div class="row">
			<div class="col-md-12">
				<b-alert show variant="primary">
					INFO PRA REGISTRASI
				</b-alert>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="ck-content p-4">
					<ul><li><span class="text-big" style="color:hsl(240,75%,60%);">Pastikan koneksi internet Anda stabil sehingga proses registrasi tidak terkendala</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Siapkan data yang akan diisi dengan benar</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Siapkan dokumen yang akan diunggah pada proses pendaftaran (foto, kk, dsb)</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Pastikan semua data sudah terinput dengan benar, form registrasi akan melakukan pembatasan akses dengan validasi jika pengisian data belum sempurna</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Setelah proses pendaftaran selesai, Anda akan mendapatkan No Registrasi serta PIN</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Anda bisa mencetak data registrasi Anda dengan memasukkan PIN yang telah Anda dapatkan sebelumnya.</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Anda bisa melakukan pengecekan status pendaftaran Anda pada menu <router-link :to="{path:'/status'}">'<i>Cek Status</i>'</router-link>.</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Bagi yang memasukkan email, maka data registrasi Anda akan dikirimkan juga melalui email</span></li><li><span class="text-big" style="color:hsl(240,75%,60%);">Selanjutnya silakan datang ke sekolah untuk verifikasi data jika telah selesai pada proses registrasi online ini</span></li></ul><p><span class="text-big" style="color:hsl(0,75%,60%);"><strong><u>Catatan:</u></strong></span><span class="text-big"> Jika terkendala dalam melakukan registrasi online, silakan datang langsung ke sekolah</span></p><p>&nbsp;</p><p><span class="text-big"><i>INFORMASI LEBIH LANJUT, SILAKAN BERKONSULTASI LANGSUNG DI SEKOLAH ATAU MENGHUBUNGI KAMI DI MENU 'KONTAK'</i></span></p><p><span class="text-big">TERIMA KASIH.</span></p>
				</div>
			</div>
		</div>
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
			if(this.$v.persetujuan.$invalid) {
				this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
				return false
			} else {
				return true
			}
		}
    }
};
</script>