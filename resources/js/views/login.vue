<template>
  <v-app id="inspire">
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Login form</v-toolbar-title>
              
               
              </v-toolbar>
              <v-card-text>
                <v-form @submit.prevent="login">
                  <v-text-field
                    label="username"
                    name="username"
                    type="username"
                    v-model="username"
                    prepend-icon="mdi-account"
                  ></v-text-field>

                  <v-text-field
                    label="Password"
                    name="password"
                    type="password"
                    v-model="password"
                    prepend-icon="mdi-lock"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click.native="login">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data () {
    return {
      username: '',
      password: ''
    }
  },
   methods: {
      login () {
        this.$store
          .dispatch('login', {
            username: this.username,
            password: this.password
          })
          .then(() => { this.$router.push({ name: 'index' }) })
      }
    }
  };
</script>