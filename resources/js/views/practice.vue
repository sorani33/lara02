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
              <v-btn-toggle borderless >
                <v-layout wrap >
                  <v-flex xs12 sm6 md3 v-for="answer in examinationQuestion.question">
                   <v-btn class="mb-6 text-caption">{{answer}}</v-btn>
                  </v-flex>
                </v-layout>
              </v-btn-toggle>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>


<script>
export default {
  data(){
    return{
      examinationQuestions:[
      ],
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
      const data = {
        userid: '1' //今回投げるuserid
      }
      axios.post('/api/examinationquestions/1', data
      ).then((response) => {
        console.log(response.data.examinationQuestions);
        this.examinationQuestions = response.data.examinationQuestions;
      })
    },
  },
}
</script>