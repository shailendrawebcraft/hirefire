<div class="table-outer">
    <div class="table-header">
        <div>Order id #{{$booking->id}}</div>
        <div>Amount AED {{$booking->fare}}</div>
    </div>
    <div class="table-body">
        <table width="100%" class="width100 table  dataTable no-footer" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" width="50%"><h6>USER INFO</h6></td>
                <td colspan="2" width="50%"><h6>RIDE INFO</h6></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>&nbsp;</td>
                <td>Points of pickup:</td>
                <td>{{$booking->pickup}} <br/> <a href="http://maps.google.com/?q={{$booking->pickup_lat}},{{$booking->pickup_lng}}" target="_blank" >http://maps.google.com/?q={{$booking->pickup_lat}},{{$booking->pickup_lng}}</a></td>
            </tr>
            <tr>
                <td>Mobile No.:</td>
                <td>{{$booking->mobile_number}}</td>
                <td>Point of Drop off:</td>
                <td>{{$booking->drop}} <br/> <a href="http://maps.google.com/?q={{$booking->drop_lat}},{{$booking->drop_lng}}" target="_blank" >http://maps.google.com/?q={{$booking->drop_lat}},{{$booking->drop_lng}}</a></td>
            </tr>
            <tr>
                <td colspan="2"><h6>VEHICLE INFO</h6></td>
                <td>Date and Time:</td>
                <td>{{$booking->created_at}}</td>
            </tr>
            <tr>
                <td>Plate Source</td>
                <td>{{$booking->pick_emirates}}</td>
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
                <td colspan="2"><h6>Driver Info</h6></td>
            </tr>
            <tr>
                <td>Vehicle Type</td>
                <td>{{$booking->vehictype_name}}</td>
                <td>Driver Name:</td>
                <td>{{$booking->driver_name}}</td>
            </tr>
            <tr>
                <td>Vehicle Other Details</td>
                <td>{{$booking->other_details}}</td>
                <td>Driver Contact Number:</td>
                <td>{{$booking->driver_mobile_number}}</td>
            </tr>
            <tr>
                <td>Vehicle Additional Info</td>
                <td>{{$booking->additional_info}}</td>
                <td>Driver Plate Number:</td>
                <td>{{$booking->driver_vehicle_number}}</td>
            </tr>
            <tr>
                <td><span class="text-success">Status</span></td>
                <td colspan="3"> 
                    @php
                        if($booking->status == 1) {
                            echo "Accepted";
                        } elseif($booking->status == 2) {
                            echo "Inprogress";
                        }else {
                            echo "Completed";
                        }
                    @endphp
                </td>
            </tr>
        </table>
        
        <!-- <div class="text-right mt-2">
            <button class="btn btn-primary">Assign Truck</button>
        </div> -->
    </div>
</div>