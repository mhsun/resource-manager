<template>
    <el-dialog
        title="Edit Link"
        :visible.sync="showModal"
        :before-close="closeModal"
        width="50%">
        <div>
            <el-form :model="formData" :rules="rules" ref="linkUpdateForm" label-width="120px">
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
                    <button class="btn btn-sm btn-primary" @click.prevent="submitForm('linkUpdateForm')">Confirm
                    </button>
                </el-form-item>
            </el-form>
        </div>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Switch} from "element-ui";

export default {
    name: "EditLinkModal",
    props: ['showModal', 'editable'],
    components: {
        ElDialog: Dialog, ElForm: Form, ElFormItem: FormItem, ElSwitch: Switch
    },
    data() {
        return {
            formData: {
                title: '',
                url: '',
                new_tab: ''
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
            this.$emit('close', false);
        },

        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    axios.patch(`/api/v1/links/${this.editable.id}`, this.formData)
                        .then(response => {
                            this.$emit('link-updated', response.data.data);
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
                this.formData.url = data.url;
                this.formData.new_tab = data.new_tab;
            }
        }
    }
}
</script>

<style scoped>

</style>
