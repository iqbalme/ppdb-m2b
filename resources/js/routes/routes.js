import DashboardLayout from './../components/layout/DashboardLayout.vue'
// GeneralViews
import NotFound from './../components/pages/NotFoundPage.vue'

// Admin pages
import Overview from './../components/pages/Overview.vue'
import Registrasi from './../components/ppdbPages/registrasiForm.vue'
import Info from './../components/ppdbPages/infoForm.vue'
import Login from './../components/ppdbPages/Login.vue'
import RegisDataWali from './../components/ppdbPages/RegistrasiTemplate/RegisDataWali.vue'
import RegisInfo from './../components/ppdbPages/RegistrasiTemplate/RegisInfo.vue';
import EditInfo from './../components/ppdbPages/editInfo.vue';
import RegisDataDiri from './../components/ppdbPages/RegistrasiTemplate/RegisDataDiri.vue';
import RegisDataSekolah from './../components/ppdbPages/RegistrasiTemplate/RegisDataSekolah.vue';
import RegisDataNilai from './../components/ppdbPages/RegistrasiTemplate/RegisDataNilai.vue';
import RegisDataKonfirmasi from './../components/ppdbPages/RegistrasiTemplate/RegisDataKonfirmasi.vue';
import Submit from './../components/ppdbPages/tesSubmit.vue';

const routes = [
  //{
  //  path: '/',
  //  component: DashboardLayout,
  //  redirect: '/dashboard'
  //},
  {
    path: '/',
    component: DashboardLayout,
    redirect: '/index',
    children: [
      {
        path: 'index',
        name: 'Home',
        component: Overview
      },
      {
        path: 'registrasi',
        name: 'Registrasi',
        component: Registrasi
      },
      {
        path: 'info',
        name: 'Info',
        component: Info
      },
	  {
        path: 'login',
        name: 'Login',
        component: Login
      },
	  {
        path: 'regiskonfir',
        name: 'RegisDataKonfirmasi',
        component: RegisDataKonfirmasi
      }
    ]
  },
  {
    path: '/info',
    component: DashboardLayout,
    //redirect: '/info',
	children: [
		{
			path: 'edit',
			name: 'EditInfo',
			component: EditInfo,
			meta: { requiresAuth: true }
		},
	]
  },
  { path: '*', component: NotFound }
]

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Views/' + name + '.vue');
   return res;
};**/

export default routes