<template>
<div>
<h1>{{isEditable? 'Edit Tag' : 'Add Tag'}}</h1>
<form @submit.prevent="addTag">
  <div class="form-group">
    <label>&emsp;<b>Name:</b></label>
    <input type="text" v-model="tag.name" class="form-control">
    <span class="text-danger" v-if="error.name">{{error.name[0]}}</span>
  </div>
  <div class="text-right">
      <button type="submit" class="btn btn-info">Submit</button>&emsp;&emsp;&emsp;
  </div>
</form>
    </div>
</template>
<script>
export default{
        props : [ 'edittag', 'isEditable' ],
    data(){
        return{
            tag:{
                name : '',
            },
            error:'',
            success:'',
        }
    },
    watch:{
        edittag: function(val){
            this.tag=val
        }
    },
    methods:{
        addTag() {
            let _this=this;
            axios({
                method: 'post',
                url: '/api/tag/store',
                data : _this.tag
            }).then(function (response) {
                _this.tag = {
                    name: '',
                }
                _this.$emit('refresh',response.data.message);
                _this.success=response.data.message;
                _this.danger='';

            }).catch(function (error) {
                _this.error=error.response.data.errors
            });
        },
    }
}
</script>