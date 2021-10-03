import Vue from 'vue'
import * as swal from "sweetalert2";

Vue.prototype.$showConfirmationAlert = function (title, message, type) {
    return swal.fire({
        title: title,
        text: message,
        icon: type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    })
};

Vue.prototype.$showSuccess = function (message) {
    return swal.fire(
        'Success!',
        message,
        'success',
    )
};

Vue.prototype.$showError = function (message) {
    return swal.fire(
        'Error!',
        message,
        'error',
    )
};

Vue.prototype.$filterErrorMessageFrom = function (err) {
    return Object.values(err.response.data.errors).length
        ? Object.values(err.response.data.errors)[0].toString()
        : err.response.data.message;
}
