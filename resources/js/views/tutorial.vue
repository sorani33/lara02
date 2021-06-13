<template>
  <v-app>
    <!-- サイドメニュー -->
    <!-- https://masa-enjoy.com/vuetify-beginner -->
    <v-navigation-drawer app clipped v-model="drawer" dark color="info">
    </v-navigation-drawer>

    <!-- ヘッダー -->
    <v-app-bar app clippedLeft flat dark color="indigo darken-3">
      <v-app-bar-nav-icon @click.stop="drawer=!drawer"></v-app-bar-nav-icon>
    </v-app-bar>

    <!-- メイン -->
    <v-main>
      <v-container fluid>
        <v-form>

          <v-btn color="success" class="">
            Validate
          </v-btn>

          <v-btn color="error" class="">
            Reset Form
          </v-btn>

          <v-btn color="warning" class="">
            Reset Validation
          </v-btn>
        </v-form>

      </v-container>
    </v-main>

    <!-- フッター -->
    <v-footer app color="primary">
    </v-footer>
  </v-app>
</template>
<script>
  export default {
    name: 'app',
    data() {
      return {
        drawer: true
      }
    }
  }
</script>