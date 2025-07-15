<template>
    <div class="row align-items-center">
        <!-- Title Section -->
        <div class="col-12 col-md-3 mb-2 mb-md-0">
            <h5 class="text-capitalize mb-0">
                {{ setup.all_page_title }} ({{ status }})
            </h5>
        </div>


        <!-- Search Input -->
        <div class="col-12 col-md-6 mb-2 mb-md-0">
            <input class="form-control" @keyup="(e) => set_search_key(e)" placeholder="Search" />
        </div>

        <!-- Sorting Button -->
        <div class="col-12 col-md-3 text-md-right text-sm-left">
            <button class="btn btn-outline-warning btn-sm mr-2" @click="reset_filters" title="Reload">
                <i class="fa fa-refresh"></i>
            </button>
            <button class="btn btn-outline-success btn-sm" @click="set_show_filter_canvas">
                <i class="fa fa-gear mx-2"></i>Filter
            </button>

        </div>


    </div>
</template>
<script>
import Search from './Search.vue';
import setup from '../../setup';
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../store';
import debounce from '../../helpers/debounce';
export default {
    components: { Search },
    data: () => ({
        setup,
    }),
    methods: {
        ...mapActions(store, ['set_show_filter_canvas', 'get_all','reset_filter_criteria']),
        set_search_key: debounce(async function (event) {
            let value = event.target.value;
            this.search_key = value;

            this.only_latest_data = true;
            await this.get_all();
            this.only_latest_data = false;
        }, 500),
        async reset_filters() {
            this.reset_filter_criteria();
            await this.get_all();
        },
    },
    computed: {
        ...mapWritableState(store, [
            'search_key',
            'only_latest_data',
            'status',
            
        ])
    }
}
</script>
<style lang="">

</style>
