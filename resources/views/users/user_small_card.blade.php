<div class="rounded orange lighten-4 shadow mt-3 pt-2 pb-2 w-100">
    <div class="d-flex">
        <a class="ml-3" href="{{ route('users.show', ['name' => $user->name]) }}">
            <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" class="rounded-circle m-1" height="60px"
                width="60px" alt="Userトップ画像">
        </a>

        <div>
            <a href="{{ route('users.show', ['name' => $user->name]) }}">
                <h1 class="mt-1 ml-1 p-0 h6 green-text"> <i class="mr-2 far fa-user-circle"></i>{{ $user->name }}</h1>
            </a>
            <!-- フォローコンポーネント -->
            @if (Auth::id() !== $user->id)
                <div class="ml-auto">
                    <follow :initial-is-followd-by='@json($user->isFollowdBy(Auth::user()))'
                        :login-check='@json(Auth::check())'
                         url="{{ route('users.follow', ['name' => $user->name]) }}">
                    </follow>
                </div>
            @endif
        </div>
    </div>
</div>
