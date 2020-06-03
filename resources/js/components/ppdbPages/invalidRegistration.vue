<template>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<card>
						<b-jumbotron bg-variant="info" text-variant="white" border-variant="info">
							<template v-slot:header>
								<div class="text-center mb-5">
									<img src="http://ppdb.ccom/uploads/m2b.png" class="xlogo">
								</div>
								<div class="text-center">
									TIDAK AKTIF
								</div>
							</template>
							<template v-slot:lead>
								<div class="text-center">
									MAAF, FORM REGISTRASI TIDAK AKTIF / TUTUP
								</div>
							</template>
						</b-jumbotron>
					</card>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import { required } from 'vuelidate/lib/validators';
import Card from "./../themeComponents/Cards/Card.vue";
import { mapMutations, mapState } from 'vuex';

export default {
	name: "invalidRegistration",
    components: {
        Card,
    },
	created(){
		if(this.registrationStatus=='running'){
			this.$router.push({ name: 'Registrasi' })
		}
	},
	watch: {
		registrationStatus: function(){
			if(this.registrationStatus=='running'){
				this.$router.push({ name: 'Registrasi' })
			}
		}
	},
	computed: {
		...mapState(['registrationStatus'])
	},
    methods: {
		pushRunning(){
			if(this.registrationStatus!='running'){
				this.$router.push({ name: 'Registrasi' })
			}
		}
    },
};
</script>
