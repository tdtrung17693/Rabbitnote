<template lang="jade">

.container-fluid.main-wrap
    sidebar(:current-note.sync='currentNote')
    main-content(:current-note.sync='currentNote')

</template>

<script>
import sidebar from './sidebar.vue';
import mainContent from './mainContent.vue';

export default {
    props: {
        currentNote: {
            twoWay: true
        }
    },

    components: { sidebar, mainContent }
}

</script>