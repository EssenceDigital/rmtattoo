/** Primary component and template for the entire application.
  * Includes the main navigation and Vue router outlet.
*/
<template>
  <v-app standalone dark>
    <nav-drawer></nav-drawer>
    <main>
      <!-- For showing user alerts and feedback -->
      <v-snackbar
        v-model="snackbar"
        :timeout="timeout"
        :absolute="true"
        :multi-line="true"
        class="absolute-center"
      >
        {{ snackBarText }}
        <v-btn flat class="pink--text" @click.native.stop="snackbar = false">Close</v-btn>
      </v-snackbar>

      <v-content>
        <v-container fluid>
          <v-card>
            <router-view></router-view>
          </v-card>
        </v-container>
      </v-content>
    </main>
    <v-footer app fixed>
      <span>&copy; 2017</span>
    </v-footer>
  </v-app>
</template>

<script>
  import NavDrawer from './components/_views/_ui/Nav-drawer';

  export default {
    data: () => ({
      snackbar: false,
      mode: '',
      timeout: 6000,
      snackBarText: ''
    }),

    components: {
      'nav-drawer': NavDrawer 
    },

    created () {
      this.$router.app.$on('show-snackbar', (config) => {
        this.snackbar = true;
        this.snackBarText = config.text;    
      }); 
    }    
  }
</script>

<style scoped>
  .absolute-center{
    top: 40%;
  }
</style>