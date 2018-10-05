<template lang="html">
    <div class="card">
        <div class="card-body">
            <h6 class="heading mb-3">Categories</h6>
            <div class="py-2 mb-3" v-if="categories">
                <div>
                    <small>
                        <strong>This post is under:</strong>
                    </small>
                </div>
                <span v-for="item in categories">
                    <span class="badge badge-primary mr-1 mb-1">{{ item.name }}</span>
                </span>
            </div>
            <div class="mb-1" v-if="list.length > 0">
                <div class="parent" v-for="category in list">
                    <div class="custom-control custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" name="categories[]" :id="category.slug" :value="category.id">
                        <label class="custom-control-label" :for="category.slug">
                            <strong> {{ category.name }}</strong>
                         </label>
                    </div>
                    <div class="child pl-4 pt-1 pb-1">
                        <div class="custom-control custom-checkbox mb-1" v-for="child in category.children">
                            <input type="checkbox" class="custom-control-input" name="categories[]" :id="child.slug" :value="child.id">
                            <label class="custom-control-label" :for="child.slug">
                                {{ child.name }}
                             </label>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-muted" v-else>
                No categories found.
            </span>
            <div v-if="errors.length > 0" class="mt-3">
                <div class="error" v-for="error in errors">
                    <small class="text-danger">{{ error.message }}</small>
                </div>
            </div>
        </div>
        <div class="card-footer border-0 bg-white">
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
                    <select class="custom-select form-control" v-model="category.parent">
                        <option value="0">No parent</option>
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
    props: [
        'to',
        'categories'
    ],
    data() {
        return  {
            errors: [],
            visible: false,
            edit: false,
            list: [],
            category: {
                belongs_to: this.to,
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
            axios.get('/api/category/' + this.to)
                .then((response) => {
                    // console.log(response.data);
                    this.list = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        createCategory: function() {
            this.errors = [];
            // console.log('Creating category...');
            let self = this;
            let params = Object.assign({}, self.category);
            axios.post('/api/category/store', params)
                .then(function(){
                    self.category.name = '';
                    self.category.parent = '';
                    self.edit = false;
                    self.fetchCategoryList();
                })
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors.push(error.response.data);
                    }
                });
        }
    }
}
</script>
