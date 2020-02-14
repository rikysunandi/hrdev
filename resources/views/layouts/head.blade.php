		<meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">

        @yield('css')

        <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css">

        <style type="text/css">
			.bs-example {
				font-family: sans-serif;
				position: relative;
				margin: 100px;
			}
			.typeahead, .tt-query, .tt-hint {
				border: 2px solid #CCCCCC;
				border-radius: 8px;
				font-size: 12px; /* Set input font size */
				height: 30px;
				line-height: 30px;
				outline: medium none;
				padding: 8px 12px;
				width: 196px;
			}
			.typeahead {
				background-color: #FFFFFF;
			}
			.typeahead:focus {
				border: 2px solid #0097CF;
			}
			.tt-query {
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			}
			.tt-hint {
				color: #999999;
			}
			.tt-menu {
				background-color: #FFFFFF;
				border: 1px solid rgba(0, 0, 0, 0.2);
				border-radius: 8px;
				box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
				margin-top: 12px;
				padding: 8px 0;
				width: 222px;
			}
			.tt-suggestion {
				font-size: 12px;  /* Set suggestion dropdown font size */
				padding: 3px 20px;
			}
			.tt-suggestion:hover {
				cursor: pointer;
				background-color: #0097CF;
				color: #FFFFFF;
			}
			.tt-suggestion p {
				margin: 0;
			}

			.empty-message {
			  padding: 5px 10px;
			 text-align: center;
			}
		</style>