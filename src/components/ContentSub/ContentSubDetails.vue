<template>

    <div class="row">

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="col-md-12">

            <h4>

                <i class="fas fa-brain mr-1"></i>

                <router-link v-bind:to="{name : 'content-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                    Conteúdo/

                </router-link>

                <router-link v-bind:to="{name : 'content-sub-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : inputs.content_id}}">

                    Sub-Conteúdo/

                </router-link>

                Auxiliar/

                <span class="ml-1 badge badge-primary">Listagem</span>

            </h4>

        </div>

        <div class="col-md-12">

            <div class="row">

                <div class="col-md-6">

                    <div class="card shadow-sm animate__animated animate__fadeIn">

                        <div class="card-body">

                            <h4 class="card-title">

                                <span class="badge badge-primary">

                                    <i class="fas fa-hashtag mr-1"></i>{{ query.result_content.content_id }}

                                </span>

                                <strong> {{ query.result_content.title }} </strong>

                            </h4>

                            <h6 class="card-subtitle text-muted">

                                Conteúdo

                            </h6>

                            <div class="mt-1">

                                <span class="text-muted">

                                    <i class="far fa-clock mr-1"></i> {{ query.result_content.date_register }}

                                </span>

                                -

                                <span class="text-muted">

                                    {{ query.result_content.user_name }}

                                </span>

                                -
                                <span class="text-muted">

                                    {{ query.result_content.user_function }}

                                </span>

                            </div>

                        </div>

                        <nav class="navbar navbar-card navbar-expand-lg navbar-light card-footer">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#navbar_content_' + query.result_content.content_id" v-bind:aria-controls="'#navbar_content_' + query.result_content.content_id" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" v-bind:id="'navbar_content_' + query.result_content.content_id">

                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item">

                                        <router-link v-bind:to="{name : 'content-file-datagrid', params : {content_id : query.result_content.content_id}}" class="nav-link">

                                            <i class="far fa-file mr-1"></i>Arquivos

                                        </router-link>

                                    </li>

                                </ul>

                            </div>

                        </nav>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card shadow-sm animate__animated animate__fadeIn">

                        <div class="card-body">

                            <h4 class="card-title">

                                <span class="badge badge-primary">

                                    <i class="fas fa-hashtag mr-1"></i>{{ query.result_content_sub.content_sub_id }}

                                </span>

                                <strong> {{ query.result_content_sub.title }} </strong>

                            </h4>

                            <h6 class="card-subtitle text-muted">

                                Sub-Conteúdo

                            </h6>

                            <div class="mt-1">

                                <span class="text-muted">

                                    <i class="far fa-clock mr-1"></i> {{ query.result_content_sub.date_register }}

                                </span>

                                -

                                <span class="text-muted">

                                    {{ query.result_content_sub.user_name }}

                                </span>

                                -
                                <span class="text-muted">

                                    {{ query.result_content_sub.user_function }}

                                </span>

                            </div>

                        </div>

                        <nav class="navbar navbar-card navbar-expand-lg navbar-light card-footer">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#navbar_content_sub_' + query.result_content.content_id" v-bind:aria-controls="'#navbar_content_sub' + query.result_content.content_id" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" v-bind:id="'navbar_content_sub' + query.result_content.content_id">

                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item">

                                        <router-link v-bind:to="{name : 'content-sub-file-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id: query.result_content.content_id, content_sub_id : query.result_content_sub.content_sub_id}}"  class="nav-link">

                                            <i class="far fa-file mr-1"></i>Arquivos

                                        </router-link>

                                    </li>

                                </ul>

                            </div>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-12 mt-3">

            <div class="row mb-2">

                <div class="col-md-10 animate__animated animate__fadeIn">

                    <h4>

                        <i class="fas fa-link mr-1"></i>Conteúdo Auxiliar

                    </h4>

                </div>

                <div class="col-md-2 text-right">

                    <router-link v-bind:to="{name : 'content-sub-auxiliary-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : query.result_content.content_id, content_sub_id : query.result_content_sub.content_sub_id, action : 0}}" class="btn btn-primary">

                        <i class="fas fa-pencil-alt mr-1"></i>Novo

                    </router-link>

                </div>

            </div>

            <div class="animate__animated animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="animate__animated animate__fadeIn" v-else-if="query.result_content_sub_auxiliary <= 0">

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

                <div class="col-md-3 mb-2 animate__animated animate__fadeIn" v-for="(result, index) in query.result_content_sub_auxiliary" v-bind:key="index">

                    <div class="card shadow-sm">

                        <div class="card-body">

                            <h4 class="card-title">

                                <span class="badge badge-primary">

                                    <i class="fas fa-hashtag mr-1"></i>{{ result.content_sub_id }}

                                </span>

                                <strong> {{ result.title }} </strong>

                            </h4>

                            <h6 class="card-subtitle text-muted">

                                Sub-Conteúdo

                            </h6>

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

                            <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#navbar_content_sub_auxiliary_' + result.content_sub_id" v-bind:aria-controls="'#navbar_content_sub_auxiliary_' + result.content_sub_id" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" v-bind:id="'navbar_content_sub_auxiliary_' + result.content_sub_id">

                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item">

                                        <router-link v-bind:to="{name : 'content-sub-file-datagrid', params : {content_sub_id : result.content_sub_id}}" class="nav-link">

                                            <i class="far fa-file mr-1"></i>Arquivos

                                        </router-link>

                                    </li>

                                    <li class="nav-item">

                                        <router-link class="nav-link" type="button" v-bind:to="{name : 'content-sub-auxiliary-form', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : result.content_id, content_sub_id : result.content_sub_id, action : 1}}">

                                            <i class="fas fa-pencil-alt mr-1"></i>Editar

                                        </router-link>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.content_sub_id = result.content_sub_id">

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

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        /** Nome do componente atual **/
        name: "ContentSubDetails",

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

                    result_content_sub_auxiliary: [],
                    result_content: [],
                    result_content_sub: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_sub_id: this.$route.params.content_sub_id,
                    content_id: this.$route.params.content_id,
                    content_sub_auxiliary_id: this.$route.params.content_sub_id,

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
            GetContent() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT&ACTION=CONTENT_EDIT_FORM', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_content = response.data.result;

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

            /** Listagem de Classes **/
            GetContentSub() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_EDIT_FORM', {
                    inputs: this.inputs
                })

                /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result_content_sub = response.data.result;

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
                        this.query.result_content_sub_auxiliary = response.data.result;

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

            /** Listo os registros **/
            this.List();
            /** Listo um registro especifico **/
            this.GetContent();
            /** Listo um registro especifico **/
            this.GetContentSub();
            console.log('Componente "ContentSubDetails", montado com sucesso!')

        },

    }

</script>