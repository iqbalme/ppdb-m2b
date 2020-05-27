<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <card>
                    <h4 slot="header" class="card-title">Form Registrasi Siswa</h4>
                    <form>
						<vue-form-json-schema v-model="model" :schema="schema" :ui-schema="uiSchema" v-on:state-change="onChangeState" v-on:validated="onValidated"></vue-form-json-schema>
					</form>
				</card>
			</div>
		</div>
	</div>
</div>
</template>

<script>
// Import VueFormJsonSchema
import VueFormJsonSchema from "vue-form-json-schema";
// We use a component to display JSON in a pretty way
// it is NOT included NOR required by VueFormJsonSchema
// import PrettyPrint from "./pretty-print";

export default {
    components: {
        "vue-form-json-schema": VueFormJsonSchema,
        // "pretty-print": PrettyPrint
    },
    data() {
        return {
            model: {},
            state: {},
            valid: false,
            schema: {
                // type: "object",
                // properties: {
                //     firstName: {
                //         type: "string"
                //     },
                //     tempatLahir: {
                //         type: "string"
                //     }
                // }
            },
            uiSchema: [{
                "component": "div",
                "fieldOptions": {
                    "class": "row"
                },
                "children": [
					{
                        "component": "div",
                        "fieldOptions": {
                            "class": "col-md-12"
                        },
                        "children": [{
                            "component": "div",
                            "fieldOptions": {
                                "class": "form-group"
                            },
                            "children": [
							{
							"component" : "label",
							"fieldOptions": {
								"class": [
									"control-label"
								],
								"domProps": {
									"innerHTML": "Nama Lengkap"
								},
								//"attrs": {
								//	"for": "age"
								//}
							  }
							},
							{
                                "component": "input",
                                "model": "nama_lengkap",
                                "fieldOptions": {
                                    "class": [
                                        "form-control"
                                    ],
                                    "on": [
                                        "input"
                                    ],
                                    "attrs": {
                                        "placeholder": "Nama Lengkap"
                                    }
                                }
                            }]
                        }]
                    }]
				}, //end nama lengkap
				{
                "component": "div",
                "fieldOptions": {
                    "class": "row"
                },
                "children": [
					{
                        "component": "div",
                        "fieldOptions": {
                            "class": "col-md-6"
                        },
                        "children": [{
                            "component": "div",
                            "fieldOptions": {
                                "class": "form-group"
                            },
                            "children": [
							{
							"component" : "label",
							"fieldOptions": {
								"class": [
									"control-label"
								],
								"domProps": {
									"innerHTML": "Jenis Kelamin"
								},
								//"attrs": {
								//	"for": "jenis_kelamin"
								//}
							  }
							},
							{
                                "component": "select",
                                "model": "jenis_kelamin",
                                "fieldOptions": {
                                    "class": [
                                        "form-control"
                                    ]
                                },
								"children": [
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "L"
											},
											"domProps": {
												"innerHTML": "Laki-laki"
											},
										},
									},
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "P"
											},
											"domProps": {
												"innerHTML": "Perempuan"
											},
										},
									}
								]
                            }]
                        }]
                    }, //end jenis kelamin
					{
                        "component": "div",
                        "fieldOptions": {
                            "class": "col-md-6"
                        },
                        "children": [{
                            "component": "div",
                            "fieldOptions": {
                                "class": "form-group"
                            },
                            "children": [
							{
							"component" : "label",
							"fieldOptions": {
								"class": [
									"control-label"
								],
								"domProps": {
									"innerHTML": "Agama"
								}
							  }
							},
							{
                                "component": "select",
                                "model": "agama",
                                "fieldOptions": {
                                    "class": [
                                        "form-control"
                                    ]
                                },
								"children": [
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "0"
											},
											"domProps": {
												"innerHTML": "Islam"
											},
										},
									},
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "1"
											},
											"domProps": {
												"innerHTML": "Kristen Protestan"
											},
										},
									},
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "2"
											},
											"domProps": {
												"innerHTML": "Katolik"
											},
										},
									},
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "3"
											},
											"domProps": {
												"innerHTML": "Hindu"
											},
										},
									},
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "4"
											},
											"domProps": {
												"innerHTML": "Budha"
											},
										},
									},
									{
										"component": "option",
										"fieldOptions": {
											"attrs": {
												"value": "5"
											},
											"domProps": {
												"innerHTML": "Kong hu cu"
											},
										},
									}
								]
                            }]
                        }]
                    } //end agama
				]
			}]
        };
    },
    methods: {
        onChangeState(value) {
            this.state = value;
        },
        onValidated(value) {
            this.valid = value;
        }
    }
};
</script>
