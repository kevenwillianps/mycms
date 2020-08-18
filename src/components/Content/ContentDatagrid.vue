<template>

    <div>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <nav class="navbar navbar-expand-lg navbar-light bg-default mb-0">

            <div class="navbar-brand">

                <i class="far fa-folder-open mr-1"></i>Conteúdo Principal/<span class="ml-1 badge badge-primary">Listagem</span>

            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#method_navbar_header" aria-controls="method_navbar_header" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="method_navbar_header">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">

                        <a type="button" v-on:click="List()" class="nav-link">

                            <i class="fas fa-sync mr-1"></i>Atualiar

                        </a>

                    </li>

                    <li class="nav-item">

                        <router-link v-bind:to="{name : 'content-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : 0}}" class="nav-link">

                            <i class="fas fa-pencil-alt mr-1"></i>Novo

                        </router-link>

                    </li>

                </ul>

            </div>

        </nav>

        <div class="col-md-12 mt-3">

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

                <div class="col-md-3 mb-3 animate__animated animate__fadeIn" v-for="(result, index) in query.result" v-bind:key="index">

                    <div class="card shadow-sm">

                        <div class="card-body">

                            <h4 class="card-title">

                            <span class="badge badge-primary">

                                <i class="fas fa-hashtag mr-1"></i>{{ result.content_id }}

                            </span>

                                <strong> {{ result.title }} </strong>

                            </h4>

                            <div class="mt-1">

                            <span class="text-muted">

                                <i class="far fa-clock mr-1"></i> {{ result.date_register }}

                            </span>

                                -

                                <span class="text-muted">

                                {{ result.user_name }}

                            </span>

                                -
                                <span class="text-muted">

                                {{ result.user_function }}

                            </span>

                            </div>

                        </div>

                        <nav class="navbar navbar-card navbar-expand-lg navbar-light card-footer">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#navbar_content_' + result.content_id" v-bind:aria-controls="'#navbar_content_' + result.content_id" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" v-bind:id="'navbar_content_' + result.content_id">

                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item">

                                        <router-link v-bind:to="{name : 'content-sub-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id}}" class="nav-link">

                                            <i class="far fa-eye mr-1"></i>Ver

                                        </router-link>

                                    </li>

                                    <li class="nav-item">

                                        <router-link v-bind:to="{name : 'content-file-datagrid', params : {content_id : result.content_id}}" class="nav-link">

                                            <i class="far fa-file mr-1"></i>Arquivos

                                        </router-link>

                                    </li>

                                    <li class="nav-item">

                                        <router-link class="nav-link" type="button" v-bind:to="{name : 'content-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id}}">

                                            <i class="fas fa-pencil-alt mr-1"></i>Editar

                                        </router-link>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_id = result.content_id">

                                            <i class="fas fa-times mr-1"></i>Excluir

                                        </a>

                                    </li>

                                </ul>

                            </div>

                        </nav>

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
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        /** Nome do componente atuala **/
        name: "ContentDatagrid",

        components: {

            Progress,
            ModalConfirm,

        },

        data() {

            return {

                form: {

                    progress_bar: false,
                    class: null,
                    progressBar: 0,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],
                    message: null,

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_id: null,

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
                axios.post('router.php?TABLE=CONTENT&ACTION=CONTENT_DATAGRID')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        switch (response.data.cod){

                            case 404:

                                /** Recarrego a página **/
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

            /** Exclusão de Classes **/
            Delete() {

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=CONTENT&ACTION=CONTENT_DELETE', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 1:

                                this.List();
                                window.setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                            case 404:

                                /** Recarrego a página **/
                                location.reload();
                                break;

                            default:

                                window.setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    .catch(response => {

                        console.log('Erro' + response);

                    })

            },

        },

        created() {

            this.List();
            console.log('Componente "ContentDatagrid", montado com sucesso!')

        },

    }

</script>
