<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-warning">
              <i class="nc-icon nc-chart text-warning"></i>
            </div>
            <div slot="content">
              <p class="card-category">Pengunjung</p>
              <h4 class="card-title">{{ visitors }}</h4>
            </div>
            <!--div slot="footer">
              <i class="fa fa-refresh"></i>Updated now
            </div-->
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-success">
              <i class="nc-icon nc-light-3 text-success"></i>
            </div>
            <div slot="content">
              <p class="card-category">Pendaftar</p>
              <h4 class="card-title">{{ pendaftar }}</h4>
            </div>
            <!--div slot="footer">
              <i class="fa fa-calendar-o"></i>Total
            </div-->
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-danger">
              <i class="nc-icon nc-vector text-danger"></i>
            </div>
            <div slot="content">
              <p class="card-category">Tervalidasi</p>
              <h4 class="card-title">{{ j_validated }}</h4>
            </div>
            <!--div slot="footer">
              <i class="fa fa-clock-o"></i>Last day
            </div-->
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-info">
              <i class="nc-icon nc-favourite-28 text-primary"></i>
            </div>
            <div slot="content">
              <p class="card-category">Lulus</p>
              <h4 class="card-title">{{ lulus }}</h4>
            </div>
            <!--div slot="footer">
              <i class="fa fa-refresh"></i>Updated now
            </div-->
          </stats-card>
        </div>
      </div>

	<div class="row">
        <div class="col-md-8">
          <chart-card
            :chart-data="barChart.data"
            :chart-options="barChart.options"
            :chart-responsive-options="barChart.responsiveOptions"
            chart-type="Bar">
            <template slot="header">
              <h4 class="card-title">Grafik Pendaftar</h4>
              <p class="card-category">Berdasarkan status</p>
            </template>
            <template slot="footer">
              <div class="legend">
                <!--i class="fa fa-circle text-info"></i> Tesla Model S
                <i class="fa fa-circle text-danger"></i-->
              </div>
              <hr>
              <div class="stats">
                <i class="fa fa-check"></i> Data valid
              </div>
            </template>
          </chart-card>
        </div>
	  <div class="col-md-4">
          <chart-card :chart-data="pieChart.data" chart-type="Pie">
            <template slot="header">
              <h4 class="card-title">Statistik</h4>
              <p class="card-category">Top browser</p>
            </template>
            <template slot="footer">
              <div class="legend">
                <!--i class="fa fa-circle text-info"></i> Open
                <i class="fa fa-circle text-danger"></i> Bounce
                <i class="fa fa-circle text-warning"></i-->
              </div>
              <hr>
              <div class="stats">
                <i class="fa fa-clock-o"></i> 30 Hari terakhir
              </div>
            </template>
          </chart-card>
        </div>
	  </div>
    </div>
  </div>
</template>
<script>
  import ChartCard from './../themeComponents/Cards/ChartCard.vue'
  import StatsCard from './../themeComponents/Cards/StatsCard.vue'
  import LTable from './../themeComponents/Table.vue'

  export default {
    components: {
      LTable,
      ChartCard,
      StatsCard
    },
    data() {
      return {
		pendaftar: 0,
		tervalidasi: 0,
		lulus: 0,
		pageViews: 0,
		visitors: 0,
        editTooltip: 'Edit Task',
        deleteTooltip: 'Remove',
        pieChart: {
          data: {
            labels: [],
            series: []
          }
        },
        barChart: {
          data: {
            labels: ['Pendaftar', 'Terverifikasi', 'Lulus'],
            series: [
              []
            ]
          },
          options: {
            seriesBarDistance: 10,
            axisX: {
              showGrid: false
            },
            height: '245px',
          },
          responsiveOptions: [
            ['screen and (max-width: 640px)', {
              seriesBarDistance: 5,
              axisX: {
                labelInterpolationFnc (value) {
                  return value[0]
                }
              }
            }]
          ]
        }
      }
    },
	created(){
		this.clearAttachment();
		this.getPendaftar();
		this.getValidated();
		this.getLulus();
		this.getVisitors();
		this.getSetting();
		//this.getPageViews();
		//this.getBrowser();
		// this.barChart.data.series[0].push(15);
		// this.barChart.data.series[0].push(45);
		// this.barChart.data.series[0].push(32);		
	},
	mounted(){
		this.barChart.data.series[0].push(this.pendaftar);
		this.barChart.data.series[0].push(this.j_validated);
		this.barChart.data.series[0].push(this.lulus);
	},
	computed: {
		j_validated: function(){
			return this.tervalidasi + this.lulus;
		}
	},
	watch: {
		pendaftar: function(){
			this.barChart.data.series[0][0] = this.pendaftar;
		},
		j_validated: function(){
			this.barChart.data.series[0][1] = this.j_validated;
		},
		lulus: function(){
			this.barChart.data.series[0][2] = this.lulus;
		},
	},
	methods: {
		getPageViews() {
		  axios
			.get('/api/analytics-pv')
			.then((response)=> {
			  var items = response.data;
			  if(items.status=='success'){
				this.pageViews = items.data;
			  }
			});
		},
		getsetting() {
			  $axios
				.get('/setting')
				.then((response)=> {
				  var items = response.data;
				  this.setting = [];
				  for (var i = 0; i < items.length; i++) {
					this.$store.commit('SET_APP_SETTING', {
						id : items[i].id,
						setting: items[i].nama_setting,
						value: items[i].value
					});
				  }
				})
				.catch(error => {
					if(this.data.length==0){
						this.getsetting();
					}
				});
		},
		getPendaftar() {
		  axios
			.get('/api/jumlah_pendaftar')
			.then((response)=> {
			  var items = response.data;
			  this.pendaftar = items.jumlah_pendaftar;
			});
		},
		getValidated() {
		  axios
			.get('/api/jumlah_tervalidasi')
			.then((response)=> {
			  var items = response.data;
			  this.tervalidasi = items.tervalidasi;
			});
		},
		getLulus() {
		  axios
			.get('/api/jumlah_lulus')
			.then((response)=> {
			  var items = response.data;
			  this.lulus = items.lulus;
			});
		},
		getBrowser() {
		  axios
			.get('/api/browser-ga')
			.then((response)=> {
			  var res = response.data;
			  if(res.status == 'success'){
				for(var i=0;i<res.data.length;i++){
					this.pieChart.data.series.push(res.data[i].sessions);
				}
				for(var i2=0;i2<res.data.length;i2++){
					this.pieChart.data.labels.push(res.data[i2].browser);
				}
			  }
			});
		},
		getVisitors() {
		  axios
			.get('/api/visitors')
			.then((response)=> {
			  var res = response.data;
			  if(res.status == 'success'){
				this.visitors = res.data;
			  }
			});
		},
		clearAttachment() {
		  axios.get('/api/clearAttachment');
		},
	}
  }
</script>
<style>
.ct-bar {
	stroke-width: 70px;
}
</style>
