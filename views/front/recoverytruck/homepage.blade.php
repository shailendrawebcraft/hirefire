@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")
    <div class="login-input">
        <div class="input-outer-box text-center">
            <img height="50px" src="{{url('images/genral/'.$front_logo)}}" alt="logo"> 
            <form method="post" action="{{ url('/recoverytruck/login') }}">
                @csrf
                <div class="form-group mt-3">
                    <input type="tel" pattern="[0-9]*" inputmode="numeric" class="form-control" placeholder="Enter mobile no." name="mobile_no" required>
                </div>
                <!-- <a href="otp.html" type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</a> -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
@endsection