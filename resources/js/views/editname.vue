<template>
  <v-app>

    <!-- ヘッダー -->
    <v-app-bar app clippedLeft flat dark color="indigo darken-3">
      <v-app-bar-nav-icon @click.stop="drawer=!drawer"></v-app-bar-nav-icon>
    </v-app-bar>

    <!-- メイン -->
    <v-main>
    <h1>プロフィール変更</h1>
      <v-container fluid>
        <v-form v-on:submit.prevent="updateItem" ref="test_form">
          <div v-show="" class="alert alert-danger">{{userdata}}</div>
          <div class="form-group">
        <v-text-field
          v-model="userdata.name"
          label="名前"
          :rules="[required, limit_length]"
          counter="20"
        >
        </v-text-field>
          </div>
          <div class="form-group">
     <v-select
      v-model="selectedClass"
      label="クラスを選択してください"
      item-text="label"
      item-value=""
      :rules="[required]"
      :items="classname"
      return-object
    />
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update Item" />
          </div>

        </v-form>

      </v-container>
    </v-main>

    <!-- フッター -->
    <v-footer app color="primary">
    </v-footer>
  </v-app>
</template>
<script>
  export default {
    name: 'app',
    data() {
      return {
        examinationQuestions:[],
        userdata: {},
        selectedClass:{ },
        classname: [
          { label: 'ラグナリオ'   , value: '1'  },
          { label: 'ウォルクス' , value: '2'    },
          { label: 'アリスカーナ' , value: '3'   },
          { label: 'フラーシア' , value: '4'   },
          { label: '未所属' , value: '5'   },
        ],
        drawer: true,
        value: '',
        required: value => !!value || "必ず入力してください", // 入力必須の制約
        limit_length: value => value.length <= 10 || "10文字以内で入力してください" // 文字数の制約
      }
    },

    created: function () {
        axios.get('/api/mypage/edit'
        ).then((response) => {
          this.userdata = response.data.userdata;
          // 効かない↓↓↓
          this.selectedClass.label = this.classname[response.data.userdata.class_id-1].label;

          // 効かない↓↓↓
          // this.$set(this.selectedClass, 'label', this.classname[response.data.userdata.class_id-1].label)
          // this.$set(this.selectedClass, 'value', response.data.userdata.class_id)

          // ベタ書きは通る↓↓↓
          // this.$set(this.selectedClass, 'label', 'フラーシア')
          // this.$set(this.selectedClass, 'value', '4')

        })

    },

    methods: {
      /**
      * getUserDatas
      */
      getUserDatas: function () {
        axios.get('/api/mypage/edit'
        ).then((response) => {
          this.userdata = response.data.userdata;
        })
      },

    updateItem: function () {
      let uri = "/api/mypage/edit/";
      let senddata = {
        userdata:this.userdata,
        selectedClass:this.selectedClass,
      };

      if(this.$refs.test_form.validate()){
        axios.put(uri, senddata
        ).then(() => {
          window.location.href = '/mypage';
        });
      }

    }

    }
  }
</script>