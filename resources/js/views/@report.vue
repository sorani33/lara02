<template>

  <v-container class="grey lighten-5">
    <p class="font-weight-black"> 成績板</p>
	<v-divider></v-divider>
	<br>
    <v-row
      :class="n === 1 ? 'mb-6' : ''"
      no-gutters
    >
      <v-col :key="1">
        <v-card class="pa-2" outlinedtile shaped >
		  <v-card-title class="headline">総合スコア　自己ベスト　140</v-card-title>
		<v-divider class="mx-3"></v-divider>
		<v-card-text>
		  <div class="body-1 mb-1">1位　[A]クラウド　300</div>
		  <div class="body-1 mb-1">2位　[R]ティファ　220</div>
		  <div class="body-1 mb-1">3位　[F]土生翔吾(はぶっち)＠東京都　3</div>
		</v-card-text>
        </v-card>
      </v-col>
    </v-row>

      <v-col :key="2">
        <v-card class="pa-2" outlinedtile shaped >
		  <v-card-title class="headline">月間スコア　自己ベスト　140</v-card-title>
		<v-divider class="mx-3"></v-divider>
		<v-card-text>
		  <div class="body-1 mb-1">1位　クラウド　300</div>
		  <div class="body-1 mb-1">2位　ティファ　220</div>
		  <div class="body-1 mb-1">3位　バレット　60</div>
		</v-card-text>
        </v-card>
      </v-col>
    </v-row>


	<br>
    <p class="text-h1">▼タイムアタック</p>
    <p class="font-weight-black">▼世界史【2019】</p>
    <v-row>
      <v-col>
        <v-card class="pa-2" outlinedtile shaped >
		  <v-card-title class="headline">ヨーロッパ史</v-card-title>
		  <v-card-subtitle>自己ベスト　140</v-card-subtitle>
		<v-divider class="mx-3"></v-divider>
		<v-card-text>
		  <div class="body-1 mb-1">1位　クラウド　300</div>
		  <div class="body-1 mb-1">2位　ティファ　220</div>
		  <div class="body-1 mb-1">3位　バレット　60</div>
		</v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-card class="pa-2" outlinedtile shaped >
		  <v-card-title class="headline">中東史</v-card-title>
		  <v-card-subtitle>自己ベスト　140</v-card-subtitle>
		<v-divider class="mx-3"></v-divider>
		<v-card-text>
		  <div class="body-1 mb-1">1位　クラウド　300</div>
		  <div class="body-1 mb-1">2位　ティファ　220</div>
		  <div class="body-1 mb-1">3位　バレット　60</div>
		</v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-card class="pa-2" outlinedtile shaped >
		  <v-card-title class="headline">インド史</v-card-title>
		  <v-card-subtitle>自己ベスト　140</v-card-subtitle>
		<v-divider class="mx-3"></v-divider>
		<v-simple-table dense>
			<template v-slot:default>
			<tbody>
				<tr v-for="item in desserts" :key="item.name">
				<td>{{ item.name }}</td>
				<td>{{ item.calories }}</td>
				</tr>
			</tbody>
			</template>
		</v-simple-table>
        </v-card>
      </v-col>
    </v-row>




  </v-container>
</template>



<script>
export default {
  data(){
    return{
      n:1,
        desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
          },
          {
            name: 'Eclair',
            calories: 262,
          },
		],

      titles:{
        // 1:"例題",
        // 2:"世界史1　ヨーロッパ史【2019版】",
        // 3:"世界史2　中東【2019版】",
        // 4:"世界史3　インド【2019版】",
        // 5:"世界史4　中国【2019版】",
        // 6:"世界史5　大航海【2019版】",
        // 3:"",
        // 4:"",
      },
    }
  },

}
</script>
