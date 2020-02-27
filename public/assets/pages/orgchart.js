
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

    function populateProfile(node){

    	if((node.prev_per_no=='' || node.prev_per_no=='null' || !node.prev_per_no)){
    		/* POSISI KOSONG NIH */
    		$('.profile-card dl').hide();
    		$('.profile-card span ul').hide();
	    	$('#avatar').attr('src', node.img);
	        $('#nama').html(node.fullname);
	        $('#jabatan').html(node.pos_ltext_name);
			$('.profile-card #btn_kandidat').show();

    	}else{
    		$('.profile-card dl').show();
    		$('.profile-card span ul').show();
			$('.profile-card #btn_kandidat').hide();
	    	$('#avatar').attr('src', node.img);
	        $('#nama').html(node.fullname);
	        $('#jabatan').html(node.position_ltext);
	        $('#nip').html(node.prev_per_no);
	        $('#ttl').html(node.place_of_birth+', '+node.birthday);
	        $('#grade').html(node.grade_name);
	        $('#jenjang').html(node.main_group);
	        $('#pendidikan').html(node.branch_of_study_text);
	        $('#unit').html(node.sub_area_text);
	        //$('#modal_detail').modal('show');

	        $('#jabatan').removeClass();
	    	$('#jabatan').addClass(node.tags);

	    	if(node.email!='' && node.email!='null')
	    		$('#email').attr('href', 'mailto:'+node.email);
	    	if(node.telephone_num!='' && node.telephone_num!='null')
	    		$('#telepon').attr('href', 'https://web.whatsapp.com/send?phone='+node.telephone_num);
	    	$('#detail').click(function(e){
	    		e.preventDefault();
	    		$.redirect(APP_URL+'/profile', {prev_per_no: node.prev_per_no, _token: csrf_token}, "POST", "_blank");
	    	});
	    }
    }

    function resetProfile(){
    	$('.profile-card dd').html('');
    	$('.profile-card img').attr('src','');
    	$('.profile-card a').attr('href','#');
        $('#jabatan').removeClass();
    }


    $('#btn_cari').click(function(){

    	console.log('Cari...');

    	if($('#prev_per_no_cari').val()=='')
    		$('#prev_per_no').val("");

		var first_time = true;
    	$('#orgchart').empty();

    	resetProfile();
		$('.profile-card').hide();
    	$.blockUI({message: '<h5 class="p-10">Mohon menunggu...</h5>'});

    	$.getJSON('/organisasi/get_chart_data', {
	        prev_per_no: $('#prev_per_no').val(),
	        ko1: '01',
	        ko2: $('#ko_2').val(),
	        ko3: $('#ko_3').val(),
	        ko4: $('#ko_4').val(),
	        fungsional: $('#sw_fungsional').is(":checked"),
	        blth: $('#blth').val(),
	    }, function(data) {

	    	var pilih = data[1];
	    	var ftk = data[2];
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
                    png: { text: "Export PNG" },
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
                
                populateProfile(node);


                return false;
            });


            $('#ftk').html(ftk.org_ltext+' '+ftk.real_ftk+' / '+ftk.pagu_ftk);

	    	$('#collapseOne').collapse();
	    	$('.profile-card').show();

	    	setTimeout($.unblockUI, 500);

	    	chart.on('redraw', function (sender) {
	            
	            if(first_time){
			    	console.log('pilih', pilih);
			    	chart.ripple(parseInt(pilih.id));
			    	populateProfile(pilih);
			    	first_time = false;
			    }

	        });  




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