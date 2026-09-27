<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ !empty($header_title) ? $header_title : '' }}-BabliYaceSchoolDashboard</title>
    <meta content="width=device-width,initial-scale=1.0,shrink-to-fit=no" name="viewport">
    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon">
    <script src="{{ asset('assets1/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets1/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/chat.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ url('/') }}" class="logo"><img
                                src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20"></a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                        </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>
                @include('layouts.header')
            </div>
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="mt-4 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;">Mon espace de chat</h3>
                        </div>
                    </div>
                    @include('_message')
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card chat-app">
                                <div id="plist" class="people-list">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="getSearchUser"><i
                                                    class="fa fa-search"></i></span>
                                        </div>
                                        <input type="text" id="getSearch" class="form-control"
                                            placeholder="Recherche...">
                                        <input type="hidden" id="getReciverIDDynamic" value="{{ $receiver_id }}">
                                    </div>
                                    <ul class="list-unstyled chat-list mt-2 mb-0" id="getSearchUserDynamic">
                                        @include('chat._user')
                                    </ul>
                                </div>
                                <div class="chat" id="getChatMessageAll">
                                    @if (isset($getReceiver) && !empty($getReceiver))
                                        @include('chat._message')
                                    @else
                                        <div class="h-100 d-flex align-items-center justify-content-center">
                                            <div class="text-center text-muted">
                                                <i class="fa fa-comments fa-3x mb-3"></i>
                                                <h5>Mon espace de chat</h5>
                                                <p>Sélectionnez une personne pour commencer une conversation.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets1/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets1/js/setting-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            function receiver() {
                return $("#getReciverIDDynamic").val();
            }

            function scrollDown() {
                let h = $(".chat-history");
                if (h.length) h.stop().animate({
                    scrollTop: h[0].scrollHeight
                }, 300);
            }

            function updateGlobalCount(count) {
                count = parseInt(count || 0, 10);
                let badge = $("#globalChatCount");
                if (count <= 0) {
                    if (badge.length) badge.text("").hide();
                    return;
                }
                if (!badge.length) {
                    let container = $("#messageDropdown");
                    if (!container.length) return;
                    container.append('<span class="notification" id="globalChatCount"></span>');
                    badge = $("#globalChatCount");
                }
                badge.text(count).show();
            }

            function refreshReceiverStatus() {
                let receiverId = receiver();
                if (!receiverId) return;
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_chat_user_status') }}",
                    data: {
                        receiver_id: receiverId,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status !== true) return;
                        let html = "";
                        if (data.is_online) html = '<i class="fa fa-circle online"></i> En ligne';
                        else html = '<i class="fa fa-circle offline"></i> ' + (data.last_seen || "");
                        $("#receiverOnlineStatus").html(html);
                    }
                });
            }

            function refreshAllUsersStatus() {
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_chat_users_status') }}",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status !== true || !data.users) return;
                        $.each(data.users, function(userId, user) {
                            let status = $("#user-status-" + userId);
                            if (!status.length) return;
                            if (user.is_online) status.html(
                                '<i class="fa fa-circle online"></i> En ligne');
                            else status.html('<i class="fa fa-circle offline"></i> ' + (user
                                .last_seen || "Hors ligne"));
                        });
                    }
                });
            }
            $("body").on("click", ".getChatWindows", function(e) {
                e.preventDefault();
                let receiverId = $(this).attr("id");
                $("#getReciverIDDynamic").val(receiverId);
                $(".getChatWindows").removeClass("active");
                $(this).addClass("active");
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_chat_windows') }}",
                    data: {
                        receiver_id: receiverId,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status === true) {
                            $("#getChatMessageAll").html(data.success);
                            $("#getSearchUserDynamic").html(data.chat_users);
                            $(".getChatWindows").removeClass("active");
                            $("#" + receiverId).addClass("active");
                            window.history.pushState("", "", '{{ url('chat?receiver_id=') }}' +
                                data.receiver_id);
                            scrollDown();
                            refreshReceiverStatus();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            $("#getSearch").on("keyup", function() {
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_chat_search_user') }}",
                    data: {
                        search: $(this).val(),
                        receiver_id: receiver(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status === true) {
                            $("#getSearchUserDynamic").html(data.success);
                            let receiverId = receiver();
                            if (receiverId) {
                                $(".getChatWindows").removeClass("active");
                                $("#" + receiverId).addClass("active");
                            }
                        }
                    }
                });
            });
            $("body").on("submit", "#submit_message", function(e) {
                e.preventDefault();
                let form = this;
                let textarea = $("#ClearMessage");
                let button = $(form).find("button[type='submit']");
                let fileInput = $("#file_name")[0];
                if (!textarea.val().trim() && (!fileInput || !fileInput.files.length)) return;
                button.prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "{{ url('submit_message') }}",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.status === true) {
                            $("#AppendMessage").append(data.success);
                            textarea.val("");
                            $("#file_name").val("");
                            $("#getfileName").html("");
                            $("#typingIndicator").hide();
                            $("#getSearchUserDynamic").html(data.chat_users);
                            $(".getChatWindows").removeClass("active");
                            $("#" + receiver()).addClass("active");
                            scrollDown();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    complete: function() {
                        button.prop("disabled", false);
                        textarea.focus();
                    }
                });
            });
            $("body").on("click", "#OpenFile", function(e) {
                e.preventDefault();
                $("#file_name").trigger("click");
            });
            $("body").on("change", "#file_name", function() {
                if (this.files.length) $("#getfileName").html(this.files[0].name);
            });

            function sendTyping() {
                let receiverId = receiver();
                if (!receiverId) return;
                $.ajax({
                    type: "POST",
                    url: "{{ url('chat_typing') }}",
                    data: {
                        receiver_id: receiverId,
                        _token: "{{ csrf_token() }}"
                    }
                });
            }
            $("body").on("input", "#ClearMessage", function() {
                if ($(this).val().trim().length > 0) sendTyping();
            });

            function checkTyping() {
                let receiverId = receiver();
                if (!receiverId) return;
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_chat_typing') }}",
                    data: {
                        receiver_id: receiverId,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        let indicator = $("#typingIndicator");
                        if (!indicator.length) return;
                        if (data.typing === true) indicator.show();
                        else indicator.hide();
                    }
                });
            }

            function checkNewMessages() {
                let receiverId = receiver();
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_new_chat_messages') }}",
                    data: {
                        receiver_id: receiverId || "",
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status !== true) return;
                        if (receiverId) {
                            let current = $("#AppendMessage").html();
                            let incoming = data.success;
                            if (incoming !== current) {
                                let wasAtBottom = false;
                                let history = $(".chat-history");
                                if (history.length) {
                                    wasAtBottom = history.scrollTop() + history.innerHeight() + 50 >=
                                        history[0].scrollHeight;
                                }
                                $("#AppendMessage").html(incoming);
                                if (wasAtBottom) scrollDown();
                            }
                        }
                        if (data.chat_users) {
                            let activeId = receiver();
                            let currentUsers = $("#getSearchUserDynamic").html();
                            if (currentUsers !== data.chat_users) {
                                $("#getSearchUserDynamic").html(data.chat_users);
                                if (activeId) {
                                    $(".getChatWindows").removeClass("active");
                                    $("#" + activeId).addClass("active");
                                }
                            }
                        }
                        updateGlobalCount(data.count);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            function refreshGlobalChatCount() {
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_new_chat_messages') }}",
                    data: {
                        receiver_id: "",
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status === true) updateGlobalCount(data.count);
                    }
                });
            }
            $("#getReciverIDDynamic").val("{{ $receiver_id }}");
            let initialReceiver = $("#getReciverIDDynamic").val();
            if (initialReceiver) {
                $(".getChatWindows").removeClass("active");
                $("#" + initialReceiver).addClass("active");
            }
            scrollDown();
            refreshGlobalChatCount();
            refreshReceiverStatus();
            refreshAllUsersStatus();
            setInterval(checkNewMessages, 2000);
            setInterval(refreshGlobalChatCount, 3000);
            setInterval(checkTyping, 1200);
            setInterval(refreshReceiverStatus, 3000);
            setInterval(refreshAllUsersStatus, 3000);
        });
    </script>
</body>

</html>
