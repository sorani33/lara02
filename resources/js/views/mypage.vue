<template>
  <v-app>

    <!-- ヘッダー -->
    <v-app-bar app clippedLeft flat dark color="indigo darken-3">
      <v-app-bar-nav-icon @click.stop="drawer=!drawer"></v-app-bar-nav-icon>
    </v-app-bar>

    <!-- メイン -->
    <v-main>
    <h1>マイページ画面</h1>
      <v-container fluid>
        <v-form>
          <v-btn color="success" to="/mypage/editname">
            名前・クラスを変更
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