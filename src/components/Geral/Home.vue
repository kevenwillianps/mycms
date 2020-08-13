<template>

    <div>

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="media">

                    <img src="image/svg/042-homepage.svg" width="70px" class="align-self-center mr-3" alt="MyCMS - Keven Willian">

                    <div class="media-body">

                        <h3 class="mt-0">

                            Seja Bem Vindo {{ session.user_name }}!

                        </h3>

                        <p class="card-text text-muted">

                            Os CMS´s (Content Management System – Sistema de Gerenciamento de Conteúdo) são, em grande parte, softwares livres, desenvolvido por programadores do mundo inteiro, onde o usuário pode editar e criar conteúdo para seus sites com grande facilidade. Acessado diretamente pelo navegador, possui uma linguagem visual pratica e intuitiva.

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="card shadow-sm mt-3">

            <div class="card-body">

                <Bar v-bind:labels="chart_content.labels" v-bind:label="chart_content.label" v-bind:background-color="chart_content.background_color" v-bind:data="chart_content.data"/>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';
    import Bar from "./Charts/Bar";

    export default {

        name: "Home",

        components : {

            Bar,

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

                    label : 'Conteúdo Principal',
                    labels : [],
                    background_color : '#f87979',
                    data : [],

                }

            }

        },

        methods : {

            /** Listagem de Classes **/
            ListContent() {

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

                                /** Monto os dados do gráfico */
                                for (let i = 0; i < response.data.result.length; i++){

                                    this.chart_content.labels.push(response.data.result[i].title);
                                    this.chart_content.data.push(response.data.result[i].content_visited);

                                }
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
            this.GetSession();

        }

    }
</script>