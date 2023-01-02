@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")
    <div class="slider-full">
        <div class="owl-carousel owl-theme" id="owl-carousel8">
            <div class="item">
                <img src="{{url('images/banner/banner-1.jpg')}}" class="w-100" alt="Jasper Real Estate">
            </div>
            <div class="item">
                <img src="{{url('images/banner/banner-2.jpg')}}" class="w-100" alt="Jasper Real Estate">
            </div>
        </div>    
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-heading">Recover my -</h2>
            </div>
        </div>
        <ul class="ser-list">
            @foreach($vehicleTypes as $key => $vehicleType) 
                <li class="wow fadeIn" data-wow-duration="1s" data-wow-delay="{{0.16 * $key+1}}s">
                    <div class="service-box" data-id="{{ $vehicleType->id }}" data-name="{{ $vehicleType->name }}">
                        <a href="javascript:void(0)">
                            <div class="icon-outer">
                                {!! get_vehicle_type_icon($vehicleType->name) !!}
                            </div>
                            <h3>{{ $vehicleType->name }}</h3>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="row" id="vehicle-info">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
            <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></p>
            @endforeach
            </div>
        @endif
        @csrf
            
        </div>
    </div>
@endsection

@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ url('js/wow.js') }}"></script>
    <script src="{{ url('js/owl.carousel.min.js') }}"></script>
    <script>        
        let baseUrl = window.location.origin
        $(document).ready(function() {
            $("#navToggle").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
            });
            $(".dropshadow").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
                s
            });

            $("#owl-carousel8").owlCarousel({
                loop: !0,
                margin: 0,
                autoplay: !0,
                autoplayTimeout: 8e3,
                items: 1,
                nav: !0,
                dots: !1,
                touchDrag: true,
                mouseDrag: true,
                animateOut: "fadeOut",
                animateIn: "fadeIn"
            }), $(".owl-prev").html('<span class="material-symbols-sharp"> ‹ </span>'), $(".owl-next").html('<span class="material-symbols-sharp"> › </span>');
        
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        
            let vehicleId = '{{old('vehicle_id')}}';
            
            setTimeout(() => {
                $('.service-box').each(function(e){
                    if($(this).data('id') == vehicleId){
                        $(this).click();
                    }
                });
            }, 2000);
        
        }),
        //animated class for scroll
        wow = new WOW(

            {

                animateClass: 'animated',

                offset: 100,

                callback: function(box) {

                }
            }

        );

        wow.init();

        $('*').each(function() {

            if ($(this).attr('data-animation')) {

                var $animationName = $(this).attr('data-animation'),

                    $animationDelay = "delay-" + $(this).attr('data-animation-delay');

                $(this).appear(function() {

                    $(this).addClass('wow').addClass($animationName);

                    $(this).addClass('wow').addClass($animationDelay);

                });

            }

        });

        $(document).on('click', '.service-box', function() {
            const vehicle_id = $(this).data('id');
            const serviceTypeObj = $(this);
            if($('.additional-info').length) {
                $('.additional-info').remove();
            }

            $('#vehicle_id').val('');
            $('.service-box').each(function(e){
                $(this).removeClass('active');
            });
            if(!$(this).hasClass('active')) {
                $(this).addClass('active');
                $('#vehicle-info').show('slow');
                $("html, body").animate({ scrollTop: $(document).height() }, 1000);
                $('#vehicle_id').val(vehicle_id);
            }

            if(vehicle_id > 0) {
                let urlLike = baseUrl + '/recoverytruck/getForm'
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    },
                    type: "POST",
                    url: urlLike,
                    data: {
                        vehicletype_id: vehicle_id
                    },
                    success: function(data) {
                        $('#vehicle-info').html(data);
                        $('#vehicle_id').val(vehicle_id);

                        if($(serviceTypeObj).data('name').toLowerCase() == 'bus' || $(serviceTypeObj).data('name').toLowerCase() == 'truck' || $(serviceTypeObj).data('name').toLowerCase() == 'construction equipment' || $(serviceTypeObj).data('name').toLowerCase() == 'construction eq.') {
                            let urlLike1 = baseUrl + '/recoverytruck/getvehicleotherdetails'
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                                },
                                type: "POST",
                                url: urlLike1,
                                data: {
                                    vehicletype_id: vehicle_id
                                },
                                success: function(data) {
                                    $('#other-details').html(data);
                                    
                                    $('#country').attr('disabled', 'true');
                                    $('#plate-number').after($('.additional-info'));
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log(XMLHttpRequest);
                                }
                            });
                        } else {
                            $('#other-details').html('')
                            $('#country').removeAttr('disabled')

                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                    }
                });
            }


            
        })

        $(document).on('change', '#other_details_select', function() {
            if($(this).val().length > 0)
                $('#country').removeAttr('disabled')
            else{
                $('#country option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('#country').attr('disabled', true)
                $('#state').closest('.form-group').remove()
            }

        });

        $(document).on('change', '#country', function() {
            let country_id = $('option:selected', this).val();
            if(country_id == '229') {
                let urlLike = baseUrl + '/recoverytruck/getState';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    },
                    type: "POST",
                    url: urlLike,
                    data: {
                        country_id: country_id
                    },
                    success: function(data) {
                        $('#state-info').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                    }
                });
            } else {
                $('#state-info').html('');
                getPlateColor(country_id, '')
            }
        })

        $(document).on('change', '#state', function() {
            getPlateColor($('#country option:selected').val(), $('option:selected', this).val())
        });

        $(document).on('change', '#plate_code', function() {
            $('#plate_number').removeAttr('readonly');            
        });

        function getPlateColor(country_id, state_id) {
            let urlLike = baseUrl + '/recoverytruck/getPlateColor';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                type: "POST",
                url: urlLike,
                data: {
                    country_id: country_id,
                    state_id: state_id,
                    other_detail: $('#other_details_select').length ? $('#other_details_select option:selected').val() : '',
                    vehicletype_id: $('.service-box.active').data('id')
                },
                success: function(data) {
                    $('#color-info').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                }
            });
        }

    </script>
@endsection