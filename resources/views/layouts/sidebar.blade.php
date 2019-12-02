            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="{{ URL::to('/') }}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i><span class="badge badge-primary badge-pill float-right">2</span> <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('/') }}calendar" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Calendar </span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email-outline"></i><span> Email <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/email-inbox">Inbox</a></li>
                                    <li><a href="{{ URL::to('/') }}/email-read">Email Read</a></li>
                                    <li><a href="{{ URL::to('/') }}/email-compose">Email Compose</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">Organisasi</li>
                            <li>
                                <a href="{{ URL::to('/') }}/organisasi/chart" class="waves-effect"><i class="mdi mdi-file-tree"></i><span> Struktur Organisasi </span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email-outline"></i><span> Dummy <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/email-inbox">Inbox</a></li>
                                    <li><a href="{{ URL::to('/') }}/email-read">Email Read</a></li>
                                    <li><a href="{{ URL::to('/') }}/email-compose">Email Compose</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Components</li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> UI Elements <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/ui-alerts">Alerts</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-buttons">Buttons</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-badge">Badge</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-cards">Cards</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-carousel">Carousel</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-dropdowns">Dropdowns</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-grid">Grid</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-images">Images</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-lightbox">Lightbox</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-modals">Modals</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-pagination">Pagination</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-popover-tooltips">Popover & Tooltips</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-rangeslider">Range Slider</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-session-timeout">Session Timeout</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-progressbars">Progress Bars</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-sweet-alert">Sweet-Alert</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-tabs-accordions">Tabs & Accordions</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-typography">Typography</a></li>
                                    <li><a href="{{ URL::to('/') }}/ui-video">Video</a></li>


                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Forms <span class="badge badge-pill badge-success float-right">6</span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/form-elements">Form Elements</a></li>
                                    <li><a href="{{ URL::to('/') }}/form-validation">Form Validation</a></li>
                                    <li><a href="{{ URL::to('/') }}/form-advanced">Form Advanced</a></li>
                                    <li><a href="{{ URL::to('/') }}/form-editors">Form Editors</a></li>
                                    <li><a href="{{ URL::to('/') }}/form-uploads">Form File Upload</a></li>
                                    <li><a href="{{ URL::to('/') }}/form-xeditable">Form Xeditable</a></li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-line"></i><span> Charts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/charts-morris">Morris Chart</a></li>
                                    <li><a href="{{ URL::to('/') }}/charts-chartist">Chartist Chart</a></li>
                                    <li><a href="{{ URL::to('/') }}/charts-chartjs">Chartjs Chart</a></li>
                                    <li><a href="{{ URL::to('/') }}/charts-flot">Flot Chart</a></li>
                                    <li><a href="{{ URL::to('/') }}/charts-c3">C3 Chart</a></li>
                                    <li><a href="{{ URL::to('/') }}/charts-other">Jquery Knob Chart</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted-type"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/tables-basic">Basic Tables</a></li>
                                    <li><a href="{{ URL::to('/') }}/tables-datatable">Data Table</a></li>
                                    <li><a href="{{ URL::to('/') }}/tables-responsive">Responsive Table</a></li>
                                    <li><a href="{{ URL::to('/') }}/tables-editable">Editable Table</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i> <span> Icons  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/icons-material">Material Design</a></li>
                                    <li><a href="{{ URL::to('/') }}/icons-ion">Ion Icons</a></li>
                                    <li><a href="{{ URL::to('/') }}/icons-fontawesome">Font Awesome</a></li>
                                    <li><a href="{{ URL::to('/') }}/icons-themify">Themify Icons</a></li>
                                    <li><a href="{{ URL::to('/') }}/icons-dripicons">Dripicons</a></li>
                                    <li><a href="{{ URL::to('/') }}/icons-typicons">Typicons Icons</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-maps"></i><span> Maps <span class="badge badge-pill badge-danger float-right">2</span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/maps-google"> Google Map</a></li>
                                    <li><a href="{{ URL::to('/') }}/maps-vector"> Vector Map</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Extras</li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-location"></i><span> Authentication <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/pages-login">Login</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-register">Register</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-recoverpw">Recover Password</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-lock-screen">Lock Screen</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-pages"></i><span> Extra Pages <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ URL::to('/') }}/pages-timeline">Timeline</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-invoice">Invoice</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-directory">Directory</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-blank">Blank Page</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-404">Error 404</a></li>
                                    <li><a href="{{ URL::to('/') }}/pages-500">Error 500</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->