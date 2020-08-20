<template>

    <div>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <nav class="navbar navbar-expand-lg navbar-light bg-default mb-0">

            <div class="navbar-brand">

                <i class="far fa-folder-open mr-1"></i>Usuários/<span class="ml-1 badge badge-primary">Listagem</span>

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

                        <router-link v-bind:to="{name : 'users-form', params : {user_id : 0}}" class="nav-link">

                            <i class="fas fa-pencil-alt mr-1"></i>Novo

                        </router-link>

                    </li>

                </ul>

            </div>

        </nav>

        <div class="col-md-12 mt-3">

            <div class="mt-3 animate__animated animate__fadeIn" v-if="form.progress_bar">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <Progress percent="100"></Progress>

                    </div>

                </div>

            </div>

            <div class="row" v-else>

                <div class="col-md-3 mb-3 animate__animated animate__fadeIn" v-for="(result, index) in query.result" v-bind:key="index">

                    <div class="card">

                        <div class="card-body">

                            <h5 class="card-title">

                            <span class="badge badge-primary">

                                {{ result.user_id }}

                            </span>

                                {{ result.user_name }}

                            </h5>

                            <div class="card-text">

                                {{ result.user_function }}

                            </div>

                        </div>

                        <nav class="navbar navbar-card navbar-expand-lg navbar-light bg-light card-footer">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                <ul class="navbar-nav mr-auto">

                                    <li class="nav-item">

                                        <router-link class="nav-link" type="button" v-bind:to="{name : 'users-form', params : {user_id : session.user_id}}">

                                            <i class="fas fa-pencil-alt mr-1"></i>Editar

                                        </router-link>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.user_id = result.user_id">

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

    import axios        from 'axios';
    import Progress     from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        name: "UsersDatagrid",

        components : {

            Progress,
            ModalConfirm,

        },

        data(){

            return{

                /** Controle do HTML **/
                form : {

                    progress_bar : false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query : {

                    result : [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    user_id : null,

                },
                /** Dados da Seção **/
                session : {

                    user_id          : this.$route.params.user_id,
                    user_function_id : this.$route.params.user_function_id,

                },

            }

        },

        methods : {

            /** Listagem de Classes **/
            List(){

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=USER&ACTION=USER_DATAGRID')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Guardo minha resposta em uma váriavel **/
                        this.query.result = response.data.result;

                        /** Defino um delay no progresso **/
                        window.setTimeout(() => {

                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Exclusão de Classes **/
            Delete(){

                this.form.progress_bar = true;

                /** Evnio uma requisão ao meu servidor pelo método 'Post' **/
                axios.post('router.php?TABLE=USER&ACTION=USER_DELETE', {inputs : this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

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

        created(){

            this.List();
            console.log('Componente "UsersDatagrid", montado com sucesso!')

        },

    }

</script>
