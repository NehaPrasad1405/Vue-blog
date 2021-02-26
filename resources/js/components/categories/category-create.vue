<template>
<div>
<h1>{{isEditable? 'Edit Category' : 'Add Category'}}</h1>
<form @submit.prevent="addCategory">
  <div class="form-group">
    <label>&emsp;<b>Name:</b></label>
    <input type="text" v-model="category.name" class="form-control">
    <span class="text-danger" v-if="error.name">{{error.name[0]}}</span>
  </div>
  <div class="form-group">
    <label>&emsp;<b>Description:</b></label>
    <textarea type="text" v-model="category.description" class="form-control"></textarea>
    <span class="text-danger" v-if="error.description">{{error.description[0]}}</span>
  </div>
  <div class="text-right">
      <button type="submit" class="btn btn-info">Submit</button>&emsp;&emsp;&emsp;
  </div>
</form>
    </div>
</template>
<script>
export default{
        props : [ 'editCategory', 'isEditable' ],
    data(){
        return{
            category:{
                name : '',
                description: '',
            },
            error:'',
            success:'',
        }
    },
    watch:{
        editCategory: function(val){
            this.category=val
        }
    },
    methods:{
        addCategory() {
            let _this=this;
            axios({
                method: 'post',
                url: '/api/category/store',
                data : _this.category
            }).then(function (response) {
                _this.category = {
                    name: '',
                    description : '',
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