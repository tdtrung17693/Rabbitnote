<template lang="jade">

div.overlay(v-show="waiting", style="position: fixed; background-color: #1F3240; width: 100%; height: 100%;z-index: 1000;")
    div.loader
    
div.app(v-show="authenticated") 
    navigation(:notes.sync="notes", :current-note.sync="currentNote")

    main-wrap(:current-note.sync="currentNote")

div.login(v-else)
    login-form 

</template>

<style lang="sass">
    .loader,
    .loader:before,
    .loader:after {
      background: #ffffff;
      -webkit-animation: load1 1s infinite ease-in-out;
      animation: load1 1s infinite ease-in-out;
      width: 1em;
      height: 4em;
    }
    .loader:before,
    .loader:after {
      position: absolute;
      top: 0;
      content: '';
    }
    .loader:before {
      left: -1.5em;
      -webkit-animation-delay: -0.32s;
      animation-delay: -0.32s;
    }
    .loader {
      color: #ffffff;
      text-indent: -9999em;
      margin: auto;
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      font-size: 11px;
      -webkit-transform: translateZ(0);
      -ms-transform: translateZ(0);
      transform: translateZ(0);
      -webkit-animation-delay: -0.16s;
      animation-delay: -0.16s;
    }
    .loader:after {
      left: 1.5em;
    }
    @-webkit-keyframes load1 {
      0%,
      80%,
      100% {
        box-shadow: 0 0;
        height: 4em;
      }
      40% {
        box-shadow: 0 -2em;
        height: 5em;
      }
    }
    @keyframes load1 {
      0%,
      80%,
      100% {
        box-shadow: 0 0;
        height: 4em;
      }
      40% {
        box-shadow: 0 -2em;
        height: 5em;
      }
    }
</style>

<script>

import Vue from 'vue';
import Storage from 'localforage';
import navigation from './components/navigation/navigation.vue';
import mainWrap from './components/main-wrap/index.vue';
import store from './store';
import loginForm from './components/login/index.vue';

export default {
    replace: false,
    components: { navigation, mainWrap, loginForm },

    ready() {
        let token = '';

        Storage.getItem('token')
            .then(t => {

                if (t !== null) {
                    this.authenticated = true;

                    store.init()
                         .then((response) => {
                            this.currentNote = store.state.notes[0];
                         })
                         .catch(() => {
                            this.authenticated = false;
                         });
                }
            })
            .catch(() => {
                console.error('Get storage item failed');
            })
            .then(() => {
                this.waiting = false;
            });
    },

    data() {
        return {
            currentNote: {
                id: '',
                title: '',
                content: ''
            },
            authenticated: false,
            waiting: true
        }
    },

    events: {
        'user:loggedin': function (token) {
            this.authenticated = true;

            Vue.http.headers.common.Authorization = `Bearer ${token}`;

            this.waiting = true;

            store.init()
                 .then((response) => {
                    this.currentNote = store.state.notes[0];
                 })
                 .catch(() => {
                    this.authenticated = false;
                 })
                 .then(() => {
                    this.waiting = false;
                 });
        },
        'user:logout': function () {
            
            Vue.http
                .delete('auth')
                .then(response => {
                    Storage
                        .removeItem('token')
                        .then(() => {
                            this.authenticated = false;
                        })
                        .catch(() => {
                            console.error('Storage error');
                        });        
                })
                .catch(() => {
                    alert('Logout failed');
                });
            
        },
        'note:saved': function () {
            this.getAllNotes();
        },
        'note:changed': function () {
            store.update(this.currentNote.id, this.currentNote);
        },
        'note:new': function () {
            this.$http
                .post('/api/notes', this.currentNote)
                .then((response) => {
                    this.getAllNotes();
                });
        }
    },

    methods: {
        getAllNotes: function () {
            store.getAll()
                 .then((response) => {
                    this.notes = response.data.data;
                    
                    this.currentNote = this.notes[0] ? this.notes[0] : this.currentNote;

                    this.currentNote = (this.currentNote.title.length > 0) ? this.currentNote : response.data[0];
                });
        },
        init() {
            store.init()
                 .then((response) => {
                    this.currentNote = store.state.notes[0];
                 })
                 .catch(() => {
                    this.authenticated = false;
                 });
        }
    }
}

</script>