@extends('templates.pagetemp')

@section('pagename', 'Главная страница')

@section('content')
    <h1>Интерактивная карта</h1>
    <div style="width:100%;">
        <div class="mapbox" style="width:70%;height:90vh;display:inline-block;" id="mapbox">

        </div>
        <div class="rightbox" style="width:20%; display:inline-block; vertical-align:top;">
            <div id="settingsBox">
                <h3>Настройки</h3>  
            </div>
            <hr>
            <div id="searchBox">
                <h3>Поиск</h3>
                <input type="text" id="adressSearch" style="width:100%;">
                <div id="suggestions">

                </div>
            </div>
            <hr>
        </div>
    </div>


    <script>
        //settings stuff
        var mainMap;
        class Settings {
            showAccidents = true;
            showFriends = false;
            showSigns = false;
        }
        let mapSettings = new Settings();

        //init stuff
        window.addEventListener("load", function(){
            InitMap();
        });

        function InitMap(){
            mainMap = L.map('mapbox').setView([59.93863, 30.31413], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(mainMap);
        }

        //api stuff
        




        //find input
        document.getElementById('adressSearch').addEventListener("keyup", function (evt) {
            //console.log(SuggestAdress(this.value));
            SuggestAdress(this.value);
        }, false);
        function SuggestAdress(adress){
            var suggestionUrl = "http://locator.reshupdd.ru/api/suggestAdress";
            var params = "?adress="+adress;
            var Httpreq = new XMLHttpRequest(); 
			Httpreq.open("GET",suggestionUrl+params,false);
			Httpreq.send(null);
			var jsonOBJ = JSON.parse(Httpreq.responseText);    
            var suggestPlaceholder = document.getElementById("suggestions");
            suggestPlaceholder.innerHTML = null;
            for(var i in jsonOBJ.content){
                //console.log(jsonOBJ.content[i].value);
                suggestPlaceholder.innerHTML += '<a href="javascript:moveMapTo('+jsonOBJ.content[i].data.geo_lat+','+jsonOBJ.content[i].data.geo_lon+')" class="button1" style="width:100%">'+jsonOBJ.content[i].value+'</a>';
            }
        }
        function moveMapTo(lat, lon){
            mainMap.setView([lat,lon],17);
        }
        function getNearAccidents(){
            //http://locator.reshupdd.ru/api/getAccidents?distance=10&lat=59.951777&lon=30.349350
            var accidentsUrl = "http://locator.reshupdd.ru/api/getAccidents";
            var params = "?distance=10&lat=59.951777&lon=30.349350";
            var Httpreq = new XMLHttpRequest(); 
			Httpreq.open("GET",accidentsUrl+params,false);
			Httpreq.send(null);
			var jsonOBJ = JSON.parse(Httpreq.responseText);  
            for(var i in jsonOBJ.content){
                L.marker([jsonOBJ.content[i].lat, jsonOBJ.content[i].lon], {icon: greenIcon}).addTo(mainMap);
            }
        }


    </script>

    <script>
        var yobaIcon = L.icon({
            iconUrl: '/site-content/map/icons/yoba.png',
            //shadowUrl: '',

            iconSize:     [24, 24], // size of the icon
            //shadowSize:   [28, 64], // size of the shadow
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
            //shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        var trafficJam = L.icon({
            iconUrl: '/site-content/map/icons/yoba.png',
            iconSize:     [24, 24], 
            iconAnchor:   [12, 12], 
            popupAnchor:  [-3, -76] 
        });
        var constructions = L.icon({
            iconUrl: '/site-content/map/icons/yoba.png',
            iconSize:     [24, 24], // size of the icon
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        var accident = L.icon({
            iconUrl: '/site-content/map/icons/yoba.png',
            iconSize:     [24, 24], // size of the icon
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
    </script>
@endsection