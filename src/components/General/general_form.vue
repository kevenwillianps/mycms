<template>

    <div>

        <h4>

            <i class="fas fa-cogs"></i> Configuração

        </h4>

        <!-- Exibe a barra de progresso quando for verdadeiro-->
        <div class="animate animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div class="card shadow-sm animate animate__fadeIn" v-else>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Título" v-model="inputs.title">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Descrição" v-model="inputs.description">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Copyright" v-model="inputs.copyright">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="CNPJ" v-model="inputs.cnpj">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="URL" v-model="inputs.url">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Palavra Chave" v-model="inputs.keywords">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Autor" v-model="inputs.author">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Email" v-model="inputs.email">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="smtp" v-model="inputs.smtp">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="port" v-model="inputs.port">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Senha" v-model="inputs.password">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Dominio" v-model="inputs.domain">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="charset" v-model="inputs.charsert">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Usuário" v-model="inputs.username">

                        </div>

                    </div>

                    <div class="col-md-2">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Sessão" v-model="inputs.session">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Número de Registros" v-model="inputs.number_register">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Endereço" v-model="inputs.address">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Telefone" v-model="inputs.telefone">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Celular" v-model="inputs.celular">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Facebook" v-model="inputs.facebook">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Instagram" v-model="inputs.instagram">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Pinterest" v-model="inputs.pinterest">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Twitter" v-model="inputs.twitter">

                        </div>

                    </div>

                    <div class="col-md-12 text-right">

                        <div class="form-group">

                            <button class="btn btn-default" v-on:click="Save()">

                                <i class="fas fa-paper-plane mr-1"></i>Salvar

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    import axios    from 'axios';
    import Progress from '../Geral/Progress'

    export default {

        components : {

            Progress

        },

        data(){

            return {

                form : {

                    progress_bar : false,

                },
                query : {

                    result : [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs : {

                    general_id : null,
                    user_id : null,
                    title : null,
                    description : null,
                    keywords : null,
                    copyright : null,
                    author : null,
                    url : null,
                    email : null,
                    smtp : null,
                    port : null,
                    password : null,
                    domain : null,
                    charsert : null,
                    username : null,
                    session : null,
                    number_register : null,
                    cnpj : null,
                    endereco : null,
                    telefone : null,
                    celular : null,
                    facebook : null,
                    instagram : null,
                    pinterest : null,
                    twitter : null,
                    date_register : null,
                    date_update : null,

                },

                /** Dados da Seção **/
                session : {

                    user_id : this.$route.params.user_id,
                    user_function_id : this.$route.params.user_function_id,

                },

            }

        },

        name: "GeneralForm",

        methods : {

            /** Salvo minhas informações **/
            Save(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=GENERAL&ACTION=GENERAL_SAVE', {inputs: this.inputs})

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod){

                            case 1:

                                /** Redireciono para página principal **/
                                this.$router.replace({ name : 'content-datagrid', params : { user_id : this.session.user_id, user_function_id : this.session.user_function_id}});
                                break;

                            default:

                                this.form.progress_bar = false;
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    });

            },

            /** Salvo minhas informações **/
            Form(){

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=GENERAL&ACTION=GENERAL_FORM')

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Preencho os campos do formulário **/
                        this.inputs = response.data.result;

                        window.setTimeout(() => {

                            /** Habilito minha barra de progresso **/
                            this.form.progress_bar = false;

                        }, 1000);

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    });

            },

        },

        mounted (){

            this.Form();
            console.log('Componente "GeneralForm", montado com sucesso!');

        }

    }

</script>