
<template>
<v-app>
	<div id="nav">
<!--Comment
		<v-alert type="info" color="green">【new】 世界史2　世界史3　を追加しました！</v-alert>
 -->
		<br>
		<br>
		<br>
        <div v-for="(genreWithSubgenreData, ii) in genreWithSubgenreDatas">
			<v-row no-gutters v-for="(subGenreData, index) in genreWithSubgenreData.subgenres" :key="index">
				<v-col  cols="2">
				</v-col>
				<v-col  cols="6" class="text-left">
					<router-link :to="{ name: 'practice', params: {id: subGenreData.id } }" >{{subGenreData.name}}</router-link>
				</v-col>				
				<v-col  cols="1">
					<v-btn :to="{ name: 'practice', params: {id: subGenreData.id } }" elevation="2" icon small>
						<v-icon>mdi-controller-classic-outline </v-icon>
					</v-btn>
				</v-col>
				<v-col  cols="1">
					<v-btn :to="{ name: 'timeattack5', params: {id: subGenreData.id } }" elevation="2" icon small>
						<v-icon>mdi-clock-time-three-outline</v-icon>
					</v-btn>
				</v-col>
				<v-col  cols="1">
					<v-btn :href="subGenreData.url" target="_blank" rel="noopener noreferrer" icon small>
						<v-icon>mdi-youtube-tv</v-icon>
					</v-btn>
				</v-col>
				<v-col  cols="1">
				</v-col>
			</v-row>
		</div>
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
      },
      link: false,
      genreWithSubgenreDatas:[],
      authUser: false,

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
      axios.get('/api/home')
  	  .then((response) => {
        this.genreWithSubgenreDatas = response.data.genreWithSubgenreDatas;
		if(response.data.authUser){
          this.authUser = true;
        }

      })
    },
  }
}
</script>