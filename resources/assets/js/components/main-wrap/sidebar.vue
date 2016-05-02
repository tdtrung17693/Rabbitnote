<template lang="jade">

.sidebar
    ul.list.note-list
        li.note(v-for="note in state.notes", @click="openNote(note)")
            a(href='#')
                | {{ note.title | preview 30 }}
                small.note-excerpt {{ note.content | preview 30 }}

</template>

<style lang="sass">
@import "../../../sass/partials/_vars";

.sidebar {
    width: 350px;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    border-right: 1px solid $dividerColor;
    overflow-y: auto;
}

.note-list {
    padding: 0;
    list-style-type: none;

    .note {
        border-bottom: 1px solid $dividerColor;

        a {
            display: block;
            padding: 20px 15px;
            color: inherit;
            text-decoration: none;

            &:hover {
                background-color: $noteHoverColor;
            }
        }

        .note-excerpt {
            display: block;
            color: $excerptColor;
        }
    }
}

</style>

<script>
import store from '../../store';


export default {
    props: {
        'currentNote': {
            twoWay: true
        }
    },
    data() {
        return {
            state: store.state
        };
    },
    methods: {
        openNote(note) {
            this.currentNote = note;
        }
    },
    filters: {
        preview: function (value, input) {
            var firstLine = value.split('\n').shift();
            var letters = firstLine.length;
            var result = '';

            if (letters > input) {
                result = firstLine.substr(0, input);
                result += '..';
            } else {
                result = firstLine;
            }

            return result;
        }
    }
}

</script>