<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header" style="color: #fe980f">Xin chào quý khách đã quan tâm đến E-shopper!!!</div>
                   <div class="card-body">
                    @if (session('resent'))
                         <div class="alert alert-success" role="alert">
                            {{ __('A fresh mail has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="container">
                <p class="code">Sử dụng code sau: {{ $coupon_code }} <span class="text-danger"></span> để được giảm giá 20% khi mua hàng tại <span  style="color: #fe980f">E-shopper</span></p>
            </div>
        </div>
    </div>
</div>