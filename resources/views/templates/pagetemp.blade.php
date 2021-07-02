<!doctype html>
<html>
	<head>
		<title>@yield('pagename')|DriverLocator</title>
		<link rel="icon" href="http://reshupdd.ru/site-content/gallery/site/favicon.ico" type="image/x-icon">
		<meta name="description" content="Locator"> 
		<meta charset="utf-8">
        <link rel="stylesheet" href="http://reshupdd.ru/css/mainstyle.css">
        <link rel="stylesheet" href="http://reshupdd.ru/css/theme-black.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
         <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
	</head>
	<body>
        <header>
            <div class="menu">
                <a href="/" class="logo"><h1 style="display: inline;">Driver Locator</h1><i style="color:white"> При поддержке РешуПДД.РУ</i></a>
                <ul>
                    <li><a class="button2" href="{{route('index')}}">Главная</a></li>
                </ul>
            </div>
        </header>
        <section>
            @yield('content')
        </section>
        <footer>
        
        </footer>
	</body>
</html>