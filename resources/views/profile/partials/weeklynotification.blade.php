<div>
{{--    weekly notifications from ['likes', 'comments', 'isFollowing', 'isFollowedBy'] array --}}
    {{--    message --}}
    <span class="inline-flex items-center">
        <b> {{$notification->data['message']}}</b>
    </span> <br>
    <div class="flex items-center">
        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                <span class="inline-flex items-center">
                    <b> {{ $notification->data['weeklies']['likes_count'] }}</b> Likes
                </span>
            </a>
        </div>
        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                <span class="inline-flex items-center">
                    <b> {{ $notification->data['weeklies']['comments_count'] }}</b> Comments
                </span>
            </a>
        </div>
        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                <span class="inline-flex items-center">
                    <b> {{ $notification->data['weeklies']['is_following_count'] }}</b> New Followers
                </span>
            </a>
        </div>
        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                <span class="inline-flex items-center">
                    <b> {{ $notification->data['weeklies']['is_followed_by_count'] }}</b> New Followings
                </span>
            </a>
        </div>
    </div>
</div>
