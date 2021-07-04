<template>
  <v-card class="mx-auto" max-width="600" tile>
    <v-list flat>
      <v-subheader>成績板</v-subheader>
      <v-list-item-group
        v-model="selectedItem"
        color="primary"
      >
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
    		  @click="selectItem(item)"
        >
          <v-list-item-icon>
            <v-icon v-text="item.icon"></v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title v-text="item.titleText"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>


      <v-list-group
        :value="true"
        prepend-icon="mdi-account-circle"
      >
        <template v-slot:activator>
          <v-list-item-title>世界史2019</v-list-item-title>
        </template>

        <v-list-item
          v-for="(sekaishidata, i) in sekaishidatas"
          :key="i"
    		  @click="selectItem(sekaishidata)"
        >
          <v-list-item-content>
            <v-list-item-title v-text="sekaishidata.titleText"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>

      <v-app id="app">
        <div class="text-center">
          <v-dialog v-model="isOpen" width="500">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="red lighten-2" dark v-bind="attrs" v-on="on"> Click Me </v-btn>
            </template>

            <v-card>
              <v-card-title class="text-h5 grey lighten-2">
                {{ modalTitle }}
              </v-card-title>
              <v-card-text>
              <div v-if="reportMode==1" class="body-1 mb-1">自己ベストスコア　{{ myscore }}点</div>
              <div v-if="reportMode==2" class="body-1 mb-1">自己ベストタイムアタック　{{ mybesttime }}</div>
              <br>
              <v-row v-if="reportMode==1" v-for="(rank, index) in ranking">
                <div class="body-1 mb-1">{{ index+1 }}位　[A]{{ rank.user_id }} {{ rank.number_correct_answers }}点</div>
              </v-row>
              <v-row v-if="reportMode==2" v-for="(rank, index) in timeAttacks">
                <div class="body-1 mb-1">{{ index+1 }}位　[A]{{ rank.name }} {{ rank.timeScore }}</div>
              </v-row>
              </v-card-text>

              <v-divider></v-divider>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="isOpen = false"> 閉じる </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>
      </v-app>

    </v-list>
  </v-card>
</template>


<script>
  export default {
    data: () => ({
      dialog: false,

      selectedItem: 1,
      items: [
        { genreId: 900, reportMode: 1, titleText: '総合スコア', icon: 'mdi-clock' },
        { genreId: 950, reportMode: 1, titleText: '月間スコア', icon: 'mdi-account' },
      ],
      sekaishidatas: [
        { genreId: 1, reportMode: 2, titleText: 'ヨーロッパ史', icon: 'mdi-clock' },
        { genreId: 2, reportMode: 2, titleText: '中東史', icon: 'mdi-account' },
      ],

      item: '',
      isOpen: false,

      modalTitle: '月間スコア',
      genreId: '',
      reportMode: '',
      myscore: 183,
      ranking: [
        { class: 1, name: 'クラウド', number_correct_answers: 300 },
        { class: 1, name: 'ティファ', number_correct_answers: 220 },
        { class: 1, name: '土生翔吾(はぶっち)', number_correct_answers: 19 },
      ],
      mybesttime: '09:77',
      timeAttacks: [
        { class: 1, name: 'クラウド', timeScore: '05:42' },
        { class: 1, name: 'ティファ', timeScore: '07:18' },
        { class: 1, name: '土生翔吾(はぶっち)', timeScore: '09:77' },
      ],
    }),

  methods: {
   selectItem(parameter) {
     this.genreId = parameter.genreId;
     this.reportMode = parameter.reportMode;
     this.getReportDatas();

     this.modalTitle = parameter.titleText;
     this.isOpen = true
    },


    /*
     * getReportDatas
     */
    getReportDatas: function () {

      // const questionId = this.$route.params.id; //routerからパラメータidを取得する。
      const genreId = this.genreId; //routerからパラメータidを取得する。
 	    console.log(genreId);

      axios.get('/api/report/'+ genreId
      ).then((response) => {
      //   this.examinationQuestions = response.data.examinationQuestions;

      if(this.reportMode == 1){
        console.log("1");
        this.myscore = response.data.myscore;
        this.ranking = response.data.ranking;
        console.log(response.data.ranking);

        // // 返り値のKeyを元にしてdata()を作成する
        // var rankingArray = response.data.ranking;
        // var rankingObj = {};
        // for (var key in rankingArray) {
        // // console.log(rankingArray[key]["number_correct_answers"]);
        //   rankingObj[key]["score"] = rankingArray[key]["number_correct_answers"];
        //   rankingObj[key]["name"] = rankingArray[key]["user_id"];
        // }
        // console.log(this.ranking);
        // console.log(rankingObj);
        // this.ranking = rankingObj; //dataに入れる。


      }
      if(this.reportMode == 2){
        console.log("2");
        // console.log(response.data);
      }
      //   // 返り値のKeyを元にしてdata()を作成する
      //   var array = response.data.examinationQuestions;
      //   var obj = {};
      //   for (var key in array) {
      //     obj[key] = '';
      //   }
      //   this.$data.picked = obj; //dataに入れる。
      })
    },
  }

  }
</script>
