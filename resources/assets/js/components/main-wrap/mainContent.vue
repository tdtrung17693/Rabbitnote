<template lang="jade">

.main-content
    input.note-title(type="text", v-model="currentNote.title", @input="saveNote")

    .note-editor-wrap
        textarea.note-editor(name="note-text", v-model="currentNote.content", @input="saveNote")


</template>

<style>
.note-title {
    width: 100%;
    padding: 10px 20px;
    border: none;
    border-bottom: 1px solid #CCC;
    outline: none;
    font-size: 25px;
}

.note-editor-wrap {
    width: 100%;
    height: auto;
    position: absolute;
    top: 58px;
    bottom: 0;
}

.note-editor {
    display: block;
    width: 100%;
    height: 100%;
    padding: 20px;
    border: none;
    outline: none;
    resize: none;
}


</style>

<script>
import io from '../../socket';
var updateTimeout = 0;

export default {
    props: {
        currentNote: {
            twoWay: true
        }
    },

    methods: {
        saveNote() {
            clearTimeout(updateTimeout);

            updateTimeout = setTimeout(() => {
                if (this.currentNote.id !== null) {
                    this.$dispatch('note-changed');
                } else {
                    this.$dispatch('create-note');
                }
            }, 700);
        }
    }
}

</script>