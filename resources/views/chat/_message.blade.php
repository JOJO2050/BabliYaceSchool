<div class="chat-header clearfix">
    <div class="row">
        <div class="col-lg-12">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                <img src="{{ $getReceiver->getProfile() }}" alt="avatar">
            </a>
            <div class="chat-about">
                <h6 class="m-b-0">
                    {{ $getReceiver->name }} {{ $getReceiver->last_name }}
                </h6>
                <small>
                    <span id="typingStatus"></span>
                    <span id="receiverOnlineStatus">
                        @if ($getReceiver->OnlineUser())
                            <i class="fa fa-circle online"></i>
                            En ligne
                        @else
                            <i class="fa fa-circle offline"></i>
                            {{ $getReceiver->updated_at ? \Carbon\Carbon::parse($getReceiver->updated_at)->format('d/m/Y H:i') : '' }}
                        @endif
                    </span>
                </small>
            </div>
        </div>
    </div>
</div>

<div class="chat-history">
    <ul class="m-b-0" id="AppendMessage">
        @if (!empty($getChat))
            @foreach ($getChat as $chat)
                @include('chat._single', ['getChat' => [$chat]])
            @endforeach
        @endif
    </ul>
</div>

<div class="chat-message clearfix">
    <div id="typingIndicator" style="display:none;padding:0 10px 8px;color:#6c757d;font-size:13px;">
        {{ $getReceiver->name }} est en train d’écrire...
    </div>

    <form action="" id="submit_message" method="post" class="mb-0" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{ $getReceiver->id }}" name="receiver_id">

        <div class="chat-input-container">
            <textarea class="form-control" placeholder="Écrire un message..." name="message" id="ClearMessage" rows="2"></textarea>

            <button class="btn btn-primary" type="submit">
                Envoyer
            </button>
        </div>

        <div class="col-lg-6 hidden-sm text-right" style="margin-top:10px">
            <a href="javascript:void(0);" id="OpenFile" class="btn btn-outline-primary">
                <i class="fa fa-image"></i>
            </a>

            <input type="file" style="display:none" name="file_name" id="file_name">

            <span id="getfileName"></span>
        </div>
    </form>
</div>
