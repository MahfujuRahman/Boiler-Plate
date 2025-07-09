<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header py-2">
                        <all-page-header />
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table_responsive card_body_fixed_height">
                            <table class="table table-hover text-center table-bordered">
                                <thead>
                                    <table-head />
                                </thead>
                                <tbody v-if="all?.data?.length">
                                    <table-body :data="all?.data" />
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mx-3" v-if="typeof all == `object`">
                        <pagination :data="all" :get_data="get_all_data" :set_paginate="set_paginate"
                            :set_page="set_page" />
                    </div>
                    <div class="card-footer py-2">
                        <all-page-footer-actions></all-page-footer-actions>
                    </div>
                </div>
            </div>
        </div>
        <export-all-loader />
        <quick-view />
        <filter-data />
        <import-modal />
      

    </div>
</template>

<script>
/** plugins */
import { mapActions, mapState, mapWritableState } from 'pinia'
import setup from "../setup";
import { store as data_store } from "../store";

/** helper and actions */
import get_all_data from "../store/async_actions/all";

/** components */

import AllPageHeader from '../components/all_data_page/AllPageHeader.vue';
import TableHead from '../components/all_data_page/TableHead.vue';
import TableBody from '../components/all_data_page/TableBody.vue';
import AllPageFooterActions from '../components/all_data_page/AllPageFooterActions.vue';
import ExportAllLoader from '../components/all_data_page/ExportAllLoader.vue';
import QuickView from '../components/canvas/QuickView.vue';
import FilterData from '../components/canvas/FilterData.vue';
import ImportModal from '../components/all_data_page/ImportModal.vue';



export default {

    data: () => ({
        setup,
    }),
    created: async function () {
        this.reset_filter_criteria();
        this.paginate = 10;
        await this.get_all_data();
    },
    methods: {
        ...mapActions(data_store, [
            'set_page', // needs in pagination props
            'set_paginate', // needs in pagination props
            'reset_filter_criteria', // needs in pagination props
            'set_import_csv_modal_show',
        ]),
        get_all_data,
        async FileUploadHandler(event) {
            const formData = new FormData(event.target);
            try {
                // Add your import logic here
                console.log('Importing file...', formData.get('file'));
                // You can call an API action here
                // await this.import_data(formData);
                this.set_import_csv_modal_show(false);
                await this.get_all_data(); // Refresh data after import
            } catch (error) {
                console.error('Import failed:', error);
            }
        },
        export_demo_csv() {
            // Add your demo CSV export logic here
            console.log('Downloading demo CSV...');
            // You can call an API action here
            // this.download_demo_csv();
        },
    },
    computed: {
        ...mapWritableState(data_store, {
            all: 'all',
            paginate: 'paginate',
            import_csv_modal_show: 'import_csv_modal_show',
        })
    },
    components: {
        TableHead,
        TableBody,
        AllPageHeader,
        AllPageFooterActions,
        ExportAllLoader,
        QuickView,
        FilterData,
        ImportModal,
    },
}
</script>

<style></style>
