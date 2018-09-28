<template>
	<div>
	  <v-navigation-drawer
	    clipped
	    persistent
	    v-model="drawer"
	    enable-resize-watcher
	    app
    >
      <v-list class="mt-2">
        <v-list-tile tag="div" class="pl-1">
          <v-list-tile-avatar>
            <v-icon>perm_data_setting</v-icon>
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title>{{ auth_email }}</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-menu offset-y>
              <v-btn slot="activator" icon>
                <v-icon>expand_more</v-icon>                
              </v-btn>
              <v-list> 
                <v-divider></v-divider>
                <v-list-tile @click="logout">
                  <v-list-tile-title>

                  <form action="/logout" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <button type="submit"><v-icon>lock_open</v-icon> Logout</button>
                  </form>
                  </v-list-tile-title>
                </v-list-tile>                                
              </v-list>
            </v-menu>          
          </v-list-tile-action>
        </v-list-tile>
      </v-list> 
      <v-toolbar flat class="transparent">
        <v-list class="pa-0">
          <v-list-tile>
            <v-list-tile-content>
              <v-list-tile-title>Tools</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-toolbar> 
      <v-list dense>
        <v-list-tile 
          @click="$router.push(item.link)"
          v-for="item in userToolsMenuItems"
          :key="item.title"
          :to="item.link"         
        >
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>         
  	  <v-toolbar v-if="auth_role == 'admin'" flat class="transparent">
  	    <v-list class="pa-0">
  	      <v-list-tile>
  	        <v-list-tile-content>
  	          <v-list-tile-title>Manage</v-list-tile-title>
  	        </v-list-tile-content>
  	      </v-list-tile>
  	    </v-list>
  	  </v-toolbar> 
      <v-list v-if="auth_role == 'admin'" dense>
        <v-list-tile 
        	@click="$router.push(item.link)"
          v-for="item in appMenuItems"
          :key="item.title"
          :to="item.link"	      	
        >
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>	 
      <v-toolbar v-if="auth_role == 'admin'" flat class="transparent">
        <v-list class="pa-0">
          <v-list-tile>
            <v-list-tile-content>
              <v-list-tile-title>Website</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-toolbar>    
      <v-list v-if="auth_role == 'admin'" dense>
        <v-list-tile 
          @click="$router.push(item.link)"
          v-for="item in websiteMenuItems"
          :key="item.title"
          :to="item.link"         
        >
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>           
	  </v-navigation-drawer>
	  <v-toolbar app fixed clipped-left>
	    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
	    <v-toolbar-title>RMT</v-toolbar-title>
	  </v-toolbar>		
	</div>

</template>

<script>
  export default {
  	data() {
  		return {
        // AUTHENTICATED USER ID
        auth_role: AUTH_ROLE,
        auth_email: AUTH_EMAIL,
  			drawer: true,
  			websiteMenuItems: [
  				{ icon: 'photo_library', title: 'Portfolio', link: '/portfolio' },
  				{ icon: 'list', title: 'FAQs', link: '/faqs' }				
  			],
  			appMenuItems: [
          { icon: 'person', title: 'Users', link: '/users' },
  				{ icon: 'event', title: 'Bookings', link: '/bookings' }
  			],
        userToolsMenuItems: [
          { icon: 'event', title: 'Your Bookings', link: '/your-bookings' },
        ],
        token: window.Laravel.csrfToken
  		}
  	},

    methods: {
      logout () {
        // Logout
        axios.post('/logout')
          .then( (response) => {
            console.log(response);

            // Redirect
            this.$router.go('/login');
          })
          .catch( (error) => {
            console.log(error);
          });
      }
    }
  }
</script>