<template>
    <el-dialog
        title="Edit Snippet"
        :visible.sync="showModal"
        :before-close="closeModal"
        width="50%">
        <div>
            <el-form :model="formData" :rules="rules" ref="snippetUpdateForm" label-width="120px">
                <el-form-item label="Title" prop="title">
                    <input class="form-control" v-model="formData.title" style="width: 100%;"></input>
                </el-form-item>

                <el-form-item label="Description" prop="description">
                    <textarea class="form-control" v-model="formData.description" cols="50" rows="3"></textarea>
                </el-form-item>

                <el-form-item label="HTML Snippet" prop="code">
                    <textarea class="form-control" v-model="formData.code" cols="50" rows="5"></textarea>
                </el-form-item>

                <el-form-item>
                    <button class="btn btn-sm btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button class="btn btn-sm btn-primary" @click.prevent="submitForm('snippetUpdateForm')">Confirm
                    </button>
                </el-form-item>
            </el-form>
        </div>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Switch} from "element-ui";

export default {
    name: "EditSnippetModal",
    props: ['showModal', 'editable'],
    components: {
        ElDialog: Dialog, ElForm: Form, ElFormItem: FormItem, ElSwitch: Switch
    },
    data() {
        return {
            formData: {
                title: '',
                description: '',
                code: ''
            },
            rules: {
                title: [
                    {required: true, message: 'Please enter title here', trigger: 'blur'},
                    {min: 1, max: 150, message: 'Length should be maximum 150', trigger: 'blur'}
                ],
                description: [
                    {required: true, message: 'Please enter description here', trigger: 'blur'}
                ],
                code: [
                    {required: true, message: 'Please enter code here', trigger: 'blur'}
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
                    axios.patch(`/api/v1/snippets/${this.editable.id}`, this.formData)
                        .then(response => {
                            this.$emit('snippet-updated', response.data.data);
                            this.resetForm(formName);
                            this.closeModal();
                            this.$showSuccess(response.data.message)
                        })
                        .catch(error => {
                            this.closeModal();
                            this.$showError(error.response.data.message)
                        })
                } else {
                    this.$showError("Failed to submit data")
                }
            });
        },

        resetForm(formName) {
            this.$refs[formName].resetFields();
        }
    },
    watch: {
        'editable': {
            handler(data) {
                this.formData.title = data.title;
                this.formData.description = data.description;
                this.formData.code = data.code;
            }
        }
    }
}
</script>

<style scoped>

</style>
