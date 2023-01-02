@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")
    <div class="login-input">
        <div class="input-outer-box text-center">
            <img src="{{url('images/recovery_truck/recovery.gif')}}" class="w-100" alt="hnf">
            <h1 class="text-success mt-5">
                Congratulations!!!
            </h1>
            <h5>Your booking has been confirmed</h5>
            <p> <span id="time">Your recovery truck will reach your destination shortly.
                You will receive truck details soon.</span></p>

            @csrf
            <input type="hidden" id="booking-id" name="id" value="{{$booking->id}}" />
        </div>
    </div>
@endsection

@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#navToggle").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
                
            });

            $(".dropshadow").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
                
            });
            get_status();
        })

        function get_status(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                type: "GET",
                url: "{{ route('recoverytruck.bookingstatus') }}",
                data: {
                    booking_id: $('#booking-id').val()
                },
                success: function(data) {
                    if(data == 'false') {
                        setTimeout(() => get_status(), 10000);
                    } else {
                        $('#time').html(`${data}`);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                }
            });
        }
    </script>
@endsection