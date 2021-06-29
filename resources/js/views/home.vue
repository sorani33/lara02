
<template>
<v-app>
	<div id="nav">
		<v-app-bar color="primary" dark app clipped-left><!-- これがヘッダー -->
			<v-toolbar-title>YouTube大学のあれ</v-toolbar-title>
		</v-app-bar>
		<h2>YouTube大学 入試対策講座</h2>
		<v-alert type="info" color="green">【new】 世界史4　世界史5　を追加しましああた！</v-alert>
		<br>
		<p>最近〇〇さんがログインしました！</p><br>
		<p>ランキング</p><br>
		<v-btn >練習問題</v-btn>
		<v-btn >タイムアタック（ランダム5問）</v-btn>
			<router-link :to="{ name: 'mypage' }">マイページ</router-link>
			<router-link :to="{ name: 'report' }">成績板</router-link>
		<br>
		<br>

		<v-row no-gutters>
		<v-col v-for="(title, index) in titles" :key="index" cols="12" sm="6">
			<v-card class="pa-2" outlined tile>
			<router-link :to="{ name: 'practice', params: {id: index } }">{{title}}</router-link>
			<router-link :to="{ name: 'timeattack5', params: {id: index } }">タイムアタック</router-link>
			</v-card>
		</v-col>
		</v-row>

		<v-bottom-navigation app color="teal" grow>
			<v-btn>
				<router-link :to="{ name: 'home' }"><span>PLAY</span></router-link>
				<v-icon>mdi-history</v-icon>
			</v-btn>

			<v-btn>
				<router-link :to="{ name: 'report' }"><span>成績板</span></router-link>
				<v-icon>mdi-history</v-icon>
			</v-btn>

			<v-btn>
				<router-link :to="{ name: 'mypage' }"><span>マイページ</span></router-link>
				<v-icon>mdi-map-marker</v-icon>
			</v-btn>
		</v-bottom-navigation>
	</div>
</v-app>
</template>


<script>
export default {
  data(){
    return{
      titles:{
        1:"例題",
        2:"世界史1　ヨーロッパ史【2019版】",
        3:"世界史2　中東【2019版】",
        4:"世界史3　インド【2019版】",
        // 5:"世界史4　中国【2019版】",
        // 6:"世界史5　大航海【2019版】",
        // 3:"",
        // 4:"",
      },
    }
  },

}
</script>