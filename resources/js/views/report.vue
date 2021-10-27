<template>




  <v-card class="mx-auto"  tile>
    <v-list flat>
<!--Comment
		<v-alert type="info" color="green">最近〇〇の記録が更新されました！</v-alert>
 -->
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
            <v-list-item-title v-text="item.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>

<!--Comment
      <v-list-group
        :value="true"
        prepend-icon=""
      >
 -->
        <div v-for="(genreWithSubgenreData, ii) in genreWithSubgenreDatas">
<!--Comment
          <template>
            <v-list-item-title><b>【{{genreWithSubgenreData.name}}】</b></v-list-item-title>
          </template>
 -->
          <v-list-item
            v-for="(subGenreData, i) in genreWithSubgenreData.subgenres"
            :key="i"
            @click="selectItem(subGenreData)"
          >
            <v-list-item-content>
              <v-list-item-title v-text="subGenreData.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

<!--Comment
      </v-list-group>
 -->

      <v-app id="app">

        <v-dialog v-if = "authUser == false" v-model="dialog" persistent max-width="290" overlay-opacity="100" >
          <v-card>
            <v-card-title class="text-h5">
              成績板では、<br>
              自分のスコアと<br>
              タイムアタック記録、<br>
              上位3名のランキング<br>
              が確認できます。
            </v-card-title>
            <v-card-text>こちらの画面を表示するにはログインが必要です</v-card-text>
            <v-btn href="/login/twitter" icon small>twitter login</v-btn><br>
            <v-btn href="/" icon small>ホームに戻る</v-btn>
            <v-card-actions>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <div class="text-center">
          <v-dialog v-model="isOpen" width="500">
            <template v-slot:activator="{ on, attrs }">
            </template>

            <v-card>
              <v-card-title class="text-h5 grey lighten-2">
                {{ modalTitle }}
              </v-card-title>
              <v-card-text >
                <div v-if="reportMode==1" class="body-1 mb-1 ">自己ベストスコア　{{ myscore }}点</div>
                <div v-if="reportMode==2" class="body-1 mb-1">自己ベストタイムアタック　{{ mybesttime }}秒</div>
                <br>
                <v-row v-if="reportMode==1" v-for="(rank, index) in ranking" :key="index">
                  <div v-if="userId !== rank.user.id && className[rank.user.class_id-1]" class="body-1 mb-1">{{ index+1 }}位　{{ className[rank.user.class_id-1].shortName }}{{ rank.user.name }} {{ rank.number_correct_answers }}点</div>
                  <div v-if="userId === rank.user.id && className[rank.user.class_id-1]" class="body-1 mb-1 red--text ">{{ index+1 }}位　{{ className[rank.user.class_id-1].shortName }}{{ rank.user.name }} {{ rank.number_correct_answers }}点</div>
                </v-row>

                <v-row v-if="reportMode==2" v-for="(rank, index) in timeAttacks" :key="index">
                  <div v-if="userId !== rank.user.id && className[rank.user.class_id-1]" class="body-1 mb-1 ">{{ index+1 }}位　{{ className[rank.user.class_id-1].shortName }}{{ rank.user.name }} {{ rank.time_attack }}秒</div>
                  <div v-if="userId === rank.user.id && className[rank.user.class_id-1]" class="body-1 mb-1 red--text ">{{ index+1 }}位　{{ className[rank.user.class_id-1].shortName }}{{ rank.user.name }} {{ rank.time_attack }}秒</div>
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

      selectedItem: 1,
      items: [
        { id: 900, reportMode: 1, name: '総合スコア', icon: '' },
        { id: 950, reportMode: 1, name: '月間スコア', icon: '' },
      ],
      genreWithSubgenreDatas: [],

      item: '',
      isOpen: false,

      modalTitle: '月間スコア',
      genreId: '',
      reportMode: '',
      myscore:  '',
      ranking: [],
      mybesttime: '09:77',
      timeAttacks: [],

      className: [
        { id: 1, name: 'ラグナリオ', shortName: '【R】'},
        { id: 2, name: 'ウォルクス', shortName: '【W】'},
        { id: 3, name: 'アリスカーナ', shortName: '【A】'},
        { id: 4, name: 'フラーシア', shortName: '【F】'},
        { id: 5, name: '無所属', shortName: '【無】'},
      ],
      dialog: true, //ダイヤログはアクセス時に表示させる
      authUser: true,
      myRankingNumber : '',
      userId: '',
     

    }),


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
        this.genreWithSubgenreDatas = response.data.genreWithSubgenreDatas;
        if(!response.data.authUser){
          this.authUser = false;
        }
      })
    },

    /**
     * selectItem
     */
    selectItem(parameter) {
     this.genreId = parameter.id;
      
    //  this.genreId = parameter.genreId;
    //  this.reportMode = parameter.reportMode;
     this.getReportDatas();
     this.modalTitle = parameter.name;
    },


    /*
     * getReportDatas
     */
    getReportDatas: function () {

      const genreId = this.genreId; //routerからパラメータidを取得する。

      axios.get('/api/report/'+ genreId).then((response) => {
        this.reportMode = response.data.reportMode;
        this.myRankingNumber = response.data.myRankingNumber;
        this.userId = response.data.userId;
        if(this.reportMode == 1){
          this.myscore = response.data.myscore;
          this.ranking = response.data.ranking;
          // this.modalTitle = parameter.titleText;
        }
        if(this.reportMode == 2){
          this.mybesttime = response.data.mybesttime;
          this.timeAttacks = response.data.timeAttacks;
          // this.modalTitle = this.subGenreDatas.name;
        }
        this.isOpen = true
      })
    },
  }

  }
</script>
