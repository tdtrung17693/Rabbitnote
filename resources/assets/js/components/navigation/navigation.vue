<template lang="jade">

nav.navbar.navbar-light.navbar-app
    form.form-inline.pull-md-left(action='')
        input#s.form-control(type='text', name='')
    ul.nav.navbar-nav
        li.nav-item
            a.nav-link(href='#', @click="newNote") New
        li.nav-item
            a.nav-link(href='#', @click="trashNote(currentNote, $event)") Trash
    a.navbar-brand Rabbitnote
    ul.nav.navbar-nav.pull-md-right
        li.nav-item.dropdown
            a.nav-link.dropdown-toggle(href='#', data-toggle='dropdown', role='button', aria-haspopup='true', aria-expanded='false') {{ user.email }}
            .dropdown-menu
                a.dropdown-item Settings 
                a.dropdown-item(@click.prevent="logout") Logout


</template>

<script>
import event from '../../eventbus';
import io from '../../socket';
import store from '../../store';

export default {
    props: {
        currentNote: {
            twoWay: true
        },
        notes: {
            twoWay: true
        }
    },
    data() {
        return {
            user: store.state.user
        }
    },
    methods: {
        newNote: function ($event) {
            $event.preventDefault();

            var note = {
                id: null,
                title: '',
                content: ''
            };

            this.notes.unshift(note);

            this.currentNote = note;

            event.emit('make-new-note');
        },
        
        trashNote: function (note, $event) {
            $event.preventDefault();
        },

        logout() {
            this.$dispatch('user:logout');
        }
    }
}

</script>

<style lang="sass">
@import "../../../sass/partials/_vars";

.navbar-brand svg,
.navbar-brand span {
    display: inline-block;
    vertical-align: middle;
}

.navbar-brand svg { stroke: $logoColor; }
.navbar-app {
    border-bottom: 1px solid $dividerColor;

    form {
        margin-right: 20px;
    }

    .navbar-brand {
        position: absolute;
        left: 50%;
        top: 0;
        margin-left: -48px;
        margin-top: 10px;
    }

    .dropdown-menu {
        left: auto;
        right: 0;
    }
}

</style>
