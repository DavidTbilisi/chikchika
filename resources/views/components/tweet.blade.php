{{-- single post laravel component --}}



<div class="tweet">
    <div class="tweet__header">
        <div class="tweet__header__info">
            <div class="tweet__header__info__name">
                {{ $tweet->user->name }}
            </div>
        </div>
    </div>

    <div class="tweet__body">
        {{ $tweet->body }}
    </div>

    <div class="tweet__footer">
        <div class="tweet__footer__date">
            {{ $tweet->created_at->diffForHumans() }}
        </div>
    </div>
    <hr class="tweet__hr">
</div>

