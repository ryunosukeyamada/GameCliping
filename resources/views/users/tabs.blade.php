<ul class="nav nav-tabs nav-justified  mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{ $clip? 'active peach-gradient  ':'' }}" href="{{ route('users.show', ['name' => $user->name]) }}">
            投稿
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $like? 'active peach-gradient':'' }}" href="{{ route('users.likes', ['name' => $user->name]) }}">
            いいね
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $follows? 'active peach-gradient':'' }}" href="{{ route('users.follows', ['name' => $user->name]) }}">
            フォロー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $followers? 'active peach-gradient':'' }}" href="{{ route('users.followers', ['name' => $user->name]) }}">
            フォロワー
        </a>
    </li>
</ul>
