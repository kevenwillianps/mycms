<template>

    <div>

        <nav class="navbar navbar-expand-lg navbar-light bg-default mb-0">

            <div class="navbar-brand">

                <i class="far fa-folder-open mr-1"></i>Cargos de Usuários/<span class="ml-1 badge badge-primary">Formulário</span>

            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#method_navbar_header" aria-controls="method_navbar_header" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="method_navbar_header">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">

                        <router-link v-bind:to="{name : 'user-function-datagrid'}" class="nav-link">

                            <i class="fas fa-bars mr-1"></i>Listagem

                        </router-link>

                    </li>

                </ul>

            </div>

        </nav>

        <div class="col-md-12 mt-3">

            <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-dashed animate animate__fadeIn" v-else>

                <div class="card-body">

                    <div class="media my-3">

                        <div class="media-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Nome" v-model="inputs.name">

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Descrição" v-model="inputs.description">

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <select class="custom-select" v-model="inputs.situation_id" id="situation_id">

                                                    <option v-bind:value="result.situation_id" v-for="(result, index) in query.result_situations" v-bind:key="index">

                                                        {{ result.name }}

                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-12 text-right mt-3">

                                    <button class="btn btn-primary" v-on:click="Save()" v-if="inputs.name && inputs.description">

                                        <i class="fas fa-paper-plane"></i> Salvar

                                    </button>

                                    <button class="btn btn-primary disabled" v-else disabled>

                                        <i class="fas fa-paper-plane"></i> Salvar

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress';

    export default {

        /** Nome do componente atual **/
        name: "UserFunctionForm",

        /** Declaração de Componentes **/
        components: {

            Progress,

        },

        data() {

            return {

                form: {

                    progress_bar: false,
                    show_form: false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],
                    result_situations: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    user_function_id : this.$route.params.user_function_id,
                    situation_id : null,
                    name : null,
                    description : null,
                    c_execute : null,
                    r_execute : null,
                    u_execute : null,
                    d_execute : null,
                    date_register : null,
                    date_update : null,
                },
                /** Grupo de variaveis da sessão do usuário **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Listagem de 'Situações' **/
            ListSituations() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=SITUATION&ACTION=SITUATION_DATAGRID', )

                /** Caso tenha sucesso **/
                    .then(response => {

                        switch (response.data.cod){

                            case 404:

                                location.reload();
                                break;

                            default :

                                /** Guardo minha resposta em uma váriavel **/
                                this.query.result_situations = response.data.result;

                                /** Defino um delay no progresso **/
                                setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Busco o 'Conteúdo' **/
            EditForm() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?table=user_function&action=user_function_edit_form', {
                    inputs: this.inputs
                })

                /** caso tenha sucesso **/
                    .then(response => {

                        /** guardo minha resposta em uma váriavel **/
                        this.inputs = response.data.result;

                        /** defino um delay no progresso **/
                        window.setTimeout(() => {

                            this.form.progress_bar = false;
                            this.form.show_form = true;

                        }, 1000);

                    })

                    /** caso tenha falha **/
                    .catch(response => {

                        console.log('erro:' + response);

                    });

            },

            /** Método para listar todos os registros **/
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=USER_FUNCTION&ACTION=USER_FUNCTION_SAVE', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                window.setTimeout(() => {

                                    this.$router.replace({
                                        name: 'user-function-datagrid',
                                    });

                                }, 1000);
                                break;

                            default:

                                window.setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    });

            },

        },

        mounted() {

            /** Verifico se é edição **/
            if (this.$route.params.user_function_id > 0) {

                this.EditForm();

            }
            this.ListSituations();
            console.log("Componente 'UserFunctionForm', montado com sucesso!");

        }

    }

</script>