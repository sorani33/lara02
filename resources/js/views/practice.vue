<template>
  <v-app>
    <v-container>
      <v-row v-for="examinationQuestion in examinationQuestions">
        <v-col>
          <v-card class="mx-auto">
            <v-card-text>
              <p class="text--primary">
                {{examinationQuestion.subject}}
              </p>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn-toggle borderless class="text--primary">
                <v-layout wrap >
                  <v-flex xs12 sm6 md3 v-for="answer in examinationQuestion.question">
                   <v-btn class="mx-4 mb-6 text-caption">{{answer}}</v-btn>
                  </v-flex>
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
  </v-app>
</template>


<script>
export default {
  data(){
    return{
      examinationQuestions:[],
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
      axios.post('/api/examinationquestions/'+ questionId
      ).then((response) => {
        this.examinationQuestions = response.data.examinationQuestions;
      })
    },
    /**
     * 予約情報保存
     */
    postReserve:  function () {
        console.log(this);

        axios.post('/api/result', this)
        .then(async response => {
        console.log(response);
        })
      }
    },



}
</script>