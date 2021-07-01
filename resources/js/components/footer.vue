<template>
		<!-- これがフッター -->
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
		<!-- フッターここまで -->
</template>


