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
    <div class="col-md-9">
        <p>{!! $answer->answer !!}</p>
        <p>{!! $answer->created_at->diffForHumans() !!}</p>
        <p>{!! $answer->user->name !!}</p>
        <p>{!! $answer->user->points !!}</p>
    </div>
    @can('update', $answer)
    <div class="actions">
        <a href="{!! route('answers.edit', $answer->id) !!}">
            <span class="label label-default">edit</span>
        </a>

        <span data-item="{!! $answer->id !!}" class="label label-default delete-answer">delete</span>
    </div>
    @endcan
</div>
<hr>
@endforeach
