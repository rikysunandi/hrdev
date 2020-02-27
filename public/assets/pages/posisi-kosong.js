

$(document).ready(function() {

	$.getJSON('/referensi/get_ko2/01', function(data){
	    $('#ko_2').empty()
	    		.append('<option selected disabled>Pilih Organisasi I</option>');
	    		//.append('<option value="XX">TIDAK PILIH ORGANISASI</option>');
	    $('#ko_3').empty()
	    		.append('<option selected disabled>Pilih Organisasi II</option>');
	    		//.append('<option value="XX">TIDAK PILIH ORGANISASI</option>');
	    $('#ko_4').empty()
	    		.append('<option selected disabled>Pilih Organisasi III</option>');
	    		//.append('<option value="XX">TIDAK PILIH ORGANISASI</option>');
    	$.each(data,function(i,v){
        	$('#ko_2').append('<option value="'+v.kode+'">'+v.singkatan+'</option>');
    	});
		$('#ko_2').append('<option value="00">SEMUA ORGANISASI</option>');
    });

    $('#ko_2').change(function(){

	    $('#ko_3').empty()
	    		.append('<option selected disabled>Pilih Organisasi II</option>');
	    		//.append('<option value="XX">TIDAK PILIH ORGANISASI</option>');
	    $('#ko_4').empty()
	    		.append('<option selected disabled>Pilih Organisasi III</option>');
	    		//.append('<option value="XX">TIDAK PILIH ORGANISASI</option>');
	    $.getJSON('/referensi/get_ko3/'+$('#ko_2').val(), function(data){
	    	$.each(data,function(i,v){
	        	$('#ko_3').append('<option value="'+v.kode+'">'+v.singkatan+'</option>');
	    	});
			$('#ko_3').append('<option value="00">SEMUA ORGANISASI</option>');
	    });
    });

    $('#ko_3').change(function(){

	    $('#ko_4').empty()
    			.append('<option selected disabled>Pilih Organisasi III</option>');
	    		//.append('<option value="XX">TIDAK PILIH ORGANISASI</option>');
	    $.getJSON('/referensi/get_ko4/'+$('#ko_3').val(), function(data){
	    	$.each(data,function(i,v){

	        	$('#ko_4').append('<option value="'+v.kode+'">'+v.singkatan+'</option>');
	    	});
			$('#ko_4').append('<option value="00">SEMUA ORGANISASI</option>');
	    });
    });


    var table =  $('#datatable-posisi-kosong').DataTable({
	destroy: true,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
	dom:
	  "<'row'<'col-sm-6'B><'col-sm-4'f>>" +
	  "<'row'<'col-sm-12'tr>>" +
	  "<'row'<'col-sm-3'i><'col-sm-5 m-t-5'l><'col-sm-4'p>>",
	buttons: ['copy', 'csv', 'excel', 'pdf'],
    oLanguage: {
				sProcessing: '<i class="fas fa-spinner fa-spin fa-fw m-t-10"></i><span> Loading...</span> ',
				sZeroRecords: "Tidak Ada Data",
				sInfoEmpty: 'Data Tidak Ada'
	},

    columns: [
        { "data": "jabatan", "width": "35%" },
        { "data": "personnel_subarea" },
        { "data": "organizational_unit" },
        { "data": "jenjang", "width": "15%" },
        { "data": "level_min" },
		{
            render: function (data, type, row) {
            	console.log('data', data);
            	console.log('type', type);
            	console.log('row', row);
                return '<form action="/karir/daftar-kandidat/show" method="post">'+
                            '<input type="hidden" name="_token" value="'+csrf_token+'"></input>'+
                            '<input type="hidden" name="jabatan_id" value="'+row['id']+'">'+
                			'<button type="submit" class="btn btn-sm btn-outline-primary waves-effect waves-light">'+
                				'<i class="mdi mdi-account-search"></i> Kandidat'+
                			'</button></form>';
            }
        }
    ],
    deferRender: true,
    //serverSide: true,
    deferLoading: 0, // here
	processing: true,
	"ajax": {
        //"url": '/karir/posisi-kosong/get-data',
        "type": "GET",
		//data : {unitpln:unitpln, idpilih:idpilih, idpilih2:idpilih2, idpilih3:idpilih3, id_status:id_status, id_fam:id_fam},
		complete: function() {

		},
		/*success: function() {
			loadout();
		},*/
		error: function (xhr, ajaxOptions, thrownError) {
			console.log('ERROR : '+xhr.status);
			//alert(thrownError);
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

    $('#btn_cari').click(function(){

    	//$.blockUI({message: '<h1 class="p-10">Mohon menunggu...</h1>'});
    	table.ajax.url('/karir/posisi-kosong/get-data?ko1=01&ko2='+$('#ko_2').val()+'&ko3='+$('#ko_3').val()+'&ko4='+$('#ko_4').val()+'&fungsional='+$('#sw_fungsional').is(":checked")).load(
	    function(data) {

	    	console.log(data);

	    	//setTimeout($.unblockUI, 2000);

	    });
    });


});
