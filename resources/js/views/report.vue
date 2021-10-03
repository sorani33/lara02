<template>




  <v-card class="mx-auto"  tile>
    <v-list flat>
      <h3>成績板</h3>
		<v-alert type="info" color="green">最近〇〇の記録が更新されました！</v-alert>
    <br>
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

        <v-dialog v-if = "authUser == false" v-model="dialog" persistent max-width="290" overlay-opacity="100" >
          <v-card>
            <v-card-title class="text-h5">
              ここがタイトル
            </v-card-title>
            <v-card-text>こちらの画面を表示するにはログインが必要です</v-card-text>
            <v-btn href="/login" icon small>ログイン</v-btn><br>
            <v-btn href="/login/twitter" icon small>twitter login</v-btn><br>
            <v-btn href="/register" icon small>会員登録</v-btn><br>
            <v-btn href="/" icon small>ホームに戻る</v-btn>
            <v-card-actions>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <div class="text-center">
          <v-dialog v-model="isOpen" width="500">
            <template v-slot:activator="{ on, attrs }">
               <!-- <v-btn color="red lighten-2" dark v-bind="attrs" v-on="on"> Click Me </v-btn>-->
            </template>

            <v-card>
              <v-card-title class="text-h5 grey lighten-2">
                {{ modalTitle }}
              </v-card-title>
              <v-card-text>
              <div v-if="reportMode==1" class="body-1 mb-1">自己ベストスコア　{{ myscore }}点</div>
              <div v-if="reportMode==2" class="body-1 mb-1">自己ベストタイムアタック　{{ mybesttime }}</div>
              <br>
              <v-row v-if="reportMode==1" v-for="(rank, index) in ranking" :key="index">
              {{ rank.user.class_id-1 }}
              {{ className[0].shortName }}
                <div class="body-1 mb-1">{{ index+1 }}位　{{ className[rank.user.class_id-1].shortName }}{{ rank.user.name }} {{ rank.number_correct_answers }}点</div>
              </v-row>
              <v-row v-if="reportMode==2" v-for="(rank, index) in timeAttacks" :key="index">
                <div class="body-1 mb-1">{{ index+1 }}位　{{ className[rank.user.class_id-1].shortName }}{{ rank.user.name }} {{ rank.time_attack }}</div>
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
        { class: 1, user: { name: 'クラウド'}, number_correct_answers: 300 },
        { class: 1, user: { name: 'ティファ'}, number_correct_answers: 220 },
        { class: 1, user: { name: '土生翔吾(はぶっち)'}, number_correct_answers: 19 },
      ],
      mybesttime: '09:77',
      timeAttacks: [
        { class: 1, user: { name: 'クラウド'}, timeScore: '05:42' },
        { class: 1, user: { name: 'ティファ'}, timeScore: '07:18' },
        { class: 1, user: { name: '土生翔吾(はぶっち)'}, timeScore: '09:77' },
      ],

      className: [
        { id: 1, name: 'ラグナリオ', shortName: '【R】'},
        { id: 1, name: 'ウォルクス', shortName: '【W】'},
        { id: 1, name: 'アリスカーナ', shortName: '【A】'},
        { id: 1, name: 'フラーシア', shortName: '【F】'},
        { id: 1, name: '無所属', shortName: '【無】'},
      ],
      dialog: true, //ダイヤログはアクセス時に表示させる
      authUser: true,
      

    }),


  created: function () {
    this.getCreateDatas();
  },


  methods: {


    /**
     * getCreateDatas
     */
    getCreateDatas: function () {
  	  console.log("例題");

      axios.get('/api/home')
  	  .then((response) => {
        // this.authUser = response.data.authUser;
        if(response.data.authUser){
          this.authUser = true;
        }
      })
    },

    /**
     * selectItem
     */
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

      const genreId = this.genreId; //routerからパラメータidを取得する。
 	    console.log(genreId);

      axios.get('/api/report/'+ genreId).then((response) => {

      if(this.reportMode == 1){
        console.log("1");
        this.myscore = response.data.myscore;
        this.ranking = response.data.ranking;
        console.log(response.data.ranking);
      }
      if(this.reportMode == 2){
        console.log("2");
        // console.log(response.data);
        this.mybesttime = response.data.mybesttime;
        this.timeAttacks = response.data.timeAttacks;
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
