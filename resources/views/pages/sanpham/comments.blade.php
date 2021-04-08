	@foreach ($comments as $value)
	<div class="row style_comment" style="border: 1px solid #ddd;border-radius: 10px;background: #F0F0E9;padding: 12px;">
		<div class="col-lg-2">
			<img src="{{ asset('public/upload/avatar/anh.jpg') }}" width ="80%" class="img img-responsive thumbnail ">
			<input type="hidden" name="comment_product_id" value="{{ $product_id }}" class="comment_product_id">
		</div>
		<div class="col-lg-10">
			<p style="color: blue;">{{  $value->name }}</p>
			<p style="color:#FE980F">vào ngày: {{ ($value->created_at)->format('d/m/Y') }}</p>
			<p>{{ $value->comment }}</p>
		</div>
	</div>
	<br>
	@foreach ($comment_parent as $value2)
		@if ($value2->comment_parent==$value->id)
		<div class="row style_comment" style="border: 1px solid #630606;
		border-radius: 10px;
		background: #F0F0E9;
		padding: 12px;
		width: 88%;
		margin: 0px 109px;margin-bottom: 30px">
		<div class="col-lg-2">
			<img src="{{ asset('public/upload/avatar/lead.jpg') }}" width ="80%" class="img img-responsive thumbnail ">
			<input type="hidden" name="comment_product_id" value="{{ $product_id }}" class="comment_product_id">
		</div>
		<div class="col-lg-10">
			<p style="color: red;">{{ '@Admin' }}</p>
			<p style="color:#FE980F">vào ngày: {{ ($value->created_at)->format('d/m/Y') }}</p>
			<p>{{ $value2->comment }}</p>
		</div>
		</div>
		@endif
	@endforeach
@endforeach
<style type="text/css">
	#reviews ul {
    background: #f5f5f5;
    border: 0 none;
    list-style: none outside none;
    margin: 0 0 20px;
    padding: 15px;
    text-align: start;
}
</style>
<footer class="panel-footer">
      <div class="row">
        <div class="col-sm-7 text-right text-center-xs pg">                
          {{ $comments->appends(request()->all())}}
        </div>
      </div>
 </footer>