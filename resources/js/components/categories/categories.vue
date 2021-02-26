<template>
<div class="container bg-lights">
<div class="row justify-content-center">
<form class="form-inline col-10" @submit.prevent="getCategories">
    <input class="form-control mr-sm-2" v-model="search.name" placeholder="Search by Name..">
    <input class="form-control mr-sm-2" v-model="search.description" placeholder="Search by Description..">
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
<div class="card-header bg-dark text-light">Category &nbsp;&nbsp;<small class="btn btn-info btn-sm" @click="CategoryForm = !CategoryForm;error='';category={'name':'','description':''}">+</small></div>
<div v-if="CategoryForm">
<category-create @refresh="onSuccess" :isEditable="isEditable" :editCategory="category"></category-create>
<br>
</div>
<table class="table table-hover">
  <thead>
    <tr class="bg-success">
      <th class="">ID</th>
      <th class="">Name</th>
      <th class="">Description</th>
      <th class="">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(category, index) in categories.data" :key=index>
        <td>{{categories.from + index}}</td>
        <td class="" @dblclick="searchOnClick('name',category.name)">{{category.name}}</td>
        <td class="" @dblclick="searchOnClick('description',category.description)">{{category.description}}</td>
        <td class="">
            <a href="#" class="btn btn-warning" @click="editCategory(category)">Edit</a>&nbsp;
            <a href="#" class="btn btn-danger" @click="deleteCategory(category.id)">Delete</a>
        </td>
    </tr>
  </tbody>
</table>
<div v-bind:class="[isActive ? 'se-pre-con' : 'no-js']"></div>
</div>
</div>
</div>
<br>
<pagination :paginationData="categories" @paginate="paginate"></pagination>
</div>

</template>

<script>
import categoryCreate from '../../components/categories/category-create'
import pagination from '../../components/pagination'
    export default {
        components : { categoryCreate , pagination},
        data() {
            return {
                category:{
                name : '',
                description: '',
                },
                isActive:false,
                CategoryForm:false,
                search:{
                    name : '',
                    description: '',
                },
                categories:[],
                success:'',
                danger:'',
                loader:'',
                isEditable:false
            }
        },
        created(){
        this.getCategories();
    },
    methods:{
        paginate(current_page)
        {
            this.categories.current_page=current_page;
            this.getCategories();
        },
        onSuccess(message){
            this.success=message;
            this.getCategories;
        },
        reset()
        {
            this.search.name="",
            this.search.description="",
            this.getCategories();
        },
        searchOnClick(key,value)
        {
            let _this=this;
            if(key==="name")
            {
            _this.search.name=value;
            }
            if(key==="description")
            {
            _this.search.description=value;
            }
            _this.getCategories();
        },
        editCategory(category)
        {
            this.CategoryForm=true,
            this.error=false,
            this.isEditable=true,
            this.category=category
        },
        
        getCategories(){
            let _this=this;
            _this.isActive=true;
            axios({
                method: 'get',
                url: '/api/categories/get?page='+this.categories.current_page
                    +'&name='+_this.search.name
                    +'&description='+_this.search.description,
            }).then(function (response) {
                _this.categories=response.data.categories
                _this.isActive=false;
                _this.CategoryForm=false;

            }).catch(function (error) {
                console.log(error);
            });
        },
        deleteCategory(key){
            let _this=this;
            axios({
                method: 'delete',
                url: '/api/category/delete/'+key,
            }).then(function (response) {
                 _this.getCategories();
                _this.danger=response.data.message;
                _this.success='';
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
    }
</script>
