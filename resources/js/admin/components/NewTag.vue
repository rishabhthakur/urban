<template lang="html">
    <div class="card">
        <div class="card-body">
            <h6 class="heading mb-3">Tags</h6>
            <div class="tegs" v-if="list.length > 0">
                <div class="custom-control custom-checkbox mb-1"  v-for="tag in list">
                    <input type="checkbox" class="custom-control-input" :id="tag.slug + tag.id" :value="tag.id" name="tags[]">
                    <label class="custom-control-label" :for="tag.slug + tag.id"> {{ tag.name }}</label>
                </div>
            </div>
            <span class="text-muted" v-else>
                No tags found.
            </span>
            <div v-if="errors.length > 0" class="mt-3">
                <div class="error" v-for="error in errors">
                    <small class="text-danger">{{ error.message }}</small>
                </div>
            </div>
        </div>
        <div class="card-footer border-0 bg-white">
            <a href="#" v-on:click.prevent="visibility()">
                <i class="fas fa-plus"></i> Add new tag
            </a>
            <div class="mt-4" v-if="visible">
                <div class="form-group">
                    <label>Tag Name</label>
                    <input type="text" class="form-control" v-model="tag.name" placeholder="Tag Name">
                </div>
                <div class="form-group">
                    <button type="button" v-on:click="createTag()" v-show="!edit" class="btn btn-outline-primary btn-sm">Add New Tag</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'to'
    ],
    data() {
        return  {
            errors: [],
            visible: false,
            edit: false,
            list: [],
            tag: {
                name: '',
                belongs_to: this.to
            }
        }
    },
    mounted() {
        // console.log('tag component...');
        this.fetchTagList();
        this.loading = false;
    },
    methods: {
        visibility: function() {
            if (this.visible == false) {
                this.visible = true;
            } else {
                this.visible = false;
            }
        },
        fetchTagList: function() {
            // console.log('Fetching tags...');
            axios.get('/api/tag/' + this.to)
                .then((response) => {
                    // console.log(response.data);
                    this.list = response.data;
                })
                .catch((response) => {
                    // console.log(response);
                });
        },
        createTag: function() {
            this.errors = [];
            // console.log('Creating tag...');
            let self = this;
            let params = Object.assign({}, self.tag);
            axios.post('/api/tag/store', params)
                .then(function() {
                    self.tag.name = '';
                    self.edit = false;
                    self.fetchTagList();
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
