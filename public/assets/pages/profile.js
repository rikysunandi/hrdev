(function(){

	moment.locale('id');
    $('input.rating').rating();
    $('.chart').easyPieChart({
        barColor: "#3eb7ba",
        trackColor: "#e6e6e6",
        lineCap: "square",
        lineWidth: 5,
        size: $(".skills").find(".col-4").find("span").width()
    });


    function titleCase(str) {
	  return str.toLowerCase().split(' ').map(function(word) {
	    return (word.charAt(0).toUpperCase() + word.slice(1));
	  }).join(' ');
	}

    $('div.container-fluid').block({ message: null }); 
    $.getJSON('profile/get-data/'+$('#prev_per_no').html(), function(data){
    	console.log(data);
    	data = data[0];
	    $('div.container-fluid').unblock(); 

	    $('#avatar').attr('src', '../assets/images/photos/'+data.prev_per_no+'.jpg');
	    $('#personnel_number').html(data.personnel_number);
	    $('#city').html('<i class="fa fa-map-marker"></i> '+data.city);
	    $('#position').html(data.position);
	    $('#overview').html('Bertugas sebagai '+titleCase(data.nama_panjang_posisi)+' di '+data.personnel_subarea+' sejak '+moment(data.tgl_jabat).format('LL'));
	    $('#telephone_no').html(data.telephone_no);
	    $('#alamat').html(data.street_and_house_number+'<br/>'+data.district+', '+data.city+', '+data.postal_code);
	    $('#email').html(data.email);
	    $('#email').attr('href', 'mailto:'+data.email);
	    $('#ttl').html(data.birthplace+', '+moment(data.birth_date).format('LL'));
	    $('#gender_key').html(data.gender_key);
	    $('#religious_denomination_key').html(data.religious_denomination_key);
	    $('#marital_status_key').html(data.marital_status_key);
	    $('#tanggal_masuk').html(moment(data.tanggal_masuk).format('LL'));

	    $('#btn_whatsapp').click(function(){
	    	window.open('http://web.whatsapp.com/send?phone='+data.telephone_no);
	    });

	    $('#btn_orgchart').click(function(){
    		$.redirect(APP_URL+'/organisasi/chart', {prev_per_no: data.prev_per_no, _token: csrf_token}, "POST"); 
	    });

	});

	//radar chart
    var data = {
        labels: ["Dicipline", "Performance", "Experience", "Achievement", "Personality"],
        datasets: [
            {
                backgroundColor: "rgba(122, 111, 190, 0.2)",
                borderColor: "#7a6fbe",
                pointBackgroundColor: "#7a6fbe",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#7a6fbe",
                data: [72, 84, 68, 55, 70]
            }
        ]
    };

    new Chart('radar', {
			type: 'radar',
			data: data,
			options: {
				legend: false,
				tooltips: true,
				scale: {
			        ticks: {
			            beginAtZero: true,
				        max: 100,
				        min: 0,
				        stepSize: 20
			        }
			    }
			}
		});


    var table_pendidikan =  $('#datatable-pendidikan').DataTable({
		destroy: true,
	    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
		dom:
		  "<'row'<'col-sm-3'f>>" +
		  "<'row'<'col-sm-12'tr>>" +
		  "<'row'<'col-sm-3'i><'col-sm-5 m-t-5'l><'col-sm-4'p>>",
	    oLanguage: {
					sProcessing: '<i class="fas fa-spinner fa-spin fa-fw m-t-10"></i><span> Loading...</span> ',
					sZeroRecords: "Tidak Ada Data",
					sInfoEmpty: 'Data Tidak Ada'
		},
	    columns: [
	        { "data": "tahun" },
	        { "data": "level", "width": "35%"  },
	        { "data": "sekolah", "width": "50%" },
	    ], 
	    "order": [[ 0, 'desc' ]],
	    deferRender: true,
	    deferLoading: 0, // here
		processing: true,
		"ajax": {
	        //"url": '/karir/pendidikan/get-data',
	        "type": "GET",
			//data : {unitpln:unitpln, idpilih:idpilih, idpilih2:idpilih2, idpilih3:idpilih3, id_status:id_status, id_fam:id_fam},
			complete: function() {

			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log('ERROR : '+xhr.status);
				//alert(thrownError);
			}
			
		}, 
    });

    var table_rjab =  $('#datatable-rjab').DataTable({
		destroy: true,
	    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
		dom:
		  "<'row'<'col-sm-3'f>>" +
		  "<'row'<'col-sm-12'tr>>" +
		  "<'row'<'col-sm-3'i><'col-sm-5 m-t-5'l><'col-sm-4'p>>",
	    oLanguage: {
					sProcessing: '<i class="fas fa-spinner fa-spin fa-fw m-t-10"></i><span> Loading...</span> ',
					sZeroRecords: "Tidak Ada Data",
					sInfoEmpty: 'Data Tidak Ada'
		},
	    columns: [
	        { "data": "start_date" },
	        { "data": "nama_panjang_posisi", "width": "40%"  },
	        { "data": "business_area", "width": "25%" },
	        { "data": "personnel_subarea", "width": "25%" },
	    ], 
	    "order": [[ 0, 'desc' ]],
	    deferRender: true,
	    deferLoading: 0, // here
		processing: true,
		"ajax": {
	        //"url": '/karir/pendidikan/get-data',
	        "type": "GET",
			//data : {unitpln:unitpln, idpilih:idpilih, idpilih2:idpilih2, idpilih3:idpilih3, id_status:id_status, id_fam:id_fam},
			complete: function() {

			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log('ERROR : '+xhr.status);
				//alert(thrownError);
			}
			
		}, 
    });

    var table_talenta =  $('#datatable-talenta').DataTable({
		destroy: true,
	    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
		dom:
		  "<'row'<'col-sm-3'f>>" +
		  "<'row'<'col-sm-12'tr>>" +
		  "<'row'<'col-sm-3'i><'col-sm-5 m-t-5'l><'col-sm-4'p>>",
	    oLanguage: {
					sProcessing: '<i class="fas fa-spinner fa-spin fa-fw m-t-10"></i><span> Loading...</span> ',
					sZeroRecords: "Tidak Ada Data",
					sInfoEmpty: 'Data Tidak Ada'
		},
	    columns: [
	        { "data": "start_date" },
	        { "data": "talenta_description", "width": "30%" },
	        { "data": "nilai_sasaran_kinerja", "width": "15%"  },
	        { "data": "sasaran_kinerja", "width": "10%" },
	        { "data": "nilai_kompetensi_individu", "width": "15%" },
	        { "data": "indeks_sasaran_kompetensi", "width": "10%" },
	    ], 
	    "order": [[ 0, 'desc' ]],
	    deferRender: true,
	    deferLoading: 0, // here
		processing: true,
		"ajax": {
	        //"url": '/karir/pendidikan/get-data',
	        "type": "GET",
			//data : {unitpln:unitpln, idpilih:idpilih, idpilih2:idpilih2, idpilih3:idpilih3, id_status:id_status, id_fam:id_fam},
			complete: function() {

			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log('ERROR : '+xhr.status);
				//alert(thrownError);
			}
			
		}, 
    });

    table_rjab.ajax.url('/profile/get-rjab/'+$('#prev_per_no').html()).load(
	    function(data) {

	    	console.log(data);

	    });

    table_talenta.ajax.url('/profile/get-talenta/'+$('#prev_per_no').html()).load(
	    function(data) {

	    	console.log(data);

	    });

})(jQuery);