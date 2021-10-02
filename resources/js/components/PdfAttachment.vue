<template>
    <div v-loading="loading">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-sm btn-primary float-right mb-2" @click="showAddModal = true">+Add New PDF</button>
            </div>
        </div>

        <attachment-table
            :data.sync="attachments"
            @update="updatePdf"
            @pdf-deleted="removePdf"
        />

        <add-pdf-modal
            :show-modal="showAddModal"
            @close="showAddModal = false"
            @pdf-created="addToPdfList"
        />
    </div>
</template>

<script>
import {Loading} from "element-ui";
import AttachmentTable from "../partials/attachment/AttachmentTable";
import AddPdfModal from "../partials/attachment/AddPdfModal";

export default {
    name: "PdfAttachment",
    components: {
        AttachmentTable, AddPdfModal, Loading
    },
    data() {
        return {
            attachments: [],
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
            axios.get('/api/v1/attachments')
                .then(response => this.attachments = response.data.data)
                .catch(error => this.$showError(error.response.data.message))
                .finally(() => this.loading = false)
        },

        addToPdfList(attachment) {
            this.attachments.unshift(attachment)
        },

        updatePdf(data) {
            this.attachments.forEach((item, index) => {
                if (data.id === item.id) {
                    Object.assign(this.attachments[index], data)
                }
            })
        },

        removePdf(attachment) {
            this.attachments = this.attachments.filter(item => item.id !== attachment.id);
        }
    }
}
</script>

<style scoped>

</style>
