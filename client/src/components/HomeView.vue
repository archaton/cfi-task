<template>
    <div>
        <v-alert>Welcome to the Application</v-alert>
        <v-row>
            <v-col cols="12" md="6">
                <v-form
                    class="form-row"
                    @submit.prevent="submit"
                >
                    <v-textarea
                        solo
                        hint="Please enter text"
                        label="Text"
                        v-model="text"
                        rows="5"
                    />
                    <v-btn
                        :disabled="loading"
                        class="m-1"
                        type="submit"
                        variant="primary"
                    >
                        <i
                            :class="loading ? 'fa-spin fa-spinner' : 'fa-check'"
                            class="fas"
                        />
                        Submit
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import axios from 'axios';
import {generateUuid} from "../utils/generateUuid";

export default {
    name: "HomeView",
    data() {
        return {
            loading: false,
            text: null,
        };
    },
    async mounted() {
        const currentUser = this.$root.$data.sharedState.getCurrentUser();
        if (!!currentUser && !!currentUser.userId) {
            return;
        }

        this.loading = true;
        try {
            const userId = generateUuid();
            await axios.post('/api/users', {
                userId,
            });
            this.$root.$data.sharedState.setCurrentUser({userId});
        } catch (e) {
            console.error(e);
            const userId = e.response.headers['x-user-id'];
            this.$root.$data.sharedState.setCurrentUser({userId});
        }
        this.$root.$data.sharedState.clearCurrentUserSubmittedText();
        this.loading = false;
    },
    methods: {
        async submit() {
            this.loading = true;
            try {
                const {userId} = this.$root.$data.sharedState.getCurrentUser();
                await axios.post(`/api/users/${userId}/text`, {text: this.text});
                this.$root.$data.sharedState.setCurrentUserSubmittedText(this.text);
                this.$router.push({name: 'Results'});
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
