<template>

    <div>

        <nav class="navbar navbar-expand-lg navbar-light bg-default mb-0">

            <div class="navbar-brand">

                <i class="far fa-folder-open mr-1"></i>Marcadores/<span class="ml-1 badge badge-primary">Formulário</span>

            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#method_navbar_header" aria-controls="method_navbar_header" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="method_navbar_header">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">

                        <router-link v-bind:to="{name : 'highlighter-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}" class="nav-link">

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

                                       <div class="col-md-6">

                                           <div class="form-group">

                                               <input type="text" class="form-control" placeholder="Nome" v-model="inputs.name">

                                           </div>

                                       </div>

                                       <div class="col-md-6">

                                           <div class="form-group">

                                               <input type="text" class="form-control" placeholder="Marcadores" v-model="inputs.description">

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
        name: "HighlighterForm",

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

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    highlighter_id: this.$route.params.highlighter_id,
                    name: null,
                    description: null,
                    date_register: null,
                    date_update: null,
                },
                /** Grupo de variáveis que guardar os dados dos campos do arquivo **/
                inputs_file: {

                    name: [],
                    name_auxiliary: [],
                    part: [],
                    length: [],
                    extension: [],

                },
                /** Grupo de variaveis da sessão do usuário **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Busco o 'Conteúdo' **/
            EditForm() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=HIGHLIGHTER&ACTION=HIGHLIGHTER_EDIT_FORM', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.inputs = response.data.result;

                        /** Defino um delay no progresso **/
                        setTimeout(() => {

                            this.form.progress_bar = false;
                            this.form.show_form = true;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Método para listar todos os registros **/
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=HIGHLIGHTER&ACTION=HIGHLIGHTER_SAVE', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                window.setTimeout(() => {

                                    this.$router.replace({
                                        name: 'highlighter-datagrid',
                                        params: {
                                            user_id: this.session.user_id,
                                            user_function_id: this.session.user_function_id
                                        }
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
            if (this.$route.params.highlighter_id > 0) {

                this.EditForm();

            }
            console.log("Componente 'HighlighterForm', montado com sucesso!");

        }

    }

</script>