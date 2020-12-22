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
