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
		<div class="row" v-if="dokumen.fileFotoPath.length==0">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">
						Upload Foto
					</label>
				<b-form-file
				  v-model="dokumen.fileFoto"
				  accept=".jpg, .png, .gif"
				  placeholder="Pilih file foto ..."
				  drop-placeholder="Drag file ke sini..."
				  @change="FotoSelectedMethod"
				  browse-text="Pilih"
				  ref="file-foto-input"
				  :class="{'is-invalid': $v.dokumen.fileFoto.$error}"
				></b-form-file>
				</div>
			</div>
		</div>
		<div class="row" v-if="isEdit && (dokumen.fileFotoPath.length>0)">
			<div class="col-md-12">
				<b-alert show variant="secondary">
					<div class="row">
						<div class="col-md-11">
							<a :href="fotoPathx" target="blank" class="btn btn-fill">FOTO : {{ fotoPathx }}</a>
						</div>
						<div class="col-md-1">
							<b-button variant="danger" class="btn-fill" @click="removeFotoTemporary"><b-icon icon="trash-fill"></b-icon></b-button>
						</div>
					</div>
				</b-alert>
			</div>
		</div>
		<div class="row" v-if="$v.dokumen.fileFoto.$error">
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
		<div class="row">
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
		<div class="row">
			<div class="col-md-3">
				<b-button variant="dark" class="btn-fill" @click="insertLampiranToTable">UPLOAD LAMPIRAN</b-button>
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
					<div class="col-md-2">
					{{ data.index + 1 }}
					</div>
					</template>
					<template v-slot:cell(edit)="data" >
					<div class="col-md-2" :key="data.index">
						<b-button variant="danger" class="btn-fill" @click="removeLampiran(data.index)" v-if="!isEdit"><b-icon icon="trash-fill"></b-icon></b-button>
						<b-button variant="danger" class="btn-fill" @click="removeLampiranTemporary(data.index)" v-if="isEdit"><b-icon icon="trash-fill"></b-icon></b-button>
					</div>
					</template>
				</b-table>
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

export default {
	name: "regis-data-konfirmasi",
    components: {
        Card,
    },
    data() {
        return {
			dokumen: {
				fileFoto: null,
				fileLampiran: [],
				fileFotoPath: [],
				fileLampiranPath: [],
				email: null
			},
			list_file: [
				{value: 'kk', text: 'KK'},
				{value: 'ktp', text: 'KTP'},
				{value: 'rapor', text: 'Rapor'},
				{value: 'ijazah', text: 'Ijazah'},
				{value: 'akta', text: 'Akta Kelahiran'},
				{value: 'sertifikat', text: 'Sertifikat'},
			],
			persetujuan: 'tidak_setuju',
			lampiran: {
				file_lampiran: null,
				jenis_lampiran: null,
				keterangan: ''
			},
			fileToDelete: [],
			fileToUpload: [],
			fieldsLampiran: ['no', {key: 'jenis_file', label: 'Jenis File'}, {key: 'nama_file', label: 'Nama File'}, 'keterangan', {key:'edit', label:''}],
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations() {
		if(this.isEdit){
			return {
				dokumen: {
					fileFoto: {
						requiredIf: requiredIf(function() { return this.comp_fileFotoPath })
					},
					email: {
						email
					}
				},
				persetujuan: {},
				lampiran: {
					jenis_lampiran: {
						requiredIf: requiredIf(function() { return this.isFileLampiran })
					}
				}
			}
		} else {
			return {
				dokumen: {
					fileFoto: {
						required
					},
					email: {
						email
					}
				},
				persetujuan : {
					sameAs: val => val === 'setuju'
				},
				lampiran: {
					jenis_lampiran: {
						requiredIf: requiredIf(function() { return this.isFileLampiran })
					}
				}
			}
		}
	},
	computed: {
		...mapState(['isEdit', 'loadingState']),
		...mapGetters(['isAuth']),
		isFileLampiran(){
			if(this.lampiran.file_lampiran == null){
				return false
			} else {
				return true
			}			
		},
		comp_fileFotoPath(){
			return this.dokumen.fileFotoPath.length == 0;
		},
		fotoPathx(){
			if(this.dokumen.fileFotoPath.length>0){
				return this.dokumen.fileFotoPath[0];
			} else {
				return null;
			}			
		}
	},
	watch: {
		
	},
    methods: {
		validate() {
			this.$v.$touch(); //VALIDASI DIJALANKAN
			if(this.$v.$error) {
				this.$emit('invalidValidation') //APABILA ERROR MAKA STOP
				return false
			} else {
				if(this.isEdit){
					if(this.dokumen.fileFotoPath.length == 0){
						this.uploadFoto();
					}
					if(this.fileToDelete.length>0){
						for(var i=0;i<this.fileToDelete.length;i++){
							$axios.post('/hapusFileDokumen', {
								'jenis_file' : this.fileToDelete[i].jenis_file,	
								'filename' : this.fileToDelete[i].nama_file
							});
							$axios.post('/hapusLampiranUser', {
								'nama_file' : this.fileToDelete[i].nama_file,
								'id' : this.fileToDelete[i].id
							});
						}
					}
					if(this.fileToUpload.length>0){
						this.dokumen.fileLampiranPath = [];
						this.uploadLampiran(this.fileToDelete)
					}
				} else {
					this.uploadFoto();
				}
				this.$emit('on-validate', this.dokumen, true)
				return true
			}			
		},
		appendValueFromParent(val){
			this.dokumen = val;
		},
		removeLampiran(id){
			this.dokumen.fileLampiran.splice(id,1);
		},
		clearLampiranForm() {
			this.$refs['file-lampiran-input'].reset();
			this.lampiran.keterangan = '';
			this.lampiran.jenis_lampiran = null;
		},
		clearFotoForm() {
			this.$refs['file-foto-input'].reset()
		},
		FotoSelectedMethod(e){
			var fotoFile = e.target.files[0];
			//console.log(fotoFile);
			if(fotoFile.size>409600){
				this.warningFileSize();
				this.clearFotoForm();
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
			this.$v.lampiran.jenis_lampiran.$touch();
			if(!this.$v.lampiran.jenis_lampiran.$invalid){
				this.dokumen.fileLampiran.push({
					jenis_file: this.lampiran.jenis_lampiran,
					nama_file: this.lampiran.file_lampiran.name,
					keterangan: this.lampiran.keterangan,
					file: this.lampiran.file_lampiran
				});
				if(this.isEdit){
					this.addToUploadList.push(
						this.lampiran.file_lampiran.name,
						'lampiran',
						this.lampiran.file_lampiran,
						this.lampiran.keterangan
					);
				}
				this.clearLampiranForm();
			}
		},
		warningFileSize(){
			Swal.fire(
			  'Gagal',
			  'Ukuran file tidak boleh lebih dari 400Kb!',
			  'warning'
			)
		},
		uploadFoto(){
			this.$store.commit('SET_LOADING_STATE', true);
			//this.dokumen.fileFotoPath = null;
			const formData = new FormData();
			formData.append('upload', this.dokumen.fileFoto);
			formData.append('jenis_file', 'foto');
			$axios.post('/uploadLampiran',
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
			)
			.then((response)=> {
				if(response.data.status == 'success'){
					this.dokumen.fileFotoPath.push(response.data.url);
					this.$store.commit('SET_LOADING_STATE', false);
					this.dokumen.fileLampiranPath = [];
					this.uploadLampiran(this.dokumen.fileLampiran);					
				} else {
					this.$store.commit('SET_LOADING_STATE', false);
					return false;
				}				
			})
			.catch(error => {
				return false;
			});
		},
		uploadLampiran(files){
			this.$store.commit('SET_LOADING_STATE', true);
			var errors = 0;
			for(var i=0;i<files.length;i++){
				const formData = new FormData();
				formData.append('upload', files[i].file);
				formData.append('jenis_file', files[i].jenis_file);
				//formData.append('nama_file', files[i].nama_file);
				formData.append('keterangan', files[i].keterangan);
				$axios.post('/uploadLampiran',
					formData,
					{
						headers: {
							'Content-Type': 'multipart/form-data'
						}
					}
				)
				.then((response)=> {
					this.dokumen.fileLampiranPath.push({
						filename: response.data.fileName,
						url: response.data.url,
						jenis_file: response.data.jenis_file,
						keterangan: response.data.keterangan,
					})
				})
				.catch(error => {
					errors ++;
				});
			}
			if(errors == 0){
				this.$store.commit('SET_LOADING_STATE', false);
				return true
			} else {
				for(var ii=0;ii<this.dokumen..length;ii++){
					$axios.post('/hapusFileDokumen', {
						'jenis_file' : 'lampiran',	
						'filename' : this.dokumen.fileLampiranPath[ii].filename
					})
				}
				this.$store.commit('SET_LOADING_STATE', false);
				return false
			}
		},
		addToUploadList(nama, jenis, file, keterangan){
			this.fileToUpload.push({
				nama_file: nama,
				file: file,
				jenis_file: jenis, //foto atau lampiran
				keterangan: keterangan
			});
		},
		addToDeleteList(id, nama, jenis){
			this.fileToDelete.push({
				nama_file: nama,
				jenis_file: jenis //foto atau lampiran
			});
		},
		removeFotoTemporary(){
			this.addToDeleteList(
				this.dokumen.fileFotoPath[0],
				'lampiran'
			);
			this.dokumen.fileFotoPath = [];
		},
		removeLampiranTemporary(index){
			this.addToDeleteList(
				this.dokumen.fileLampiranPath[index].url,
				'lampiran'
			);
			this.removeLampiran(index);
			this.dokumen.fileLampiranPath.splice(index,1);
		}
    }
};
</script>

<style scope>
.is-invalid : {
	border-color: #f79483;
}

.col-width: 100px;
</style>
