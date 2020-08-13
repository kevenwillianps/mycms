<template>

    <div>

        <h4>

            <i class="fas fa-cogs"></i> Configuração

        </h4>

        <!-- Exibe a barra de progresso quando for verdadeiro-->
        <div class="animate__animated animate__fadeIn" v-if="form.progress_bar">

            <div class="card shadow-sm">

                <div class="card-body">

                    <Progress percent="100"></Progress>

                </div>

            </div>

        </div>

        <div class="card shadow-sm animate__animated animate__fadeIn" v-else>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="title">

                                Título

                            </label>

                            <input type="text" class="form-control" placeholder="Título" id="title" v-model="inputs.title">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="description">

                                Descrição

                            </label>

                            <input type="text" class="form-control" placeholder="Descrição" id="description" v-model="inputs.description">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="copyright">

                                Copyright

                            </label>

                            <input type="text" class="form-control" placeholder="Copyright" id="copyright" v-model="inputs.copyright">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="cnpj">

                                CNPJ

                            </label>

                            <input type="text" class="form-control" placeholder="CNPJ" id="cnpj" v-model="inputs.cnpj">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="url">

                                URL

                            </label>

                            <input type="text" class="form-control" placeholder="URL" id="url" v-model="inputs.url">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="keywords">

                                Palavra Chave

                            </label>

                            <input type="text" class="form-control" placeholder="Palavra Chave" id="keywords" v-model="inputs.keywords">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="author">

                                Autor

                            </label>

                            <input type="text" class="form-control" placeholder="Autor" id="author" v-model="inputs.author">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="email">

                                Email

                            </label>

                            <input type="text" class="form-control" placeholder="Email" id="email" v-model="inputs.email">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="smtp">

                                smtp

                            </label>

                            <input type="text" class="form-control" placeholder="smtp" id="smtp" v-model="inputs.smtp">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="port">

                                port

                            </label>

                            <input type="text" class="form-control" placeholder="port" id="port" v-model="inputs.port">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="password">

                                Senha

                            </label>

                            <input type="text" class="form-control" placeholder="Senha" id="password" v-model="inputs.password">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="domain">

                                Dominio

                            </label>

                            <input type="text" class="form-control" placeholder="Dominio" id="domain" v-model="inputs.domain">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="charsert">

                                charset

                            </label>

                            <input type="text" class="form-control" placeholder="charset" id="charsert" v-model="inputs.charsert">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="username">

                                Usuário

                            </label>

                            <input type="text" class="form-control" placeholder="Usuário" id="username" v-model="inputs.username">

                        </div>

                    </div>

                    <div class="col-md-2">

                        <div class="form-group">

                            <label for="session">

                                Sessão

                            </label>

                            <input type="text" class="form-control" placeholder="Sessão" id="session" v-model="inputs.session">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="number_register">

                                Número de Registros

                            </label>

                            <input type="text" class="form-control" placeholder="Número de Registros" id="number_register" v-model="inputs.number_register">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="address">

                                Endereço

                            </label>

                            <input type="text" class="form-control" placeholder="Endereço" id="address" v-model="inputs.address">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="telefone">

                                Telefone

                            </label>

                            <input type="text" class="form-control" placeholder="Telefone" id="telefone" v-model="inputs.telefone">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="celular">

                                Celular

                            </label>

                            <input type="text" class="form-control" placeholder="Celular" id="celular" v-model="inputs.celular">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="facebook">

                                Facebook

                            </label>

                            <input type="text" class="form-control" placeholder="Facebook" id="facebook" v-model="inputs.facebook">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="instagram">

                                Instagram

                            </label>

                            <input type="text" class="form-control" placeholder="Instagram" id="instagram" v-model="inputs.instagram">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="pinterest">

                                Pinterest

                            </label>

                            <input type="text" class="form-control" placeholder="Pinterest" id="pinterest" v-model="inputs.pinterest">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="twitter">

                                Twitter

                            </label>

                            <input type="text" class="form-control" placeholder="Twitter" id="twitter" v-model="inputs.twitter">

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