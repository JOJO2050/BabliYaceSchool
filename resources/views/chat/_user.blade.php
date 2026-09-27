@foreach ($getChatUser as $user)
    <li class="clearfix getChatWindows @if (!empty($receiver_id) && $receiver_id == $user['user_id']) active @endif" id="{{ $user['user_id'] }}">
        <img src="{{ $user['profile_pic'] }}" alt="avatar">
        <div class="about">
            <div class="name">
                {{ $user['name'] }}
                @if (!empty($user['messagecount']))
                    <span id="ClearMessage{{ $user['user_id'] }}"
                        style="background:green;color:#fff;border-radius:5px;padding:1px 7px;">
                        <b>{{ $user['messagecount'] }}</b>
                    </span>
                @endif
            </div>
            <div class="status" id="user-status-{{ $user['user_id'] }}">
                @if (!empty($user['is_online']))
                    <i class="fa fa-circle online"></i>
                    En ligne
                @else
                    <i class="fa fa-circle offline"></i>
                    {{ !empty($user['last_seen']) ? \Carbon\Carbon::parse($user['last_seen'])->format('d/m/Y à H:i') : 'Hors ligne' }}
                @endif
            </div>
        </div>
    </li>
@endforeach
