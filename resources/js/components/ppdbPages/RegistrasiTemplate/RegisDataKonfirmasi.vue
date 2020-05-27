<template>
<div>
	<card>
		<div class="row">
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
					<template v-slot:cell(edit)="data">
					<div class="col-md-2" :key="data.index">
						<b-button variant="danger" class="btn-fill" @click="removeLampiran(data.index)"><b-icon icon="trash-fill"></b-icon></b-button>
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
		<hr>
		<div class="row">
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
				fileFotoPath: null,
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
			fieldsLampiran: ['no', {key: 'jenis_file', label: 'Jenis File'}, {key: 'nama_file', label: 'Nama File'}, 'keterangan', {key:'edit', label:''}],
        };
    },
	//MENDEFINISIKAN RULE VALIDASI 
	validations: {
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
	},
	computed: {
		isFileLampiran(){
			if(this.lampiran.file_lampiran == null){
				return false
			} else {
				return true
			}			
		},
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
				this.uploadFoto();
				this.uploadLampiran();
				this.$emit('on-validate', this.dokumen, true)
				return true
			}			
		},
		removeLampiran(id){
			this.dokumen.fileLampiran.slice(id,1);
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
			this.dokumen.fileLampiran.push({
				jenis_file: this.lampiran.jenis_lampiran,
				nama_file: this.lampiran.file_lampiran.name,
				keterangan: this.lampiran.keterangan,
				file: this.lampiran.file_lampiran
			});
			this.clearLampiranForm();
		},
		warningFileSize(){
			Swal.fire(
			  'Gagal',
			  'Ukuran file tidak boleh lebih dari 400Kb!',
			  'warning'
			)
		},
		uploadFoto(){
			this.dokumen.fileFotoPath = null;
			const formData = new FormData();
			formData.append('upload', this.dokumen.fileFoto);
			formData.append('jenis_file', 'foto');
			axios.post('/api/uploadImageRegistration',
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
			)
			.then((response)=> {
				this.dokumen.fileFotoPath = response.data.url;
				return true;
			})
			.catch(error => {
				return false;
			});
		},
		uploadLampiran(){
			this.dokumen.fileLampiranPath = [];
			var errors = 0;
			for(var i=0;i<this.dokumen.fileLampiran.length;i++){
				const formData = new FormData();
				formData.append('upload', this.dokumen.fileLampiran[i].file);
				formData.append('jenis_file', this.lampiran.jenis_lampiran);
				formData.append('nama_file', this.lampiran.file_lampiran.name);
				formData.append('keterangan', this.lampiran.keterangan);
				axios.post('/api/uploadLampiran',
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
				return true
			} else {
				for(var ii=0;ii<this.dokumen.fileLampiranPath.length;ii++){
					axios.post('/api/hapusFileDokumen', {
						'jenis_file' : 'lampiran',	
						'filename' : this.dokumen.fileLampiranPath[ii].filename
					})
				}
				return false
			}
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
