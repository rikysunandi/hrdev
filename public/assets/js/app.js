/*
 Template Name: lexa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 Website: www.themesbrand.com
 File: Main js
 */


!function($) {
    "use strict";

    var MainApp = function() {};

    MainApp.prototype.intSlimscrollmenu = function () {
        $('.slimscroll-menu').slimscroll({
            height: 'auto',
            position: 'right',
            size: "5px",
            color: '#9ea5ab',
            wheelStep: 5,
            touchScrollStep: 50
        });
    },
    MainApp.prototype.initSlimscroll = function () {
        $('.slimscroll').slimscroll({
            height: 'auto',
            position: 'right',
            size: "5px",
            color: '#9ea5ab',
            touchScrollStep: 50
        });
    },

    MainApp.prototype.initMetisMenu = function () {
        //metis menu
        $("#side-menu").metisMenu();
    },

    MainApp.prototype.initLeftMenuCollapse = function () {
        // Left menu collapse
        $('.button-menu-mobile').on('click', function (event) {
            event.preventDefault();
            $("body").toggleClass("enlarged");
        });
    },

    MainApp.prototype.initEnlarge = function () {
        if ($(window).width() < 1025) {
            $('body').addClass('enlarged');
        } else {
            $('body').removeClass('enlarged');
        }
    },

    MainApp.prototype.initActiveMenu = function () {
        // === following js will activate the menu in left side bar based on url ====
        $("#sidebar-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().addClass("in");
                $(this).parent().parent().prev().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("in"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("active");
            }
        });
    },

    MainApp.prototype.initComponents = function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    },

    MainApp.prototype.initHeaderCharts = function () {
        $('#header-chart-1').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
            type: 'bar',
            height: '35',
            barWidth: '5',
            barSpacing: '3',
            barColor: '#7A6FBE'
        });
        $('#header-chart-2').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
            type: 'bar',
            height: '35',
            barWidth: '5',
            barSpacing: '3',
            barColor: '#29bbe3'
        });
    },


    MainApp.prototype.initDarkMode = function () {
        $('#sw_darkmode').change(function(x){
            console.log('CHANGE', x);
            var darkmode;
            if($(this).is(":checked")) {
                darkmode='Y';
            }else{
                darkmode='T';
            }

            $.ajax({
                 url: "set_session.php",
                 data: {darkmode: darkmode }
            });
            //$.redirect(APP_URL+'/profile', {prev_per_no: suggestion.prev_per_no, _token: csrf_token}, "POST");
        });
    },

    MainApp.prototype.initCariPegawai = function () {

        var pegawai = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('personnel_number'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // The url points to a json file that contains an array of country names
            prefetch: APP_URL+'/data/get-pegawai'
        });
        
        // Initializing the typeahead with remote dataset without highlighting
        $('#top_prev_per_no').typeahead(null, {
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
                    return '<div class="row no-marginLR">'+
                        '<div class="col-3 no-padding"><img src="'+data.img+'" width="48" height="48" /></div>'+
                        '<div class="col-9"><strong>' + data.prev_per_no + '</strong><br/>' + data.personnel_number + '</div></row>';
                }
                //suggestion: Handlebars.compile('<div><strong>{{prev_per_no}}</strong> – {{personnel_number}}</div>')
            },
            limit: 10 
        });

        $('#top_prev_per_no').bind('typeahead:select', function(ev, suggestion) {
          console.log('ev: ', ev);
          console.log('Selection: ', suggestion);
            //window.location.href = APP_URL+'/profile/'+suggestion.prev_per_no;
            $.redirect(APP_URL+'/profile', {pers_no: suggestion.pers_no, _token: csrf_token}, "POST"); 
        });

    },


    MainApp.prototype.init = function () {
        this.intSlimscrollmenu();
        this.initSlimscroll();
        this.initMetisMenu();
        this.initLeftMenuCollapse();
        this.initEnlarge();
        this.initActiveMenu();
        this.initComponents();
        this.initHeaderCharts();
        this.initCariPegawai();
        this.initDarkMode();
        Waves.init();
    },

    //init
    $.MainApp = new MainApp, $.MainApp.Constructor = MainApp
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.MainApp.init();
}(window.jQuery);
