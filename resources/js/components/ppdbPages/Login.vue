<template>
<div>
	<card>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					LOGIN
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Username" v-model="username" :validatedClass="$v.username.$error"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Password" v-model="password" :validatedClass="$v.password.$error"></base-input>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-fill btn-block btn-info" @click="validate">SUBMIT</button>
			</div>
		</div>
		</card>
	</div>
</template>

<script>

import { required } from 'vuelidate/lib/validators';
import Card from "./../themeComponents/Cards/Card.vue";
import Swal from 'sweetalert2';
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';

export default {
	name: "Login",
    components: {
        Card,
    },
    data() {
        return {
			username: null,
			password: null
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
		username: { required },
		password: { required }
	},
	//SEBELUM COMPONENT DI-RENDER
    created() {
        //KITA MELAKUKAN PENGECEKAN JIKA SUDAH LOGIN DIMANA VALUE isAuth BERNILAI TRUE
        if (this.isAuth) {
            //MAKA DI-DIRECT KE ROUTE DENGAN NAME home
            this.$router.push({ name: 'Home' })
        }
    },
    computed: {
        ...mapGetters(['isAuth']), //MENGAMBIL GETTERS isAuth DARI VUEX
      	//...mapState(['errors'])
    },
    methods: {
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) {
				this.modalBox('Gagal', 'Login salah, silakan coba lagi!', 'warning');
			} else {
				this.$router.push({ name: 'Home' })
			}			
		},
		
    },
	modalBox(header, msg, icon){
		Swal.fire(
		  header,
		  msg,
		  icon
		)
	}
};
</script>

<style scope>
.is-invalid : {
	border-color: #f79483;
}

.col-width: 100px;
</style>
