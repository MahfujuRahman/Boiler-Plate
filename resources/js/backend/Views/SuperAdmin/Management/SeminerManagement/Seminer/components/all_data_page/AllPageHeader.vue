<template>
    <div class="row align-items-center">
        <!-- Title Section -->
        <div class="col-12 col-md-3 mb-2 mb-md-0">
            <h5 class="text-capitalize mb-0">
                {{ setup.all_page_title }}
            </h5>
        </div>

        <!-- Search Input -->
        <div class="col-12 col-md-6 mb-2 mb-md-0">
            <input class="form-control" @keyup="(e) => set_search_key(e)" placeholder="Search" />
        </div>

        <!-- Sorting Button -->
        <div class="col-12 col-md-3 text-md-right text-sm-left">
            <button class="btn btn-outline-success btn-sm" @click="set_show_filter_canvas">
                <i class="fa fa-gear mx-2"></i>Filter
            </button>
        </div>
    </div>
</template>
<script>
import Search from './Search.vue';
import setup from '../../setup';
import { mapActions } from 'pinia';
import { store } from '../../store';
export default {
    components: { Search },
    data: () => ({
        setup,
    }),
    methods: {
        ...mapActions(store, ['set_show_filter_canvas'])
    }
}
</script>
<style lang="">

</style>
