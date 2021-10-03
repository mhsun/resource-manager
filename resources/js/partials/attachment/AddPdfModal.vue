<template>
    <el-dialog
        title="Add New PDF"
        :visible.sync="showModal"
        :before-close="closeModal"
        width="50%">
        <div>
            <el-form :model="formData" :rules="rules" ref="attachmentForm" label-width="120px">
                <el-form-item label="Title" prop="title">
                    <input class="form-control" v-model="formData.title" style="width: 100%;"></input>
                </el-form-item>

                <el-form-item label="File" prop="file">
                    <input
                        class="form-control"
                        type="file"
                        accept="application/pdf"
                        @change="uploadFile"
                        ref="pdf"
                    >
                    <p class="text-danger" v-if="fileError !== ''">{{ fileError }}</p>
                </el-form-item>

                <el-form-item>
                    <button class="btn btn-sm btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button class="btn btn-sm btn-primary" @click.prevent="submitForm('attachmentForm')">Add</button>
                </el-form-item>
            </el-form>
        </div>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Switch} from "element-ui";

export default {
    name: "AddPdfModal",
    props: ['showModal'],
    components: {
        ElDialog: Dialog, ElForm: Form, ElFormItem: FormItem, ElSwitch: Switch
    },
    data() {
        return {
            formData: {
                title: ''
            },
            file: '',
            fileError: '',
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
            this.resetForm('attachmentForm');
            this.$emit('close', false);
        },

        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    if (!this.file) {
                        this.fileError = "Select a file first";
                    } else {
                        let payload = new FormData();
                        payload.append('title', this.formData.title);
                        payload.append('file', this.file);

                        axios.post('/api/v1/attachments', payload, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                            .then(response => {
                                this.$emit('pdf-created', response.data.data)
                                this.resetForm(formName);
                                this.closeModal();
                                this.$showSuccess(response.data.message)
                            })
                            .catch(error => {
                                this.closeModal();
                                this.$showError(this.$filterErrorMessageFrom(error));
                            })
                    }
                } else {
                    if (!this.file) {
                        this.fileError = "Select a file first";
                    }
                }
            });
        },

        resetForm(formName) {
            this.$refs.pdf.value = null;
            this.$refs[formName].resetFields();
        },

        uploadFile() {
            this.file = this.$refs.pdf.files[0];
            this.fileError = "";
        }
    }
}
</script>

<style scoped>

</style>
