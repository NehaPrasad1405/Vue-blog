<template>
<div class="container bg-lights">
<div class="row justify-content-center">
<form class="form-inline col-10" @submit.prevent="getTags">
    <input class="form-control mr-sm-2" v-model="search.name" placeholder="Search by Name..">
    <button class="btn btn-outline-success my-2" type="submit">Search</button>&nbsp;&nbsp;
    <button class="btn btn-outline-danger my-2" @click="reset();">Reset</button>
</form>
<div class="col-10"> 
 <div class="alert alert-success" role="alert" v-if="success">
{{success}}
</div>
<div class="alert alert-danger" role="alert" v-if="danger">
{{danger}}
</div>
<div class="card">
<div class="card-header bg-dark text-light">Tags &nbsp;&nbsp;<small class="btn btn-info btn-sm" @click="TagForm = !TagForm;error='';tag={'name':''}">+</small></div>
<div v-if="TagForm">
<tag-create @refresh="onSuccess" :isEditable="isEditable" :edittag="tag"></tag-create>
<br>
</div>
<table class="table table-hover">
  <thead>
    <tr class="bg-success">
      <th class="">ID</th>
      <th class="">Name</th>
      <th class="">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(tag, index) in tags.data" :key=index>
        <td>{{tags.from + index}}</td>
        <td class="" @dblclick="searchOnClick('name',tag.name)">{{tag.name}}</td>
        <td class="">
            <a href="#" class="btn btn-warning" @click="edittag(tag)">Edit</a>&nbsp;
            <a href="#" class="btn btn-danger" @click="confirmDelete(tag.id)">Delete</a>
        </td>
    </tr>
  </tbody>
</table>
<div v-bind:class="[isActive ? 'se-pre-con' : 'no-js']"></div>
</div>
</div>
</div>
<br>
<pagination :paginationData="tags" @paginate="paginate"></pagination>
<confirmation v-if="showDeleteConfirmation" :show="true" @confirmDelete="deleteItem"></confirmation>
</div>
</template>

<script>
import tagCreate from '../../components/tags/tag-create'
import pagination from '../../components/pagination'
    export default {
        components : { tagCreate , pagination },
        data() {
            return {
                tag:{
                name : '',
                },
                isActive:false,
                TagForm:false,
                search:{
                    name : '',
                },
                tags:[],
                success:'',
                danger:'',
                loader:'',
                isEditable:false,
                showDeleteConfirmation:false,
                tag_id:''
            }
        },
        created(){
        this.getTags();
    },
    methods:{
        paginate(current_page)
        {
            this.tags.current_page=current_page;
            this.getTags();
        },
        onSuccess(message){
            this.success=message;
            this.getTags();
        },
        reset()
        {
            this.search.name="",
            this.getTags();
        },
        searchOnClick(key,value)
        {
            let _this=this;
            if(key==="name")
            {
            _this.search.name=value;
            }
            _this.getTags();
        },
        edittag(tag)
        {
            this.TagForm=true,
            this.error=false,
            this.isEditable=true,
            this.tag=tag
        },
        
        getTags(){
            let _this=this;
            _this.isActive=true;
            axios({
                method: 'get',
                url: '/api/tags/get?page=' + this.tags.current_page
                    +'&name='+_this.search.name,
            }).then(function (response) {
                _this.tags=response.data.tags
                _this.isActive=false;
                _this.TagForm=false;

            }).catch(function (error) {
                console.log(error);
            });
        },
        confirmDelete(key){
            let _this=this;
            _this.tag_id=key;
            _this.showDeleteConfirmation=true;
        },
        deleteItem(){
            let _this=this;
            axios({
                method: 'delete',
                url: '/api/tag/delete/'+_this.tag_id,
            }).then(function (response) {
                _this.showDeleteConfirmation=false;
                _this.danger=response.data.message;
                _this.success='';
                _this.getTags();
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
    }
</script>
