@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")
    <style>
        .disabled, .disabled:hover {
            cursor: default;
            color: #7c7c7c;
        }
    </style>

    <div class="login-input">
        <div class="input-outer-box text-center">
            <img src="{{url('images/genral/'.$front_logo)}}" alt="logo"> 
            <form method="post" action="{{ route('recoverytruck.otpverify') }}" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                <div class="form-group mt-3">
                    @csrf
                     <input name="otp[]" type="text" inputmode="numeric" id="digit-1" name="digit-1" data-next="digit-2" placeholder="-" required/>
                     <input name="otp[]" type="text" inputmode="numeric" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" placeholder="-" required/>
                     <input name="otp[]" type="text" inputmode="numeric" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" placeholder="-" required/>
                     <input name="otp[]" type="text" inputmode="numeric" id="digit-4" name="digit-4" data-previous="digit-3" placeholder="-" required/>                    
                </div>
                <button type="submit" class="btn btn-primary btn-lg  btn-block">VERIFY OTP</button>
                <a href="javascript:void(0)" class="float-right mt-1 disabled" id="resendotp"><small>Resend OTP</small><span id="countdown"></span></a>
            </form>
        </div>
    </div>
    <!-- footer end -->
@endsection

@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        let timeLeft, elem, timerId;
        $('.digit-group').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
                var parent = $($(this).parent());
                
                if(e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));
                    
                    if(prev.length) {
                        $(prev).select();
                    }
                } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                    var next = parent.find('input#' + $(this).data('next'));
                    
                    if(next.length) {
                        $(next).select();
                    } else {
                        if(parent.data('autosubmit')) {
                            parent.submit();
                        }
                    }
                }
            });
        });

        countdownstart = () => {
            timeLeft = 30;
            elem = document.getElementById('countdown');
            timerId = setInterval(countdown, 1000);
        }

        countdown = () => {
            if (timeLeft == 0) {
                clearTimeout(timerId);
                doSomething();
            } else {
                elem.innerHTML = ` in ${timeLeft}s`;
                timeLeft--;
            }
        }

        $(document).ready(function() {
            countdownstart();
        })
        
        doSomething = () => {
            $('#countdown').text('');
            $('#resendotp').removeClass('disabled');
        }

        $(document).on('click', '#resendotp', function(e) {
            if(!$(this).hasClass('disabled')) {
                // console.log('action');
                $.ajax({
                    type:'POST',
                    url:'{{route("recoverytruck.resetotp")}}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": "{{ $authData['user_id'] }}"
                    },
                    success:function(data){
                        // $("#msg").html(data.msg);
                        if(data === 'success') {
                            $('#countdown').text(' sent');
                            $('#resendotp').addClass('disabled');
                            countdownstart();
                            location.reload();
                        }
                    }
                });
            }
        })

        @if(Session::has('success'))
            {{ notify()->info('OTP sent successfully') }}
        @php  
            Session::forget('success');  
            @endphp  
        @endif 
    </script>
@endsection