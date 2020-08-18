<template>

    <div>

        <nav class="navbar navbar-expand-lg navbar-light bg-default mb-0">

            <div class="navbar-brand">

                <i class="far fa-folder-open mr-1"></i>Conteúdo Principal/Sub Conteúdo/<span class="ml-1 badge badge-primary">Formulário</span>

            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#method_navbar_header" aria-controls="method_navbar_header" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="method_navbar_header">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">

                        <router-link v-bind:to="{name : 'content-sub-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id, content_id : inputs.content_id}}" class="nav-link">

                            <i class="fas fa-bars mr-1"></i>Listagem

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

            <div v-else>

                <div class="card card-default shadow-sm animate__animated animate__fadeIn border-dashed mb-2" v-if="query.error.length > 0">

                    <div class="card-body">

                        <div class="media">

                            <img src="image/svg/007-blocked.svg" width="50px" class="align-self-center mr-3" alt="MyCMS - Keven Willian">

                            <div class="media-body">

                                <h4 class="mt-0 mb-2 card-title">

                                    Ops! Alguns erros foram encontrados...

                                </h4>

                                <h6 class="card-subtitle text-muted">

                                    Verifique os itens para poder prosseguir

                                </h6>

                            </div>

                        </div>

                        <hr>

                        <ul class="list-unstyled">

                            <li class="media" v-for="(result, index) in query.error" v-bind:key="index">

                                <div class="media-body">

                                    <p class="card-text">

                                        {{ result }}

                                    </p>

                                </div>

                            </li>

                        </ul>

                    </div>

                </div>

                <div class="card shadow-sm animate__animated animate__fadeIn border-dashed">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-12 animate__animated animate__fadeIn">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="URL" v-model="inputs.url">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 animate__animated animate__fadeIn">

                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Título" v-model="inputs.title">

                                        </div>

                                    </div>

                                    <div class="col-md-4 animate__animated animate__fadeIn">

                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Título do Menu" v-model="inputs.title_menu">

                                        </div>

                                    </div>

                                    <div class="col-md-4 animate__animated animate__fadeIn">

                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Descrição" v-model="inputs.description">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 animate__animated animate__fadeIn">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Conteúdo Resumido" v-model="inputs.content_resume">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 animate__animated animate__fadeIn">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <ckeditor v-bind:editor="editor" v-model="inputs.content_complete" v-bind:config="editorConfig"></ckeditor>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 animate__animated animate__fadeIn">

                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="Position">

                                                Posição

                                            </label>
                                            <input type="number" class="form-control" placeholder="Posição" v-model="inputs.menu_position" id="Position">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="situation_id">

                                                Situação

                                            </label>

                                            <select class="custom-select" v-model="inputs.situation_id" id="situation_id">

                                                <option v-bind:value="result.situation_id" v-for="(result, index) in query.result_situations" v-bind:key="index">

                                                    {{ result.name }}

                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="highlighter_id">

                                                Marcador

                                            </label>

                                            <select class="custom-select" v-model="inputs.highlighter_id" id="highlighter_id">

                                                <option v-bind:value="result.highlighter_id" v-for="(result, index) in query.result_highlighters" v-bind:key="index">

                                                    {{ result.description }}

                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="StarDate">

                                                Data de Inicio do Conteúdo

                                            </label>

                                            <input type="date" class="form-control" v-model="inputs.start_date" id="StarDate">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="StartClosing">

                                                Data de Encerramento do Conteúdo

                                            </label>

                                            <input type="date" class="form-control" v-model="inputs.closing_date" id="StartClosing">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 animate__animated animate__fadeIn">

                                <div class="form-group">

                                    <div class="border-dashed-default rounded">

                                        <div class="file-drop-area" v-if="!inputs_file.file">

                                    <span class="fake-btn mr-3">

                                        Escolha seus arquivos

                                    </span>

                                            <span class="file-msg">

                                        Arraste seus arquivos e solte até aqui para carregalos

                                    </span>

                                            <input class="file-input" type="file" multiple v-on:change="onChange">

                                        </div>

                                        <div v-else>

                                            <div class="media">

                                                <div class="media-body p-3">

                                                    <h3 class="mt-0">

                                                        {{ inputs_file.name }}

                                                    </h3>

                                                    <button class="btn btn-primary" v-on:click="ResetFormFile()">

                                                        <i class="fas fa-eraser mr-1"></i> Remover Arquivo

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 animate__animated animate__fadeIn" v-if="inputs_file.name.length > 0">

                                <div class="form-group">

                                    <table class="table table-bordered table-borderless border-dashed-table rounded shadow-sm">

                                        <thead>

                                        <tr>

                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col">Posição</th>
                                            <th scope="col">Marcador</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col" class="text-center">Operações</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                        <tr v-for="(result, index) in inputs_file.name_auxiliary" v-bind:key="index" class="border-top-dashed-table">

                                            <th scope="row" class="text-center">

                                                {{ index }}

                                            </th>

                                            <th>

                                                <div class="form-group">

                                                    <input type="number" class="form-control" v-model="inputs_file.position[index]"/>

                                                </div>

                                            </th>

                                            <th>

                                                <div class="form-group">

                                                    <select class="custom-select" v-model="inputs_file.highlighter_file_id[index]">

                                                        <option v-bind:value="result.highlighter_file_id" v-for="(result, index_select) in query.result_highlighters_file" v-bind:key="index_select">

                                                            {{ result.description }}

                                                        </option>

                                                    </select>

                                                </div>

                                            </th>

                                            <td>

                                                {{ result }}

                                            </td>

                                            <td class="text-center">

                                                <button class="btn btn-danger" v-on:click="RemoveFile(index)">

                                                    <i class="fas fa-fire-alt mr-1"></i>

                                                </button>

                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="col-md-12 text-right">

                                <button class="btn btn-primary" v-on:click="Save()">

                                    <i class="fas fa-paper-plane"></i> Salvar

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios';
    import Progress from '../Geral/Progress'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {

        name: "ContentSubForm",

        components: {

            Progress,

        },

        data() {

            return {

                editor: ClassicEditor,
                editorConfig: {},
                form: {

                    progress_bar: false,

                },
                /** Grupo de variáveis que guarda os dados de consultas sql's **/
                query: {

                    result: [],
                    error: [],
                    message: null,
                    result_situations: [],
                    result_highlighters: [],
                    result_highlighters_file: [],

                },
                /** Grupo de variáveis que guardar os dados dos campos do formulário **/
                inputs: {

                    content_sub_id: this.$route.params.content_sub_id,
                    content_id: this.$route.params.content_id,
                    content_sub_auxiliary_id: null,
                    situation_id: null,
                    menu_position: null,
                    highlighter_id: null,
                    url: null,
                    title: null,
                    title_menu: null,
                    description: null,
                    start_date: null,
                    closing_date: null,
                    content_resume: null,
                    content_complete: null,

                },
                /** Grupo de variáveis que guardar os dados dos campos do arquivo **/
                inputs_file: {

                    name_auxiliary: [],
                    position: [],
                    highlighter_file_id: [],
                    name: [],
                    part: [],
                    length: [],
                    extension: [],

                },
                /** Dados da Seção **/
                session: {

                    user_id: this.$route.params.user_id,
                    user_function_id: this.$route.params.user_function_id,

                },

            }

        },

        methods: {

            /** Adiciono ou removo um elemento da array **/
            RemoveFile(index) {

                /** Removo o elemento da array **/
                this.inputs_file.name.splice(index, 1);
                this.inputs_file.part.splice(index, 1);
                this.inputs_file.length.splice(index, 1);
                this.inputs_file.extension.splice(index, 1);

            },

            /** Listagem de 'Situações' **/
            ListSituations() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=SITUATION&ACTION=SITUATION_DATAGRID', )

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 404:

                                location.reload();
                                break;

                            default:

                                /** Guardo minha resposta em uma váriavel **/
                                this.query.result_situations = response.data.result;

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

            /** Listagem de 'Marcadores' **/
            ListHighlighters() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=HIGHLIGHTER&ACTION=HIGHLIGHTER_DATAGRID', )

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 404:

                                location.reload();
                                break;

                            default:

                                /** Guardo minha resposta em uma váriavel **/
                                this.query.result_highlighters = response.data.result;

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

            /** Listagem de 'Marcadores' **/
            ListHighlightersFile() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=HIGHLIGHTER_FILE&ACTION=HIGHLIGHTER_FILE_DATAGRID', )

                    /** Caso tenha sucesso **/
                    .then(response => {

                        switch (response.data.cod){

                            case 404:

                                location.reload();
                                break;

                            default :

                                /** Guardo minha resposta em uma váriavel **/
                                this.query.result_highlighters_file = response.data.result;

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

            /** Busco o 'Conteúdo' **/
            Form() {

                /** Deixo a barra de progresso disponivel **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao meu backend **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_EDIT_FORM', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 404:

                                location.reload();
                                break;

                            default:

                                /** Guardo minha resposta em uma váriavel **/
                                this.inputs = response.data.result;

                                /** Defino um delay no progresso **/
                                setTimeout(() => {

                                    this.form.progress_bar = false;
                                    this.form.show_form = true;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro:' + response);

                    });

            },

            /** Salvo minhas informações **/
            Save() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                /** Envio uma requisição ao servidor **/
                axios.post('router.php?TABLE=CONTENT_SUB&ACTION=CONTENT_SUB_SAVE', {
                    inputs: this.inputs
                })

                    /** Caso tenha sucesso **/
                    .then(response => {

                        /** Verifico a categoria do meu retorno **/
                        switch (response.data.cod) {

                            case 0:

                                this.query.error = response.data.result;
                                this.form.progress_bar = false;
                                break;

                            case 1:

                                window.setTimeout(() => {

                                    /** Verifico se tem arquivos para envio **/
                                    if (this.inputs_file.part.length > 0) {

                                        this.inputs.content_sub_id = response.data.content_sub_id;

                                        /** Realizdo o envio dos arquivos **/
                                        this.PrepareForm();

                                    } else {

                                        /** Retorno para uma página especifica **/
                                        this.$router.replace({
                                            name: 'content-sub-datagrid',
                                            params: {
                                                user_id: this.session.user_id,
                                                user_function_id: this.session.user_function_id,
                                                content_id: this.inputs.content_id
                                            }
                                        });

                                    }

                                }, 1000);
                                break;

                            case 404:

                                location.reload();
                                break;

                            default:

                                window.setTimeout(() => {

                                    this.form.progress_bar = false;

                                }, 1000);
                                break;

                        }

                    })

                    /** Caso tenha falha **/
                    .catch(response => {

                        console.log('Erro' + response);

                    });

            },

            /** Preparo o formulário para envio **/
            async PrepareForm() {

                /** Envio as requisições de acordo com o tamanho da array **/
                for (let i = 0; i < this.inputs_file.part.length; i++) {

                    for (let j = 0; j < this.inputs_file.part[i].length; j++) {

                        await this.SendForm(this.inputs.content_sub_id, this.inputs.situation_id, this.inputs_file.position[i], this.inputs_file.highlighter_file_id[i], this.inputs_file.name[i], j, this.inputs_file.part[i][j], this.inputs_file.part[i].length, this.inputs_file.extension[i])

                    }

                }

                this.$router.replace({
                    name: 'content-sub-datagrid',
                    params: {
                        user_id: this.session.user_id,
                        user_function_id: this.session.user_function_id,
                        content_sub_id: this.inputs.content_sub_id
                    }
                });

            },

            /** Envio uma requisição para o servidor **/
            SendForm: async(content_sub_id, situation_id, position, highlighter_file_id, name, pointer, part, length, extension) => {

                return axios.post('router.php?TABLE=CONTENT_SUB_FILE&ACTION=CONTENT_SUB_FILE_SAVE', {
                    inputs: {
                        content_sub_id: content_sub_id,
                        position: position,
                        situation_id: situation_id,
                        highlighter_file_id: highlighter_file_id,
                        name: name,
                        pointer: pointer,
                        part: part,
                        length: length,
                        extension: extension
                    }
                });

            },

            onChange(e) {

                /** Preparo o envio de múltiplos arquivos **/
                for (let i = 0; i < e.target.files.length; i++) {

                    /** Instâncimento de objeto para ler o conteúdo do arquivo ***/
                    let fileReader = new FileReader();

                    /** Leio o conteúdo do arquivo **/
                    fileReader.readAsDataURL(e.target.files[i]);

                    /** Pego o nome real do arquivo **/
                    this.inputs_file.name_auxiliary.push(e.target.files[i].name);

                    /** Gero o nome que vai salvar no banco de dados **/
                    this.inputs_file.name.push('mycms_' + (btoa(Math.random())) + '.' + (e.target.files[i].name.substring(e.target.files[i].name.indexOf(".") + 1)));

                    /** Pego o tipo do arquivo **/
                    this.inputs_file.extension.push(e.target.files[i].type);

                    fileReader.onload = (e) => {

                        /** Particionar o base64 em Array **/
                        let localString = e.target.result.split(',')[1];
                        let start = 0;
                        let end = 2097152;
                        let localArray = Array();
                        let part = null;

                        /** Executo de acordo com o tamanho do base64 **/
                        for (let i = 0; i < localString.length; i++) {

                            /** Preencho selecionando o que esta entre o valor inicial e final **/
                            part = localString.substring(start, end);

                            /** Verifico se cheguei ao final do base64, senão preencho as variáveis **/
                            if (part && part !== null) {

                                /** Coloca o trecho do base64 na última posição da array **/
                                localArray.push(part);

                                /** Crio um novo intervalo de valores **/
                                start = end;
                                end = end + 2097152;

                            }

                        }

                        /** Informo minha array de base64 particionada **/
                        this.inputs_file.part[i] = localArray;

                        /** Informo tamnho da minha array **/
                        this.inputs_file.length.push(localArray.length);

                    };

                }

            },

        },

        mounted() {

            /** Listo os marcadores **/
            this.ListSituations();
            /** Listo as situações **/
            this.ListHighlighters();
            /** Listo os Marcadores para Arquivos **/
            this.ListHighlightersFile();
            /** Verifico se o relatório esta em edição **/
            if (this.$route.params.content_sub_id > 0) {

                this.Form();

            }
            console.log('Componente "ContentSubForm", montado com sucesso');

        }

    }

</script>