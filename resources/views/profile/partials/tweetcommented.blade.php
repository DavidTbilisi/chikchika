<a href="{{route("username", ["username"=>$notification->data['user']['name']])}}">
    <span class="inline-flex items-center">
        <b> {{$notification->data['user']['name']}}</b>
    </span>
</a>
