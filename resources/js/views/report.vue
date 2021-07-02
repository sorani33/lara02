<template>
  <v-card
    class="mx-auto"
    max-width="600"
    tile
  >
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
            <v-list-item-title v-text="item.text"></v-list-item-title>
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
            <v-list-item-title v-text="sekaishidata.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

      </v-list-group>


<v-app id="app">
  <div class="text-center">
    <v-dialog
      v-model="isOpen"
      width="500"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Click Me
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          総合スコア
        </v-card-title>

        <v-card-text>
        <div v-if="mode==1" class="body-1 mb-1">自己ベスト　{{ myscore }}点</div>
        <div v-if="mode==2" class="body-1 mb-1">自己ベスト　{{ mybesttime }}</div>
        <br>
        <v-row v-if="mode==1" v-for="(rank, index) in ranking">
          <div class="body-1 mb-1">{{ index+1 }}位　[A]{{ rank.name }} {{ rank.score }}点</div>
        </v-row>
        <v-row v-if="mode==2" v-for="(rank, index) in timeAttacks">
          <div class="body-1 mb-1">{{ index+1 }}位　[A]{{ rank.name }} {{ rank.timeScore }}</div>
        </v-row>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="isOpen = false"
          >
            閉じる
          </v-btn>
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
      admins: [
        ['自己ベスト', 'mdi-account-multiple-outline'],
        ['ランキング', 'mdi-cog-outline'],
      ],

      selectedItem: 1,
      items: [
        { mode: 100, text: '総合スコア', icon: 'mdi-clock' },
        { mode: 101, text: '月間スコア', icon: 'mdi-account' },
      ],

      sekaishidatas: [
        { mode: 100, text: 'ヨーロッパ史', icon: 'mdi-clock' },
        { mode: 101, text: '中東史', icon: 'mdi-account' },
      ],

      item: '',
      isOpen: false,

      mode: 2,
      myscore: 183,
      ranking: [
        { class: 1, name: 'クラウド', score: 300 },
        { class: 1, name: 'ティファ', score: 220 },
        { class: 1, name: '土生翔吾(はぶっち)', score: 19 },
      ],
      mybesttime: '09:77',
      timeAttacks: [
        { class: 1, name: 'クラウド', timeScore: '05:42' },
        { class: 1, name: 'ティファ', timeScore: '07:18' },
        { class: 1, name: '土生翔吾(はぶっち)', timeScore: '09:77' },
      ],


    }),

  methods: {
   selectItem(item) {
	   console.log(item);
	   console.log('月間スコア');
      this.item = item;
      this.isOpen = true
    }
  }

  }
</script>
