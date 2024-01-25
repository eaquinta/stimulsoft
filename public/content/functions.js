function showError(field, message, parent='') {
    const el = parent+' '+field;
    //console.log(el);
    if (!message) {
        $(el)
            .addClass("is-valid")
            .removeClass("is-invalid")
            .siblings(".invalid-feedback")
            .text("");
     } else {
        $(el)
            .addClass("is-invalid")
            .removeClass("is-valid")
            .siblings(".invalid-feedback")
            .text(message);
    }
}

function removeValidationClasses(form) {
    $(form).each(function () {
        $(form).find(":input").removeClass("is-valid is-invalid");
    });
}

function showMessage(type, message){
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
    <strong>${message}</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}
