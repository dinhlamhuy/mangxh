@extends('groups.header')
@section('header_groups')
    <div class="container-fluid" style="margin-top: -10px">
        
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5><b>Giới thiệu về nhóm</b></h5>
                        <hr class="netngang">

                        <h6><b>
                        @if ($group->group_privacy == '1')
                        <i class="fa fa-globe" aria-hidden="true"></i>&ensp;Đây là nhóm công khai<br></b>
                        <span class="text-muted ml-3" style="font-size: 12px;">
                          Bất kỳ ai cũng có thể nhìn thấy mọi người trong nhóm và những gì họ đăng.
                        </span>
                        @elseif($group->group_privacy == '2')
                        <i class="fa fa-lock" aria-hidden="true"></i>&ensp;Đây là nhóm riêng tư<br></b>
                        <span class="text-muted ml-3" style="font-size: 12px;">
                          Những ai tham gia vào nhóm mới có thể nhìn thấy mọi người trong nhóm và những gì họ đăng.
                        </span>
                    @endif
                        </h6>
                        <h6><b><i class="fa fa-clock-o" aria-hidden="true"></i>&ensp; Ngày tạo nhóm</b> <br>
                      <span class="text-muted ml-3" style="font-size: 12px;">
                        Đang tạo nhóm vào {{ date('\L\ú\c\ H:i A \N\g\à\y d \T\h\á\n\g m \N\ă\m Y',strtotime($group->created_at)) }}
                      . Lần cập nhật gần nhất là {{ date('\L\ú\c\ H:i A \N\g\à\y d \T\h\á\n\g m \N\ă\m Y',strtotime($group->updated_at)) }}
                      </span>
                        </h6>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <h5><b>Quy tắc nhóm của quản trị viên</b></h5>
                        <hr class="netngang">
                        <div id="accordion">
                            <div class="card acc_card">
                              <div class="card-header tieude" id="headingOne">
                                <h5 class="mb-0">
                                  <button class="btn text-decoration-none btn-acco" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    1. Hãy Tử tế và lịch sự
                                  </button>
                                </h5>
                              </div>
                          
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body mx-5">
                                    Tất cả chúng ta cùng có mặt ở đây để tạo nên một môi trường thân thiện. Hãy tôn trọng tất cả mọi người. Tranh luận lành mạnh là điều hết sức tự nhiên nhưng cũng cần tử tế.
                                </div>
                              </div>
                            </div>
                            <div class="card acc_card">
                              <div class="card-header tieude" id="headingTwo">
                                <h5 class="mb-0">
                                  <button class="btn collapsed text-decoration-none btn-acco" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                   2. Không có ngôn tư xúc phạm gây thù hằn hoặc bắt nạt
                                  </button>
                                </h5>
                              </div>
                              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body mx-5">
                                    Hãy đảm bảo mọi người cảm thấy an toàn. Mọi hình thức bắt nạt đều không được cho phép và những bình luận hạ nhục về chủng tộc, tôn giáo, văn hóa, khuynh hướng tình dục, giới tính hoặc bản sắc sẽ không được chấp nhận.
                                </div>
                              </div>
                            </div>
                            <div class="card acc_card">
                              <div class="card-header tieude" id="headingThree">
                                <h5 class="mb-0">
                                  <button class="btn collapsed text-decoration-none btn-acco" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. Tôn trọng quyền riêng tư của mọi người
                                  </button>
                                </h5>
                              </div>
                              <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body mx-5">
                                    Tham gia nhóm này đòi hỏi phải có sự tin tưởng từ hai phía. Các cuộc thảo luận thực, mang tính biểu đạt giúp nhóm trở nên tuyệt vời nhưng cũng có thể nhạy cảm và riêng tư. Không tiết lộ nội dung được chia sẻ trong nhóm ra bên ngoài.
                                </div>
                              </div>
                            </div>
                            <div class="card acc_card">
                              <div class="card-header tieude" id="headingFour">
                                <h5 class="mb-0">
                                  <button class="btn collapsed text-decoration-none btn-acco" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    4. Cấm chia sẻ những văn hóa phẩm đồi trụy
                                  </button>
                                </h5>
                              </div>
                              <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body mx-5">
                                    Việc phát tán các văn hoá phẩm đồi truỵ như hình ảnh, video nhạy cảm của người khác lên mạng xã hội là vi phạm pháp luật, ảnh hưởng xấu đến sự lành mạnh của văn hoá xã hội, đồng thời xâm phạm nghiêm trọng đến danh dự, nhân phẩm của nạn nhân.
                                </div>
                              </div>
                            </div>
                          </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('header_groups_js')
    <script>
        $(document).ready(function() {
          $('#about').addClass('btn-active');
          
        });
    </script>
@endsection
