<div class="rounded orange lighten-4 shadow mt-3 pt-2 pb-2 w-100">
    <div class="d-flex">
        <a href="{{ route('users.show', ['name' => $user->name]) }}">
            <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" class="rounded-circle" height="80px"
                width="80px" alt="Userトップ画像">
        </a>

        <div>
            <a href="{{ route('users.show', ['name' => $user->name]) }}">
                <h1 class="h6 green-text"> <i class="mr-2 far fa-user-circle"></i>{{ $user->name }}</h1>
            </a>
            <!-- フォローコンポーネント -->
            @if (Auth::id() !== $user->id)
                <div>
                    <follow :initial-is-followd-by='@json($user->isFollowdBy(Auth::user()))'
                        :login-check='@json(Auth::check())' url="{{ route('users.follow', ['name' => $user->name]) }}">
                    </follow>
                </div>
            @endif
        </div>
    </div>
</div>
