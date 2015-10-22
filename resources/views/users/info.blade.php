@if (isset($item->user->exists))
    <img src="{{ $item->user->avatar }}">
    <a href="">{{ $item->user->name }}</a>
    <label class="pts">{{ $item->user->points }}</label>
@else
    <a href="">Deleted user</a>
    <label class="pts">0</label>
@endif