
/* v1.0 - php */
jshelper = {};
jshelper.debug = false;

jshelper.deleteConfirm = function (callback, message) {
    message = typeof message !== 'undefined' ? message : 'Esta acción es irreversible !';
    Swal.fire({
        title: '¿Está seguro que desea eliminar?',
        //text: message,
        html: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        customClass:{
            cancelButton: 'btn btn-outline-danger rounded-0 mx-2 fw-500',
            confirmButton: 'btn btn-outline-primary rounded-0 mx-2 fw-500',
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
};

jshelper.failure = function () {
    toastr.error('Ago Salio mal, Por favor intente nuevamente, si el problema persiste comuniquese con el administrador del sistema.', 'Alert de Error');
};

jshelper.success = function (msg, callback, time) {
    toastr.success(msg, 'Información', { onHidden: callback, timeOut: time });
};

jshelper.error = function (msg) {
    toastr.error(msg, 'Alerta de Error');
};

jshelper.showAlert = function (success, msg) {
    if (success) {
        this.success(msg);
    } else {
        this.error(msg);
    }
};

jshelper.populateDropdown = function(dropdown, data, empty = true){
    if(empty){
        dropdown.empty();
    }
    $.each(data, function(key, value) {
        dropdown.append($('<option></option>').attr('value', key).text(value));
    });
};
jshelper.selectDropdownValues = function(dropdown, selectedValues){
    dropdown.val(selectedValues);
};
jshelper.handleErrors = function(xhr) {
    let statusCode = xhr.status;

    if (statusCode === 200) {           // OK
        console.log('Solicitud exitosa');
    } else if (statusCode === 400) {   // Bad Request
        jshelper.error('Solicitud Erronea');
        console.log('Bad Request');
    } else if (statusCode === 401) {   // Unauthorized
        jshelper.error('Privilegios insuficientes');
        console.log('Unauthorized');
    } else if (statusCode === 422) {   // Unprocesable entity
        // Code for a "Not Found" response
        jshelper.error('No se logro prcesar la solicitud');
        console.log('Unprocesable entity');
    } else if (statusCode === 404) {   // Not Found
        console.log('Not found');
    } else if (statusCode === 500) {   // Server error
        jshelper.error('Ha ocurrido un Error interno en el Servidor');
        console.log('Internal server error');
    } else {
        // Handling other status codes
        console.log('Other status code: ' + statusCode);
    }
};
