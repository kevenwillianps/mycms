<template>

  <div id="app">

      <div class="container mt-3 animate animate__fadeIn" v-if="form.progress_bar">

          <div class="card shadow-sm">

              <div class="card-body">

                  <Progress percent="100"></Progress>

              </div>

          </div>

      </div>

      <div v-else-if="session.user_name">

          <div class="wrapper">

              <nav id="sidebar" class="shadow-sm">

                  <div class="sidebar-header text-center">

                      <h3 class="mb-0">

                          MyCMS

                      </h3>

                  </div>

                  <ul class="list-unstyled components">

                      <li>

                          <router-link v-bind:to="{name : 'content-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                              <i class="far fa-folder-open mr-1" title="Conteúdo"></i> Conteúdo

                          </router-link>

                      </li>

                      <li>

                          <router-link v-bind:to="{name : 'users-details', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                              <i class="fas fa-user-circle mr-1"></i> Perfil

                          </router-link>

                      </li>

                      <li class="active" v-if="session.user_function_id == 1">

                          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                              <i class="fas fa-cog mr-1"></i>Configurações

                          </a>

                          <ul class="collapse list-unstyled" id="homeSubmenu">

                              <li>

                                  <router-link v-bind:to="{name : 'general-form', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-cogs mr-1"></i> Geral

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'users-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-users mr-1"></i> Usuários

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'user-function-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-user-tie mr-1"></i> Funções

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'content-category-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-layer-group mr-1"></i> Categoria

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'situation-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-exclamation mr-1"></i> Situações

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'highlighter-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-check mr-1"></i> Marcadores

                                  </router-link>

                              </li>

                              <li>

                                  <router-link v-bind:to="{name : 'highlighter-file-datagrid', params : {user_id : session.user_id, user_function_id : session.user_function_id}}">

                                      <i class="fas fa-check mr-1"></i> Marcadores de Arquivos

                                  </router-link>

                              </li>

                          </ul>

                      </li>

                      <li>

                          <router-link to="/">

                              <i class="fas fa-info-circle mr-1"></i>Informações

                          </router-link>

                      </li>

                  </ul>

                  <ul class="list-unstyled CTAs">

                      <li>

                          <a type="button" class="article" v-on:click="DestroySession()">

                              <i class="fas fa-power-off mr-1"></i>Sair

                          </a>

                      </li>

                  </ul>

              </nav>

              <!-- Page Content  -->
              <div id="content">

                  <router-view></router-view>

              </div>

          </div>

      </div>

      <div v-else>

          <Login></Login>

      </div>

  </div>

</template>

<script type="text/ecmascript-6">

    /** Importação de componentes **/
    import axios from 'axios'
    import Login from './components/Geral/Login'
    import Progress from './components/Geral/Progress';

    export default {

        name: 'App',

        /** Declaração de componentes **/
        components: {

            Login,
            Progress,

        },

        data() {

            return {

                form: {

                    progress_bar: false,
                    show_form: false,

                },
                session: [],
                progress: {

                    show: true,

                },
                inputs: {

                    search: null,

                },
                query: {

                    result: {

                        content: [],
                        content_sub: [],

                    }

                }

            }

        },

        methods: {

            /** Encerro a sessão do usuário **/
            DestroySession() {

                /** Habilito minha barra de progresso **/
                this.form.progress_bar = true;

                axios.post('router.php?TABLE=USER&ACTION=USER_DESTROY_SESSION')

                    .then(response => {

                        location.reload();
                        console.log(response);

                    })

                    .catch(response => {

                        console.log(response.data)

                    });

            },

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

        /** Métodos executados quando o componente é montado **/
        mounted() {

            this.GetSession();

            /** Informo que o componente foi motando **/
            console.log('Componente "App", montado com sucesso')

        }

    }

</script>
