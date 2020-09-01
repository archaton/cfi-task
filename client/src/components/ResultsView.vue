<template>
    <v-row justify="center">
        <v-col cols="12" md="6">
            <v-btn
                to="/"
                tag="button"
                class="m-1"
                variant="secondary"
                @click="$router.push({name: 'Home'})"
            >
                Submit another text
            </v-btn>
            <span>You submitted text:</span>
            <v-textarea
                solo
                disabled
                :value="$root.$data.sharedState.getCurrentUserSubmittedText()"
            />
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
                            <td>{{ showStars(index) }}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-col>
    </v-row>
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
        showStars(index) {
            if (index > 2) {
                return '-';
            }
            return '*'.repeat(3 - index);
        },
    },
}
</script>

<style scoped>

</style>
