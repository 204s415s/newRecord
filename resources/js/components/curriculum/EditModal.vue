<template>
  <div>
    <div @click.self="$emit('close')" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              Modal Title
            </h5>
            <a @click="$emit('close')" class="close">
              <span aria-hidden="true">&times;</span>
            </a>
          </div>
          <div class="modal-body">
              <button class="btn btn-orange" v-on:click="editMode" v-if="!edit">編集</button>
              <button class="btn btn-blue" v-on:click="edit=false" v-if="edit">取消</button>
            <form v-on:submit.prevent="editRecord">
                <div class="form-group row border-bottom">
                    <label for="recorded_at" class="col-sm-5 col-form-label">記録日</label>
                    <p class="col-sm-3 form-control-plaintext" readonly id="recorded_at">{{val.recorded_at}}</p>
                </div>
                <div class="form-group row border-bottom">
                    <label for="progress" class="col-sm-5 col-form-label">進捗</label>
                    <p v-if="!edit" class="col-sm-6 form-control-plaintext" readonly id="progress">{{val.progress}}</p>
                    <select v-if="edit && val.type == 1" class="col-sm-6 form-control pb-2" v-model="newRecord.progress">
                            <option v-for="section in sections" v-bind:value="section.value" >
                                {{ section.value }}
                            </option>
                    </select>
                    <input v-if="edit && val.type == 2" type="text" class="col-sm-6 form-control" v-model="newRecord.progress"/>
                </div>
                
                <div class="form-group row border-bottom" v-if="val.type == 2">
                    <label for="topical" class="col-sm-5 col-form-label">特筆事項</label>
                    <p v-if="!edit" type="text" class="col-sm-6 form-control-plaintext" readonly id="topical">{{val.topical}}</p>
                    <input v-if="edit" type="text" class="col-sm-6 form-control" v-model="newRecord.topical">
                </div>
                <div class="form-group" v-else>
                </div>
                
                <div class="form-group row border-bottom">
                    <label for="question" class="col-sm-5 col-form-label">質問</label>
                    <p v-if="!edit" type="text" class="col-sm-6 form-control-plaintext" readonly id="question">{{val.question}}</p>
                    <textarea-autosize v-if="edit" class="col-sm-6 form-control" v-model="newRecord.question"></textarea-autosize>
                </div>
                <div class="form-group row border-bottom">
                    <label for="aim" class="col-sm-5 col-form-label">目標</label>
                    <p v-if="!edit" type="text" class="white-space col-sm-6 form-control-plaintext" id="aim">{{val.aim}}</p>
                    <select v-if="edit && val.type == 1" class="col-sm-6 form-control pb-2" v-model="newRecord.aim">
                            <option v-for="section in sections" v-bind:value="section.value" >
                                {{ section.value }}
                            </option>
                    </select>
                    <input v-if="edit && val.type == 2" type="text" class="col-sm-6 form-control" v-model="newRecord.aim">
                </div>
               

                
            </form>
          </div>
          <div class="modal-footer">
                <button v-on:click="editRecord" class="btn btn-orange" v-if="edit">更新</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" />
  </div>
</template>

<style scoped>
  .modal{
    display: block;
  }
  
  .modal-backdrop {
    z-index: 10;
    background-color: rgba(0,0,0,0.50);
  }
</style>

<script>
    import sections from '../../datas/section.json';
    import MyForm from '../MyForm.vue';
    export default{
        components: {
            MyForm
        },
        props: {
            // studentId: {
            //     type: String
            // },
            val: {
                type: Object
            }
        },
        data: function() {
            return {
                newRecord: {
                    id: '',
                    progress: '',
                    topical: '',
                    question: '',
                    aim: ''
                },
                sections: sections,
                height: "60px",
                prev: '',
                btn: false,
                edit: false,
            }
        },
        methods: {
            editRecord() {
                if(this.val.type == 1) {
                    axios.put('/api/record/curriculum/' + this.newRecord.id, this.newRecord)
                        .then((res => {
                            this.$emit('close');
                        }))
                } else if (this.val.type == 2) {
                    axios.put('/api/record/project/' + this.newRecord.id, this.newRecord)
                        .then((res => {
                            this.$emit('close');
                        }))
                }
            },
            editMode() {
                this.edit = true;
                axios.get('/api/record/' + this.val.record_id)
                    .then((res) => {
                        console.log(res.data);
                        this.newRecord = res.data[0];
                    })
            }
        },
        mounted() {
            //this.showRecords();
        }
        
    };
</script>