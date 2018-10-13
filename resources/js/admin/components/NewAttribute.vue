<template>
    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
        <div class="text-muted mb-2">
            <small>Make sure to check the attribute checkbox to add the relevant attribute to the product.</small>
        </div>
        <div v-if="mode == 'edit'">
            <div class="mb-3" v-if="list.length > 0">
                <div class="border rounded mb-3" v-for="attribute in list">
                    <div class="attribute-title border-bottom p-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                            v-for="item in attributes"
                            :checked="item.id == attribute.id"
                            name="attrbs[]" :id="attribute.slug + attribute.id" :value="attribute.id">
                            <label class="custom-control-label" :for="attribute.slug + attribute.id">
                                <strong>{{ attribute.name }}</strong>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="attributes p-3">
                            <div class="row">
                                <div class="col-md-6" v-if="attribute.data.length > 0">
                                    <div class="custom-control custom-checkbox custom-control-inline mb-2" v-for="data in attribute.data">
                                        <input type="checkbox" class="custom-control-input"
                                        v-for="term in terms"
                                        :checked="term.id == data.id"
                                         name="data[]" :id="data.slug" :value="data.id">
                                        <label class="custom-control-label" :for="data.slug">
                                            {{ data.name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6" v-else>
                                    No terms found.
                                </div>
                                <div class="col-md-6">
                                    <h6 class="heading mb-3">
                                        Add new term
                                    </h6>
                                    <div class="form-group">
                                        <label>Term Name</label>
                                        <input type="text" class="form-control" v-model="adata.name" placeholder="Term Name">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" v-on:click="createAttributeData(attribute.id)" class="btn btn-outline-primary btn-sm">Add New Term</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2" v-else>
                No attributes found.
            </div>
        </div>
        <div v-else>
            <div class="mb-3 accordion" v-if="list.length > 0" id="attribute">
                <div class="border rounded mb-3" v-for="attribute in list">
                    <div class="attribute-title border-bottom p-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="attrbs[]" :id="attribute.slug + attribute.id" :value="attribute.id" data-toggle="collapse" :data-target="'#'+attribute.slug" aria-expanded="true" :aria-controls="attribute.slug">
                            <label class="custom-control-label" :for="attribute.slug + attribute.id">
                                <strong>{{ attribute.name }}</strong>
                            </label>
                        </div>
                    </div>
                    <div :id="attribute.slug" class="collapse" aria-labelledby="headingOne" data-parent="#attribute">
                        <div class="attributes p-3">
                            <div class="row">
                                <div class="col-md-6" v-if="attribute.data.length > 0">
                                    <div class="custom-control custom-checkbox custom-control-inline mb-2" v-for="data in attribute.data">
                                        <input type="checkbox" class="custom-control-input" name="data[]" :id="data.slug" :value="data.id">
                                        <label class="custom-control-label" :for="data.slug">
                                            {{ data.name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6" v-else>
                                    No terms found.
                                </div>
                                <div class="col-md-6">
                                    <h6 class="heading mb-3">
                                        Add new term
                                    </h6>
                                    <div class="form-group">
                                        <label>Term Name</label>
                                        <input type="text" class="form-control" v-model="adata.name" placeholder="Term Name">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" v-on:click="createAttributeData(attribute.id)" class="btn btn-outline-primary btn-sm">Add New Term</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2" v-else>
                No attributes found.
            </div>
        </div>
        <div class="mt-4">
            <a href="#" v-on:click.prevent="visibility()">
                <i class="fas fa-plus"></i> Add new attribute
            </a>
            <div v-if="errors.length > 0" class="mt-3">
                <div class="error" v-for="error in errors">
                    <small class="text-danger">{{ error.message }}</small>
                </div>
            </div>
            <div class="mt-3" v-if="visible">
                <div class="form-group">
                    <label>Attribute Name</label>
                    <input type="text" class="form-control" v-model="attribute.name" placeholder="Attribute Name">
                </div>
                <div class="form-group">
                    <button type="button" v-on:click="createAttribute()" v-show="!edit" class="btn btn-outline-primary btn-sm">Add New Attribute</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'attributes',
        'terms',
        'mode'
    ],
    data() {
        return  {
            errors: [],
            visible: false,
            edit: false,
            list: [],
            attribute: {
                name: ''
            },
            adata: {
                name: ''
            }
        }
    },
    mounted() {
        this.fetchAttributeList();
    },
    methods: {
        visibility: function() {
            if (this.visible == false) {
                this.visible = true;
            } else {
                this.visible = false;
            }
        },
        fetchAttributeList: function() {
            // console.log('Fetching Categorys...');
            axios.get('/api/attribute')
                .then((response) => {
                    // console.log(response.data);
                    this.list = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        createAttribute: function() {
            this.errors = [];
            // console.log('Creating attribute...');
            let self = this;
            let params = Object.assign({}, self.attribute);
            axios.post('/api/attribute/store', params)
                .then(function(){
                    self.attribute.name = '';
                    self.attribute.attrb_id = '';
                    self.edit = false;
                    self.fetchAttributeList();
                })
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors.push(error.response.data);
                    }
                });
        },
        createAttributeData: function(id) {
            this.errors = [];
            // console.log('Creating attribute...');
            let self = this;
            let params = Object.assign({}, self.adata);
            axios.post('/api/attribute/data/store/' + id, params)
                .then(function(){
                    self.adata.name = '';
                    self.edit = false;
                    self.fetchAttributeList();
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
