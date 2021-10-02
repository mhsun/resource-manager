<template>
    <div class="row">
        <table class="table table-sm">
            <thead>
            <tr class="bg-light">
                <th scope="col">Title</th>
                <th scope="col">Url</th>
                <th scope="col">Open in new Tab</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(link, index) in data" :key="index">
                <td>{{ link.title }}</td>
                <td>{{ link.url }}</td>
                <td>
                    <span class="badge badge-success" v-if="link.new_tab">Yes</span>
                    <span class="badge badge-warning" v-else>No</span>
                </td>
                <td>
                    <button class="btn" title="Edit"><i class="el-icon-edit text-warning" @click="selectForEdit(link)"></i></button>
                    <button class="btn" title="Delete"><i class="el-icon-delete text-danger" @click="selectForDelete(link)"></i></button>
                </td>
            </tr>
            <tr v-if="data.length < 1">No data found</tr>
            </tbody>
        </table>

        <edit-link-modal
            :show-modal="showEditModal"
            @close="showEditModal = false"
            :editable.sync="selectedLink"
            @link-updated="$emit('update', $event)"
        />
    </div>
</template>

<script>
import EditLinkModal from "./EditLinkModal";

export default {
    name: "LinkTable",
    components: {
        EditLinkModal
    },
    props: ['data'],
    data() {
        return {
            selectedLink: {},
            showEditModal: false
        }
    },
    methods: {
        selectForEdit(link) {
            this.selectedLink = link;
            this.showEditModal = true;
        },

        selectForDelete(link) {
            this.$showConfirmationAlert(
                'Delete link', 'Are you sure?', 'warning'
            ).then(response => {
                if (response.value) this.deleteLink(link);
            })
        },

        deleteLink(link) {
            axios.delete(`/api/v1/links/${link.id}`)
            .then(response => {
                this.$emit('link-deleted', link);
                this.$showSuccess("Link deleted successfully");
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
