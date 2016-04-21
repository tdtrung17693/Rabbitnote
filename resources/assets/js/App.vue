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
                .put('/api/notes/' + this.currentNote.id, this.currentNote)
                .then((response) => {
                    this.getAllNotes();
                });
        },
        'save-new-note': function () {
            this.$http
                .post('/api/notes', this.currentNote)
                .then((response) => {
                    this.getAllNotes();
                });
        }
    },

    methods: {
        getAllNotes: function () {
            this.$http
                .get('/api/notes')
                .then(function (response) {
                    this.notes = response.data;
                    this.currentNote = (this.currentNote.title.length > 0) ? this.currentNote : response.data[0];
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