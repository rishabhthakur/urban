<template lang="html">
    <div class="card">
        <div class="card-body">
            <h6 class="heading mb-3">Product Categories</h6>
            <div class="mb-1" v-if="list.length > 0">
                <div class="parent" v-for="category in list">
                    <div class="custom-control custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" name="categories[]" :id="category.id" :value="category.id">
                        <label class="custom-control-label" :for="category.id">
                            <strong> {{ category.name }}</strong>
                         </label>
                    </div>
                    <div class="child pl-4 pt-1 pb-1">
                        <div class="custom-control custom-checkbox mb-1" v-for="child in category.children">
                            <input type="checkbox" class="custom-control-input" name="categories[]" :id="child.id" :value="child.id">
                            <label class="custom-control-label" :for="child.id">
                                {{ child.name }}
                             </label>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-muted" v-else>
                No categories found.
            </span>
        </div>
        <div class="card-footer">
            <a href="#" v-on:click.prevent="visibility()">
                <i class="fas fa-plus"></i> Add new category
            </a>
            <div class="mt-4" v-if="visible">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" v-model="category.name" placeholder="Category Name">
                </div>
                <div class="form-group">
                    <label>Category Parent (Optional)</label>
                    <select class="custom-select" v-model="category.parent">
                        <option selected>No parent</option>
                        <option v-for="category in list" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="button" v-on:click="createCategory()" v-show="!edit" class="btn btn-outline-primary btn-sm">Add New Category</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return  {
            visible: false,
            edit: false,
            list: [],
            category: {
                name: '',
                parent: ''
            }
        }
    },
    mounted() {
        // console.log('Category component...');
        this.fetchCategoryList();
    },
    methods: {
        visibility: function() {
            if (this.visible == false) {
                this.visible = true;
            } else {
                this.visible = false;
            }
        },
        fetchCategoryList: function() {
            // console.log('Fetching Categorys...');
            axios.get('http://urb.an/api/category')
                .then((response) => {
                    // console.log(response.data);
                    this.list = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        createCategory: function() {
            // console.log('Creating category...');
            let self = this;
            let params =Object.assign({}, self.category);
            axios.post('http://urb.an/api/category/store', params)
                .then(function(){
                    self.category.name = '';
                    self.category.parent = '';
                    self.edit = false;
                    self.fetchCategoryList();
                })
                .catch(function(error){
                    console.log(error);
                });
        }
    }
}
</script>
