import MainLayout from './../components/layout/MainLayout.vue'
// GeneralViews
import NotFound from './../components/pages/NotFoundPage.vue'

// Admin pages
import Overview from './../components/pages/Overview.vue'
import Registrasi from './../components/ppdbPages/registrasiForm.vue'
import Info from './../components/ppdbPages/infoForm.vue'
import Login from './../components/ppdbPages/Login.vue'
import Status from './../components/ppdbPages/Status.vue'
import Kontak from './../components/ppdbPages/Kontak.vue'
import successReg from './../components/ppdbPages/successReg.vue'
import registrationTime from './../components/ppdbPages/registrationTime.vue'
import invalidRegistration from './../components/ppdbPages/invalidRegistration.vue'
import RegisDataWali from './../components/ppdbPages/RegistrasiTemplate/RegisDataWali.vue'
import RegisInfo from './../components/ppdbPages/RegistrasiTemplate/RegisInfo.vue';
import EditInfo from './../components/ppdbPages/editInfo.vue';
import RegisDataDiri from './../components/ppdbPages/RegistrasiTemplate/RegisDataDiri.vue';
import RegisDataSekolah from './../components/ppdbPages/RegistrasiTemplate/RegisDataSekolah.vue';
import RegisDataNilai from './../components/ppdbPages/RegistrasiTemplate/RegisDataNilai.vue';
import RegisDataKonfirmasi from './../components/ppdbPages/RegistrasiTemplate/RegisDataKonfirmasi.vue';
import Cetak from './../components/ppdbPages/Cetak.vue';
import Pengaturan from './../components/ppdbPages/Pengaturan.vue';
import inputEditPendaftar from './../components/ppdbPages/inputEditPendaftar.vue';
import pendaftarView from './../components/ppdbPages/pendaftarView.vue';

const routes = [
  //{
  //  path: '/',
  //  component: MainLayout,
  //  redirect: '/dashboard'
  //},
  {
    path: '/',
    component: MainLayout,
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
        path: 'login',
        name: 'Login',
        component: Login
      },
	  {
        path: 'status',
        name: 'Status',
        component: Status
      },
	  {
        path: 'kontak',
        name: 'Kontak',
        component: Kontak
      },
	  {
        path: 'invalidregistration',
        name: 'invalidRegistration',
        component: invalidRegistration
      },
	  {
        path: 'suksesreg',
        name: 'successReg',
        component: successReg,
		props: true
      },
	  {
        path: 'cetak',
        name: 'Cetak',
        component: Cetak,
		props: true,
		//meta: { requiresAuth: true }
      },
	  {
        path: 'pengaturan',
        name: 'Pengaturan',
        component: Pengaturan,
		meta: { requiresAuth: true }
      },
	  {
        path: 'input',
        name: 'inputEditPendaftar',
        component: inputEditPendaftar,
		meta: { requiresAuth: true },
		props: true,
      },
	  {
        path: 'status/:no_reg',
        name: 'pendaftarView',
        component: pendaftarView,
		props: true,
      },
    ]
  },
  {
    path: '/info',
    component: MainLayout,
    redirect: '/info/index',
	children: [
		{
			path: 'edit',
			name: 'EditInfo',
			component: EditInfo,
			meta: { requiresAuth: true }
		},
		{
			path: 'index',
			name: 'Info',
			component: Info
		  },
	]
  },
  //{ path: '*', component: NotFound }
  { 
	path: '*', 
	component: MainLayout,
    redirect: '/notfound',
	children: [
		{
			path: '/',
			name: 'NotFound',
			component: NotFound
		}
	]
  }
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