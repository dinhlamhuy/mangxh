@extends('layouts.layout')

@section('content-title')
<title>Tạo nhóm | Halo</title>
@endsection
@section('content-css')
<style>
    .labelform{
        font-weight: bold;
        font-size: 18px;
        color: white;
    }
    body{
        background: url("{{ asset('storage/app/assets/img/nen/bg_group.jpg') }}")  center ;
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
    <div class="row">
        <div class="col-md-5 mx-auto mt-5">
            <form action="{{ url('/groups/create-group') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform " for="">Tên nhóm</label>
                            <input type="text" class="form-control" name="name_group" placeholder="Tên của nhóm" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform " for="">Chọn ảnh bìa</label>
                            <input type="file" class="form-control" name="bg_group"  placeholder="Ảnh nhóm" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform" for="">Chọn quyền riêng tư</label>
                            <select name="rules" class="form-control" required>
                                <option value="" disabled selected hidden>Chọn quyền</option>
                                <option value="1">Công khai</option>
                                <option value="2">Riêng tư</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="labelform" for="selectfriend">Mời bạn bè (Không bắt buộc)</label><br>
                            <select name="friend_invitation[]" id="selectfriend" class="form-control select2 w-100" multiple="multiple" >
                                @foreach($friends as $friend)
                                <option  value="{{ $friend->user_id }}">{{ $friend->firstname. ' '.$friend->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success text-light form-control mt-3 font-weight-bold py-1">Tạo nhóm</button>
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