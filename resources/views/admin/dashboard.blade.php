@extends('admin_layout')
@if (session('thongbao'))
<div class="text-success text-center">
	{{ session('thongbao') }}
</div>
@endif
@section('content')
<h1 class="text-center">Quản lý thống kê</h1>
<hr>
<div class="row">
	<h3 class="card-title" style="color: #d46709;padding: 20px;">Thống kê doanh thu</h3>
	<form autocomplete="off">
		@csrf
		<div class="col-lg-4">
			<p>Từ ngày: <input type="text" id="datepicker3" class="form-control"></p>
		</div>
		<div class="col-lg-4">
			<p>Đến ngày: <input type="text" id="datepicker4" class="form-control"></p>
		</div>
		<div class="col-md-2">
			<p>
				Lọc theo:
				<select class="admin_filter form-control">
					<option>---chọn---</option>
					<option value="1tuan">1 tuần qua</option>
					<option value="thangtruoc">Tháng trước</option>
					<option value="thangnay">Tháng này</option>
					<option value="1namqua">1 năm qua</option>
				</select>
			</p>
		</div>
		<div class="col-lg-2">
			<input type="button" id="btn-dashboard-filter" value="lọc kệt quả" class="btn btn-primary" style="margin: 24px -12px;">
		</div>
	</form>
	<div class="col-lg-12">
		<div id="chart" style="height: 250px;"></div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-6">
		<h3 class="card-title" style="color: #d46709;padding: 20px;">Thống kê truy cập</h3>
		<table class="table table-bordered table-dark" style="background: #292424">
			<thead>
				<tr>
					<th scope="col">Đang online</th>
					<th scope="col">Tổng tháng trước</th>
					<th scope="col">Tổng tháng này</th>
					<th scope="col">Tổng 1 năm</th>
					<th scope="col">Tổng truy cập</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $visitor_count_online }}</td>
					<td>{{ $visitor_lastmonth_count }}</td>
					<td>{{ $visitor_thismonth_count }}</td>
					<td>{{ $visitor_oneyear_count }}</td>
					<td>{{ $visitors_total }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-lg-6 text-center">
		<h3 class="card-title" style="color: #d46709;padding: 20px;">Thống kê website</h3>
		<p style="font-weight: 700;">Tổng số đơn hàng được xử lý: <span class="text-danger">{{$order_count }}</span></p>
		<p style="font-weight: 700;">Tổng số sản phẩm của website: <span class="text-danger">{{ $product_count }}</span></p>
		<p style="font-weight: 700;">Tổng số khách hàng đăng ký tài khoản: <span class="text-danger">{{ $customer_count }}</span></p>
		<p style="font-weight: 700;">Tổng số bình luận: <span class="text-danger">{{ $comment_count }}</span></p>
	</div>
</div>

{{-- xử lý thống kê --}}
<script type="text/javascript">
	$(document).ready(function() {
		chart_orders_30days();
		var chart = new Morris.Area({
			element: 'chart',
			lineColors: ['#609e4d','#fc870','#FF6541','#c9940e'],  /*màu cột*/
			parseTime:false,
			hideHover: 'auto',
			xkey: 'period',
			gridTextColor:'#ffffff',
			ykeys: ['order','sales','profit','quantity'],
			labels: ['Đơn hàng','doanh số','lợi nhuận','số lượng'],
		});


		$('.admin_filter').change(function(event) {
			var filterValue = $(this).val();
			$.ajax({
				url: '{{ route('order_filter') }}',
				type: 'POST',
				dataType:'JSON',
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data:{
					filterValue:filterValue,

				}, /*name:biến var*/
				success:function(data) /*dữ liệu(data) trả về bên function*/
				{
					if (data!=null) {
						chart.setData(data);
					}

				}     
			});  

		});

		function chart_orders_30days(){
			$.ajax({
				url: '{{ route('order_30_day') }}',
				type: 'POST',
				dataType:'JSON',
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success:function(data) /*dữ liệu(data) trả về bên function*/
				{
					chart.setData(data);
				}     
			});   
		}

		$('#btn-dashboard-filter').click(function(event) {
			event.preventDefault();
			var fromDate = $('#datepicker3').val();
			var toDate = $('#datepicker4').val();
			$.ajax({
				url: '{{ route('filter_date') }}',
				type: 'POST',
				dataType:'JSON',
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data:{
					fromDate:fromDate,
					toDate:toDate,

				}, /*name:biến var*/
				success:function(data) /*dữ liệu(data) trả về bên function*/
				{
					chart.setData(data);
				}     
			});   

		});
	});


</script>
{{-- end xử lý thống kê --}}
@stop