<template>

  <v-app>
    <v-container>
    <div v-if="answeresult">
        採点結果は<span class="red--text .font-weight-bold">{{ score.toFixed() }}点</span>でした！
    　　{{ correctAnswerCount }} / {{ examinationCount }}<br>
    </div>
    <p>{{interval.toFixed(2)}}</p> <!-- 小数2桁まで表示 -->



    <v-dialog v-model="dialog" persistent max-width="290" overlay-opacity="100">
      <template v-slot:activator="{ on, attrs }">

      </template>
      <v-card>
        <v-card-title class="text-h5">
          00:00:00
        </v-card-title>
        <v-card-text>タイムアタック　ready...</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="timeattackstart"> Go!!</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

      <v-row v-for="(examinationQuestion, index, count) in examinationQuestions" :key="index">
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
                  <v-flex xs12 sm6 md3 v-for="(answer, questionindex) in examinationQuestion.question" :key="questionindex">
                   <input type="radio" v-bind:value="answer" v-model="picked[index]" :id="examinationQuestion.subject + questionindex" /><label :for="examinationQuestion.subject + questionindex">{{answer}}</label>
                  </v-flex>
                  <div v-if="answeresult">
                    <div v-if="examinationQuestion.correctAnswer == 1">
                    <img src="/images/maru.png" width="20">
                      正解。あなたが答えたのは<span class="primary--text">「{{ examinationQuestion.inCorrectAnswer }}」</span>でした。                      
                    </div>
                    <div v-else-if="examinationQuestion.correctAnswer == 2">
                    <img src="/images/batsu.png" width="20">
                      残念。未回答でしたが<span class="red--text">正解は「{{ examinationQuestion.answer }}」でした。</span><br>
                      授業の復習はこちらから→<v-btn small color="success" href="http://local.lara02.com/">授業を復習する</v-btn>
                    </div>
                    <div v-else-if="examinationQuestion.correctAnswer == 3">
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
      <v-btn color="primary" v-on:click.native="resetReserve">もういちど</v-btn>
      <v-btn color="primary" href="https://yu-learning.herokuapp.com//">トップに戻る</v-btn>
      <v-btn color="primary" v-bind:href="'https://twitter.com/share?url=https://yu-learning.herokuapp.com/&text=【練習問題】youtube大学の、' + subGenreName + 'で' + score + '点でした。一緒に過去の授業を復習しよう！&hashtags=#aaaa'">結果をツイートする</v-btn>
    </div>
    <br>
    <div v-if="postReserveButton">
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
      gamemode: 2, //モード

      drawer: null, //ドロワー用途
      value: null, //ドロワー用途
      examinationCount: 5, //問題数
      correctAnswerCount: 3, //正解数
      score: 80, //点数
      answeresult: false, //結果表示
      dialog: true, //ダイヤログはアクセス時に表示させる
      show: false, //フラッシュ

      // タイムアタック用
      active : false, // 実行状態
      start : 0, // startを押した時刻
      timer : 0, // setInterval()の格納用
      interval : 0, // 計測時間
      accum : 0, // 累積時間(stopしたとき用)

      postReserveButton: false, //採点するボタンのちらつきをなおす
      subGenreName: '', //ドロワー用途

      picked:{},
    }
  },

  created: function () {
    this.getExaminationQuestionDatas();
  },

  mounted : function(){
    console.log('mounted')
  },

  beforeRouteUpdate (to, from, next) {
  },

  methods: {
    showFlash(){
      this.show = true;
      setTimeout(() => {
        this.show = false}
        ,3000
      )
    },


    /*
     * タイムアタック用
     */
    timeattackstart: function () {
      this.dialog = false;
      console.log('timeattackstart');
      this.active = true;
      this.start = Date.now();
      this.timer = setInterval(()=>{ 
        this.interval = this.accum + (Date.now() - this.start) * 0.001;
        }, 10
      ); // 10msごとに現在時刻とstartを押した時刻の差を足す
    },

    stopTimer(){
        this.active = false;
        this.accum = this.interval;
        clearInterval(this.timer);
    },

    resetTimer(){
        this.interval = 0;
        this.accum = 0;
        this.start = Date.now();
    },


    /*
     * getExaminationQuestionDatas
     */
    getExaminationQuestionDatas: function () {
      const questionId = this.$route.params.id; //routerからパラメータidを取得する。
      axios.get('/api/examinationquestions/'+ questionId, {
        params: {
          questionId: questionId,
          gamemode: 2,
        }
      }).then((response) => {

        this.examinationQuestions = response.data.examinationQuestions;
        this.postReserveButton = true;

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
      var questionId = this.$route.params.id; //routerからパラメータidを取得する。
      var sub_genre_id = this.$data.picked;
      var gamemode = this.$data.gamemode;
      this.stopTimer();
        var sendApiParameters = {
          param:{
            questionId:questionId,
            genre_id:1,
            sub_genre_id:sub_genre_id,
            gamemode:gamemode,
            timeAttack:this.interval,
          }
        };
        axios.post('/api/result', sendApiParameters)
        .then((response) => {
          this.examinationQuestions = response.data.inCorrectAnswerLists;
          this.answeresult = true;
          this.score = response.data.score;
          this.correctAnswerCount = response.data.correctAnswerCount;
          this.examinationCount = response.data.examinationCount;
          this.subGenreName = response.data.subGenreName;
          this.moveToTop();
        })
    },


    resetReserve:  function () {
      this.$router.go({path: this.$router.currentRoute.path, force: true}) //vuerouterのhistory対策
    }

  },



}
</script>