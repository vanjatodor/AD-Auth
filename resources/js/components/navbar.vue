<template>
  <v-app-bar
      color="deep-purple accent-4"
      dense
      dark
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Aplication</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

     
        <router-link v-if="!loggedIn" to="/login">
          Login
        </router-link>
     

      <v-btn v-else @click="logout">
          Logout
      </v-btn>

      <v-menu
        left
        bottom
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            icon
            v-bind="attrs"
            v-on="on"
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            v-for="n in 5"
            :key="n"
            @click="() => {}"
          >
            <v-list-item-title>Option {{ n }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>

        
      
        <v-footer></v-footer>

    </v-app-bar>
</template>

<script>
import { mapGetters } from 'vuex'
import { authComputed } from '../vuex/helpers.js'

  export default {
    computed: {
      ...authComputed
    },
    methods: {
        logout () {
          this.$store.dispatch('logout')
        }
      },
  };
</script>