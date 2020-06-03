<template>
	<!--div class="content"-->
			<b-alert show :variant="variantCounter">
				<div>
					<div class="message mb-3 text-center">{{ message | upper }}</div>
					<div v-show ="statusType !== 'expired'" class="text-center">
						<div class="day">
						  <span class="number">{{ days }}</span>
						  <div class="format">{{ wordString.day }}</div>
						</div>
						<div class="hour">
						  <span class="number">{{ hours }}</span>
						  <div class="format">{{ wordString.hours }}</div>
						</div>
						<div class="min">
						  <span class="number">{{ minutes }}</span>
						  <div class="format">{{ wordString.minutes }}</div>
						</div>
						<div class="sec">
						  <span class="number">{{ seconds }}</span>
						  <div class="format">{{ wordString.seconds }}</div>
						</div>
					</div>
					<div class="status-tag" :class="statusType">STATUS : {{ statusText }}</div>
				</div>
			</b-alert>
	<!--/div-->		
</template>

<script>

import Card from "./../themeComponents/Cards/Card.vue";
import { mapMutations, mapState, mapGetters } from 'vuex';
import $axios from '../../api.js';
import moment from 'moment';

export default {
	name: "Counter",
    components: {
        Card,
    },
    data() {
        return {
			variantCounter: "primary",
			timer:"",
			wordString: {  
				"day":"Hari",
				"hours":"Jam",
				"minutes":"Menit",
				"seconds":"Detik",
				"expired":"Pendaftaran telah tertutup",
				"running":"Pendaftaran akan ditutup dalam",
				"upcoming":"Pendaftaran akan dibuka dalam",
				"status_running" : "AKTIF",
				"status_expired" : "TUTUP",
				"status_upcoming" : "AKAN DIBUKA"
			},
			// start: moment(new Date()),
			// end: moment().add(30,'days'),
			start: '',
			end: '',
			interval: "",
			days:"",
			minutes:"",
			hours:"",
			seconds:"",
			message:"",
			statusType:"",
			statusText: ""
        };
    },
	filters: {
		upper(value){
			if(!value) return ''
				value = value.toString()
			return value.toUpperCase()
		},
		lower(value){
			if(!value) return ''
				value = value.toString()
			return value.toLowerCase()
		}
	},
	created(){
		this.getJadwal();
		//console.log(this.waktu);
	},
	mounted(){
		//this.start = new Date(this.starttime).getTime();
		//this.end = new Date(this.endtime).getTime();
		// Update the count down every 1 second
		//this.timerCount(this.start,this.end);
	},
	watch: {
		statusType: function(){
			this.$store.commit('SET_REG_STATUS', this.statusType);
			this.setVariant();
		},
		waktu: function(){
			this.start = new Date(this.waktu.mulai).getTime();
			this.end = new Date(this.waktu.akhir).getTime();
			this.countTheTimer();
		}
	},
	computed: {
		...mapState(['waktu','registrationStatus'])
	},
    methods: {
		countTheTimer(){
			this.timerCount(this.start,this.end);
			this.interval = setInterval(() => {
				this.timerCount(this.start,this.end);
			}, 1000);
			this.setVariant();
		},
		setVariant(){
			if(this.statusType=='upcoming'){
				this.variantCounter = "warning";
			} else if(this.statusType=='running'){
				this.variantCounter = "primary";
			} else {
				this.variantCounter = "danger";
			}
		},
		timerCount: function(start,end){
			// Get todays date and time
			var now = new Date().getTime();

			// Find the distance between now an the count down date
			var distance = start - now;
			var passTime =  end - now;

			if(distance < 0 && passTime < 0){
				this.message = this.wordString.expired;
				this.statusType = "expired";
				this.statusText = this.wordString.status_expired;
				clearInterval(this.interval);
				return;

			}else if(distance < 0 && passTime > 0){
				this.calcTime(passTime);
				this.message = this.wordString.running;
				this.statusType = "running";
				this.statusText = this.wordString.status_running;

			} else if( distance > 0 && passTime > 0 ){
				this.calcTime(distance); 
				this.message = this.wordString.upcoming;
				this.statusType = "upcoming";
				this.statusText = this.wordString.status_upcoming;
			}
		},
		calcTime: function(dist){
		  // Time calculations for days, hours, minutes and seconds
			this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
			this.hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
			this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
		},
		getJadwal(){
			$axios.get('/jadwalppdb')
			.then((response)=> {
				var res = response.data;
				if(res.status == 'success'){
					this.$store.commit('SET_WAKTU', {
						mulai: res.data.waktu_mulai,
						akhir: res.data.waktu_akhir
					});
					this.start = new Date(res.data.waktu_mulai).getTime();
					this.end = new Date(res.data.waktu_akhir).getTime();
				}
			});
		}
	}
};
</script>

<style scope>
	.timer {
		font-size: 20px;
		color: #fff;
		text-align:center;
		margin-top: 50px;
	}

	.day, .hour, .min, .sec {
		font-size: 30px;
		display: inline-block;
		font-weight: 500;
		text-align: center;
		margin: 0 5px;
	}
	
	.format {
		font-weight: 300;
		font-size: 14px;
		opacity: 0.8;
		width: 60px;
	}
	
	.number{
		background: rgba(51, 51, 51, 0.53);
		padding: 0 5px;
		border-radius: 5px;
		display: inline-block;
		width: 60px;
		text-align: center;
	}
	
	.message {
		font-size: 14px;
		font-weight: 400;
		margin-top: 5px;
	}
	
	.status-tag{
		width: 270px;
		margin: 10px auto;
		padding: 8px 0;
		font-weight: 500;
		color: #000;
		text-align: center;
		border-radius: 15px;
	}
	
	.upcoming{
		background-color: lightGreen;
	}
	.running{
		background-color: gold;
	}
	.expired{
		background-color: silver;
	}

</style>
