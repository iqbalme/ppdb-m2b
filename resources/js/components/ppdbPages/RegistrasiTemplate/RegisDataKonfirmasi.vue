<template>
<div>
	<card>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning" style="font-size:1.5rem;font-weight:bold">
					Data Lainnya
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				Pilihan Peminatan (Maksimal 2)
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label class="control-label"></label>
					<b-form-select v-model="temp_peminatan" :options="list_peminatan" :class="{'is-invalid': $v.dokumen.peminatan.$error}"></b-form-select>
				</div>
			</div>
			<div class="">
			<b-button variant="warning" class="btn-fill" @click="tambahPeminatan(temp_peminatan)"
			style="width:50px;" :disabled="comp_peminatan"><i class="fas fa-plus-circle"></i></b-button>
			</div>
			</div>
			<div class="row" v-if="dokumen.peminatan.length>0">
			<div class="col-md-12">
				<b-table hover fixed striped :items="dokumen.peminatan" :fields="kolomPeminatan" responsive="sm" stacked="md">
					<template v-slot:cell(no)="data">
					<div>
					{{ data.index + 1 }}
					</div>
					</template>
					<template v-slot:cell(edit)="data" >
					<div :key="data.index">
						<b-button variant="danger" class="btn-fill" @click="removePeminatan(data.index)"><b-icon icon="trash-fill"></b-icon></b-button>
					</div>
					</template>
				</b-table>
			</div>
		</div>
		<div class="row" v-if="dokumen.fileFoto.url == null">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">
						Upload Foto
					</label>
				<b-form-file
				  accept=".jpg, .png, .gif"
				  placeholder="Pilih file foto ..."
				  drop-placeholder="Drag file ke sini..."
				  @change="FotoSelectedMethod"
				  browse-text="Pilih"
				  ref="file-foto-input"
				  :class="{'is-invalid': $v.dokumen.fileFoto.url.$error}"
				></b-form-file>
				</div>
			</div>
		</div>
		<div class="row" v-if="(dokumen.fileFoto.url != null)">
			<div class="col-md-12">
				<b-alert show variant="secondary">
					<div class="row">
						<div class="col-md-12 text-center">
							<div style="width:150px;margin:0 auto" class="mb-3">
								<img :src="dokumen.fileFoto.url" width="100%" height="auto" style="object-fit: cover;">
							</div>
							<b-button variant="danger" class="btn-fill" @click="removeFotoTemporary" style="width:150px;"><b-icon icon="trash-fill"></b-icon>&nbsp;&nbsp;HAPUS</b-button>
						</div>
					</div>
				</b-alert>
			</div>
		</div>
		<div class="row" v-if="$v.dokumen.fileFoto.url.$error">
			<div class="col-md-12">
				<b-alert show variant="danger">File foto wajib disertakan</b-alert>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Lampiran Lainnya
				</div>
			</div>
		</div>
		<div class="row" v-show="!isUploading">
			<div class="col-md-7">
				<div class="form-group">
					<label class="control-label">
						File Lampiran
					</label>
				<b-form-file
				  v-model="lampiran.file_lampiran"
				  accept=".jpg, .png, .gif"
				  placeholder="Pilih file lainnya ..."
				  drop-placeholder="Drag file ke sini..."
				  browse-text="Pilih"
				  ref="file-lampiran-input"
				  @change="LampiranSelectedMethod"
				></b-form-file>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label">Jenis Dokumen</label>
					<b-form-select v-model="lampiran.jenis_lampiran" :options="list_file" :class="{'is-invalid': $v.lampiran.jenis_lampiran.$error}"></b-form-select>
				</div>
			</div>
			<div class="col-md-12">
				<base-input type="text" label="Keterangan" v-model="lampiran.keterangan"></base-input>
			</div>
		</div>
		<div class="row p-5" v-if="isUploading">
            <div class="col-md text-center">
				<b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<b-button variant="dark" class="btn-fill" @click="insertLampiranToTable" :disabled="(lampiran.file_lampiran == null) || (isUploading)">UPLOAD LAMPIRAN</b-button>
			</div>
			<div class="col-md-9">
				<b-alert show variant="warning">Pastikan UPLOAD agar data lampiran tersimpan</b-alert>
			</div>
		</div>
		<hr v-if="dokumen.fileLampiran.length>0">
		<div class="row" v-if="dokumen.fileLampiran.length>0">
			<div class="col-md-12">
				<b-table hover fixed striped :items="dokumen.fileLampiran" :fields="fieldsLampiran" responsive="sm" stacked="md">
					<template v-slot:cell(no)="data">
					<div>
					{{ data.index + 1 }}
					</div>
					</template>
					<template v-slot:cell(nama_file)="row">
					<div>
					<a :href="row.item.url" target="blank">{{ row.item.nama_file }}</a>
					</div>
					</template>
					<template v-slot:cell(keterangan)="row">
					<div>
					{{ row.item.keterangan }}
					</div>
					</template>
					<template v-slot:cell(edit)="data" >
					<div :key="data.index">
						<b-button variant="danger" class="btn-fill" @click="removeLampiran(data.index, dokumen.peminatan)"><b-icon icon="trash-fill"></b-icon></b-button>
					</div>
					</template>
				</b-table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<b-progress height="20px" :value="progressupload" show-progress class="mb-2" v-show="progressupload >0"></b-progress>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" style="font-size:1.5rem;font-weight:bold">
					Data Tambahan
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<base-input type="text" label="Email" v-model="dokumen.email" :validatedClass="$v.dokumen.email.$error"></base-input>
			</div>
		</div>
		<hr v-if="!isAuth">
		<div class="row" v-if="!isAuth">
			<div class="col-md-12">
				<div class="form-group">
					<b-form-checkbox
					  v-model="persetujuan"
					  name="cb_persetujuan"
					  value="setuju"
					  unchecked-value="tidak_setuju">
					  <strong>Saya menyatakan semua data adalah benar dan bersedia bertanggungjawab atas konsekuensi hukum yang ditimbulkan jika data tidak benar</strong>
					</b-form-checkbox>
				</div>
			</div>
		</div>
		</card>
	</div>
</template>

<script>

import { required, requiredIf, sameAs, email} from 'vuelidate/lib/validators';
import Card from "./../../themeComponents/Cards/Card.vue";
import Swal from 'sweetalert2';
import $axios from '../../../api.js';
import { mapMutations, mapState, mapGetters } from 'vuex';
import '@fortawesome/fontawesome-free/css/all.css'

export default {
	name: "regis-data-konfirmasi",
    components: {
        Card,
    },
    data() {
        return {
			progressupload : 0,
			dokumen: {
				fileFoto: {
					file: null,
					url: null
				},
				peminatan: [],
				fileLampiran: [],
				email: null,
				uploadList: [], //menambahkan file yang ingin dihapus baik dari storage asli atau temporary
				deleteList: [] //menambahkan file yang ingin diupload ke temporary
			},
			isUploading: false,
			list_file: [
				{value: 'kk', text: 'KK'},
				{value: 'ktp', text: 'KTP'},
				{value: 'rapor', text: 'Rapor'},
				{value: 'ijazah', text: 'Ijazah'},
				{value: 'akta', text: 'Akta Kelahiran'},
				{value: 'sertifikat', text: 'Sertifikat'},
				{value: 'lainnya', text: 'Lainnya'},
			],
			list_peminatan: [],
			persetujuan: 'tidak_setuju',
			lampiran: {
				file_lampiran: null,
				jenis_lampiran: null,
				keterangan: ''
			},
			fieldsLampiran: ['no', {key: 'jenis_file', label: 'Jenis File'}, {key: 'nama_file', label: 'Nama File'}, 'keterangan', {key:'edit', label:''}],
			kolomPeminatan: ['no', 'peminatan', {key:'edit', label:''}],
			temp_peminatan: null
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations() {
		return {
			dokumen: {
				fileFoto: {
					// file: {
						// requiredIf: requiredIf(function() { return this.comp_fileFoto })
					// },
					url: { required }
				},
				email: {
					email
				},
				fileToUpload: {
					$each: {
						url: {
							requiredIf: requiredIf(function() { return this.comp_filesToUpload })
						}
					}				
				},
				peminatan: {
					
				}
			},
			persetujuan : {
				sameAs: val => this.comp_setuju(val)
			},
			lampiran: {
				jenis_lampiran: {
					requiredIf: requiredIf(function() { return this.isFileLampiran })
				}
			}
		}
	},
	computed: {
		...mapState(['isEdit', 'loadingState']),
		...mapGetters(['isAuth']),
		isFileLampiran(){
			return this.lampiran.file_lampiran != null
			
		},
		comp_fileFoto(){
			if(this.isEdit){
				return (this.dokumen.fileFoto.url == null);
			} else {
				return true;
			}			
		},
		comp_filesToUpload(){
			return (this.dokumen.uploadList.length > 0);
		},
		comp_peminatan(){
			return (this.dokumen.peminatan.length >= 2);
		}
	},
	watch: {
		
	},
	created(){
		this.getPeminatan();
	},
    methods: {	
		tambahPeminatan(value){
			// this.dokumen.peminatan.push({
				// id: this.list_peminatan.filter(function(peminatan_data) {
					// return peminatan_data.value == value;
				// })[0].value,
				// peminatan: this.list_peminatan.filter(function(peminatan_data) {
					// return peminatan_data.value == value;
				// })[0].text,
			// });
			var index = this.list_peminatan.map(function(o){ return o.value == value }).indexOf(true);
			var data_peminatan = {
				id: this.list_peminatan[index].value,
				peminatan: this.list_peminatan[index].text
			}
			this.dokumen.peminatan.push(data_peminatan);
			this.list_peminatan.splice(this.list_peminatan.map(function(o){ return o.value == value }).indexOf(true),1);
		},
		removePeminatan(value, arrayPeminatan){
			var data_peminatan = {
				value: this.dokumen.peminatan[value].id,
				text: this.dokumen.peminatan[value].peminatan
			}
			this.list_peminatan.push(data_peminatan);
			this.dokumen.peminatan.splice(value,1);
		},
		comp_setuju(val){
			if(this.isEdit){
				return (val != 'setuju') || (val == 'setuju');
			} else {
				return (val == 'setuju');
			}
		},
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) {
				this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
				return false
			} else {
				this.$emit('on-validate', this.dokumen, true)
				return true;
			}	
		},
		appendValueFromParent(val){
			this.dokumen = val;
		},
		setProgressBar(value){
			this.progressupload = value;
		},
		uploadLampiran(lampiran){ //this.lampiran
			this.isUploading = true;
			const formData = new FormData();
			formData.append('upload', lampiran.file_lampiran);
			$axios.post('/uploadLampiran',
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
			).then((res) => { //jika sukses upload lampiran
				var index = this.dokumen.fileLampiran.length-1;
				this.dokumen.fileLampiran[index].url = res.data.url.replace('public', 'storage');
				var split_url = res.data.url.split('/');
				var file_name = split_url[split_url.length-1];
				this.dokumen.fileLampiran[index].nama_file = file_name;
				this.dokumen.uploadList.push({
					'nama_file' : file_name,
					'path' : res.data.url,
					'jenis_file' : this.dokumen.fileLampiran[index].jenis_file,
					'keterangan' : this.dokumen.fileLampiran[index].keterangan
				});
				this.isUploading = false;
			})
			.catch((err) => { //jika gagal upload lampiran
				this.isUploading = false;
				this.modalBox('Gagal', 'Gagal upload lampiran. Silakan coba lagi!', 'warning');
			});
		},		
		uploadFoto(){
			if(this.dokumen.fileFoto.file!=null){
				const formData = new FormData();
				formData.append('foto', this.dokumen.fileFoto.file);
				$axios.post('/uploadFoto',
					formData,
					{
						headers: { 'Content-Type': 'multipart/form-data' }
					}
				).then( res => {
					this.dokumen.fileFoto.url = res.data.url.replace('public', 'storage');
					this.clearFotoForm();
				});
			} else {
				this.modalBox('Gagal', 'Upload foto gagal. Silakan coba lagi!', 'warning');
			}
		},
		removeLampiran(id){
			this.dokumen.deleteList.push(this.dokumen.fileLampiran[id].url);
			this.dokumen.fileLampiran.splice(id,1);
		},
		clearLampiranForm() {
			this.$refs['file-lampiran-input'].reset();
			this.lampiran.keterangan = null;
			this.lampiran.jenis_lampiran = null;
		},
		clearFotoForm() {
			this.$refs['file-foto-input'].reset()
		},
		FotoSelectedMethod(e){
			var fotoFile = e.target.files[0];
			if(fotoFile.size>409600){
				this.warningFileSize();
				this.clearFotoForm();
			} else {
				this.dokumen.fileFoto.file = fotoFile;
				this.uploadFoto();
			};			
		},
		LampiranSelectedMethod(e){
			var lampiranFile = e.target.files[0];
			if(lampiranFile.size>409600){
				this.warningFileSize();
				this.clearLampiranForm();
			};			
		},
		insertLampiranToTable(){
			if(this.lampiran.file_lampiran != null){
				this.$v.lampiran.jenis_lampiran.$touch();
				if(!this.$v.lampiran.jenis_lampiran.$invalid){
					this.dokumen.fileLampiran.push({
						url: null,
						jenis_file: this.lampiran.jenis_lampiran,
						nama_file: this.lampiran.file_lampiran.name,
						keterangan: this.lampiran.keterangan,
						file: this.lampiran.file_lampiran
					});
					this.uploadLampiran(this.lampiran);
					this.clearLampiranForm();
				}
			}	
		},
		warningFileSize(){
			Swal.fire(
			  'Gagal',
			  'Ukuran file tidak boleh lebih dari 400Kb!',
			  'warning'
			)
		},
		getPeminatan() {
			if(this.list_peminatan.length == 0){				
			  $axios
				.get('/peminatan')
				.then((response)=> {
				  var items = response.data;
				  this.list_peminatan = [];
				  for (var i = 0; i < items.length; i++) {
					  if(this.isEdit){
							var isSameValue = 0;
							for(var ii=0;ii<this.dokumen.peminatan.length;ii++){
								if(this.dokumen.peminatan[ii].id == items[i].id){
									isSameValue++;
								}
							}
							if(isSameValue == 0){
								this.list_peminatan.push({
									value : items[i].id,
									text: items[i].peminatan + ' (' + items[i].keterangan + ')'
								});
							}
					  } else {
							this.list_peminatan.push({
								value : items[i].id,
								text: items[i].peminatan + ' (' + items[i].keterangan + ')'
							});
					  }					
				  }				  
				})
				.catch(error => {
					this.getPeminatan();
				});
			}
		},
		modalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		},
		removeFotoTemporary(){
			this.dokumen.deleteList.push(this.dokumen.fileFoto.url);
			this.dokumen.fileFoto.url = null;
		},
    }
};
</script>

<style scope>
.is-invalid : {
	border-color: #f79483;
}

.col-width: 100px;
</style>