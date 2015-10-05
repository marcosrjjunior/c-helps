<h4>{!! $question->countAnswers() !!} Answers</h4>
<hr>

@foreach($question->answers as $answer)
<div class="row" data-id="{!! $answer->id !!}">
    <div class="vote">
        <div class="col-md-1">
            <i data-point="up" class="fa fa-caret-up fa-4x point"></i>
                <label class="points">{!! $answer->points !!}</label>
            <i data-point="down" class="fa fa-caret-down fa-4x point"></i>
        </div>
    </div>
    <div class="col-md-11">
        @can('update', $answer)
        <div class="actions pull-right">
            <a href="{!! route('answers.edit', $answer->id) !!}">
                <span class="label label-default">edit</span>
            </a>

            <span data-item="{!! $answer->id !!}" class="label label-default delete-answer">delete</span>
        </div>
        @endcan
        <p>{!! $answer->text !!}</p>
        <div class="user-info pull-right">
            <p>answered {!! $answer->created_at->diffForHumans() !!}</p>
            <img src="{!! isset($answer->user->exists) ? $answer->user->avatar : '' !!}">
            <a href="">{!! isset($answer->user->exists) ? $answer->user->name : 'Deleted user' !!}</a>
            <label class="pts">{!! isset($answer->user->exists) ? $answer->user->points : '0' !!}</label>
        </div>
    </div>
</div>
<hr>
@endforeach
