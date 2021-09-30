<template>
		<!-- これがヘッダー -->
		<v-app-bar color="primary" dark app clipped-right>
			<v-toolbar-title>YouTube大学のあれ</v-toolbar-title>
                <div class="top-right links">
					<v-btn href="/login" icon small>
						ログイン{{Auth}}
					</v-btn>
                </div>	
		</v-app-bar>
		<!-- これがヘッダーここまで -->
</template>

