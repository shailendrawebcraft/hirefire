<table class="table table-striped text-left">
    <tr>
        <td>Estimated pickup time: </td>
        <td>{{$bookingAccept->estimated_pickup_time}} mins.</td>
    </tr>
    <tr>
        <td>Driver Name: </td>
        <td>{{$driverDetail->driver_name}}</td>
    </tr>
    <tr>
        <td>Driver Contact: </td>
        <td>{{$driverDetail->mobile_number}}</td>
    </tr>
    <tr>
        <td>Truck No.: </td>
        <td>{{$truckDetail->vehicle_number}}</td>
    </tr>
</table>