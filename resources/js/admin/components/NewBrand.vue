<template>
    <div class="card">
        <div class="card-body">
            <h6 class="heading mb-3">Product Brand</h6>
            <select id="brand" class="custom-select form-control" name="brand" v-if="list.length > 0">
                <option :value="brand.id" v-for="brand in list">{{ brand.name }}</option>
            </select>
            <span class="text-muted" v-else>No brands found.</span>
        </div>
        <div class="card-footer bg-white border-0">
            <a href="#" v-on:click.prevent="visibility()">
                <i class="fas fa-plus"></i> Add new brand
            </a>
            <div class="mt-4" v-if="visible">
                <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" class="form-control" v-model="brand.name" placeholder="Brand Name">
                </div>
                <div class="form-group">
                    <button type="button" v-on:click="createBrand()" v-show="!edit" class="btn btn-outline-primary btn-sm">Add New Brand</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return  {
            errors: [],
            visible: false,
            edit: false,
            list: [],
            brand: {
                name: ''
            }
        }
    },
    mounted() {
        // console.log('Brand component...');
        this.fetchBrandList();
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
        fetchBrandList: function() {
            // console.log('Fetching Brands...');
            axios.get('http://urb.an/api/brand')
                .then((response) => {
                    // console.log(response.data);
                    this.list = response.data;
                })
                .catch((response) => {
                    // console.log(response);
                });
        },
        createBrand: function() {
            this.errors = [];
            // console.log('Creating Brand...');
            let self = this;
            let params = Object.assign({}, self.brand);
            axios.post('http://urb.an/api/brand/store', params)
                .then(function() {
                    self.brand.name = '';
                    self.edit = false;
                    self.fetchBrandList();
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
