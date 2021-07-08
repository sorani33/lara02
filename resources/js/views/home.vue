
<template>
<v-app>
	<div id="nav">

		<h2>YouTube大学 入試対策講座</h2>
		<v-alert type="info" color="green">【new】 世界史2　世界史3　を追加しました！</v-alert>
		<br>
		<p>最近〇〇の記録が更新されました！</p><br>
		<v-btn @click="link = 'practice'">練習問題</v-btn>
		<v-btn @click="link = 'timeattack5'">タイムアタック７</v-btn>
		<br>
		<br>
		<v-row no-gutters>
		<v-col v-for="(title, index) in titles" :key="index" cols="12" sm="6">
			<v-card class="pa-2" outlined tile>
			<router-link :to="{ name: link, params: {id: index } }">{{title}}</router-link>
			</v-card>
		</v-col>
		</v-row>


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
      link: false,
    }
  },

}
</script>