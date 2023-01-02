@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")

<div class="back-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <a href="{{route('recoverytruck.booking')}}">
                    <span class="material-symbols-outlined mt-2" >   keyboard_backspace  </span> 
                </a>
            </div>
        </div>
    </div>
</div>
<div class="login-input">
    <div class="input-outer-box text-center">
        <div class="amount-block">
            <h1>AED {{$authData['fare']}}</h1>
            <p class="mb2">Approximate distance: {{round($authData['distance']/1000)}} km</p>
            <div class="clearfix"></div>
        </div>
        <p class="text-center">Select Payment Method</p>
        <div class="row">
            <div class="col-6">
                <form method="post" action={{route('recoverytruck.cashpayment')}}>
                    <div class="card icon-pay cash-payment">
                        @csrf
                        <span class="material-symbols-sharp">
                            payments
                        </span>
                        <h3>CASH</h3>
                        <button type="submit" class="d-none">Cash</button>
                        <!-- <a href="{{route('recoverytruck.cashpayment')}}">
                            <span class="material-symbols-sharp">
                                payments
                            </span>
                            <h3>CASH</h3>
                        </a> -->
                    </div>
                </form>
            </div>
            <div class="col-6">
                <div class="card icon-pay online-pay">
                    <span class="material-symbols-sharp">
                    credit_card
                </span>
                <h3>CARD</h3>
                </div>
            </div>
            <!-- <div class="col mt-4">
                <a href="confirm.html" class="btn btn-primary btn-lg btn-block">book now</a>
            </div> -->
        </div>
     </div>
    </div>
@endsection
@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.foloosi.com/js/foloosipay.v2.js"></script>

    <script>
        const m_key = 'live_$2y$10$2iTuBIJ1wUopadIWLjFga.ESYnDLJ-5bj0BEuwZ7cpFlYh--6r.KC';
        const baseUrl = window.location.origin;

        $(document).ready(function() {
            $("#navToggle").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
                
            });

            $(".dropshadow").click(function(){
                $(".sidebar").toggleClass("side-open");
                $(".dropshadow").toggleClass("shadow-block");
                
            });
        })

        $(document).on('click', '.online-pay', function() {
            // post data for create order id
            data = {
                transaction_amount : "{{$authData['fare']}}",
                currency : "AED",
                customer_mobile : "{{$authData['mobile_number']}}",
                source: "Recovery Truck Booking",
                
            }
            let fetchRes = fetch(
                "https://api.foloosi.com/aggregatorapi/web/initialize-setup",{
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                "merchant_key": `${m_key}` /** get the merchant key from foloosi panel*/
                },
                body: JSON.stringify(data)
            });

            fetchRes.then(res =>
                res.json()).then(d => {
                console.log(d.data);
                var options = {
                    "reference_token" : d.data.reference_token, //which is get from step2
                    "merchant_key" : `${m_key}`,/** get the merchant key from foloosi panel*/
                }
                var fp1 = new Foloosipay(options);
                fp1.open();
            })
            foloosiHandler(response, function (e) {
                if(e.data.status == 'success'){
                    //responde success code
                    // console.log(e.data);
                    // console.log(e.data.status);
                    // console.log(e.data.data.transaction_no);
                    let url = baseUrl + "/recoverytruck/confirmed?transaction_id=" + e.data.data.transaction_no;
                    window.location.href = url;
                }
                if(e.data.status == 'error'){
                    //responde success code
                    console.log(e.data.status);
                    console.log(e.data.data.payment_status);
                }
                if(e.data.status == 'closed'){
                    //Payment Popup Closed
                    console.log(e.data);
                }
            });
        })

        $(document).on('click', '.cash-payment', function() {
            $(this).parent('form').submit();
        })
    </script>
@endsection