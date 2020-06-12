<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-primary text-center" style="font-size:1.5rem;font-weight:bold">
								EDIT INFORMASI
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
						</div>
					</div>
					<div style="margin-top: 10px;">
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-fill float-right ml-3" @click.prevent="simpanInfo">SIMPAN</button>
							<button class="btn btn-danger btn-fill float-right" @click.prevent="emptyEditor">RESET</button>
						</div>
					</div>
					<div class="clearfix"></div>
                </card>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Card from "./../themeComponents/Cards/Card.vue";
import Swal from 'sweetalert2'

// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';

import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials';
import LinkPlugin from '@ckeditor/ckeditor5-link/src/link';
import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import Underline from '@ckeditor/ckeditor5-basic-styles/src/underline';
import Strikethrough from '@ckeditor/ckeditor5-basic-styles/src/strikethrough';
import Code from '@ckeditor/ckeditor5-basic-styles/src/code';
import Subscript from '@ckeditor/ckeditor5-basic-styles/src/subscript';
import Superscript from '@ckeditor/ckeditor5-basic-styles/src/superscript';
import Table from '@ckeditor/ckeditor5-table/src/table';
import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar';
import TableProperties from '@ckeditor/ckeditor5-table/src/tableproperties';
import TableCellProperties from '@ckeditor/ckeditor5-table/src/tablecellproperties';
import MediaEmbed from '@ckeditor/ckeditor5-media-embed/src/mediaembed';
import Font from '@ckeditor/ckeditor5-font/src/font';
import Heading from '@ckeditor/ckeditor5-heading/src/heading';
import HorizontalLine from '@ckeditor/ckeditor5-horizontal-line/src/horizontalline';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload';
import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle';
import CKFinder from '@ckeditor/ckeditor5-ckfinder/src/ckfinder';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
// Core plugin that provides the API for the management of special characters and their categories.
import SpecialCharacters from '@ckeditor/ckeditor5-special-characters/src/specialcharacters';
// A plugin that combines a basic set of special characters.
import SpecialCharactersEssentials from '@ckeditor/ckeditor5-special-characters/src/specialcharactersessentials';
import TodoList from '@ckeditor/ckeditor5-list/src/todolist';
import List from '@ckeditor/ckeditor5-list/src/list';
import Autoformat from '@ckeditor/ckeditor5-autoformat/src/autoformat';
import Indent from '@ckeditor/ckeditor5-indent/src/indent';
import IndentBlock from '@ckeditor/ckeditor5-indent/src/indentblock';
import CodeBlock from '@ckeditor/ckeditor5-code-block/src/codeblock';
import $axios from '../../api.js';

export default {
	name: "editInfo",
    components: {
        Card,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
                placeholder: 'Type the content here!',
                // The configuration of the editor.
                plugins: [
                    EssentialsPlugin,
                    LinkPlugin,
                    ParagraphPlugin,
                    Bold,
                    Italic,
                    Underline,
                    Strikethrough,
                    Code,
                    Subscript,
                    Superscript,
                    Table,
                    TableToolbar,
                    TableProperties,
                    TableCellProperties,
                    MediaEmbed,
                    Font,
                    Heading,
                    HorizontalLine,
                    Image,
                    ImageUpload,
                    ImageResize,
                    ImageToolbar,
                    ImageCaption,
                    ImageStyle,
                    CKFinder,
                    Alignment,
                    SpecialCharacters,
                    SpecialCharactersEssentials,
                    TodoList,
                    Autoformat,
                    Indent,
                    IndentBlock,
                    CodeBlock,
                    List,
                ],
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        '|',
                        'alignment',
                        '|',
                        'todoList',
                        'bulletedList', 
                        'numberedList',
                        '|',
                        'strikethrough',
                        'code',
                        'subscript',
                        'superscript',
                        '|',
                        'link',
                        '|',
                        'undo',
                        'redo',
                        '|',
                        'horizontalLine',
                        '|',
                        'insertTable',
                        'mediaEmbed',                        
                        // 'ckfinder',
                        'imageUpload',
                        '|',
                        'specialCharacters',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'codeBlock',
                    ],
                    // viewportTopOffset: 30,
                    shouldNotGroupWhenFull: true
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
                },
                image: {
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',
                        'side',
                        'alignCenter',
                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight'
                    ]
                },
                // codeBlock: { //default code block languages
                //     languages: [{
                //             language: 'plaintext',
                //             label: 'Plain text'
                //         }, // The default language.
                //         {
                //             language: 'c',
                //             label: 'C'
                //         },
                //         {
                //             language: 'cs',
                //             label: 'C#'
                //         },
                //         {
                //             language: 'cpp',
                //             label: 'C++'
                //         },
                //         {
                //             language: 'css',
                //             label: 'CSS'
                //         },
                //         {
                //             language: 'diff',
                //             label: 'Diff'
                //         },
                //         {
                //             language: 'html',
                //             label: 'HTML'
                //         },
                //         {
                //             language: 'java',
                //             label: 'Java'
                //         },
                //         {
                //             language: 'javascript',
                //             label: 'JavaScript'
                //         },
                //         {
                //             language: 'php',
                //             label: 'PHP'
                //         },
                //         {
                //             language: 'python',
                //             label: 'Python'
                //         },
                //         {
                //             language: 'ruby',
                //             label: 'Ruby'
                //         },
                //         {
                //             language: 'typescript',
                //             label: 'TypeScript'
                //         },
                //         {
                //             language: 'xml',
                //             label: 'XML'
                //         }
                //     ]
                // },
                ckfinder: { //ckfinder alternative
                    // The URL that the images are uploaded to.
                    uploadUrl: '/api/images',
                    // Define the CKFinder configuration (if necessary).
                    options: {
                        resourceType: 'Images'
                    }
                }
            }
        };
    },
	created(){
		this.getInfo();
	},
    methods: {
        emptyEditor() {
            this.editorData = '';
        },
        onBlur(evt) {
            console.log(evt);
        },
        onFocus(evt) {
            console.log(evt);
        },
        onContentDom(evt) {
            console.log(evt);
        },
        onDialogDefinition(evt) {
            console.log(evt);
        },
        onFileUploadRequest(evt) {
            console.log(evt);
        },
        onFileUploadResponse(evt) {
            console.log(evt);
        },
		getInfo() {
		  $axios.get('/informasi')
			.then((response)=> {
				var data = response.data;
				if(data.status == 'success'){
					if(data.data.informasi == null){
						this.editorData = '';
					} else {
						this.editorData = data.data.informasi;
					}
				}
			});
		},
		simpanInfo() {
			$axios.post('/informasi', {
				informasi: this.editorData
			})
			.then((response)=> {
			  var data = response.data;
			  if(data.status == 'success'){
				  this.swalBox('Berhasil', 'Data telah tersimpan!', 'success');
			  } else {
				  this.swalBox('Gagal', 'Data gagal tersimpan, silakan coba lagi!', 'warning');
			  }
			})
			.catch(error => {
			  this.swalBox('Gagal', 'Data gagal tersimpan, silakan coba lagi!', 'warning');
			});
		},
		swalBox(header, msg, icon){
			Swal.fire(
			  header,
			  msg,
			  icon
			)
		}
    }
};
</script>

<style>
</style>
