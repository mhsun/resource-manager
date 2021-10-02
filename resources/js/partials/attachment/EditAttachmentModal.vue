<template>
    <el-dialog
        title="Edit PDF"
        :visible.sync="showModal"
        :before-close="closeModal"
        width="50%">
        <div>
            <el-form :model="formData" :rules="rules" ref="pdfUpdateForm" label-width="120px">
                <el-form-item label="Title" prop="title">
                    <input class="form-control" v-model="formData.title" style="width: 100%;"></input>
                </el-form-item>

                <el-form-item label="File" prop="file">
                    <input
                        class="form-control"
                        type="file"
                        @change="uploadFile"
                        ref="pdf"
                    >
                </el-form-item>

                <el-form-item>
                    <button class="btn btn-sm btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button class="btn btn-sm btn-primary" @click.prevent="submitForm('pdfUpdateForm')">Confirm
                    </button>
                </el-form-item>
            </el-form>
        </div>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Switch} from "element-ui";

export default {
    name: "EditAttachmentModal",
    props: ['showModal', 'editable'],
    components: {
        ElDialog: Dialog, ElForm: Form, ElFormItem: FormItem, ElSwitch: Switch
    },
    data() {
        return {
            formData: {
                title: ''
            },
            file: '',
            rules: {
                title: [
                    {required: true, message: 'Please enter title here', trigger: 'blur'},
                    {min: 1, max: 150, message: 'Length should be maximum 150', trigger: 'blur'}
                ]
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close', false);
        },

        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    let payload = new FormData();
                    payload.append('title', this.formData.title);

                    if (this.file) payload.append('file', this.file);

                    axios.post(`/api/v1/attachments/${this.editable.id}?_method=PATCH`, payload, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(response => {
                            this.$emit('pdf-updated', response.data.data);
                            this.resetForm(formName);
                            this.closeModal();
                            this.$showSuccess(response.data.message)
                        })
                        .catch(error => this.$showError(error.response.data.message))
                } else {
                    this.$showError("Failed to submit data")
                }
            });
        },

        resetForm(formName) {
            this.$refs[formName].resetFields();
        },

        uploadFile() {
            this.file = this.$refs.pdf.files[0];
        }
    },
    watch: {
        'editable': {
            handler(data) {
                this.formData.title = data.title;
            }
        }
    }
}
</script>

<style scoped>

</style>
