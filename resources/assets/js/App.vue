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
                title: '',
                content: ''
            }
        }
    },

    events: {
        'note_updated': function () {
            this.getAllNotes();
        }
    },

    methods: {
        getAllNotes: function () {
            this.$http.get('/api/notes', (response) => {
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