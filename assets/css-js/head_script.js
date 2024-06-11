function init_toast_head(message = "", id = "my_toast_offline") {
    document.addEventListener('DOMContentLoaded',(e)=>{
        const toast = document.querySelector(`.toast#${id}`);
        if (message)
            document.querySelector(`#${id} #message`).innerText = message;
        toaster = new bootstrap.Toast(toast);
        toaster.show();
    })  
}
function modal_show(id, message = '') {
    document.addEventListener("DOMContentLoaded", () => {
        const bs_modal = document.querySelector(id);
        if (message)
            document.querySelector(id + " " + "#message").innerHTML = message;
        modal = new bootstrap.Modal(bs_modal);
        modal.show();
    })
}
function modal_hide(id) {
    document.addEventListener("DOMContentLoaded", () => {
        const bs_modal = document.querySelector(id);
        modal = new bootstrap.Modal(bs_modal);
        modal.hide();
    })
}