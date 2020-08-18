<template>

    <div>

        <nav class="navbar navbar-expand-lg navbar-light bg-default mb-0">

            <div class="navbar-brand">

                <i class="far fa-folder-open mr-1"></i>Conteúdo Principal/Sub Conteúdo/Conteúdo Auxiliar/<span class="ml-1 badge badge-primary">Listagem</span>

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

                        <router-link v-bind:to="{name : 'content-sub-auxiliary-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : inputs.content_id, content_sub_id : 0}}" class="nav-link">

                            <i class="fas fa-pencil-alt mr-1"></i>Novo

                        </router-link>

                    </li>

                </ul>

            </div>

        </nav>

        <nav class="navbar navbar-expand-lg navbar-light bg-light animate__animated animate__fadeIn">

            <a class="navbar-brand" href="#">

                <strong>

                    <i class="fas fa-link mr-1"></i>Conteúdo Auxiliar

                </strong>

            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item">

                        <a class="nav-link">

                            Cadastro

                        </a>

                    </li>

                </ul>

            </div>

        </nav>

        <div class="animate__animated animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div class="animate__animated animate__fadeIn" v-else-if="query.result <= 0">

            <AlertInfo message="Não foram localizados registros"></AlertInfo>

        </div>

        <div class="row" v-else>

            <div class="col-md-3 mb-2 animate__animated animate__fadeIn" v-for="(result, index) in query.result" v-bind:key="index">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h4 class="card-title">

                            <strong>

                                {{ result.title }}

                            </strong>

                        </h4>

                        <div class="mt-1">

                            <span class="text-muted">

                                <i class="fas fa-hashtag mr-1"></i>{{result.content_sub_id}}

                            </span> -

                            <span class="text-muted">

                                <i class="far fa-clock mr-1"></i>{{result.date_register}}

                            </span> -

                            <span class="text-muted">

                                {{result.user_name}}

                            </span> -

                            <span class="text-muted">

                                {{result.user_function}}

                            </span>

                        </div>

                    </div>

                    <nav class="navbar navbar-expand-lg navbar-light bg-light card-footer card-footer-transparent">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#MenuContentSubDatagrid_' + result.content_sub_id" v-bind:aria-controls="'#MenuContentSubDatagrid_' + result.content_sub_id" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" v-bind:id="'MenuContentSubDatagrid_' + result.content_sub_id">

                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item">

                                    <router-link class="nav-link" type="button" v-bind:to="{name : 'content-sub-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id, content_sub_id : result.content_sub_id}}">

                                        <i class="fas fa-pencil-alt mr-1"></i>Editar

                                    </router-link>

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

    import axios from 'axios';
    import Progress from '../Geral/Progress';

    export default {

        name: "ContentSubAuxiliaryDatagrid",

        components: {

            Progress,

        },

        props: {

            userId: null,
            userFunctionId: null,
            contentId: null,
            contentSubId: null,

        },

        data() {

            return {

                form: {

                    progress_bar: false,

                },

                query: {

                    result: [],

                },

                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_id: this.contentId,
                    content_sub_id: this.contentSubId,
                    content_sub_auxiliary_id: this.contentSubId,

                },

            }

        },

        methods: {

            /** Listagem de Classes **/
            List() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB_AUXILIARY&ACTION=CONTENT_SUB_AUXILIARY_DATAGRID', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;

                        /** Defino um delay no progresso **/
                        setTimeout(() => {

                            this.form.progress_bar = false;

                        }, 1000);

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
                axios.post('router.php?TABLE=CONTENT_SUB_AUXILIARY&ACTION=CONTENT_SUB_AUXILIARY_DELETE', {
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
            console.log('Componente "ContentSubAuxiliaryDatagrid", montado com sucesso!')

        },

    }

</script>