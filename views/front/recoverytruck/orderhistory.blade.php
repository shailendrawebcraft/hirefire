@extends("front.layout.recoverytruckmaster")

@section('meta_tags')

@endsection

@section("body")
    <div class="row">
        <div class="col-12 pt-4">
            @if(count($bookings) <= 0)
            <div class="table-outer mt-5 text-center">
                <h6>No Booking history available</h6>
            </div>
            @else
                @foreach($bookings as $key => $booking)
                    <div class="table-outer {{ $key == 0 ? 'mt-5' : ''}} {{$key}}">
                        <div class="table-header">
                            <div>Order id #{{$booking->id}}</div>
                            <div>Amount AED {{$booking->fare}}</div>
                        </div>
                        <div class="table-body">
                            <table width="100%" class="width100 table  dataTable no-footer" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="12%"><h6>USER INFO</h6></td>
                                    <td width="38%">&nbsp;</td>
                                    <td width="12%"><h6>RIDE INFO</h6></td>
                                    <td width="38%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td></td>
                                    <td>Points of pickup:</td>
                                    <td>{{$booking->pickup}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile No.:</td>
                                    <td>{{$booking->mobile_number}}</td>
                                    <td>Point of Drop off:</td>
                                    <td>{{$booking->drop}}</td>
                                </tr>
                                <tr>
                                    <td><h6>VEHICLE INFO</h6></td>
                                    <td></td>
                                    <td>Date and Time:</td>
                                    <td>{{date('d-m-Y h:i A', strtotime($booking->updated_at))}}</td>
                                </tr>
                                <tr>
                                    <td>Plate Source</td>
                                    <td>{{$booking->statename}}</td>
                                    <td>Payment Mode:</td>
                                    <td>{{$booking->payment_type}}</td>
                                </tr>
                                <tr>
                                    <td>Plate Code</td>
                                    <td>{{$booking->plate_code}}</td>
                                    <td>Amount:</td>
                                    <td>AED {{$booking->fare}}</td>
                                </tr>
                                <tr>
                                    <td>Plate Number</td>
                                    <td>{{$booking->plate_number}}</td>
                                    <td><span class="text-success">Status</span> </td>
                                    <td>{{$booking->status == 1 ? 'Accepted' : 'Processing'}}</td>
                                </tr>
                                
                                
                            </table>
                            <table width="100%" class="width100 table  dataTable no-footer" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="12%">Driver Name:</td>
                                    <td width="38%">{{$booking->driver_name}}</td>
                                    <td width="12%">Truck number</td>
                                    <td width="38%">{{$booking->vehicle_number}}</td>
                                </tr>
                                <tr>
                                    <td>Driver Mobile no.:</td>
                                    <td>{{$booking->driver_mobile_number}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            
                            
                            </table>
                                <!-- <div class="text-right mt-2">
                                <button class="btn btn-primary">Assign Truck</button>
                                </div> -->
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <style>
        .table-outer{
            background-color: #fff;
            border-radius: 6px;
            width: 100%;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.24);
            margin-bottom: 16px;
        }
        .table-header{
            background-color: #FAAE1C;
            padding: 12px;
            color: #fff;
            border-radius: 6px 6px 0px 0px;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
        }
        .table-body {
            padding: 12px;
            
        }
        .table-body table{
            margin-bottom: 0px !important;
        }
        .table-body tr td{
                padding: 4px 8px;
        }
        .table-body h6{
                margin-bottom: 0px;
                font-size: 14px;
                font-weight: 600;
        }
    </style>

@endsection

@section('script')

    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
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
        })
    </script>
@endsection