<template>
    <div class="row">
        <table class="table table-sm">
            <thead>
            <tr class="bg-light">
                <th scope="col">Title</th>
                <th scope="col">File</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(pdf, index) in data" :key="index">
                <td>{{ pdf.title }}</td>
                <td>
                    <a :href="`/api/v1/attachments/${pdf.id}`" class="p-1 mt-2  mr-1">
                        Download to View
                    </a>
                </td>
                <td>
                    <button class="btn" title="Edit"><i class="el-icon-edit text-warning" @click="selectForEdit(pdf)"></i></button>
                    <button class="btn" title="Delete"><i class="el-icon-delete text-danger" @click="selectForDelete(pdf)"></i></button>
                </td>
            </tr>
            <tr v-if="data.length < 1">No data found</tr>
            </tbody>
        </table>

        <edit-attachment-modal
            :show-modal="showEditModal"
            @close="showEditModal = false"
            :editable.sync="selectedPdf"
            @pdf-updated="$emit('update', $event)"
        />
    </div>
</template>

<script>
import EditAttachmentModal from "./EditAttachmentModal";

export default {
    name: "AttachmentTable",
    components: {
        EditAttachmentModal
    },
    props: ['data'],
    data() {
        return {
            selectedPdf: {},
            showEditModal: false
        }
    },
    methods: {
        selectForEdit(pdf) {
            this.selectedPdf = pdf;
            this.showEditModal = true;
        },

        selectForDelete(pdf) {
            this.$showConfirmationAlert(
                'Delete pdf', 'Are you sure?', 'warning'
            ).then(response => {
                if (response.value) this.deleteLink(pdf);
            })
        },

        deleteLink(pdf) {
            axios.delete(`/api/v1/attachments/${pdf.id}`)
                .then(response => {
                    this.$emit('pdf-deleted', pdf);
                    this.$showSuccess("PDF deleted successfully");
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
