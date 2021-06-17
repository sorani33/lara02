<template>
  <v-app>
  <v-navigation-drawer app v-model="drawer" clipped>Navigation Lists</v-navigation-drawer><!-- サイドのナビゲーションメニュー -->
    <v-app-bar color="primary" dark app clipped-left><!-- これがヘッダー -->
      <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon><!-- これがハンバーガーメニュー -->
      <v-toolbar-title>Vuetify</v-toolbar-title>
    </v-app-bar>
    <v-container>
      <v-row v-for="(examinationQuestion, index) in examinationQuestions">
        <v-col>
          <v-card class="mx-auto">
            <v-card-text>
              <p class="text--primary">
                {{index}} / 
                {{examinationQuestion.subject}}
              </p>
            <input type="hidden" name="no" :value="index" />
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn-toggle borderless class="text--primary">
                <v-layout wrap >
                  <v-flex xs12 sm6 md3 v-for="(answer, questionindex) in examinationQuestion.question">
                  <!-- <v-btn class="mx-4 mb-6 text-caption" v-model="picked" v-bind:value="answer">{{answer}}{{index}}</v-btn> -->
                   <input type="radio" v-bind:value="answer" v-model="picked[index]" />{{answer}}{{questionindex}}
                  </v-flex>
                  {{picked}}
                </v-layout>
              </v-btn-toggle>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <v-btn
        class="mb-8"
        block
        color="primary"
        style="font-size:var(--read-font-size-m);font-weight:bold;"
        v-on:click.native="postReserve"
      >仮予約お申し込み
      </v-btn>
    </v-container>
  <v-bottom-navigation app
    :value="value"
    color="teal"
    grow
  >
    <v-btn>
      <span>Recents</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

    <v-btn>
      <span>Favorites</span>

      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn>
      <span>Nearby</span>

      <v-icon>mdi-map-marker</v-icon>
    </v-btn>
  </v-bottom-navigation>
  </v-app>
</template>


<script>
export default {
  data(){
    return{
      examinationQuestions:[],
      drawer: null, //ドロワー用途
      value: null, //ドロワー用途
      // picked:[],
      picked:{
        // 1:"",
        // 2:"",
        // 3:"",
        // 4:"",
      },
    }
  },

  created: function () {
    // this.areaValue = this.$store.state.call.areaValue;
    // if (!this.areaValue) {
    //   this.areaValue = this.$store.state.call.tmpSearchConditions.areaValue;
    // }
    // // 指名キャストがstoreから外れた時はリダイレクト
    // if (!this.$store.state.call.nominateCast) {
    //   this.$router.push('/call')
    // }
    this.getExaminationQuestionDatas();
  },


  methods: {
    /**
     * getExaminationQuestionDatas
     */
    getExaminationQuestionDatas: function () {
      const questionId = this.$route.params.id; //routerからパラメータidを取得する。
      axios.get('/api/examinationquestions/'+ questionId
      ).then((response) => {
        this.examinationQuestions = response.data.examinationQuestions;

        // 返り値のKeyを元にしてdata()を作成する
        var array = response.data.examinationQuestions;
        var obj = {};
        for (var key in array) {
          obj[key] = '';
        }
        this.$data.picked = obj; //dataに入れる。
      })
    },
    /**
     * 予約情報保存
     */
    postReserve:  function () {
      var poipi = this.$data.picked;
        // console.log(poipi);
        var koredesu = {
          param:{
            genre_id:1,
            no:poipi
            // no:{
            //   1:"ねこ",
            //   2:"むむむ",
            //   3:"ねこ",
            //   4:"むむ"
            // }
          }
        };
        // var aaa = Object.assign(koredesu, this.$data.picked)
        // console.log(this.$data.picked);
        // console.log(aaa);
        console.log(koredesu);

        axios.post('/api/result', koredesu)
        .then((response) => {
          console.log(response.data);
          // this.$router.push('/result')
          this.$router.push({
             name:'result',
             params:response.data
          })
        }
        )
      }
    },



}
</script>