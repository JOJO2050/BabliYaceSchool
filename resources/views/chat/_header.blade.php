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

                @if ($getReceiver->OnlineUser())
                    <i class="fa fa-circle online"></i>
                    En ligne
                @else
                    <i class="fa fa-circle offline"></i>
                    Dernière connexion :
                    {{ $getReceiver->LastOnline() }}
                @endif
            </small>
        </div>
    </div>
</div>
