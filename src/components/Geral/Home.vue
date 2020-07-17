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

    </div>

</template>

<script type="text/ecmascript-6">

    import axios from 'axios';

    export default {

        name: "Home",

        data(){

            return {

                session: [],

            }

        },

        methods : {

            /** Crio a sessão do usuário **/
            GetSession() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=USER&ACTION=USER_GET_SESSION')

                    .then(response => {

                        /** Desabilito minha barra de progresso **/
                        this.session = response.data.result;
                        window.setTimeout(() => {

                            /** Habilito minha barra de progresso **/
                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    .catch(response => {

                        console.log(response.data)

                    });

            },

        },

        mounted(){

            this.GetSession();

        }

    }
</script>