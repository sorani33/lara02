<template>
		<!-- これがフッター -->
		<v-bottom-navigation app color="teal" grow>
			<v-btn :to="{ name: 'home' }">
				<span>PLAY</span>
				<v-icon>mdi-home</v-icon>
			</v-btn>

			<v-btn :to="{ name: 'report' }" >
				<span>成績板</span>
				<v-icon>mdi-trophy-outline </v-icon>
			</v-btn>

			<v-btn :to="{ name: 'mypage' }" >
				<span>マイページ</span>
				<v-icon>mdi-account</v-icon>
			</v-btn>
		</v-bottom-navigation>
		<!-- フッターここまで -->
</template>

<style>
[v-cloak] {
	display: none;
}
</style>

<script>

  export default {
    data: () => ({
      dialog: true, //ダイヤログはアクセス時に表示させる
      isActive: true,
    }),

	beforeCreate: function () {
		//ログインしていない時は、ボタンを非表示にする。
		axios.get('/api/home')
		.then((response) => {
			if(response.data.authUser){
				this.isActive = false;
			}
		})
	},

  }
</script>
