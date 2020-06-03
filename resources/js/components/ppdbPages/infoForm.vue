<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
                    <div class="row">
						<div class="col-md-12">
							<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
								INFORMASI
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="ck-content p-4" v-html="informasi"></div>
						</div>
					</div>
                </card>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Card from "./../themeComponents/Cards/Card.vue";
import $axios from '../../api.js';

export default {
    components: {
        Card,
    },
    data() {
        return {
			informasi: ''
		}
    },
	created(){
		this.getInfo();
	},
    methods: {
		getInfo() {
		  $axios.get('/informasi')
			.then((response)=> {
			  var data = response.data;
			  if(data.status == 'success'){
				this.informasi = data.data.informasi;
			  }			  
			});
		},
    }
};
</script>