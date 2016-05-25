<template lang="jade">

.main-content
    tag-editor
    input.note-title.note-input(name="note-title", type="text", v-model="currentNote.title", v-el:title-input, @input="saveNote", placeholder="Title...")

    .note-editor-wrap
        textarea.note-editor(name="note-text", v-model="currentNote.content", v-el:content-input, @input="saveNote", placeholder="Content...")


</template>

<style>

.note-input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #CCC;
    outline: none;
}

.note-tag {
    padding: 0px 20px;
    font-size: 14px;
}

.note-title {
    padding: 10px 20px;
    font-size: 25px;
}

.note-editor-wrap {
    width: 100%;
    height: auto;
    position: absolute;
    top: 100px;
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
import event from '../../eventbus';
import TagEditor from '../tag-editor/TagEditor.vue';

var updateTimeout = 0;

export default {
    components: { TagEditor },
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
                    this.$dispatch('note:changed');
                } else {
                    this.$dispatch('save-new-note');
                }
            }, 1000);
        }
    }
}

</script>
