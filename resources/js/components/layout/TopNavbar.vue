<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button type="button"
              class="navbar-toggler navbar-toggler-right"
              :class="{toggled: $sidebar.showSidebar}"
              aria-controls="navigation-index"
              aria-expanded="false"
              aria-label="Toggle navigation"
              @click="toggleSidebar">
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <button class="btn btn-primary btn-fill" v-if="!isAuth" @click="login">Log in</button>
			<button class="btn btn-danger btn-fill" v-if="isAuth" @click="logout">Log out</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
  export default {
    computed: {
      routeName () {
        const {name} = this.$route
        return this.capitalizeFirstLetter(name)
      }
    },
    data () {
      return {
        activeNotifications: false
      }
    },
	computed: {
        ...mapGetters(['isAuth']), //MENGAMBIL GETTERS isAuth DARI VUEX
      	//...mapState(['errors'])
    },
    methods: {
		...mapActions('auth', ['logout']), //MENGISIASI FUNGSI submit() DARI VUEX AGAR DAPAT DIGUNAKAN PADA COMPONENT TERKAIT. submit() BERASAL DARI ACTION PADA FOLDER STORES/auth.js
        ...mapMutations(['CLEAR_ERRORS']),
		login(){
			this.$router.push('/login')
		},
		//KETIKA TOMBOL LOGOUT DITEKAN, FUNGSI INI DIJALANKAN
		logout() {
			return new Promise((resolve, reject) => {
				localStorage.removeItem('token') //MENGHAPUS TOKEN DARI LOCALSTORAGE
				resolve()
			}).then(() => {
				//MEMPERBAHARUI STATE TOKEN
				this.$store.state.token = localStorage.getItem('token')
				this.$router.push('/login') //REDIRECT KE PAGE LOGIN
			})
		},
      capitalizeFirstLetter (string) {
        return string.charAt(0).toUpperCase() + string.slice(1)
      },
      toggleNotificationDropDown () {
        this.activeNotifications = !this.activeNotifications
      },
      closeDropDown () {
        this.activeNotifications = false
      },
      toggleSidebar () {
        this.$sidebar.displaySidebar(!this.$sidebar.showSidebar)
      },
      hideSidebar () {
        this.$sidebar.displaySidebar(false)
      }
    }
  }

</script>
<style>

</style>
