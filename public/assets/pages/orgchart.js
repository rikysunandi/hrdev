
$(document).ready(function() {
    "use strict";

    $('.button-menu-mobile').trigger('click');

    //$('body').addClass('enlarged');

    $('#blth').datepicker({
        autoclose: true,
	    minViewMode: 1,
	    format: 'mm/yyyy'
    });

	var pegawai = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('personnel_number'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: APP_URL+'/data/get-pegawai'
    });
    
    // Initializing the typeahead with remote dataset without highlighting
    $('input#prev_per_no_cari').typeahead(null, {
        name: 'pegawai',
        source: pegawai,
        display: 'personnel_number',
        templates: {
            empty: [
              '<div class="empty-message">',
                'Tidak dapat menemukan apa yang anda cari',
              '</div>'
            ].join('\n'),
            suggestion: function(data) {
                return '<p><strong>' + data.prev_per_no + '</strong> – ' + data.personnel_number + '</p>';
            }
            //suggestion: Handlebars.compile('<div><strong>{{prev_per_no}}</strong> – {{personnel_number}}</div>')
        },
        limit: 10 
    });

    $('input#prev_per_no_cari').bind('typeahead:select', function(ev, suggestion) {
      console.log('ev: ', ev);
      console.log('Selection: ', suggestion);

		$('#ko_2').append('<option selected value="00">SEMUA ORGANISASI</option>');
		$('#ko_3').empty().append('<option selected value="00">SEMUA ORGANISASI</option>');
		$('#ko_4').empty().append('<option selected value="00">SEMUA ORGANISASI</option>');

		$('#prev_per_no').val(suggestion.prev_per_no);
        //window.location.href = APP_URL+'/profile/'+suggestion.prev_per_no;
        //$.redirect(APP_URL+'/profile', {prev_per_no: suggestion.prev_per_no, _token: csrf_token}, "POST"); 
    });

    $('#btn_cari').click(function(){

    	console.log('Cari...');
    	$('#orgchart').empty();
    	$.blockUI({message: '<h1 class="p-10">Mohon menunggu...</h1>'});
    	$.getJSON('/organisasi/get_chart_data', {
	        prev_per_no: $('#prev_per_no').val(),
	        ko1: '01',
	        ko2: $('#ko_2').val(),
	        ko3: $('#ko_3').val(),
	        ko4: $('#ko_4').val(),
	        fungsional: $('#sw_fungsional').is(":checked"),
	        blth: $('#blth').val(),
	    }, function(data) {

	    	var ftk = data[1];
	    	data = data[0];

	    	var ftk_real=0;
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

		        if(node.prev_per_no!='')
		        	ftk_real = ftk_real+1;
		        //node.img = photosUrl+"/"+node.prev_per_no+".jpg";
		    }

	    	var chart = new OrgChart(document.getElementById("orgchart"),{
	    		lazyLoading: true,
	    		layout: OrgChart.mixed,
                scaleInitial: OrgChart.match.boundary,
                nodeBinding: {
                    field_0: "title",
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

	    		console.log(node);
                $('#avatar').attr('src', node.img);
                $('#nama').html(node.name);
                $('#jabatan').html(node.nama_panjang_posisi);
                $('#nip').html(node.prev_per_no);
                $('#ttl').html(node.birthplace+', '+node.birth_date);
                $('#grade').html(node.ps_group);
                $('#jenjang').html(node.jenjang);
                $('#pendidikan').html(node.branch_of_study_01);
                $('#unit').html(node.personnel_subarea);
                //$('#modal_detail').modal('show');

                $('#jabatan').removeClass();
            	$('#jabatan').addClass(node.tags[0]);

            	if(node.email!='')
            		$('#email').attr('href', 'mailto:'+node.email);
            	if(node.telephone_no!='')
            		$('#telepon').attr('href', 'https://web.whatsapp.com/send?phone='+node.telephone_no);
            	$('#detail').click(function(e){
            		e.preventDefault();
            		$.redirect(APP_URL+'/profile', {prev_per_no: node.prev_per_no, _token: csrf_token}, "POST", "_blank");
            	});

                return false;
            });

            $('#ftk').html(ftk.kotak_organisasi+' '+ftk_real+' / '+ftk.pagu_ftk);

	    	$('#collapseOne').collapse();
	    	$('.profile-card').show();

	    	setTimeout($.unblockUI, 2000);


	    });
    });


    if(prev_per_no != ''){
    	$('#prev_per_no').val(prev_per_no);
		$('#ko_2').append('<option selected value="00">SEMUA ORGANISASI</option>');
		$('#ko_3').append('<option selected value="00">SEMUA ORGANISASI</option>');
		$('#ko_4').append('<option selected value="00">SEMUA ORGANISASI</option>');
		$('#btn_cari').trigger( "click" );
    }else{

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
	}

    

});