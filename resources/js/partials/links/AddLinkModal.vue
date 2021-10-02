<template>
    <el-dialog
        title="Add New Link"
        :visible.sync="showModal"
        :before-close="closeModal"
        width="50%">
        <div>
            <el-form :model="formData" :rules="rules" ref="linkForm" label-width="120px">
                <el-form-item label="Title" prop="title">
                    <input class="form-control" v-model="formData.title" style="width: 100%;"></input>
                </el-form-item>

                <el-form-item label="Url" prop="url">
                    <input class="form-control" v-model="formData.url" style="width: 100%;"></input>
                </el-form-item>

                <el-form-item label="Open in new Tab" prop="new_tab">
                    <el-switch v-model="formData.new_tab"></el-switch>
                </el-form-item>

                <el-form-item>
                    <button class="btn btn-sm btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button class="btn btn-sm btn-primary" @click.prevent="submitForm('linkForm')">Add</button>
                </el-form-item>
            </el-form>
        </div>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Switch} from "element-ui";

export default {
    name: "AddLinkModal",
    props: ['showModal'],
    components: {
        ElDialog: Dialog, ElForm: Form, ElFormItem: FormItem, ElSwitch: Switch
    },
    data() {
        return {
            formData: {
                title: '',
                url: '',
                new_tab: false
            },
            rules: {
                title: [
                    {required: true, message: 'Please enter title here', trigger: 'blur'},
                    {min: 1, max: 150, message: 'Length should be maximum 150', trigger: 'blur'}
                ],
                url: [
                    {required: true, message: 'Please enter url here', trigger: 'blur'}
                ]
            }
        }
    },
    methods: {
        closeModal() {
            this.resetForm('linkForm');
            this.$emit('close', false);
        },

        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    axios.post('/api/v1/links', this.formData)
                    .then(response => {
                        this.$emit('link-created', response.data.data)
                        this.resetForm(formName);
                        this.closeModal();
                        this.$showSuccess(response.data.message)
                    })
                    .catch(error => {
                        this.resetForm(formName);
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
    }
}
</script>

<style scoped>

</style>
