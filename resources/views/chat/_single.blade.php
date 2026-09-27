@foreach ($getChat as $value)
    @if ($value->sender_id == Auth::user()->id)
        <li class="clearfix">
            <div class="message-data">
                <img src="{{ $value->getSender->getProfile() }}" alt="avatar">
                <span
                    class="message-data-time">{{ Carbon\Carbon::parse($value->created_date)->locale('fr')->diffForHumans() }}</span>
            </div>
            <div class="message other-message">
                {!! $value->message !!}
                @if (!empty($value->getFile()))
                    @php
                        $fileUrl = $value->getFile();
                        $extension = strtolower(pathinfo(parse_url($fileUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    @endphp
                    @if (in_array($extension, $imageExtensions))
                        <div class="chat-attachment-image">
                            <a href="{{ $fileUrl }}" target="_blank">
                                <img src="{{ $fileUrl }}" alt="Image" class="chat-image">
                            </a>
                        </div>
                    @else
                        <div class="chat-attachment-file">
                            <a href="{{ $fileUrl }}" download target="_blank">
                                <i class="fa fa-file"></i>
                                <span>{{ basename(parse_url($fileUrl, PHP_URL_PATH)) }}</span>
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </li>
    @else
        <li class="clearfix">
            <div class="message-data">
                <img src="{{ $value->getReceiver->getProfile() }}" alt="avatar">
                <span
                    class="message-data-time">{{ Carbon\Carbon::parse($value->created_date)->locale('fr')->diffForHumans() }}</span>
            </div>
            <div class="message my-message">
                {!! $value->message !!}
                @if (!empty($value->getFile()))
                    @php
                        $fileUrl = $value->getFile();
                        $extension = strtolower(pathinfo(parse_url($fileUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    @endphp
                    @if (in_array($extension, $imageExtensions))
                        <div class="chat-attachment-image">
                            <a href="{{ $fileUrl }}" target="_blank">
                                <img src="{{ $fileUrl }}" alt="Image" class="chat-image">
                            </a>
                        </div>
                    @else
                        <div class="chat-attachment-file">
                            <a href="{{ $fileUrl }}" download target="_blank">
                                <i class="fa fa-file"></i>
                                <span>{{ basename(parse_url($fileUrl, PHP_URL_PATH)) }}</span>
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </li>
    @endif
@endforeach
