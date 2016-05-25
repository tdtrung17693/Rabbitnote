<template lang="jade">

div.tag-editor
    ul.tags
        li.tag(v-for="tag in tags", :class="{ selected: tag == selectedTag }")
            | {{ tag.slug }}
            a.tag-remove(@click="close(tag, $event)") &times;
        li.tag.tag-input
            input(type="text", v-model="tagText", @focus="inputFocus()", @blur="inputBlur()", @keyup="keyUp($event)")

</template>

<style lang="sass">
@import "../../../sass/partials/_vars";

.tag-editor {
    border-bottom: 1px solid $dividerColor;
}

.tags {
  display: inline-block;
  padding: 0 5px;
  margin: 0 auto;

  .tag-input {
    background: none;
  }
}

.tag {
  display: inline-block;
  padding: 5px 10px;
  margin-right: 5px;
  background-color: #eee;
  color: darken(#eee, 30);

  & > .tag-remove {
    display: inline-block;
    margin-left: 10px;
  }
}

.tag-input > input {
    display: inline-block;
    padding: 5px 10px;
    margin-left: -10px;
    border: none;
    outline: none;
}

</style>

<script lang="babel">
import Vue from 'vue';

export default {
    ready() {
        if (this.tags.length <= 0) {
            this.tagText = 'Add tag..';
        }
    },

    data() {
        return {
            tags: Vue.TagManager.getTags(),
            tagText: '',
            selectedTag: null
        }
    },

    methods: {
        inputFocus() {
            if (this.tags.length <= 0) {
                this.tagText = '';
            }
        },

        inputBlur() {
            if (this.tagText[0] === ',') {
                this.tagText = '';
            } else {
                Vue.TagManager.addTags(this.tagText);
                this.tagText = '';
            }
        },

        keyUp($event) {
            const keyCode = $event.keyCode;

            if (keyCode === 188) {
                let tagData = this.tagText.substr(0, this.tagText.length - 1);
                Vue.TagManager.addTags(tagData);

                this.tagText = '';
            }

            if (keyCode === 8 && this.tagText === '') {
                this.selectedTag = Vue.TagManager.getTag( Vue.TagManager.total - 1 );
            }
        },

        close(tag, $ev) {
            $ev.preventDefault();

            TagManager.removeTag(tag);
        }
    }
}

</script>