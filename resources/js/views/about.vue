<template>
  <v-app>
  <v-navigation-drawer app v-model="drawer" clipped>Navigation Lists</v-navigation-drawer><!-- サイドのナビゲーションメニュー -->
    <v-app-bar color="primary" dark app clipped-left><!-- これがヘッダー -->
      <v-toolbar-title>Vuetify</v-toolbar-title>
      <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon><!-- これがハンバーガーメニュー -->
      <v-toolbar-title>Vuetify</v-toolbar-title>
    </v-app-bar>
    <v-footer color="primary" dark app>
      Vuetify
    </v-footer>
  </v-app>
</template>


<script>
export default {
  data(){
    return{
        drawer: null
    }
  }
}
</script>