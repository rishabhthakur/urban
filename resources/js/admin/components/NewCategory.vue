<template lang="html">
    <div class="card-footer">
        <a href="{!! route('admin.products.categories') !!}">
            <i class="fas fa-plus"></i> Add new category
        </a>
        <div class="mt-4">
            <div class="form-group">
                <input type="text" name="cat_name" class="form-control form-control-sm" v-model="cat_name">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-outline-primary btn-sm">Add New Category</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    date() {
        return  {
            cat_name: ''
        }
    }
}
</script>
