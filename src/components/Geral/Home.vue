<template>

    <div class="col-md-12 mt-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="media">

                    <img src="image/svg/042-homepage.svg" width="70px" class="align-self-center mr-3" alt="MyCMS - Keven Willian">

                    <div class="media-body">

                        <h4 class="mt-0">

                            Seja Bem Vindo <span class="badge badge-primary">{{ session.user_name }}</span>!

                        </h4>

                        <p class="card-text text-muted">

                            Os CMS´s (Content Management System – Sistema de Gerenciamento de Conteúdo) são, em grande parte, softwares livres, desenvolvido por programadores do mundo inteiro, onde o usuário pode editar e criar conteúdo para seus sites com grande facilidade. Acessado diretamente pelo navegador, possui uma linguagem visual pratica e intuitiva.

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-3">

                <div class="card shadow-sm mt-3">

                    <div class="card-body">

                        <h4 class="card-title">

                            Conteúdo Principal

                        </h4>

                        <Bar v-if="chart_content_loaded" v-bind:label-p="chart_content.label" v-bind:labels-p="chart_content.labels" v-bind:background-color="chart_content.background_color" v-bind:data-p="chart_content.data"/>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm mt-3">

                    <div class="card-body">

                        <h4 class="card-title">

                            Conteúdo Principal

                        </h4>

                        <Pie v-if="chart_content_loaded" v-bind:labels-p="chart_content.labels" v-bind:background-color="chart_content.background_color" v-bind:data-p="chart_content.data"/>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm mt-3">

                    <div class="card-body">

                        <h4 class="card-title">

                            Sub-Conteúdo

                        </h4>

                        <Bar v-if="chart_content_sub_loaded" v-bind:label-p="chart_sub_content.label" v-bind:labels-p="chart_sub_content.labels" v-bind:background-color="chart_sub_content.background_color" v-bind:data-p="chart_sub_content.data"/>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow-sm mt-3">

                    <div class="card-body">

                        <h4 class="card-title">

                            Sub-Conteúdo

                        </h4>

                        <Pie v-if="chart_content_sub_loaded" v-bind:labels-p="chart_sub_content.labels" v-bind:background-color="chart_sub_content.background_color" v-bind:data-p="chart_sub_content.data"/>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';
    import Bar from "./Charts/Bar";
    import Pie from "./Charts/Pie";

    export default {

        name: "Home",

        components : {

            Bar,
            Pie,

        },

        data(){

            return {

                session: [],

                query : {

                    result : {

                        content : []

                    }

                },

                chart_content : {

                    label : null,
                    labels : [],
                    background_color : [],
                    data : [],

                },

                chart_sub_content : {

                    label : null,
                    labels : [],
                    background_color : [],
                    data : [],

                },

                chart_content_loaded : false,
                chart_content_sub_loaded : false,

            }

        },

        methods : {

            /** Listagem de Classes **/
            ListContent() {

                this.chart_content_loaded = false;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT&ACTION=CONTENT_DATAGRID')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        switch (response.data.cod)
                        {

                            case 404:

                                /** Recarrego a página **/
                                location.reload();
                                break;

                            default:

                                this.chart_content.label = 'Conteúdo Principal';

                                for (let i = 0; i < response.data.result.length; i++){

                                    this.chart_content.labels[i] = response.data.result[i].title;
                                    this.chart_content.data[i] = parseInt(response.data.result[i].content_visited);

                                    let n = (Math.random() * 0xfffff * 1000000).toString(16);
                                    this.chart_content.background_color[i] = '#' + n.slice(0, 6);

                                }
                                this.chart_content_loaded = true;
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Listagem de Classes **/
            ListContentSub() {

                this.chart_content_sub_loaded = false;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_CHART')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        switch (response.data.cod)
                        {

                            case 404:

                                /** Recarrego a página **/
                                location.reload();
                                break;

                            default:

                                this.chart_sub_content.label = 'Sub-Conteúdo';

                                for (let i = 0; i < response.data.result.length; i++){

                                    this.chart_sub_content.labels[i] = response.data.result[i].title;
                                    this.chart_sub_content.data[i] = parseInt(response.data.result[i].content_sub_visited);

                                    let n = (Math.random() * 0xfffff * 1000000).toString(16);
                                    this.chart_sub_content.background_color[i] = '#' + n.slice(0, 6);

                                }
                                this.chart_content_sub_loaded = true;
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Crio a sessão do usuário **/
            GetSession() {

                axios.post('router.php?TABLE=USER&ACTION=USER_GET_SESSION')

                    .then(response => {

                        /** Desabilito minha barra de progresso **/
                        this.session = response.data.result;

                    })

                    .catch(response => {

                        console.log(response.data)

                    });

            },

        },

        mounted(){

            this.ListContent();
            this.ListContentSub();
            this.GetSession();

        }

    }
</script>