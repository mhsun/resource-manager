<template>
    <div v-loading="loading">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-sm btn-primary float-right mb-2" @click="showAddModal = true">+Add New Snippet</button>
            </div>
        </div>

        <snippet-table
            :data.sync="snippets"
            @update="updateSnippet"
            @snippet-deleted="removeSnippet"
        />

        <add-snippet-modal
            :show-modal="showAddModal"
            @close="showAddModal = false"
            @snippet-created="addToSnippets"
        />
    </div>
</template>

<script>
import SnippetTable from "../partials/snippets/SnippetTable";
import AddSnippetModal from "../partials/snippets/AddSnippetModal";
import {Loading} from "element-ui";

export default {
    name: "HtmlSnippet",
    components: {
        SnippetTable, AddSnippetModal, Loading
    },
    data() {
        return {
            snippets: [],
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
            axios.get('/api/v1/snippets')
                .then(response => this.snippets = response.data.data)
                .catch(error => this.$showError(error.response.data.message))
                .finally(() => this.loading = false)
        },

        addToSnippets(snippet) {
            this.snippets.unshift(snippet)
        },

        updateSnippet(data) {
            this.snippets.forEach((item, index) => {
                if (data.id === item.id) {
                    Object.assign(this.snippets[index], data)
                }
            })
        },

        removeSnippet(snippet) {
            this.snippets = this.snippets.filter(item => item.id !== snippet.id);
        }
    }
}
</script>

<style scoped>

</style>
