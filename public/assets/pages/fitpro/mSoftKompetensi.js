

$(document).ready(function() {

    var table =  $('#datatable-posisi-kosong').DataTable({
	destroy: true,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
	dom:
	  "<'row'<'col-sm-6'B><'col-sm-4'f>>" +
	  "<'row'<'col-sm-12'tr>>" +
	  "<'row'<'col-sm-3'i><'col-sm-5 m-t-5'l><'col-sm-4'p>>",
	buttons: ['copy', 'csv', 'excel', 'pdf'],
    oLanguage: {
				sProcessing: '<i class="fas fa-spinner fa-spin fa-fw"></i><span> Loading...</span> ',
				sZeroRecords: "Tidak Ada Data",
				sInfoEmpty: 'Data Tidak Ada'
	},

    columns: [
        { "data": "id" },
        { "data": "nama_kompetensi" },
        { "data": "ket" },
        { "data": "aktif" }
    ], 
    deferRender: true,
	processing: true,
	"ajax": {
        "url": '/fitpro/mSoftKompetensi/get-data',
        "type": "GET",
		//data : {unitpln:unitpln, idpilih:idpilih, idpilih2:idpilih2, idpilih3:idpilih3, id_status:id_status, id_fam:id_fam},
		complete: function() {

		},
		/*success: function() {
			loadout();
		},*/
		error: function (xhr, ajaxOptions, thrownError) {
			console.log('ERROR : '+xhr.status);
			alert(thrownError);
		}
		
	}, 
	// "footerCallback": function (row, data, start, end, display) {
 //            var api = this.api(), data;
 //            // Remove the formatting to get integer data for summation
 //            var intVal = function (i) {
 //                return typeof i === 'string' ?
 //                        i.replace('.00', '') * 1 :
 //                        typeof i === 'number' ?
 //                        i : 0;
 //            };
 //            // Total over all pages
 //            total = api
 //                    .column(4)
 //                    .data()
 //                    .reduce(function (a, b) {
 //                        return intVal(a) + intVal(b);
 //                    }, 0);
 //            $(api.column(4).footer()).html(
 //                     total
 //                    );
 //        }
    });
});