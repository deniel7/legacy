var table;

var validation = (function() {

    var init = function() {
        _applyValidation();
    };

    var _applyValidation = function() {

        $('#frmData').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#btnSubmit',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                kota: {
                    validators: {
                        notEmpty: {
                            message: 'Kota harus diisi'
                        },
                        stringLength: {
                            max: 100,
                            message: 'Kota tidak boleh lebih dari 100 karakter'
                        }
                    }
                }
            }
        });

    };

    return {
        init: init
    };

})();

var confirmDelete = function(event, id, kota) {
    event.preventDefault();

    swal({
            title: "Apakah anda yakin?",
            text: "Data tujuan pengiriman dengan nama " + kota + " akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Tidak, batalkan!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function() {
            $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("X-CSRF-Token", $("meta[name='csrf-token']").attr("content"));
                    },
                    type: "POST",
                    data: {
                        _method: 'DELETE'
                    },
                    url: "/tujuan/" + id
                })
                .done(function(data) {
                    if (data === "success") {
                        // Redraw table
                        table.draw();
                        swal("", "Data berhasil dihapus.", "success");
                    } else {
                        swal("", data, "error");
                    }
                });
        });

};

var datatables = (function() {

    var datatablesURL = '/tujuan/list';

    var init = function() {
        _applyDatatable();
    };

    var _applyDatatable = function() {

        table = $('#list').DataTable({
            'processing': true,
            'serverSide': true,
            'paging': true,
            //'lengthChange': false,
            //'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'ajax': {
                "url": datatablesURL,
                //"type": "POST"
            },
            'columns': [{
                data: 'kota',
                name: 'kota'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

    };

    return {
        init: init
    };

})();