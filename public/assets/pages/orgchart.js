
$(document).ready(function() {
    "use strict";

    $('.button-menu-mobile').trigger('click');
    //$('body').addClass('enlarged');

    $('#blth').datepicker({
        autoclose: true,
	    minViewMode: 1,
	    format: 'mm/yyyy'
    });

    $.getJSON('get_ko2/01', function(data){
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
	    $.getJSON('get_ko3/'+$('#ko_2').val(), function(data){
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
	    $.getJSON('get_ko4/'+$('#ko_3').val(), function(data){
	    	$.each(data,function(i,v){

	        	$('#ko_4').append('<option value="'+v.kode+'">'+v.singkatan+'</option>');
	    	});
			$('#ko_4').append('<option value="00">SEMUA ORGANISASI</option>');
	    });
    });

    $('#btn_cari').click(function(){

    	$('#orgchart').empty();
    	$.blockUI({message: '<h1 class="p-10">Mohon menunggu...</h1>'});
    	$.getJSON('/organisasi/get_chart_data', {
	        ko1: $('#ko_1').val(),
	        ko2: $('#ko_2').val(),
	        ko3: $('#ko_3').val(),
	        ko4: $('#ko_4').val(),
	        fungsional: $('#sw_fungsional').is(":checked"),
	        blth: $('#blth').val(),
	    }, function(data) {

	    	for (var i = 0; i < data.length; i++) {
		        var node = data[i];
		        switch (node.tags) {
		            case "plt":
		                node.tags = ["plt"];
		                break;
		            case "struktural":
		                node.tags = ["struktural"];
		                break;
		            case "fungsional":
		                node.tags = ["fungsional"];
		                break;
		            case "kosong":
		                node.tags = ["kosong"];
		                break;
		        }
		        //node.img = photosUrl+"/"+node.prev_per_no+".jpg";
		    }

	    	var chart = new OrgChart(document.getElementById("orgchart"),{
	    		lazyLoading: true,
	    		layout: OrgChart.mixed,
                scaleInitial: OrgChart.match.boundary,
                nodeBinding: {
                    field_0: "position",
                    field_1: "personnel_number",
                    field_2: "prev_per_no",
                    field_3: "tanggal_masuk",
                    img_0: "img"
                },
                menu: {
                    svg: { text: "Export SVG" },
                    csv: { text: "Export CSV" }
                },
                toolbar: {
                    layout: true,
                    zoom: true,
                    fit: true,
                    expandAll: false
                },
                nodeMenu:{
                    details: {text:"Details"},
                    edit: {text:"Edit"},
                    add: {text:"Add"},
                    remove: {text:"Remove"}
                },
                nodes: data
	    	});

	    	chart.on('click', function (sender, node) {

                $('#avatar').attr('src', node.img);
                $('#nama').html(node.name);
                $('#jabatan').html(node.jabatan);
                $('#modal_detail').modal('show');

                return false;
            });

	    	setTimeout($.unblockUI, 2000);

	    });
    });

    

});