<template>
  <div class="wrapper">
    <side-bar>
      <mobile-menu slot="content"></mobile-menu>
      <sidebar-link to="/index">
        <b-icon icon="house" style="width: 30px; height: 30px;margin-right:13px"></b-icon>
        <!-- <i class="nc-icon nc-chart-pie-35"></i> -->
        <p>Beranda</p>
      </sidebar-link>
      <sidebar-link to="/info">
        <i class="nc-icon nc-notes"></i>
        <p>Informasi</p>
      </sidebar-link>
	  <sidebar-link to="/info/edit" v-if="isAuth">
        <i class="nc-icon nc-notes"></i>
        <p>Edit Info</p>
      </sidebar-link>
      <sidebar-link to="/registrasi">
        <i class="nc-icon nc-tap-01"></i>
        <p>Registrasi</p>
      </sidebar-link>
      <sidebar-link to="/status">
        <i class="nc-icon nc-zoom-split"></i>
        <p>Cek Status</p>
      </sidebar-link>
      <sidebar-link to="/kontak">
        <i class="nc-icon nc-send"></i>
        <p>Kontak</p>
      </sidebar-link>
	  <li>
	  <a href="https://man2bulukumba.sch.id" target="_blank" class="nav-link">
	  <i class="nc-icon nc-zoom-split"></i>
	  <p>Website</p></a>
	  </li>
    </side-bar>
    <div class="main-panel">
      <top-navbar v-if="isAuth"></top-navbar>

      <dashboard-content @click="toggleSidebar">

      </dashboard-content>

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
  import { mapState, mapGetters } from 'vuex'
  export default {
    components: {
      TopNavbar,
      ContentFooter,
      DashboardContent,
      MobileMenu
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
