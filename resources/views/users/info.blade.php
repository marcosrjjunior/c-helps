@if (isset($item->user->exists))
    <img src="{{ $item->user->avatar }}">
    <a href="{{ route('users', $item->user->id) }}">{{ $item->user->nickname }}</a>
    <label class="pts">{{ $item->user->points }}</label>
@else
    <a href="">Deleted user</a>
    <label class="pts">0</label>
@endif