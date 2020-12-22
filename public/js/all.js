var commonModule = (function() {

    var datatableBaseURL = '/datatable/';

    var select2BaseURL = '/select2/';

    /* Auto Log Out Setelah Sekian Detik */
    var autoLogOut = function() {
        var delay = 1000; // 10 menit (10 * 60 detik * 1000 untuk miliseconds)
        window.setTimeout(function() {
            window.location.href = '/logout';
        }, delay);
    };

    return {
        autoLogOut: autoLogOut,
        datatableBaseURL: datatableBaseURL,
        select2BaseURL: select2BaseURL
    };

    autoLogOut();

})();
var coupleModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'couples';

    var existing_model = null;

    var init = function() {
        _applyDatatable();
        _applyDatepicker();
        _applyAutoNumeric();
    };



    var confirmDelete = function(event, id) {

        event.preventDefault();

        swal({
                title: "Apakah anda yakin?",
                text: "Data Project ini akan dihapus!",
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
                        url: "/project/" + id
                    })
                    .done(function(data) {
                        if (data === "success") {
                            // Redraw table
                            $('#datatable').DataTable().draw();
                            swal("", "Data berhasil dihapus.", "success");
                        } else {
                            swal("", data, "error");
                        }
                    });
            });

    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    var _applyAutoNumeric = function() {
        $("#uang_makan").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_makan"));
            });
        $("#nilai_upah").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#nilai_upah"));
            });
        $("#uang_lembur").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_lembur"));
            });

    };

    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created Date' || title == 'Updated Date' || title == 'Tanggal') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            stateSave: true,

            fnStateSave: function(oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function(oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },

            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'username',
                name: 'users.username'
            }, {
                data: 'pengantin_pria',
                name: 'users.pengantin_pria'
            }, {
                data: 'pengantin_wanita',
                name: 'users.pengantin_wanita'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {

                var keyword = this.value;

                if (this.placeholder == 'Search Model' || this.placeholder == 'Search Brand') {
                    keyword = keyword.toUpperCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };
    var showPrint = function(id) {

        $.ajax({
            method: "GET",
            url: "/karyawan-harian/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#print_modal').find(".modal-title").html("");
                $('#print_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */
                $('#print_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Status</th><th>Norek</th></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#print_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.nik + "' />" + record.nik + "</td><td>" + record.nama + "</td><td>" + record.keterangan + "</td><td>" + record.norek + "</td></tr>");

                });

                $('#print_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#print_modal').modal();
            } else {
                alert('Data Pegawai salah');
            }

        }).fail(function(response) {

        });
    };

    return {
        init: init,
        showPrint: showPrint,
        confirmDelete: confirmDelete,
    };

})(commonModule);
var userModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'users';
    // var select2BaseURLFamily = commonModule.select2BaseURL + 'absensi-harians';

    var existing_model = null;

    var init = function() {
        _applyDatatable();
        _applyDatepicker();
        _applyThousandSeperator();
        _applySelectPegawai();
        _applySelect2();

    };


    var _applySelect2 = function() {
        $('.select2').select2();
    };

    var _applySelectPegawai = function() {

        $('select.product_ajax').on('change', function(e) {

            var me = $(this);

            var cat_id = me.val();
            me.closest('tr').find('td#nat_accounts').html("<input name ='id' class='datepicker form-control' type='text' readonly value='" + subcatObj.nat_account_desc + "' />");
            //ajax




        });

    };

    var _applyAutoNumeric = function() {
        $("#harga").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#harga"));
            });
    };

    var _applyValidation = function() {
        alert('hello');
        $('#frmData').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#btnSubmit',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                status_karyawan_id: {
                    validators: {
                        notEmpty: {
                            message: 'Status Karyawan harus diisi'
                        }
                    }
                },
                nik: {
                    validators: {
                        notEmpty: {
                            message: 'NIK harus diisi'
                        }
                    }
                },
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama harus diisi'
                        }
                    }
                },
                alamat: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat harus diisi'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat harus diisi'
                        }
                    }
                },
                lulusan: {
                    validators: {
                        notEmpty: {
                            message: 'Lulusan harus diisi'
                        }
                    }
                },
                tgl_masuk: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Masuk harus diisi'
                        }
                    }
                },
                nilai_upah: {
                    validators: {
                        notEmpty: {
                            message: 'Nilai Upah harus diisi'
                        }
                    }
                },
                uang_makan: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat harus diisi'
                        }
                    }
                },
                uang_lembur: {
                    validators: {
                        notEmpty: {
                            message: 'Uang lembur harus diisi'
                        }
                    }
                },
                norek: {
                    validators: {
                        notEmpty: {
                            message: 'Nomor Rekening harus diisi'
                        }
                    }
                }
            }
        });

    };

    var _applyThousandSeperator = function() {
        $("input.number").each(function() {
            var input_name = $(this).data('input');

            $(this).autoNumeric('init', {
                aSep: ',',
                aDec: '.',
                aSign: 'Rp ',
                mDec: '0'
            });

            $(this).on('change keyup', function() {
                var value = $(this).val().replace('Rp ', '');
                $("input[name='" + input_name + "']").val(value);
            });
        });
    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: false,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };


    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created Date' || title == 'Updated Date' || title == 'Tanggal') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            stateSave: true,

            fnStateSave: function(oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function(oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },

            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'username',
                name: 'users.username'
            }, {
                data: 'email',
                name: 'users.email'
            }, {
                data: 'pengantin_pria',
                name: 'users.pengantin_pria'
            }, {
                data: 'pengantin_wanita',
                name: 'users.pengantin_wanita'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {

                var keyword = this.value;

                if (this.placeholder == 'Search Model' || this.placeholder == 'Search Brand') {
                    keyword = keyword.toUpperCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };

    var showDetail = function(id) {

        $.ajax({
            method: "GET",
            url: "/upload-absen/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#detail_modal').find(".modal-title").html("");
                $('#detail_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */




                $('#detail_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Departemen</th><th>Scan Masuk</th><th>Scan Keluar</th><th>Lembur</th></tr></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#detail_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.id_absen + "' /><input name ='nik' type='hidden' value='" + record.karyawan_id + "' /><input name ='tanggal' type='hidden' value='" + record.tanggal + "' />" + record.karyawan_id + "</td><td>" + record.nama + "</td><td>" + record.departemen + "</td><td>" + record.scan_masuk + "</td><td>" + record.scan_pulang + "</td><td>" + record.jam_lembur + "</td></tr><tr><td colspan='5' align='right'>Jenis Lembur</td><td> <select name='jenis_lembur' class='form-control selectpicker' title='-- Pilih Jenis Lembur --'><option value='0'>Tidak Ada</option><option value='1'>Rutin</option><option value='2'>Biasa</option><option value='3'>Off</option></select></td></tr><tr><td colspan='5' align='right'>Jam Lembur</td><td><input name ='lembur' type='text' /></td></tr>");

                });

                $('#detail_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#detail_modal').modal();
            } else {
                alert('Data Pegawai belum ada');
            }

        }).fail(function(response) {

        });
    };

    var showPrint = function(id) {

        $.ajax({
            method: "GET",
            url: "/absensi-harian/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#print_modal').find(".modal-title").html("");
                $('#print_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */
                $('#print_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Departemen</th></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#print_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.id + "' /><input name ='tanggal' type='hidden' value='" + record.tanggal + "' />" + record.id + "</td><td>" + record.nama + "</td><td>" + record.departemen + "</td></tr>");

                });

                $('#print_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#print_modal').modal();
            } else {
                alert('Data Pegawai belum ada');
            }

        }).fail(function(response) {

        });
    };

    return {
        init: init,
        showDetail: showDetail,
        showPrint: showPrint

    };

})(commonModule);
var packageModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'packages';

    var existing_model = null;

    var init = function() {
        _applyDatatable();
        _applyDatepicker();
        _applyAutoNumeric();
    };



    var confirmDelete = function(event, id) {

        event.preventDefault();

        swal({
                title: "Apakah anda yakin?",
                text: "Data Karyawan akan dihapus!",
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
                        url: "/karyawan-harian/" + id
                    })
                    .done(function(data) {
                        if (data === "success") {
                            // Redraw table
                            $('#datatable').DataTable().draw();
                            swal("", "Data berhasil dihapus.", "success");
                        } else {
                            swal("", data, "error");
                        }
                    });
            });

    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    var _applyAutoNumeric = function() {
        $("#uang_makan").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_makan"));
            });
        $("#nilai_upah").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#nilai_upah"));
            });
        $("#uang_lembur").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_lembur"));
            });

    };

    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created Date' || title == 'Updated Date' || title == 'Tanggal') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            stateSave: true,

            fnStateSave: function(oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function(oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },

            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'nama',
                name: 'packages.nama'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {

                var keyword = this.value;

                if (this.placeholder == 'Search Model' || this.placeholder == 'Search Brand') {
                    keyword = keyword.toUpperCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };
    var showPrint = function(id) {

        $.ajax({
            method: "GET",
            url: "/karyawan-harian/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#print_modal').find(".modal-title").html("");
                $('#print_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */
                $('#print_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Status</th><th>Norek</th></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#print_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.nik + "' />" + record.nik + "</td><td>" + record.nama + "</td><td>" + record.keterangan + "</td><td>" + record.norek + "</td></tr>");

                });

                $('#print_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#print_modal').modal();
            } else {
                alert('Data Pegawai salah');
            }

        }).fail(function(response) {

        });
    };

    return {
        init: init,
        showPrint: showPrint,
        confirmDelete: confirmDelete,
    };

})(commonModule);
var packageTakenModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'package-taken';

    var existing_model = null;

    var init = function() {

        _applyDatepicker();
        _applyAutoNumeric();
    };



    var confirmDelete = function(event, id) {
        alert('hi');
        event.preventDefault();

        swal({
                title: "Apakah anda yakin?",
                text: "Data Karyawan akan dihapus!",
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
                        url: "/package-talem/" + id
                    })
                    .done(function(data) {
                        if (data === "success") {
                            // Redraw table
                            $('#datatable').DataTable().draw();
                            swal("", "Data berhasil dihapus.", "success");
                        } else {
                            swal("", data, "error");
                        }
                    });
            });

    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    var _applyAutoNumeric = function() {
        $("#uang_makan").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_makan"));
            });
        $("#nilai_upah").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#nilai_upah"));
            });
        $("#uang_lembur").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_lembur"));
            });

    };


    var showPrint = function(id) {

        $.ajax({
            method: "GET",
            url: "/karyawan-harian/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#print_modal').find(".modal-title").html("");
                $('#print_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */
                $('#print_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Status</th><th>Norek</th></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#print_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.nik + "' />" + record.nik + "</td><td>" + record.nama + "</td><td>" + record.keterangan + "</td><td>" + record.norek + "</td></tr>");

                });

                $('#print_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#print_modal').modal();
            } else {
                alert('Data Pegawai salah');
            }

        }).fail(function(response) {

        });
    };

    return {
        init: init,
        showPrint: showPrint,
        confirmDelete: confirmDelete,
    };

})(commonModule);
var vendorModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'vendors';

    var existing_model = null;

    var init = function() {
        _applyDatatable();
        _applyDatepicker();
        _applyAutoNumeric();
    };



    var confirmDelete = function(event, id) {

        event.preventDefault();

        swal({
                title: "Apakah anda yakin?",
                text: "Data Karyawan akan dihapus!",
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
                        url: "/karyawan-harian/" + id
                    })
                    .done(function(data) {
                        if (data === "success") {
                            // Redraw table
                            $('#datatable').DataTable().draw();
                            swal("", "Data berhasil dihapus.", "success");
                        } else {
                            swal("", data, "error");
                        }
                    });
            });

    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    var _applyAutoNumeric = function() {
        $("#uang_makan").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_makan"));
            });
        $("#nilai_upah").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#nilai_upah"));
            });
        $("#uang_lembur").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#uang_lembur"));
            });

    };

    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created Date' || title == 'Updated Date' || title == 'Tanggal') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            stateSave: true,

            fnStateSave: function(oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function(oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },

            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'name',
                name: 'vendors.name'
            }, {
                data: 'contact',
                name: 'vendors.contact'
            }, {
                data: 'logo',
                name: 'vendors.logo'

            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {

                var keyword = this.value;

                if (this.placeholder == 'Search Model' || this.placeholder == 'Search Brand') {
                    keyword = keyword.toUpperCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };
    var showPrint = function(id) {

        $.ajax({
            method: "GET",
            url: "/karyawan-harian/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#print_modal').find(".modal-title").html("");
                $('#print_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */
                $('#print_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Status</th><th>Norek</th></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#print_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.nik + "' />" + record.nik + "</td><td>" + record.nama + "</td><td>" + record.keterangan + "</td><td>" + record.norek + "</td></tr>");

                });

                $('#print_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#print_modal').modal();
            } else {
                alert('Data Pegawai salah');
            }

        }).fail(function(response) {

        });
    };

    return {
        init: init,
        showPrint: showPrint,
        confirmDelete: confirmDelete,
    };

})(commonModule);
var eventModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'events';
    // var select2BaseURLFamily = commonModule.select2BaseURL + 'absensi-harians';

    var existing_model = null;

    var init = function() {
        _applyDatatable();
        _applyDatepicker();
        _applyThousandSeperator();
        _applySelectPegawai();
        _applySelect2();

    };


    var _applySelect2 = function() {
        $('.select2').select2();
    };

    var _applySelectPegawai = function() {

        $('select.product_ajax').on('change', function(e) {

            var me = $(this);

            var cat_id = me.val();
            me.closest('tr').find('td#nat_accounts').html("<input name ='id' class='datepicker form-control' type='text' readonly value='" + subcatObj.nat_account_desc + "' />");
            //ajax




        });

    };

    var _applyAutoNumeric = function() {
        $("#harga").autoNumeric("init", {
                vMin: '0',
                vMax: '9999999999999.99'
            })
            .on("keyup", function() {
                $("#frmData").formValidation("revalidateField", $("#harga"));
            });
    };

    var _applyValidation = function() {
        alert('hello');
        $('#frmData').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#btnSubmit',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                status_karyawan_id: {
                    validators: {
                        notEmpty: {
                            message: 'Status Karyawan harus diisi'
                        }
                    }
                },
                nik: {
                    validators: {
                        notEmpty: {
                            message: 'NIK harus diisi'
                        }
                    }
                },
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama harus diisi'
                        }
                    }
                },
                alamat: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat harus diisi'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat harus diisi'
                        }
                    }
                },
                lulusan: {
                    validators: {
                        notEmpty: {
                            message: 'Lulusan harus diisi'
                        }
                    }
                },
                tgl_masuk: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Masuk harus diisi'
                        }
                    }
                },
                nilai_upah: {
                    validators: {
                        notEmpty: {
                            message: 'Nilai Upah harus diisi'
                        }
                    }
                },
                uang_makan: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat harus diisi'
                        }
                    }
                },
                uang_lembur: {
                    validators: {
                        notEmpty: {
                            message: 'Uang lembur harus diisi'
                        }
                    }
                },
                norek: {
                    validators: {
                        notEmpty: {
                            message: 'Nomor Rekening harus diisi'
                        }
                    }
                }
            }
        });

    };

    var _applyThousandSeperator = function() {
        $("input.number").each(function() {
            var input_name = $(this).data('input');

            $(this).autoNumeric('init', {
                aSep: ',',
                aDec: '.',
                aSign: 'Rp ',
                mDec: '0'
            });

            $(this).on('change keyup', function() {
                var value = $(this).val().replace('Rp ', '');
                $("input[name='" + input_name + "']").val(value);
            });
        });
    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: false,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };


    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created Date' || title == 'Updated Date' || title == 'Tanggal') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            stateSave: true,

            fnStateSave: function(oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function(oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },

            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'tanggal',
                name: 'events.tanggal'
            }, {
                data: 'username',
                name: 'users.username'
            }, {
                data: 'event',
                name: 'events.event'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {

                var keyword = this.value;

                if (this.placeholder == 'Search Model' || this.placeholder == 'Search Brand') {
                    keyword = keyword.toUpperCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };

    var showDetail = function(id) {

        $.ajax({
            method: "GET",
            url: "/upload-absen/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#detail_modal').find(".modal-title").html("");
                $('#detail_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */




                $('#detail_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Departemen</th><th>Scan Masuk</th><th>Scan Keluar</th><th>Lembur</th></tr></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#detail_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.id_absen + "' /><input name ='nik' type='hidden' value='" + record.karyawan_id + "' /><input name ='tanggal' type='hidden' value='" + record.tanggal + "' />" + record.karyawan_id + "</td><td>" + record.nama + "</td><td>" + record.departemen + "</td><td>" + record.scan_masuk + "</td><td>" + record.scan_pulang + "</td><td>" + record.jam_lembur + "</td></tr><tr><td colspan='5' align='right'>Jenis Lembur</td><td> <select name='jenis_lembur' class='form-control selectpicker' title='-- Pilih Jenis Lembur --'><option value='0'>Tidak Ada</option><option value='1'>Rutin</option><option value='2'>Biasa</option><option value='3'>Off</option></select></td></tr><tr><td colspan='5' align='right'>Jam Lembur</td><td><input name ='lembur' type='text' /></td></tr>");

                });

                $('#detail_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#detail_modal').modal();
            } else {
                alert('Data Pegawai belum ada');
            }

        }).fail(function(response) {

        });
    };

    var showPrint = function(id) {

        $.ajax({
            method: "GET",
            url: "/absensi-harian/" + id,
            dataType: "json",
        }).done(function(response) {

            if (response.status == 1) {

                /* Clear Modal Body */
                $('#print_modal').find(".modal-title").html("");
                $('#print_modal').find(".modal-body").html("");

                /* Insert Data to Modal Body */
                $('#print_modal').find(".modal-body").append('<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Departemen</th></thead><tbody>');

                $.each(response.records, function(i, record) {
                    $('#print_modal').find("tbody").append("<tr><td><input name ='id' type='hidden' value='" + record.id + "' /><input name ='tanggal' type='hidden' value='" + record.tanggal + "' />" + record.id + "</td><td>" + record.nama + "</td><td>" + record.departemen + "</td></tr>");

                });

                $('#print_modal').find(".modal-body").append("</table>");


                /* Finally show */
                $('#print_modal').modal();
            } else {
                alert('Data Pegawai belum ada');
            }

        }).fail(function(response) {

        });
    };

    return {
        init: init,
        showDetail: showDetail,
        showPrint: showPrint

    };

})(commonModule);
var contactModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'contacts';
    // var select2BaseURLFamily = commonModule.select2BaseURL + 'absensi-harians';

    var existing_model = null;

    var init = function() {
        _applyDatatable();


    };

    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created Date' || title == 'Updated Date' || title == 'Tanggal') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            stateSave: true,

            fnStateSave: function(oSettings, oData) {
                localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            fnStateLoad: function(oSettings) {
                var data = localStorage.getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },

            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'nama',
                name: 'nama'
            }, {
                data: 'email',
                name: 'email'
            }, {
                data: 'phone',
                name: 'phone'
            }, {
                data: 'message',
                name: 'message'

            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {

                var keyword = this.value;

                if (this.placeholder == 'Search Model' || this.placeholder == 'Search Brand') {
                    keyword = keyword.toUpperCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };


    return {
        init: init,

    };

})(commonModule);
var newsletterModule = (function (commonModule) {
  var datatableBaseURL = commonModule.datatableBaseURL + "news-letter";

  var existing_model = null;

  var init = function () {
    _applyDatatable();
    _applyDatepicker();
    _applyAutoNumeric();
  };

  var confirmDelete = function (event, id) {
    event.preventDefault();

    swal(
      {
        title: "Apakah anda yakin?",
        text: "Data Project ini akan dihapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, lanjutkan!",
        cancelButtonText: "Tidak, batalkan!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
      },
      function () {
        $.ajax({
          beforeSend: function (xhr) {
            xhr.setRequestHeader(
              "X-CSRF-Token",
              $("meta[name='csrf-token']").attr("content")
            );
          },
          type: "POST",
          data: {
            _method: "DELETE",
          },
          url: "/project/" + id,
        }).done(function (data) {
          if (data === "success") {
            // Redraw table
            $("#datatable").DataTable().draw();
            swal("", "Data berhasil dihapus.", "success");
          } else {
            swal("", data, "error");
          }
        });
      }
    );
  };

  var _applyDatepicker = function () {
    $(".datepicker").datepicker({
      weekStart: 1,
      todayHighlight: true,
      clearBtn: true,
      format: "yyyy-mm-dd",
      autoclose: true,
    });
  };

  var _applyAutoNumeric = function () {
    $("#uang_makan")
      .autoNumeric("init", {
        vMin: "0",
        vMax: "9999999999999.99",
      })
      .on("keyup", function () {
        $("#frmData").formValidation("revalidateField", $("#uang_makan"));
      });
    $("#nilai_upah")
      .autoNumeric("init", {
        vMin: "0",
        vMax: "9999999999999.99",
      })
      .on("keyup", function () {
        $("#frmData").formValidation("revalidateField", $("#nilai_upah"));
      });
    $("#uang_lembur")
      .autoNumeric("init", {
        vMin: "0",
        vMax: "9999999999999.99",
      })
      .on("keyup", function () {
        $("#frmData").formValidation("revalidateField", $("#uang_lembur"));
      });
  };

  var _applyDatatable = function () {
    /* Tambah Input Field di TFOOT */
    $("#datatable tfoot th").each(function () {
      var title = $(this).text();
      if (title != "") {
        $(this).html(
          '<input type="text" class="form-control" placeholder="' +
            title +
            '" style="width: 100%;" />'
        );
      }
      if (
        title == "Created Date" ||
        title == "Updated Date" ||
        title == "Tanggal"
      ) {
        $(this).html(
          '<input type="text" class="datepicker form-control" placeholder="Search ' +
            title +
            '" style="width: 100%;" />'
        );
      }
    });

    var table = $("#datatable").DataTable({
      stateSave: true,

      fnStateSave: function (oSettings, oData) {
        localStorage.setItem(
          "DataTables_" + window.location.pathname,
          JSON.stringify(oData)
        );
      },
      fnStateLoad: function (oSettings) {
        var data = localStorage.getItem(
          "DataTables_" + window.location.pathname
        );
        return JSON.parse(data);
      },

      processing: true,
      serverSide: true,
      ajax: {
        url: datatableBaseURL,
        type: "POST",
      },
      language: {
        decimal: ",",
        thousands: ".",
      },
      columns: [
        {
          data: "title",
          name: "title",
        },
        {
          data: "image",
          name: "image",
          render: function (data, type, full, meta) {
            console.log(full);
            return (
              '<img src="images/upload/newsletter/' +
              data +
              '" width="150px" height="70px""/>'
            );
          },
        },
        {
          data: "date",
          name: "date",
        },
        {
          data: "action",
          name: "action",
          orderable: false,
          searchable: false,
        },
      ],
    });

    /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
    table.columns().every(function () {
      var that = this;
      $("input", this.footer()).on("keyup change", function () {
        var keyword = this.value;

        if (
          this.placeholder == "Search Model" ||
          this.placeholder == "Search Brand"
        ) {
          keyword = keyword.toUpperCase();
        }

        if (that.search() !== keyword) {
          that.search(keyword).draw();
        }
      });
    });
  };
  var showPrint = function (id) {
    $.ajax({
      method: "GET",
      url: "/karyawan-harian/" + id,
      dataType: "json",
    })
      .done(function (response) {
        if (response.status == 1) {
          /* Clear Modal Body */
          $("#print_modal").find(".modal-title").html("");
          $("#print_modal").find(".modal-body").html("");

          /* Insert Data to Modal Body */
          $("#print_modal")
            .find(".modal-body")
            .append(
              '<table class="table table-bordered table-striped"><thead><tr><th>NIK</th><th>Nama</th><th>Status</th><th>Norek</th></thead><tbody>'
            );

          $.each(response.records, function (i, record) {
            $("#print_modal")
              .find("tbody")
              .append(
                "<tr><td><input name ='id' type='hidden' value='" +
                  record.nik +
                  "' />" +
                  record.nik +
                  "</td><td>" +
                  record.nama +
                  "</td><td>" +
                  record.keterangan +
                  "</td><td>" +
                  record.norek +
                  "</td></tr>"
              );
          });

          $("#print_modal").find(".modal-body").append("</table>");

          /* Finally show */
          $("#print_modal").modal();
        } else {
          alert("Data Pegawai salah");
        }
      })
      .fail(function (response) {});
  };

  return {
    init: init,
    showPrint: showPrint,
    confirmDelete: confirmDelete,
  };
})(commonModule);

//# sourceMappingURL=all.js.map
