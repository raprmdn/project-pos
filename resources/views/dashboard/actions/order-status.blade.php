@if ($order->status == 'pending')
  <span class="badge badge-danger">Pending</span>
@else
  <span class="badge badge-success">Completed</span>
@endif
