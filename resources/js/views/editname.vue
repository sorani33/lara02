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
        <v-form v-on:submit.prevent="updateItem">
          <div v-show="" class="alert alert-danger">{{userdata}}</div>
          <div class="form-group">
            <label>名前</label>
            <input type="text" class="form-control" v-model="userdata.name" />
          </div>
          <div class="form-group">
            <label>クラス</label>
              <v-col class="form-control">
     <v-select
      v-model="selectedClass"
      item-text="label"
      item-value="value"
      :items="classname"
      label="所属クラス"
      return-object
    />
              </v-col>
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
        // items:{
        //   1:"あお",
        //   2:"いい",
        //   3:"うう",
        //   4:"ええ",
        // },
        // items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
      // selectedClass: { label: 'アリスカーナ'   , value: '3'  },
        selectedClass:{},
      classname: [
        { label: 'ラグナリオ'   , value: '1'  },
        { label: 'ウォルクス' , value: '2'    },
        { label: 'アリスカーナ' , value: '3'   },
        { label: 'フラーシア' , value: '4'   },
        { label: '未所属' , value: '5'   },
      ],


        drawer: true
      }
    },

    created: function () {
      // this.getUserDatas();
      // console.log(this.userdata);


        axios.get('/api/mypage/edit'
        ).then((response) => {
          this.userdata = response.data.userdata;
          // 効かない↓↓↓
          // this.selectedClass.label = this.classname[response.data.userdata.class_id-1].label;

          // 効かない↓↓↓
          // this.$set(this.selectedClass, 'label', this.classname[response.data.userdata.class_id-1].label)
          // this.$set(this.selectedClass, 'value', response.data.userdata.class_id)

          // ベタ書きは通る↓↓↓
          this.$set(this.selectedClass, 'label', 'フラーシア')
          this.$set(this.selectedClass, 'value', '4')

          // console.log('さいしょ');
          // console.log(this.classname[response.data.userdata.class_id-1].label);
          // console.log(response.data.userdata.class_id);

        })

// console.log('まつび');
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
        // this.userdata,this.selectedClass
          userdata:this.userdata,
          selectedClass:this.selectedClass,
      };

      axios.put(uri, senddata
      ).then(() => {
          console.log("おしたよ");
        // this.$swal({
        //   icon: "success",
        //   text: "Updated Success!"
        // });
        // this.$router.push({ name: "Index" });
      });
    }

    }
  }
</script>