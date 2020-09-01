<template>
    <div>
        <router-link to="/">Submit another text</router-link>
        <span>You submitted text:</span>
        <span>{{ $root.$data.sharedState.getCurrentUserSubmittedText() }}</span>
        <v-simple-table>

        </v-simple-table>
    </div>
</template>

<script>
export default {
    name: "ResultsView",
    async mounted() {
        await this.loadData();
    },
    methods: {
        async loadData() {

        },
    },
}
</script>

<style scoped>

</style>
