
/*
 Template Name: Lexa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Dashboard init js
 */

!function($) {
    "use strict";

    var Dashboard = function() {};

    //creates area chart
    Dashboard.prototype.createAreaChart = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
        Morris.Area({
            element: element,
            pointSize: 0,
            lineWidth: 1,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            resize: true,
            gridLineColor: '#eee',
            hideHover: 'auto',
            lineColors: lineColors,
            fillOpacity: .9,
            behaveLikeLine: true
        });
    },

    //creates Donut chart
    Dashboard.prototype.createDonutChart = function (element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true,
            colors: colors,
            formatter: function (value, data) { return value + '%'; }
        });
    },

    //creates Stacked chart
    Dashboard.prototype.createStackedChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            stacked: true,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eee',
            barColors: lineColors,
            gridTextSize: 11,
            xLabelMargin: 6
        });
    },

    $('#sparkline').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
        type: 'bar',
        height: '134',
        barWidth: '10',
        barSpacing: '7',
        barColor: '#7A6FBE'
    });

    Dashboard.prototype.dataGender = new Array();
    Dashboard.prototype.dataGrade = new Array();
    Dashboard.prototype.dataGenerasi = new Array();
    Dashboard.prototype.summary;
    Dashboard.prototype.sumGender;
    Dashboard.prototype.sumGrade;
    Dashboard.prototype.sumGenerasi;

    Dashboard.prototype.init = function() {
        var dashboard = this;

        $('div#stats .card').block({ message: null }); 
        $('div#demografi .card').block({ message: null }); 

        $.getJSON('dashboard/get_data', function(data){

            var summary = data[0];
            var rekap = data[1];

            dashboard.summary = summary;

            $('#jml_pegawai').html(summary.jml_pegawai);
            $('#jml_pensiun').html(summary.jml_pensiun);

            dashboard.sumGender = [
                {label: "Laki-laki", value: Math.round((summary.jml_laki_laki/summary.jml_pegawai)*100)},
                {label: "Perempuan", value: Math.round((summary.jml_perempuan/summary.jml_pegawai)*100)}
            ];
            dashboard.sumGrade = [
                {label: "Basic", value: Math.round((summary.jml_basic/summary.jml_pegawai)*100)},
                {label: "Specific", value: Math.round((summary.jml_specific/summary.jml_pegawai)*100)},
                {label: "System", value: Math.round((summary.jml_system/summary.jml_pegawai)*100)},
                {label: "Optimization", value: Math.round((summary.jml_optimization/summary.jml_pegawai)*100)},
                {label: "Advanced", value: Math.round((summary.jml_advanced/summary.jml_pegawai)*100)},
                {label: "Integration", value: Math.round((summary.jml_integration/summary.jml_pegawai)*100)}
            ];
            dashboard.sumGenerasi = [
                {label: "Baby Boomer", value: Math.round((summary.jml_baby_boomer/summary.jml_pegawai)*100)},
                {label: "Gen X", value: Math.round((summary.jml_generasi_x/summary.jml_pegawai)*100)},
                {label: "Gen Y / Milenial", value: Math.round((summary.jml_generasi_y/summary.jml_pegawai)*100)},
                {label: "Gen Z / iGeneration", value: Math.round((summary.jml_generasi_z/summary.jml_pegawai)*100)},
                {label: "Gen Alpha", value: Math.round((summary.jml_generasi_alpha/summary.jml_pegawai)*100)},
            ];

            dashboard.createDonutChart('morris-donut-example', dashboard.sumGender, ['#7a6fbe', '#3eb7ba']);

            $.each(rekap, function(i,v){
                dashboard.dataGender.push({y: v.singkatan_pendek, a: v.jml_laki_laki, b: v.jml_perempuan});
                dashboard.dataGrade.push({y: v.singkatan_pendek, a: v.jml_basic, b: v.jml_specific, c: v.jml_system, d: v.jml_optimization, e: v.jml_advanced, f: v.jml_integration});
                dashboard.dataGenerasi.push({y: v.singkatan_pendek, a: v.jml_baby_boomer, b: v.jml_generasi_x, c: v.jml_generasi_y, d: v.jml_generasi_z, e: v.jml_generasi_alpha});
            });

            dashboard.createStackedChart('morris-bar-stacked', dashboard.dataGender, 'y', ['a', 'b'], ['Laki-laki', 'Perempuan'], ['#7a6fbe','#3eb7ba']);

            $('div#stats .card').unblock(); 
            $('div#demografi .card').unblock(); 

        });
        // //creating area chart
        // var $areaData = [
        //     {y: '2011', a: 0, b: 0, c:0},
        //     {y: '2012', a: 150, b: 45, c:15},
        //     {y: '2013', a: 60, b: 150, c:195},
        //     {y: '2014', a: 180, b: 36, c:21},
        //     {y: '2015', a: 90, b: 60, c:360},
        //     {y: '2016', a: 75, b: 240, c:120},
        //     {y: '2017', a: 30, b: 30, c:30}
        // ];
        // this.createAreaChart('morris-area-example', 0, 0, $areaData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], ['#ccc', '#7a6fbe', '#3eb7ba']);

        //creating donut chart
        // var $donutData = [
        //     {label: "Download Sales", value: 12},
        //     {label: "In-Store Sales", value: 30},
        //     {label: "Mail-Order Sales", value: 20}
        // ];
        // this.createDonutChart('morris-donut-example', $donutData, ['#f0f1f4', '#7a6fbe', '#28bbe3']);

        // var $stckedData  = [
        //     { y: '2005', a: 45, b: 180},
        //     { y: '2006', a: 75,  b: 65},
        //     { y: '2007', a: 100, b: 90},
        //     { y: '2008', a: 75,  b: 65},
        //     { y: '2009', a: 100, b: 90},
        //     { y: '2010', a: 75,  b: 65},
        //     { y: '2011', a: 50,  b: 40},
        //     { y: '2012', a: 75,  b: 65},
        //     { y: '2013', a: 50,  b: 40},
        //     { y: '2014', a: 75,  b: 65},
        //     { y: '2015', a: 100, b: 90},
        //     { y: '2016', a: 80, b: 65}
        // ];
        // this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#28bbe3','#f0f1f4']);

    },
    //init
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing
function($) {
    "use strict";


    $.Dashboard.init();

    $('#opsi_demografi input').on('change', function(){
        
        $('#morris-bar-stacked').empty();
        $('#morris-donut-example').empty();

        if($("input[name='opsi_demografi']:checked").val() == 'gender'){
            $('#legenda').html(`
                    <div class="col-6">
                        <h5 id="jml_laki_laki" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-info">&nbsp;&nbsp;</span> Laki-laki</p>
                    </div>
                    <div class="col-6">
                        <h5 id="jml_perempuan" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-primary">&nbsp;&nbsp;</span> Perempuan</p>
                    </div>
                `);
            $.Dashboard.createStackedChart('morris-bar-stacked', $.Dashboard.dataGender, 'y', ['a', 'b'], ['Laki-laki', 'Perempuan'], ['#7a6fbe','#3eb7ba']);
            $('#jml_laki_laki').html($.Dashboard.summary.jml_laki_laki);
            $('#jml_perempuan').html($.Dashboard.summary.jml_perempuan);

            $.Dashboard.createDonutChart('morris-donut-example', $.Dashboard.sumGender, ['#7a6fbe', '#3eb7ba']);
        }
        else if($("input[name='opsi_demografi']:checked").val() == 'grade'){
            $('#legenda').html(`
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_basic" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-info">&nbsp;&nbsp;</span> BAS</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_specific" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-primary">&nbsp;&nbsp;</span> SPE</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_system" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-warning">&nbsp;&nbsp;</span> SYS</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_optimization" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-success">&nbsp;&nbsp;</span> OPT</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_advanced" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-danger">&nbsp;&nbsp;</span> ADV</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_integration" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-dark">&nbsp;&nbsp;</span> INT</p>
                    </div>
                `);

            $.Dashboard.createStackedChart('morris-bar-stacked', $.Dashboard.dataGrade, 'y', ['a', 'b', 'c', 'd', 'e', 'f'], ['Basic', 'Specific', 'System', 'Optimization', 'Advanced', 'Integration'], ['#7a6fbe','#3eb7ba', '#f5b225', '#58db83', '#ec536c', '#2a3142']);
            $('#jml_basic').html($.Dashboard.summary.jml_basic);
            $('#jml_specific').html($.Dashboard.summary.jml_specific);
            $('#jml_system').html($.Dashboard.summary.jml_system);
            $('#jml_optimization').html($.Dashboard.summary.jml_optimization);
            $('#jml_advanced').html($.Dashboard.summary.jml_advanced);
            $('#jml_integration').html($.Dashboard.summary.jml_integration);

            $.Dashboard.createDonutChart('morris-donut-example', $.Dashboard.sumGrade, ['#7a6fbe','#3eb7ba', '#f5b225', '#58db83', '#ec536c', '#2a3142']);
        }
        else if($("input[name='opsi_demografi']:checked").val() == 'generasi'){
            
            $('#legenda').html(`
                    <div class="col-lg-3 col-4">
                        <h5 id="jml_baby_boomer" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-info">&nbsp;&nbsp;</span> Baby Boomer</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_generasi_x" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-primary">&nbsp;&nbsp;</span> Gen X</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_generasi_y" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-warning">&nbsp;&nbsp;</span> Gen Y</p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h5 id="jml_generasi_z" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-success">&nbsp;&nbsp;</span> Gen Z</p>
                    </div>
                    <div class="col-lg-3 col-6">
                        <h5 id="jml_generasi_alpha" class=""></h5>
                        <p class="text-muted font-14">
                        <span class="badge badge-danger">&nbsp;&nbsp;</span> Gen Alpha</p>
                    </div>
                `);
            $.Dashboard.createStackedChart('morris-bar-stacked', $.Dashboard.dataGenerasi, 'y', ['a', 'b', 'c', 'd', 'e'], ['Baby Boomer', 'Generasi X', 'Gen Y / Milenial', 'Gen Z / iGeneration', 'Generasi Alpha'], ['#7a6fbe','#3eb7ba', '#f5b225', '#58db83', '#ec536c']);
            $('#jml_baby_boomer').html($.Dashboard.summary.jml_baby_boomer);
            $('#jml_generasi_x').html($.Dashboard.summary.jml_generasi_x);
            $('#jml_generasi_y').html($.Dashboard.summary.jml_generasi_y);
            $('#jml_generasi_z').html($.Dashboard.summary.jml_generasi_z);
            $('#jml_generasi_alpha').html($.Dashboard.summary.jml_generasi_alpha);

            $.Dashboard.createDonutChart('morris-donut-example', $.Dashboard.sumGenerasi, ['#7a6fbe','#3eb7ba', '#f5b225', '#58db83', '#ec536c']);
        }
    });

    $('div#mutasi').block({ message: null });
    $('div#mutasi .inbox-wid').empty();
    $.getJSON('dashboard/get_mutasi_terbaru', function(data){
        $.each(data, function(k,v){
            console.log(v);
            $('div#mutasi .inbox-wid').append( `
                <a href="#" class="text-dark">
                    <div class="inbox-item">
                        <div class="inbox-item-img float-left mr-3"><img src="../assets/images/photos/`+v.nipeg+`.jpg" class="thumb-md rounded-circle" alt=""></div>
                        <h6 class="inbox-item-author mt-0 mb-1">`+v.nama_pegawai+`</h6>
                        <p class="inbox-item-text text-muted mb-0">`+v.position_sname+' - '+v.org2_sname+`</p>
                        <p class="inbox-item-date text-muted">`+v.start_date+`</p>
                    </div>
                </a>
            `);
        });

        $('div#mutasi').unblock();
    });

    $('div#pensiun').block({ message: null });
    $('div#pensiun .inbox-wid').empty();
    $.getJSON('dashboard/get_pensiun_terbaru', function(data){
        $.each(data, function(k,v){
            console.log(v);
            $('div#pensiun .inbox-wid').append( `
                <a href="#" class="text-dark">
                    <div class="inbox-item">
                        <div class="inbox-item-img float-left mr-3"><img src="../assets/images/photos/`+v.nipeg+`.jpg" class="thumb-md rounded-circle" alt=""></div>
                        <h6 class="inbox-item-author mt-0 mb-1">`+v.nama_pegawai+`</h6>
                        <p class="inbox-item-text text-muted mb-0">`+v.pers_subarea_text+`</p>
                        <p class="inbox-item-date text-muted">`+v.start_date+`</p>
                    </div>
                </a>
            `);
        });

        $('div#pensiun').unblock();
    });

}(window.jQuery);
