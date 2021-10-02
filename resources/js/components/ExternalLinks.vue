<template>
    <div v-loading="loading">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-sm btn-primary float-right mb-2" @click="showAddModal = true">+Add New Link</button>
            </div>
        </div>

        <link-table
            :data.sync="links"
            @update="updateLinkData"
            @link-deleted="removeLink"
        />

        <add-link-modal
            :show-modal="showAddModal"
            @close="showAddModal = false"
            @link-created="addToLinks"
        />
    </div>
</template>

<script>
import LinkTable from "../partials/links/LinkTable";
import AddLinkModal from "../partials/links/AddLinkModal";
import {Loading} from "element-ui";

export default {
    name: "ExternalLinks",
    components: {
        LinkTable, AddLinkModal, Loading
    },
    data() {
        return {
            links: [],
            showAddModal: false,
            loading: false
        }
    },
    created() {
        this.getAllLinks();
    },
    methods: {
        getAllLinks() {
            this.loading = true;
            axios.get('/api/v1/links')
                .then(response => this.links = response.data.data)
                .catch(error => this.$showError(error.response.data.message))
                .finally(() => this.loading = false)
        },

        addToLinks(link) {
            this.links.unshift(link)
        },

        updateLinkData(data) {
            this.links.forEach((item, index) => {
                if (data.id === item.id) {
                    Object.assign(this.links[index], data)
                }
            })
        },

        removeLink(link) {
            this.links = this.links.filter(item => item.id !== link.id);
        }
    }
}
</script>

<style scoped>

</style>
