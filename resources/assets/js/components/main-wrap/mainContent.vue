<template lang="jade">

.main-content
    input.note-title(name="note-title", type="text", v-model="currentNote.title", v-el:title-input, @input="saveNote")

    .note-editor-wrap
        textarea.note-editor(name="note-text", v-model="currentNote.content", v-el:content-input, @input="saveNote")


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
import event from '../../eventbus';

var updateTimeout = 0;

export default {
    props: {
        currentNote: {
            twoWay: true
        }
    },

    ready() {
        event.on('make-new-note', () => {
           this.$els.titleInput.focus();
        });
    },

    methods: {
        saveNote() {
            if (this.currentNote.content.length <= 0) {
                return;
            }

            clearTimeout(updateTimeout);

            updateTimeout = setTimeout(() => {
                if (this.currentNote.id !== null) {
                    this.$dispatch('note-changed');
                } else {
                    this.$dispatch('save-new-note');
                }
            }, 1000);
        }
    }
}

</script>