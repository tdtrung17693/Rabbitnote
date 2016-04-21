<template lang="jade">

.container-fluid.main-wrap
    sidebar(:notes='notes', :current-note.sync='currentNote')
    main-content(:current-note.sync='currentNote')

</template>

<script>
import sidebar from './sidebar.vue';
import mainContent from './mainContent.vue';

export default {
    props: {
        currentNote: {
            twoWay: true
        },
        notes: {
            twoWay: true
        }
    },

    components: { sidebar, mainContent }
}

</script>