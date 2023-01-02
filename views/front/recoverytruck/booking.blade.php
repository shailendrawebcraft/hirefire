@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")
        <div class="back-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{route('recoverytruck.vehicleinfo')}}">
                            <span class="material-symbols-outlined mt-2" >   keyboard_backspace  </span> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="map-outer">

        </div>
        <div class="find-location-outer">
            <div class="container-fluid">
                <form action="{{ route('recoverytruck.bookingverify') }}" method="post" class="vehicle-type"  autocomplete="off">
                    <div class="row">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <p class="mb-1">Point of Pickup</p>
                                <div class="input-group">
                                    <input type="text" name="pickup" id="pickup" class="form-control" value="{{old('pickup')}}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                    <input type="hidden" name="pickuplat" id="picklat"/>
                                    <input type="hidden" name="pickuplng" id="picklng"/>
                                    <input type="hidden" name="pickemirates" id="pickemirates" />

                                    <!-- <div class="input-group-append">
                                        <button class="btn btn-tpt" type="button">
                                            <span class="material-symbols-outlined">search</span>
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <p class="mb-1">Point of Drop off</p>
                                <div class="input-group">
                                    <input type="text" name="drop" id="drop" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                    <input type="hidden" name="droplat" id="droplat" />
                                    <input type="hidden" name="droplng" id="droplng" />
                                    <input type="hidden" name="distance" id="distance" />
                                    <input type="hidden" name="dropemirates" id="dropemirates" />
                                    <!-- <div class="input-group-append">
                                        <button class="btn btn-tpt" type="button">
                                            <span class="material-symbols-outlined">search</span>
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <p class="mb-1">Recommended Drop off</p>
                            <div class="input-group recm-chips">
                            <div class="flex-list">
                                @foreach($shopTypes as $shopType)
                                    <a href="javascript:void(0)" data-id="{{$shopType->id}}" data-toggle="modal" data-target="#listModal" class="call-modal btn btn-sm btn-primary btn-outline-warning">
                                        {!! get_shop_type_icon($shopType->id) !!}
                                        {{$shopType->name}}
                                    </a>
                                @endforeach
                            </div>
                                
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark btn-block">PICKUP NOW</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal " id="listModal">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Listing</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="material-symbols-outlined"> close </span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=init&libraries=places&key={{env('GOOGLE_CLOUD_API_KEY')}}"></script>
    <script>
        let autocomplete, input, bounds, boundsListener, directionsDisplay, directionsService, mapOptions, infowindow, map, marker;
        let baseUrl = window.location.origin;
        let mapLoad = document.getElementsByClassName('map-outer')[0];

        function init() {
            navigator.geolocation.getCurrentPosition(function(response) {
                var mapOptions = {
                    center: new google.maps.LatLng(response.coords.latitude, response.coords.longitude),
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                map = new google.maps.Map(mapLoad, mapOptions);

                marker = new google.maps.Marker({
                    draggable: true,
                    position: new google.maps.LatLng(response.coords.latitude, response.coords.longitude),
                    map: map,
                    animation:google.maps.Animation.Drop
                });

                document.getElementById("picklat").value = response.coords.latitude;
                document.getElementById("picklng").value = response.coords.longitude;

                setMarkerInfo('#pickup')

                new google.maps.event.addListener(map, 'click', function(event) {
                    var myLatLng = event.latLng;
                    var lat = myLatLng.lat();
                    var lng = myLatLng.lng();
                    
                    document.getElementById("picklat").value = lat;
                    document.getElementById("picklng").value = lng;

                    marker.setMap(null)
                    showPickPosition();
                    setMarker();
                });

                initialize();         
            });   
        }

        initialize = () => {
            mapOptions = {
                mapTypeId: 'roadmap'
            };
            directionsService = new google.maps.DirectionsService();
            directionsDisplay = new google.maps.DirectionsRenderer();
            bounds = new google.maps.LatLngBounds();

            input = document.getElementById('pickup');
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            
            dropinput = document.getElementById('drop');
            dropautocomplete = new google.maps.places.Autocomplete(dropinput);
            dropautocomplete.bindTo('bounds', map);

            infowindow = new google.maps.InfoWindow();

            new google.maps.event.addListener(autocomplete, 'place_changed', function() {
                infowindow.close();
                var place = autocomplete.getPlace();
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(16);  // Why 17? Because it looks good.
                }
                // console.log(place);
                $('#picklat').val(place.geometry.location.lat);
                $('#picklng').val(place.geometry.location.lng);

                
                marker.setMap(null)
                setMarker();
                setEmiratesFromAddress($('#pickup').val(), "#pickemirates");

            });

            new google.maps.event.addListener(dropautocomplete, 'place_changed', function() {
                infowindow.close();
                var place = dropautocomplete.getPlace();
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(16);  // Why 17? Because it looks good.
                }

                $('#droplat').val(place.geometry.location.lat());
                $('#droplng').val(place.geometry.location.lng());

                setMarker();
                setEmiratesFromAddress($('#drop').val(), "#dropemirates");

            });

            showPickPosition();
        }

        setMarker = () => {
            if($('#drop').val().length > 0) {
                const directionsService = new google.maps.DirectionsService();
                const directionsRenderer = new google.maps.DirectionsRenderer({
                    draggable: true,
                    map,
                    panel: mapLoad,
                });

                directionsRenderer.addListener("directions_changed", () => {
                    const directions = directionsRenderer.getDirections();
                });

                displayRoute(
                    $('#pickup').val(),
                    $('#drop').val(),
                    directionsService,
                    directionsRenderer
                );

                    const originLat = $('#picklat').val();
                    const originLng = $('#picklng').val();
                    const destinationLat = $('#droplat').val();
                    const destinationLng = $('#droplng').val();
                    const origin1 = new google.maps.LatLng(originLat, originLng);
                    const origin2 = $('#pickup').val();
                    const destinationA = $('#drop').val();
                    const destinationB = new google.maps.LatLng(destinationLat, destinationLng);
                    getDistance(origin1, origin2, destinationA, destinationB);
                    calcRoute(new google.maps.LatLng(originLat, originLng), new google.maps.LatLng(destinationLat, destinationLng))
            } else {
                const originLat = $('#picklat').val();
                const originLng = $('#picklng').val();
                const origin1 = new google.maps.LatLng(originLat, originLng);
                const origin2 = $('#pickup').val();
                let bookingMarkers = [[$('#pickup').val(), $('#picklat').val(), $('#picklng').val()]];
                let infoWindowContent = [[`#pickup`]];

                // Add multiple bookingMarkers to map
                let i;
                
                // Place each marker on the map  
                if(bookingMarkers.length === 1) {
                    for( i = 0; i < bookingMarkers.length; i++ ) {
                        var position = new google.maps.LatLng(bookingMarkers[i][1], bookingMarkers[i][2]);
                        var infoWindow = new google.maps.InfoWindow({
                            content: name
                        });

                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            draggable: true,
                            position: position,
                            map: map,
                            title: bookingMarkers[i][0],
                            animation:google.maps.Animation.Drop
                        });
                        
                        // Add info window to marker    
                        setMarkerInfo(infoWindowContent[i][0]);
                        
                        // Center the map to fit all bookingMarkers on the screen
                        map.fitBounds(bounds);
                        // map.setZoom(16);
                    }
                }
            }

                return false;

                let bookingMarkers = [[$('#pickup').val(), $('#picklat').val(), $('#picklng').val()]];
                let infoWindowContent = [[`#pickup`]];
                bookingMarkers.push([$('#drop').val(), $('#droplat').val(), $('#droplng').val()]);
                infoWindowContent.push([`#drop`]);

            // Add multiple bookingMarkers to map
            let i;
            
            // Place each marker on the map  
            if(bookingMarkers.length === 1) {
                for( i = 0; i < bookingMarkers.length; i++ ) {
                    var position = new google.maps.LatLng(bookingMarkers[i][1], bookingMarkers[i][2]);
                    var infoWindow = new google.maps.InfoWindow({
                        content: name
                    });

                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        draggable: true,
                        position: position,
                        map: map,
                        title: bookingMarkers[i][0],
                        animation:google.maps.Animation.Drop
                    });
                    
                    // Add info window to marker    
                    setMarkerInfo(infoWindowContent[i][0]);
                    
                    // Center the map to fit all bookingMarkers on the screen
                    map.fitBounds(bounds);
                }
            }

            let originLat = $('#picklat').val();
            let originLng = $('#picklng').val();
            let destinationLat = $('#droplat').val();
            let destinationLng = $('#droplng').val();
            var origin1 = new google.maps.LatLng(originLat, originLng);
            var origin2 = $('#pickup').val();
            var destinationA = $('#drop').val();
            var destinationB = new google.maps.LatLng(destinationLat, destinationLng);

            if($('#drop').val().length > 0) {
                getDistance(origin1, origin2, destinationA, destinationB);
                calcRoute(new google.maps.LatLng(originLat, originLng), new google.maps.LatLng(destinationLat, destinationLng))
            }

            // google.maps.event.addListener(marker, 'dragend', function (event) {
            //     console.log(event)
            //     // document.getElementById("lat").value = event.latLng.lat();
            //     // document.getElementById("long").value = event.latLng.lng();
            // });
        }

        displayRoute = (origin, destination, service, display) => {
            service.route({
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING,
                    avoidTolls: true,
                    // drivingOptions: {
                    //     departureTime: new Date(Date.now() + 3000),
                    //     trafficModel: 'optimistic'
                    // },
                    unitSystem: google.maps.UnitSystem.METRIC,
                    // avoidHighways: true,
                })
                .then((result) => {
                    display.setDirections(result);
                    console.log(result);
                })
                .catch((e) => {
                    alert("Could not display directions due to: " + e);
                });
            }

        setMarkerInfo = (identifer) => {
            var infoWindow = new google.maps.InfoWindow({
                content: name
            });
                                
            // Add info window to marker    
            new google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(`<div class="info_content"><p>${$(identifer).val()}</p></div>`);
                    infoWindow.open(map, marker);
                }
            })(marker));
        }

        calcRoute = (start, end) => {
            marker.setMap(null)
            var bounds = new google.maps.LatLngBounds();
            bounds.extend(start);
            bounds.extend(end);
            map.fitBounds(bounds);
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    directionsDisplay.setMap(map);
                } else {
                    alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                }
            });

            // Set zoom level
            boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(16);
                google.maps.event.removeListener(boundsListener);
            });
        }
        
        getDistance = (origin1, origin2, destinationA, destinationB) => {
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
            {
                origins: [origin1, origin2],
                destinations: [destinationA, destinationB],
                travelMode: 'DRIVING',
                // drivingOptions: {
                //     departureTime: new Date(Date.now() + 3000),
                //     trafficModel: 'optimistic'
                // },
                unitSystem: google.maps.UnitSystem.METRIC,
                // avoidHighways: true,
                // avoidTolls: true,
            }, callback);
        }

        callback = (response, status) => {
            // See Parsing the Results for
            // the basics of a callback function.
            // var origins = response.originAddresses;
            // var destinations = response.destinationAddresses;
            // console.log(origins, destinations);
            // console.log(response, status);

            setEmiratesFromAddress(response.originAddresses[1], "#pickemirates");
            setEmiratesFromAddress(response.destinationAddresses[1], "#dropemirates");

              
            if(status == 'OK'){
                // console.log('distance: ', response.rows[0].elements[0]);
                if(response.rows[0].elements[0].status == 'OK') {
                    $('#distance').val( response.rows[0].elements[0].distance.value );
                }
                // console.log('distance: ', response.rows[0].elements[0].distance.value, response.rows[0].elements[0].distance.text)
                // return response.rows[0].elements[0].distance.value;
            }
        }

        showPickPosition = () => {
            var lat = $('#picklat').val();
            var lang = $('#picklng').val();
            let apikey = '{{env('GOOGLE_CLOUD_API_KEY')}}';
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lang + "&sensor=true&key="+apikey;

            $.getJSON(url, function (data) {
                let fromaddress = data.results[0].formatted_address;
                if(fromaddress.length > 3) {
                    $("#pickup").val(fromaddress);
                    setEmiratesFromAddress(fromaddress, "#pickemirates");
                }
            });
        } 

        showDropPosition = () => {
            var lat = $('#droplat').val();
            var lang = $('#droplng').val();
            let apikey = '{{env('GOOGLE_CLOUD_API_KEY')}}';
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lang + "&sensor=true&key="+apikey;

            $.getJSON(url, function (data) {
                let toaddress = data.results[0].formatted_address;
                if(toaddress.length > 3) {
                    // $("#drop").val(toaddress);
                    console.log(toaddress);
                    setEmiratesFromAddress(toaddress, "#dropemirates");
                }
            });
        } 

        $(document).ready(function() {
            // new google.maps.event.addDomListener(mapLoad, 'load', init);
            // window.addEventListener('load', (event) => { init(); });

            $("#navToggle").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
            });

            $(".dropshadow").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
            });
        })

        $(document).on('click', '.call-modal', function() {
            const shoptypeid = $(this).data('id');
            const shoptypeName = $(this).text();
            const pickLat = $('#picklat').val();
            const pickLng = $('#picklng').val();
            let urlLike = baseUrl + '/recoverytruck/getworkshops'
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                type: "POST",
                url: urlLike,
                data: {
                    shoptype_id: shoptypeid,
                    pick_lat: pickLat,
                    pick_lng: pickLng
                },
                success: function(data) {
                    $('.modal-body').html(data);
                    $('.modal-title').text(shoptypeName);


                    // Loop for distance
                    let loopCounter = 0;
                    $('.modal-body').find('a').each((index, e) => {
                        loopCounter++;
                        var destinationLat = $(e).data('lat');
                        var destinationLng = $(e).data('lng');
                        var origin1 = new google.maps.LatLng(pickLat, pickLng);
                        var origin2 = $('#pickup').val();                        
                        var destinationA = $(e).data('name')+', '+$(e).data('add');
                        var destinationB = new google.maps.LatLng(destinationLat, destinationLng);
                        var listid = $(e).data('id');
                        // getPointDistance(origin1, origin2, destinationA, destinationB, listid).then(distance => {
                        //     let destinationDistance = (distance / 1000).toFixed(2)
                        //     $('#distance-'+listid).text(destinationDistance);
                        //     $('#shop-'+listid).attr('data-distance', destinationDistance);
                        //     loopCounter--;

                        //     if (loopCounter == 0) sortList();
                        // })
                        $('#distance').val($(e).data('distance'));
                    })
                    // sortList()
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                }
            });
        })

        function sortList(){
            $(".modal-list li").sort(sort_li) // sort elements
                            .appendTo('.modal-list'); // append again to the list
        }

        function sort_li(a, b){
            return ($(b).data('distance')) < ($(a).data('distance')) ? 1 : -1;    
        }

        getPointDistance = async (origin1, origin2, destinationA, destinationB) => {
            var service = new google.maps.DistanceMatrixService();
            const result = await service.getDistanceMatrix(
            {
                origins: [origin1, origin2],
                destinations: [destinationA, destinationB],
                travelMode: 'DRIVING',
                // drivingOptions: 'DRIVING',
                unitSystem: google.maps.UnitSystem.METRIC,
                // avoidHighways: Boolean,
                // avoidTolls: Boolean,
            })
            return result.rows[0].elements[0].distance.value;
        }

        $(document).on('click', '.drop-button', function() {
            $('#droplat').val($(this).data('lat'));
            $('#droplng').val($(this).data('lng'));
            $('#drop').val($(this).data('name') +', '+ $(this).data('add'));
            $('#dropemirates').val($(this).data('emirates'));
            setMarker();
            setEmiratesFromAddress($('#drop').val(), '#dropemirates');
        });

        const setEmiratesFromAddress = (address, identifier) => {
            const emirates = ['Dubai', 'Sharjah', 'Umm Al Quwain', 'Ras Al Khaimah', 'Fujairah', 'Abu Dhabi', 'Ajman'];
            emirates.forEach(emirate => {
                if(address.includes(emirate)) {
                    $(identifier).val(emirate);
                }
            })
        }

    </script>
@endsection