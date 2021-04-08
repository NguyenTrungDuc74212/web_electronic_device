 @extends('admin_layout')
 @section('content')
 <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm vận chuyển
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="">Chọn thành phố</label>
                            <select class="form-control input-sm m-bot15 choose" name="name_tp" id="thanhpho">
                                <option value="" class="reset_op">---chọn thành phố---</option>
                                @foreach ($city as $value)
                                <option value="{{ $value->matp }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn quận huyện</label>
                            <select class="form-control input-sm m-bot15 choose" name="name_qh" id="quanhuyen">
                                <option value="" class="reset_op">---chọn quận huyện---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn xã phường</label>
                            <select class="form-control input-sm m-bot15 choose" name="name_xp" id="xaphuong">
                                <option value="" class="reset_op">---chọn xã phường---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Phí vận chuyển</label>
                            <input type="text" class="form-control phiship" id="exampleInputEmail1" placeholder="Phí ship" name="feeship">
                        </div>
                        <button type="button" class="btn btn-info add_delivery" name="add_delivery">Thêm phí vận chuyển</button>
                    </form>
                </div>
                <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="">
                            <thead>
                              <tr>
                                <th>Tên tỉnh, thành phố</th>
                                <th>Tên quận huyện</th>
                                <th>Tên xã phường</th>
                                <th>Phí ship</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="load-delivery">
                        </tbody>
                    </table>
                </div>
        </div>

    </section>


</div>
</div>
@stop