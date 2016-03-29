<template lang="jade">

navigation(:notes.sync="notes", :current-note.sync="currentNote")

main-wrap(:notes.sync="notes", :current-note.sync="currentNote")

</template>

<script>

import navigation from './components/navigation/navigation.vue';
import mainWrap from './components/main-wrap/index.vue';

export default {
    replace: false,
    components: { navigation, mainWrap },

    ready() {
        this.getAllNotes();
    },

    data() {
        return {
            notes: [],
            currentNote: {
                id: '',
                title: '',
                content: ''
            }
        }
    },

    events: {
        'note_saved': function () {
            this.getAllNotes();
        },
        'note-changed': function () {
            this.$http
                .post('/api/notes', this.currentNote)
                .then((response) => {
                    console.log(response);
                });
        }
    },

    methods: {
        getAllNotes: function () {
            this.$http
                .get('/api/notes')
                .then(function (response) {
                    console.log(response);
                    this.notes = response;
                    this.currentNote = response[0];
                });
        }
    },

    http: {
        root: '/api',
        headers: {
            Authorization: `Bearer ${key}`
        }
    }
}

</script>