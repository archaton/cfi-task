<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
    >
      <template v-slot:append>
        <div class="pa-2">
          <span>BerG &copy; {{ new Date().getFullYear() }}</span>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>Welcome to the Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <router-view />
      </v-container>
    </v-main>

    <v-overlay :value="$root.$data.sharedState.isLoading()">
      <v-progress-circular
        indeterminate
        color="secondary"
      />
    </v-overlay>
  </v-app>
</template>

<script>

export default {
    name: 'App',
    data () {
        return {
            drawer: false,
        };
    },
    created () {
        this.$vuetify.theme.dark = false;
    },
};
</script>
