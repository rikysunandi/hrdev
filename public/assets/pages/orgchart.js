
$(document).ready(function() {
    "use strict";


    $('#datepicker-autoclose').datepicker({
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
});