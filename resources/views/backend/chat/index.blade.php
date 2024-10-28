@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="chat-box-left">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link py-2 active" id="messages_chat_tab" data-bs-toggle="tab"
                            href="#messages_chat" role="tab">Messages</a>
                    </li>
                </ul>
                <div class="chat-search p-3">
                    <div class="p-1 bg-light rounded rounded-pill">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="button-addon2" type="submit" class="btn btn-link text-secondary"><i
                                        class="fa fa-search"></i></button>
                            </div>
                            <input type="search" placeholder="Searching.." aria-describedby="button-addon2"
                                class="form-control border-0 bg-light">
                        </div>
                    </div>
                </div><!--end chat-search-->

                <div class="chat-body-left px-3" data-simplebar>
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="messages_chat"></div><!--end general chat-->

                    </div><!--end tab-content-->
                </div>
            </div><!--end chat-box-left -->

            <div class="chat-box-right">
                <div class="p-3 d-flex justify-content-between card-bg rounded">
                    <a href="#" class="d-flex align-self-center">
                        <div class="flex-shrink-0">
                            <img src="/backend/assets/images/users/avatar-1.jpg" alt="user"
                                class="rounded-circle thumb-lg">
                        </div><!-- media-left -->
                        <div class="flex-grow-1 ms-2 align-self-center">
                            <div>
                                <h6 class="my-0 fw-medium text-dark fs-14">Mary Schneider</h6>
                                <p class="text-muted mb-0">Last seen: 2 hours ago</p>
                            </div>
                        </div><!-- end media-body -->
                    </a><!--end media-->
                    <div class="d-none d-sm-inline-block align-self-center">
                        <a href="#" class="me-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Call" data-bs-custom-class="tooltip-primary"><i
                                class="iconoir-phone fs-22"></i></a>
                        <a href="#" class="me-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Video call" data-bs-custom-class="tooltip-primary"><i
                                class="iconoir-video-camera fs-22"></i></a>
                        <a href="#" class="me-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Delete" data-bs-custom-class="tooltip-primary"><i
                                class="iconoir-trash fs-22"></i></a>
                        <a href="#" class="text-muted"><i class="iconoir-menu-scale fs-22"></i></a>
                    </div>
                </div><!-- end chat-header -->
                <div class="chat-body" data-simplebar>
                    <div class="chat-detail">
                        <div class="d-flex">
                            <img src="/backend/assets/images/users/avatar-1.jpg" alt="user"
                                class="rounded-circle thumb-md">
                            <div class="ms-1 chat-box w-100">
                                <div class="user-chat">
                                    <p class="">Good Morning !</p>
                                    <p class="">There are many variations of passages of Lorem Ipsum
                                        available.</p>
                                </div>
                                <div class="chat-time">yesterday</div>
                            </div><!--end media-body-->
                        </div><!--end media-->
                        <div class="d-flex flex-row-reverse">
                            <img src="/backend/assets/images/users/avatar-3.jpg" alt="user"
                                class="rounded-circle thumb-md">
                            <div class="me-1 chat-box w-100 reverse">
                                <div class="user-chat">
                                    <p class="">Hi,</p>
                                    <p class="">Can be verified on any platform using docker?</p>
                                </div>
                                <div class="chat-time">12:35pm</div>
                            </div><!--end media-body-->
                        </div><!--end media-->
                    </div> <!-- end chat-detail -->
                </div><!-- end chat-body -->
                <div class="chat-footer">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <input type="text" class="form-control" placeholder="Type something here...">
                        </div><!-- col-8 -->
                        <div class="col-4 text-end">
                            <div class="d-none d-sm-inline-block chat-features">
                                <a href="#"><i class="iconoir-camera"></i></a>
                                <a href="#"><i class="iconoir-attachment"></i></a>
                                <a href="#"><i class="iconoir-microphone"></i></a>
                                <a href="#" class="text-primary"><i class="iconoir-send-solid"></i></a>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end chat-footer -->
            </div><!--end chat-box-right -->
        </div> <!-- end col -->
    </div><!-- end row -->
</div><!-- container -->

<!--Start Rightbar-->
<!--Start Rightbar/offcanvas-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
    <div class="offcanvas-header border-bottom justify-content-between">
        <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
        <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h6>Account Settings</h6>
        <div class="p-2 text-start mt-3">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="settings-switch1">
                <label class="form-check-label" for="settings-switch1">Auto updates</label>
            </div><!--end form-switch-->
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                <label class="form-check-label" for="settings-switch2">Location Permission</label>
            </div><!--end form-switch-->
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="settings-switch3">
                <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
            </div><!--end form-switch-->
        </div><!--end /div-->
        <h6>General Settings</h6>
        <div class="p-2 text-start mt-3">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="settings-switch4">
                <label class="form-check-label" for="settings-switch4">Show me Online</label>
            </div><!--end form-switch-->
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                <label class="form-check-label" for="settings-switch5">Status visible to all</label>
            </div><!--end form-switch-->
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="settings-switch6">
                <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
            </div><!--end form-switch-->
        </div><!--end /div-->
    </div><!--end offcanvas-body-->
</div>

<script>
    function loadUsersWithMessages() {
        $.ajax({
            url: '/messages/users',
            type: 'GET',
            headers: {
                'Authorization': csrfToken
            },
            dataType: 'json',
            success: function (users) {
                const messagesChatContainer = $('#messages_chat');
                messagesChatContainer.empty(); // Xóa nội dung cũ
                console.log(users);
                $.each(users, function (index, user) {
                    // Tạo HTML cho mỗi người dùng
                    const userDiv = `
                        <div class="row">
                            <div class="col">
                                <div class="p-2 border-dashed border-theme-color rounded mb-2">
                                    <a href="#" class="">
                                        <div class="d-flex align-items-start">
                                            <div class="position-relative">
                                                <img src="${user.image_url}" alt="" class="thumb-lg rounded-circle">
                                                <span class="position-absolute bottom-0 end-0"><i class="fa-solid fa-circle text-success fs-10 border-2 border-theme-color"></i></span>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                                <h6 class="my-0 fw-medium text-dark fs-14">${user.full_name}<small class="float-end text-muted fs-11"></small></h6>
                                                <p class="text-muted mb-0"><span class="text-primary">${user.role_name}</span><span class="badge float-end rounded text-white bg-success ">3</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                    messagesChatContainer.append(userDiv);
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    // Gọi hàm khi trang được tải
    document.addEventListener('DOMContentLoaded', loadUsersWithMessages);
</script>
@endsection