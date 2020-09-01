<template>
    <div>
        <router-link to="/">Submit another text</router-link>
        <span>You submitted text:</span>
        <span>{{ $root.$data.sharedState.getCurrentUserSubmittedText() }}</span>
        <v-simple-table v-if="results">
            <template v-slot:default>
                <thead>
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-left">Word</th>
                        <th class="text-left">Count</th>
                        <th class="text-left">Stars</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in results" :key="item.word">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.word }}</td>
                        <td>{{ item.count }}</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ResultsView",
    data () {
      return {
          loading: false,
          results: [],
      };
    },
    async mounted() {
        console.error(this.$root.$data.sharedState.getCurrentUser());
        await this.loadData();
    },
    methods: {
        async loadData() {
            this.loading = true;
            try {
                const {userId} = this.$root.$data.sharedState.getCurrentUser();
                const {data: {items}} = await axios.get(`/api/users/${userId}/text`);
                this.results = items;
            } catch (e) {
                console.error(e);
            }
            this.loading = false;
        },
    },
}
</script>

<style scoped>

</style>
