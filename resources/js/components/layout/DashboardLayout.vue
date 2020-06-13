<template>
  <div class="wrapper">
    <side-bar>
      <!--mobile-menu slot="content"></mobile-menu-->
      <sidebar-link to="/index">
        <!--b-icon icon="house" style="width: 30px; height: 30px;margin-right:13px"></b-icon>
        <i class="nc-icon nc-chart-pie-35"></i> -->
		<i class="pe-7s-home"></i>
        <p>Beranda</p>
      </sidebar-link>
      <sidebar-link to="/info/index">
        <i class="nc-icon nc-notes"></i>
        <p>Informasi</p>
      </sidebar-link>
      <sidebar-link to="/registrasi" v-if="!isAuth">
        <i class="nc-icon nc-tap-01"></i>
        <p>Registrasi</p>
      </sidebar-link>
	  <sidebar-link to="/input" v-if="isAuth">
        <i class="nc-icon nc-tap-01"></i>
        <p>Input</p>
      </sidebar-link>
      <sidebar-link to="/status">
        <i class="fab fa-searchengin"></i>
        <p>Cek Status</p>
      </sidebar-link>
	  <sidebar-link to="/pengaturan" v-if="isAuth">
        <i class="fas fa-cogs"></i>
        <p>Pengaturan</p>
      </sidebar-link>
      <sidebar-link to="/kontak">
        <i class="nc-icon nc-send"></i>
        <p>Kontak</p>
      </sidebar-link>
	  <li>
	  <a href="https://man2bulukumba.sch.id" target="_blank" class="nav-link">
	  <i class="fas fa-globe-asia"></i>
	  <p>Website</p></a>
	  </li>
    </side-bar>
    <div class="main-panel">
		<top-navbar></top-navbar>
		
		<counter></counter>
		<dashboard-content @click="toggleSidebar"></dashboard-content>
		<content-footer></content-footer>
    </div>
  </div>
</template>
<style lang="scss">

</style>
<script>
  import TopNavbar from './TopNavbar.vue'
  import ContentFooter from './ContentFooter.vue'
  import DashboardContent from './Content.vue'
  import MobileMenu from './MobileMenu.vue'
  import Counter from '../ppdbPages/Counter.vue'
  import { mapState, mapGetters } from 'vuex'
  //import moment from 'moment'
  //import $axios from '../../api.js';
  import '@fortawesome/fontawesome-free/css/all.css'
  
  export default {
    components: {
      TopNavbar,
      ContentFooter,
      DashboardContent,
      MobileMenu,
	  Counter
    },
	computed: {
	...mapGetters(['isAuth'])
	},
    methods: {
      toggleSidebar () {
        if (this.$sidebar.showSidebar) {
          this.$sidebar.displaySidebar(false)
        }
      }
    }
  }

</script>
