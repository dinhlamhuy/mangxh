@extends('layouts.layout')

@section('content-title')
<title>Tạo fanpages | EDuck</title>
@endsection
@section('content-css')
<style>
    .labelform{
        font-weight: bold;
        font-size: 18px;
        color: white;
    }
    body{
        background: url("{{ asset('storage/app/assets/img/nen/bg_group.jpg') }}")  center;
    }
    .img-flag{
        height: 25px;
        width: 25px;
        border-radius: 50%;
    }
    
</style>
@endsection
@section('content')
<div class="container-fluid ">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row">
        <div class="col-md-5 mx-auto mt-5">
            <form action="{{ url('/fanpages/create_fanpages')}}" method="post" >
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform " for="">Tên trang</label>
                            <input type="text" class="form-control" name="name_fanpage" placeholder="Tên của trang" required>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform" for="school_category">Hạng mục</label><br>
                            <select name="school_category" id="school_category" class="form-control  w-100" required>
                             <option value="Trường đại học">Trường đại học</option>
                             <option value="Trường cao đẳng">Trường cao đẳng</option>
                             <option value="Trường trung cấp">Trường trung cấp</option>
                             <option value="Trường trung học phổ thông">Trường trung học phổ thông</option>
                             <option value="Trường trung học cơ sở">Trường trung học cơ sở</option>
                             <option value="Trường tiểu học">Trường tiểu học</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform " for="">Số điện thoại</label>
                            <input type="text" class="form-control" name="sdt_fanpage" placeholder="Số điện thoại" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform " for="">Địa chỉ</label>
                            <input type="text" class="form-control" name="diachi_fanpage" placeholder="Địa chỉ" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform " for="">Email</label>
                            <input type="text" class="form-control" name="email_fanpage" placeholder="Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform" for="selectfriend">Mô tả</label><br>
                            <textarea name="mota" id="mota" class="form-control" rows="10" placeholder="Mô tả fanpage"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success text-light form-control mt-3 font-weight-bold py-1">Tạo mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('content-js')
<script>
    $(document).ready(function(){
        function formatState (state) {
  if (!state.id) {
    return state.text;
  }
 
  var $state = $(
    '<span><img src="{{ asset('storage/app/assets/img/avatar/noteimg.png') }}" class="img-flag" /> ' + state.text + '</span>'
  );
  return $state;
};
        $('#selectfriend').select2({
            placeholder: "Mời bạn bè",
    allowClear: true,
    templateResult: formatState
        });

    });
</script>
@endsection