<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
                    <h4 slot="header" class="card-title">Informasi</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ck-content p-4" v-html="editorData"></div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                            </div>
                        </div>
                </card>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Card from "./../themeComponents/Cards/Card.vue";

export default {
    components: {
        Card,
    },
    data() {
        return {
		
		}
    },
    methods: {

    }
};
</script>