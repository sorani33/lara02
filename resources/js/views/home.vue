
<template>
<v-app>
	<div id="nav">
      <h3>PLAY</h3>

		<v-alert type="info" color="green">【new】 世界史2　世界史3　を追加しました！</v-alert>
		<br>
		<br>
		<br>
		<v-row no-gutters v-for="(subGenreData, index) in subGenreDatas" :key="index">
			<v-col  cols="2">
			</v-col>
			<v-col  cols="6" class="text-left">
				<router-link :to="{ name: 'practice', params: {id: subGenreData.id } }" >{{subGenreData.name}}</router-link>
			</v-col>
			<v-col  cols="1">
				<v-btn :href="subGenreData.url" target="_blank" rel="noopener noreferrer" icon small>
					<v-icon>mdi-youtube-tv</v-icon>
				</v-btn>
			</v-col>
			<v-col  cols="1">
				<v-btn :to="{ name: 'timeattack5', params: {id: subGenreData.id } }" elevation="2" icon small>
					<v-icon>mdi-clock-time-three-outline</v-icon>
				</v-btn>
			</v-col>
			<v-col  cols="2">
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
        1:"世界史1　ヨーロッパ史【2019版】",
        2:"世界史2　中東【2019版】",
        3:"世界史3　インド【2019版】",
        901:"例題",
        // 5:"世界史4　中国【2019版】",
        // 6:"世界史5　大航海【2019版】",
      },
      link: false,
      subGenreDatas:[],
    }
  },
  created: function () {
    this.getGenreDatas();
  },


  methods: {
    /**
     * getGenreDatas
     */
    getGenreDatas: function () {
      const questionId = this.$route.params.id; //routerからパラメータidを取得する。
	  console.log("例題");
      // axios.get('/api/examinationquestions/'+ questionId
      // ).then((response) => {

      axios.get('/api/home')
	  .then((response) => {
        this.subGenreDatas = response.data.subGenreDatas;

        // 返り値のKeyを元にしてdata()を作成する
        // var array = response.data.subGenreData;
        // var obj = {};
        // for (var key in array) {
        //   obj[key] = '';
        // }
        // this.$data.picked = obj; //dataに入れる。
      })
    },
  }



}
</script>