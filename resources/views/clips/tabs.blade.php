<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{ $clip? 'active':''}}" href="{{ route('clips.index') }}">
            ALL
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $like? 'active':''}}" href="{{ route('clips.index.likes') }}">
            いいね多い順
        </a>
    </li>
    @auth
        <li class="nav-item">
            <a class="nav-link text-muted {{ $myClip? 'active':''}}" href="{{ route('clips.index.myclip') }}">
                自分の投稿
            </a>
        </li>
    @endauth
</ul>
