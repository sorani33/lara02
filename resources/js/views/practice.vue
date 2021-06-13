<template>
  <v-app>
    <v-container>
      <v-row>

        <v-col>
          <v-card class="mx-auto">
            <v-card-text>
              <p class="text--primary">
                問6. マケドニアが滅びる原因にもなった、アレクサンドロス大王の死に際に残した言葉はなんですか
              </p>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn-toggle borderless >
                <v-layout wrap >
                  <v-flex xs12 sm6 md3 v-for="answer in answers">
                   <v-btn class="mb-6 text-caption">{{answer.anstertext}}</v-btn>
                  </v-flex>
                </v-layout>
              </v-btn-toggle>
            </v-card-actions>
          </v-card>
        </v-col>

      </v-row>
    </v-container>
  </v-app>
</template>


<script>
export default {
  data(){
    return{
      answers:[
          { anstertext:'羊が何匹いるかは狼には関係なし'},
          { anstertext:'賽（さい）は投げられた'},
          { anstertext:'勇気のあるところに希望あり'},
          { anstertext:'後継者は最強のやつ'},
        ]
    }
  }
}
</script>