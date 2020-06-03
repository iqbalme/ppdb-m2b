<template>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-4 offset-md-4 text-center mb-3">
					<img src="http://ppdb.ccom/uploads/m2b.png" class="xlogo">
				</div>
			</div>
			<form @submit.prevent="validate">
			<div class="row">
				<div class="col-md-4 offset-md-4">
					<card>
						<div class="alert alert-primary" style="font-size:1.5rem;font-weight:bold">
							LOGIN
						</div>
						<base-input type="text" label="Username" v-model="username" :validatedClass="$v.username.$error"></base-input>
						<base-input type="password" label="Password" v-model="password" :validatedClass="$v.password.$error"></base-input>
						<button type="submit" class="btn btn-fill btn-block btn-info">SUBMIT</button>
					</card>
				</div>
			</div>
			</form>
		</div>
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
      	...mapState(['errors'])
    },
    methods: {
		 ...mapActions('auth', ['submit']), //MENGISIASI FUNGSI submit() DARI VUEX AGAR DAPAT DIGUNAKAN PADA COMPONENT TERKAIT. submit() BERASAL DARI ACTION PADA FOLDER STORES/auth.js
        ...mapMutations(['CLEAR_ERRORS']),
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) this.modalBox('Gagal', 'Login salah, silakan coba lagi!', 'warning');
			this.submit(this.$data).then((res) => {
				if(res.status=='failed'){
					this.modalBox('Gagal', 'Login salah, silakan coba lagi!', 'warning');
				} else {
					//KEMUDIAN DI CEK VALUE DARI isAuth
					//APABILA BERNILAI TRUE
					if (this.isAuth) {
						this.CLEAR_ERRORS()
						//MAKA AKAN DI-DIRECT KE ROUTE DENGAN NAME home
						this.$router.push({ name: 'Home' })
					}
				}
            })
		},
		modalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		}
    },
};
</script>

<style scope>
.is-invalid : {
	border-color: #f79483;
}

.xlogo {
	width: 120px;
	height: 110px;
	opacity: 0.5;
}

.col-width: 100px;
</style>
