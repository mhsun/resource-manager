<template>
    <div class="row">
        <table class="table table-sm">
            <thead>
            <tr class="bg-light">
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Code</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(snippet, index) in data" :key="index">
                <td>{{ snippet.title }}</td>
                <td>{{ snippet.description }}</td>
                <td><pre style="max-height: 200px; overflow: scroll" class="bg-light">{{ snippet.code }}</pre></td>
                <td>
                    <button class="btn" title="Edit"><i class="el-icon-edit text-warning" @click="selectForEdit(snippet)"></i></button>
                    <button class="btn" title="Delete"><i class="el-icon-delete text-danger" @click="selectForDelete(snippet)"></i></button>
                </td>
            </tr>
            <tr v-if="data.length < 1">No data found</tr>
            </tbody>
        </table>

        <edit-snippet-modal
            :show-modal="showEditModal"
            @close="showEditModal = false"
            :editable.sync="selectedSnippet"
            @snippet-updated="$emit('update', $event)"
        />
    </div>
</template>

<script>
import EditSnippetModal from "./EditSnippetModal";

export default {
    name: "SnippetTable",
    components: {
        EditSnippetModal
    },
    props: ['data'],
    data() {
        return {
            selectedSnippet: {},
            showEditModal: false
        }
    },
    methods: {
        selectForEdit(snippet) {
            this.selectedSnippet = snippet;
            this.showEditModal = true;
        },

        selectForDelete(snippet) {
            this.$showConfirmationAlert(
                'Delete snippet', 'Are you sure?', 'warning'
            ).then(response => {
                if (response.value) this.deleteLink(snippet);
            })
        },

        deleteLink(snippet) {
            axios.delete(`/api/v1/snippets/${snippet.id}`)
            .then(response => {
                this.$emit('snippet-deleted', snippet);
                this.$showSuccess("Snippet deleted successfully");
            })
            .catch(error => {
                this.$showError(error.response.data.message)
            })
        }
    }
}
</script>

<style scoped>

</style>
