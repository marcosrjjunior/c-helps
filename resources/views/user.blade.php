@if (isset($item->user->exists))
    <a href="{{ route('users', $item->user->id) }}">{{ $item->user->name }}</a>
@else
    <a href="">Deleted User</a>
@endif
