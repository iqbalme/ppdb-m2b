<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
                    <vue-form-generator tag="div" :schema="schema" :model="model" :options="formOptions"></vue-form-generator>

                </card>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// import Vue from 'vue'
import VueFormGenerator from 'vue-form-generator'
// import 'vue-form-generator/dist/vfg.css'

// Vue.use(VueFormGenerator)

export default {
    components: {
        "vue-form-generator": VueFormGenerator.component
    },
    data() {
        return {
            model: {
                first_name: '',
                last_name: '',
                address1: '',
                address2: '',
                city: '',
                street: ''
            },
            schema: {
                groups: [{
                        label: "Name",
                        fields: [{
                                type: "input",
                                inputType: "text",
                                label: "First Name",
                                model: "first_name"
                            },
                            {
                                type: "input",
                                inputType: "text",
                                label: "Last Name",
                                model: "last_name"
                            },
                        ]
                    },
                    {
                        label: "Address",
                        classes: "row",
                        tag: 'div',
                        groups: [{
                                tag: 'div',
                                classes: "col-md-6",
                                fields: [{
                                        type: "input",
                                        inputType: "text",
                                        label: "Street",
                                        model: "address1"
                                    },
                                    {
                                        type: "input",
                                        inputType: "text",
                                        label: "Apt/Suite",
                                        model: "address2"
                                    },
                                ]
                            },
                            {
                                tag: 'div',
                                classes: "col-md-6",
                                fields: [{
                                        type: "input",
                                        inputType: "text",
                                        label: "City",
                                        model: "city"
                                    },
                                    {
                                        type: "input",
                                        inputType: "text",
                                        label: "State",
                                        model: "state"
                                    },
                                ]
                            },
                        ]
                    }
                ]
            },
            formOptions: {
                validateAfterLoad: true,
                validateAfterChanged: true,
                validateAsync: true
            }
        }
    }
}
</script>
