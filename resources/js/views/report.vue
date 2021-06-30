<template>
  <v-card
    class="mx-auto"
    max-width="600"
    tile
  >
    <v-list flat>
      <v-subheader>REPORTS</v-subheader>
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

        <v-list-group
          :value="true"
          no-action
          sub-group
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>ヨーロッパ史</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="([title, icon], i) in admins"
            :key="i"
            link
          >
            <v-list-item-title v-text="title"></v-list-item-title>

            <v-list-item-icon>
              <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list-group>

        <v-list-group
          no-action
          sub-group
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>中東史</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="([title, icon], i) in cruds"
            :key="i"
            link
          >
            <v-list-item-title v-text="title"></v-list-item-title>

            <v-list-item-icon>
              <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list-group>
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
		  <div class="body-1 mb-1">自己ベスト　163</div>
      <br>
		  <div class="body-1 mb-1">1位　[A]クラウド　300</div>
		  <div class="body-1 mb-1">2位　[R]ティファ　220</div>
		  <div class="body-1 mb-1">3位　[F]土生翔吾(はぶっち)＠東京都　3</div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="isOpen = false"
          >
            I accept
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
      cruds: [
        ['Create', 'mdi-plus-outline'],
        ['Read', 'mdi-file-outline'],
        ['Update', 'mdi-update'],
        ['Delete', 'mdi-delete'],
      ],

      selectedItem: 1,
      items: [
        { text: '総合スコア', icon: 'mdi-clock' },
        { text: '月間スコア', icon: 'mdi-account' },
      ],
      item: '',
      isOpen: false,


    }),

  methods: {
   selectItem(item) {
	   console.log('月間スコア');
      this.item = item;
      this.isOpen = true
    }
  }

  }
</script>
