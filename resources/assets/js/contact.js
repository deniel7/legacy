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