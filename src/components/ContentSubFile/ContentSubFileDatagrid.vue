<template>

    <div>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="row animate__animated animate__fadeIn">

            <div class="col-md-6">

                <h4>

                    <i class="fas fa-brain mr-1"></i>

                    <router-link v-bind:to="{name : 'content-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                        Conteúdo/

                    </router-link>

                    <router-link v-bind:to="{name : 'content-sub-details', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : inputs.content_id, content_sub_id : inputs.content_sub_id}}">

                        Sub-Conteúdo/

                    </router-link>

                    <span class="ml-1 badge badge-primary">

                        Arquivos

                    </span>

                </h4>

            </div>

            <div class="col-md-6 text-right">

                <h4>

                    <button class="btn btn-default" type="button" v-on:click="Save()">

                        Salvar

                    </button>

                </h4>

            </div>

        </div>

        <div class="animate__animated animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div class="animate__animated animate__fadeIn" v-else-if="query.result <= 0">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="media">

                        <img src="image/svg/003-error.svg" width="70px" class="mr-3" alt="MyCMS - Keven Willian">

                        <div class="media-body">

                            <h3 class="mt-0">

                                Oooops!

                            </h3>

                            <h5 class="text-muted">

                                Não foram localizado registros

                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row" v-else>

            <div class="col-md-2 mb-2 animate__animated animate__fadeIn" v-for="(result, index) in query.result" v-bind:key="index">

                <div class="card shadow-sm">

                    <img v-bind:src="result.path + '/thumbnail/' + result.name" class="card-img-top" v-bind:alt="result.name">

                    <div class="card-body">

                        <h6 class="card-title">

                            <span class="text-muted"><i class="fas fa-hashtag mr-1"></i>{{ result.content_id }}</span> - <span class="text-muted"><i class="far fa-clock mr-1"></i> {{ result.date_register }}</span>

                        </h6>

                        <div class="mt-1">

                            <div class="form-group">

                                <input type="number" class="form-control" v-model="result.position"/>

                            </div>

                            <div class="form-group mb-0">

                                <div class="input-group">

                                    <select class="custom-select" v-model="result.highlighter_file_id" id="inputGroupSelect01">

                                        <option v-bind:value="result_select.highlighter_file_id" v-for="(result_select, index_select) in query.result_highlighters_file" v-bind:key="index_select">

                                            {{ result_select.description }}

                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                    <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer card-footer-transparent">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item">

                                    <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_sub_file_id = result.content_sub_file_id">

                                        <i class="fas fa-fire-alt mr-1"></i>Excluir

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        /** Nome do componente atual **/
        name: "ContentSubFileDatagrid",

        components: {

            Progress,
            ModalConfirm,

        },

        data() {

            return {

                form: {

                    progress_bar: false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_id: this.$route.params.content_id,
                    content_sub_id: this.$route.params.content_sub_id,
                    content_sub_file_id: null,

                },
                /** Dados da Seção **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Listagem de Classes **/
            List() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB_FILE&ACTION=CONTENT_SUB_FILE_DATAGRID', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 404:

                                location.reload();
                                break;

                            default:

                                /** Guardo minha resposta em uma váriavel **/
                                this.query.result = response.data.result;

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

            /** Listagem de 'Marcadores' **/
            ListHighlightersFile() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=HIGHLIGHTER_FILE&ACTION=HIGHLIGHTER_FILE_DATAGRID', )

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 404:

                                location.reload();
                                break;

                            default:

                                /** Guardo minha resposta em uma váriavel **/
                                this.query.result_highlighters_file = response.data.result;

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

            /** Salvo minhas informações **/
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=CONTENT_SUB_FILE&ACTION=CONTENT_SUB_FILE_POSITION_SAVE', {
                    inputs: this.query.result
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            /** Sucesso **/
                            case 1:

                                window.setTimeout(() => {

                                    /** Listagem de registros **/
                                    this.List();
                                    /** Listagem de marcadores de arquivos **/
                                    this.ListHighlightersFile();
                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            /** Usuário não autenticado **/
                            case 404:

                                location.reload();
                                break;

                            /** Padrão **/
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

            Delete() {

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=CONTENT_SUB_FILE&ACTION=CONTENT_SUB_FILE_DELETE', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            /** Sucesso **/
                            case 1:

                                window.setTimeout(() => {

                                    /** Listagem de registros **/
                                    this.List();
                                    /** Listagem de marcadores de arquivos **/
                                    this.ListHighlightersFile();
                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            /** Usuário não autenticado **/
                            case 404:

                                location.reload();
                                break;

                            /** Padrão **/
                            default:

                                setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha erro **/
                    .catch(response => {

                        console.log('Erro' + response);

                    })

            },

        },

        created() {

            /** Listagem de registros **/
            this.List();
            /** Listagem de marcadores de arquivos **/
            this.ListHighlightersFile();
            console.log('Componente "ContentDatagrid", montado com sucesso!')

        },

    }

</script>
