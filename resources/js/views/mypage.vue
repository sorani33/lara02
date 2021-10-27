<template>
  <v-app>
        <v-dialog v-if = "authUser == false" v-model="dialog" persistent max-width="290" overlay-opacity="100" >
          <v-card>
            <v-card-title class="text-h5">
              マイページでは、<br>名前やクラスの変更等ができます。
            </v-card-title>
            <v-card-text>こちらの画面を表示するにはログインが必要です</v-card-text>
            <v-btn href="/login/twitter" icon small>twitter login</v-btn><br>
            <v-btn href="/" icon small>ホームに戻る</v-btn>
            <v-card-actions>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

    <!-- ヘッダー -->
    <v-app-bar app clippedLeft flat dark color="indigo darken-3">
      <v-app-bar-nav-icon @click.stop="drawer=!drawer"></v-app-bar-nav-icon>
    </v-app-bar>

    <!-- メイン -->
    <v-main>
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
        drawer: true,

        dialog: true,
        authUser: true,
      }
    },


    created: function () {
      this.getCreateDatas();
    },



  methods: {
    /**
     * getCreateDatas
     */
    getCreateDatas: function () {
      axios.get('/api/home')
  	  .then((response) => {
        if(!response.data.authUser){
          this.authUser = false;
        }
      })
    },
  }

  }
</script>