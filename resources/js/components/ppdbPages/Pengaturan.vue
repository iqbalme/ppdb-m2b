<template>
	<div class="content">
		<div class="container-fluid">
		
		<div>
<b-card no-body>
    <b-tabs
		pills 
		class="mt-3"
		active-nav-item-class="font-weight-bold text-uppercase text-primary"
		active-tab-class="font-weight-bold"
		content-class="mt-3"
		align="center">
	  <b-tab title="Waktu" active>
        <registrationTime></registrationTime>
      </b-tab>
	  <b-tab title="Info">
        <editInfo></editInfo>
      </b-tab>
      <b-tab title="Pendidikan">
		<pendidikan></pendidikan>
      </b-tab>
      <b-tab title="Pekerjaan" lazy>
        <pekerjaan></pekerjaan>
      </b-tab>
	  <b-tab title="Hobi" lazy>
        <hobi></hobi>
      </b-tab>
	  <b-tab title="Cita-cita" lazy>
        <cita_cita></cita_cita>
      </b-tab>
	  <b-tab title="Transportasi" lazy>
        <transportasi></transportasi>
      </b-tab>
	  <b-tab title="Jarak" lazy>
        <jarak></jarak>
      </b-tab>
	  <b-tab title="Penghasilan" lazy>
        <penghasilan></penghasilan>
      </b-tab>
	  <b-tab title="Mata Pelajaran" lazy>
        <mapel></mapel>
      </b-tab>
	  <b-tab title="Peminatan">
        <peminatan></peminatan>
      </b-tab>
	  <b-tab title="Kelas">
        <kelas></kelas>
      </b-tab>
	  <b-tab title="Tahun Ajaran">
        <tahun_ajaran></tahun_ajaran>
      </b-tab>
	  <b-tab title="Password">
        <profil></profil>
      </b-tab>
	  <b-tab title="Lainnya">
        <setlain></setlain>
      </b-tab>
    </b-tabs>
	</b-card>
</div>			
		</div>
	</div>
</template>

<script>

import Card from "./../themeComponents/Cards/Card.vue";
import registrationTime from "./registrationTime.vue";
import editInfo from "./editInfo.vue";
import pendidikan from "./Pendidikan.vue";
import pekerjaan from "./Pekerjaan.vue";
import cita_cita from "./CitaCita.vue";
import transportasi from "./Transportasi.vue";
import hobi from "./Hobi.vue";
import jarak from "./Jarak.vue";
import mapel from "./Mapel.vue";
import kelas from "./Kelas.vue";
import profil from "./Profil.vue";
import setlain from "./SetLain.vue";
import peminatan from "./Peminatan.vue";
import tahun_ajaran from "./TahunAjaran.vue";
import penghasilan from "./Penghasilan.vue";
import setting from "./Setting.vue";

export default {
	name: "Status",
    components: {
        Card,
		registrationTime,
		editInfo,
		pendidikan,
		pekerjaan,
		hobi,
		cita_cita,
		transportasi,
		jarak,
		penghasilan,
		mapel,
		peminatan,
		kelas,
		tahun_ajaran,
		setting,
		profil,
		setlain
    },
    data() {
        return {
        };
    },
    methods: {
    },
};
</script>
