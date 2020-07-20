<template>

    <div>

        <h4>

            <i class="far fa-envelope mr-1"></i>Contatos/

            <span class="ml-1 badge badge-primary">

                Listagem

            </span>

        </h4>

        <ModalConfirm title="Atenção!" message="Deseja excluir este registro ?" v-on:ConfirmRequest="Delete"></ModalConfirm>

        <div class="mt-3 animate animate__fadeIn" v-if="form.progress_bar">

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

                                <i class="fas fa-hashtag mr-1"></i>{{ result.contact_id }}

                            </span>

                            <strong> {{ result.name }} </strong>

                        </h4>

                        <h6 class="card-subtitle">

                            <span class="text-muted">

                                {{ result.subject_matter }}

                            </span>

                            -

                            <span class="text-muted">

                                {{ result.date_register }}

                            </span>

                        </h6>

                        <div class="card-text">

                            {{ result.message }}

                        </div>

                    </div>

                    <nav class="navbar navbar-card navbar-expand-lg navbar-light card-footer">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" v-bind:data-target="'#navbar_contact_' + result.contact_id" v-bind:aria-controls="'#navbar_contact_' + result.contact_id" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" v-bind:id="'navbar_contact_' + result.contact_id">

                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item">

                                    <a class="nav-link" type="button" data-toggle="modal" data-target="#myModal" v-on:click="inputs.contact_id = result.contact_id">

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

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';
    import Progress from '../Geral/Progress';
    import ModalConfirm from '../Geral/ModalConfirm';

    export default {

        name: "UsersDatagrid",

        components: {

            Progress,
            ModalConfirm,

        },

        data() {

            return {

                /** Controle do HTML **/
                form: {

                    progress_bar: false,
                    class: null,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    contact_id: null,

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
                axios.post('router.php?TABLE=CONTACTS&ACTION=CONTACTS_DATAGRID')

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
                axios.post('router.php?TABLE=CONTACTS&ACTION=CONTACTS_DELETE', {
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
            console.log('Componente "SituationDatagrid", montado com sucesso!')

        },

    }

</script>
