<template>
    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
        <div class="mb-1" v-if="list.length > 0">
            <div class="border rounded mb-2" v-for="attribute in list">
                <div class="attribute-title border-bottom p-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="attrbs[]" :id="attribute.slug" :value="attribute.id">
                        <label class="custom-control-label" :for="attribute.slug">
                            <strong>{{ attribute.name }}</strong>
                        </label>
                    </div>
                </div>
                <div v-if="attribute.data.length > 0">
                    <div class="attributes p-3" v-for="data in attribute.data">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="data[]" :id="data.slug" :value="data.id">
                            <label class="custom-control-label" :for="data.slug">
                                {{ data.name }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-1" v-else>
                    No attribute data found.
                </div>
            </div>
        </div>
        <div class="mb-2" v-else>
            No attributes found.
        </div>
        <div class="mt-4">
            <a href="#">
                <i class="fas fa-plus"></i> Add new attribute
            </a>
        </div>
        <div class="text-muted mt-2">
            <small>Attribute must be selected in order for child attributes to be registered.</small>
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
            attribute: {
                name: '',
                attrb_id: ''
            }
        }
    },
    mounted() {
        // console.log('Category component...');
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
            axios.get('/api/attribute/' + this.to)
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
        }
    }
}
</script>
