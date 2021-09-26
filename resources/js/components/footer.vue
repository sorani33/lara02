<template>
		<!-- これがフッター -->
		<v-bottom-navigation app color="teal" grow>
			<v-btn :to="{ name: 'home' }">
				<span>PLAY</span>
				<v-icon>mdi-controller-classic-outline</v-icon>
			</v-btn>

			<v-btn :to="{ name: 'report' }">
				<span>成績板</span>
				<v-icon>mdi-trophy-outline </v-icon>
			</v-btn>

			<v-btn :to="{ name: 'mypage' }">
				<span>マイページ</span>
				<v-icon>mdi-account</v-icon>
			</v-btn>
		</v-bottom-navigation>
		<!-- フッターここまで -->
</template>


