<template>

  <v-app>
  <v-navigation-drawer app v-model="drawer" clipped>Navigation Lists</v-navigation-drawer><!-- サイドのナビゲーションメニュー -->
    <v-app-bar color="primary" dark clipped-left app ><!-- これがヘッダー -->
      <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon><!-- これがハンバーガーメニュー -->
    </v-app-bar>
    <v-container>
    <div v-if="answeresult">
        採点結果は<span class="red--text .font-weight-bold">{{ score }}点</span>でした！
    　　{{ correctAnswerCount }} / {{ examinationCount }}<br>
    </div>

      <v-row v-for="(examinationQuestion, index, count) in examinationQuestions">
        <v-col>
          <v-card class="mx-auto">
            <v-card-text>
              <p class="text--primary">
                【{{count+1}}】
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
                   <input type="radio" v-bind:value="answer" v-model="picked[index]" />{{answer}}
                  </v-flex>
                  {{picked}}
                  <div v-if="answeresult">
                  <!--{{ examinationQuestion }}-->
                  <!--{{ examinationQuestion.CorrectAnswer }}-->
                    <div v-if="examinationQuestion.correctAnswer">
                    <img src="/images/maru.png" width="20">
                      正解。あなたが答えたのは<span class="primary--text">「{{ examinationQuestion.inCorrectAnswer }}」</span>でした。
                    </div>
                    <div v-else="examinationQuestion.correctAnswer == false">
                    <img src="/images/batsu.png" width="20">
                      残念。未回答でしたが<span class="red--text">正解は「{{ examinationQuestion.answer }}」でした。</span><br>
                      授業の復習はこちらから→<v-btn small color="success" href="http://local.lara02.com/">授業を復習する</v-btn>
                    </div>
                    <div v-else>
                    <img src="/images/batsu.png" width="20">
                      残念。<span class="red--text">{{ examinationQuestion.inCorrectAnswer }}</span>ではなく
                      <span class="red--text">正解は「{{ examinationQuestion.answer }}」でした。</span><br>
                      授業の復習はこちらから→<v-btn color="primary" href="http://local.lara02.com/">授業を復習する</v-btn>

                    </div>
                  </div>
                </v-layout>
              </v-btn-toggle>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    <div v-if="answeresult">
    <br>
      <v-btn color="primary" href="http://local.lara02.com/">もう一度（工事中）</v-btn>
      <v-btn color="primary" href="http://local.lara02.com/">トップに戻る</v-btn>
      <v-btn color="primary" href="https://twitter.com/share?url=http://local.lara02.com&text=【練習問題】youtube大学で80点でした。一緒に過去の授業を復習しよう！&hashtags=#aaaa">結果をツイートする</v-btn>
    </div>
    <br>
    <div v-if="!answeresult">
      <v-btn
        class="mb-8"
        block
        color="primary"
        style="font-size:var(--read-font-size-m);font-weight:bold;"
        v-on:click.native="postReserve"
      >採点する
      </v-btn>
    </div>
    <br>
    <br>
    <br>
    <br>
    </v-container>
  <v-bottom-navigation app
    :value="value"
    color="teal"
    grow
  >
    <v-btn>
      <span>練習問題</span>

      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn>
      <span>タイムアタック</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

    <v-btn>
      <span>マイページ</span>

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
      mode: 1, //モード

      drawer: null, //ドロワー用途
      value: null, //ドロワー用途
      examinationCount: 5, //問題数
      correctAnswerCount: 3, //正解数
      score: 80, //点数
      answeresult: false, //結果表示

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

  beforeRouteUpdate (to, from, next) {
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

    moveToTop:  function () {

        const duration = 450;  // 移動速度（1秒で終了）
        const interval = 25;    // 0.025秒ごとに移動
        const step = -window.scrollY / Math.ceil(duration / interval); // 1回に移動する距離
        const timer = setInterval(() => {
            window.scrollBy(0, step);   // スクロール位置を移動
            if(window.scrollY <= 0) {
                clearInterval(timer);
            }
        }, interval);

    },

    /**
     * 予約情報保存
     */
    postReserve:  function () {
      var poipi = this.$data.picked;
      var mode = this.$data.mode;
      console.log(mode);
        // console.log(poipi);
        var sendApiParameters = {
          param:{
            genre_id:1,
            no:poipi,
            mode:mode,
          }
        };

        axios.post('/api/result', sendApiParameters)
        .then((response) => {
          this.examinationQuestions = response.data.inCorrectAnswerLists;
          this.answeresult = true;
          this.score = response.data.score;
          this.correctAnswerCount = response.data.correctAnswerCount;
          this.examinationCount = response.data.examinationCount;
          this.moveToTop();
        })
      }
    },



}
</script>