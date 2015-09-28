@extends('default')

@section('scripts')
    <script>
        $(function() {
            $('.point').on('click', function(e) {
                e.preventDefault();

                var $this   = $(this);
                    $answer = $this.closest('[data-id]'),
                    $point   = $this.data('point');

                $.ajax({
                    headers: {'X-CSRF-TOKEN' : '{!! csrf_token() !!}'},
                    method: 'POST',
                    url: '/answers/'+$answer.data('id')+'/points/submit',
                    data: { point: $point },
                    success : function(data)
                    {
                        $answer.find('.points').text(data.points);
                    },
                    error: function(data)
                    {
                        alert('Try vote for another answer or you already voted for this answer');
                    }
                });
            });

            $('.delete-answer').on('click', function(e) {
                e.preventDefault();

                if (!confirm('Are you sure?')) return;

                var $this = $(this),
                    $id   = $this.data('item');

                $.ajax({
                    headers: {'X-CSRF-TOKEN' : '{!! csrf_token() !!}'},
                    method: 'DELETE',
                    url: '/answers/'+$id+'/delete',
                    success : function(data)
                    {
                        $this.closest('[data-id]').remove();
                    }
                });
            });

        });
    </script>
@stop

@section('styles')
<link rel="stylesheet" href="{!! asset('assets/bootstrap-markdown-editor/css/bootstrap-markdown-editor.css') !!}">
<style>
.point {
    cursor: pointer;
    color: #8E8E8E;
}
.points {
    display: block;
    margin: -8px 8px;
}
.user-info {
    background-color: #E0EAF1;
    line-height: 8px;
    padding: 9px 14px;
}
.user-info .pts {
    font-size: 14px;
}
</style>
@stop

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3>{!! $question->title !!}</h3>
                    </h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <p>{!! $question->text !!}</p>
                            <h4>
                                @foreach($question->tags as $tag)
                                    <span class="label label-default">{!! $tag->name !!}</span>
                                @endforeach
                            </h4>
                            <div class="user-info pull-right">
                                <p>asked {!! $question->created_at->diffForHumans() !!}</p>
                                <a>{!! $question->user->name !!}</a>
                                <label class="pts">{!! $question->user->points !!}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            @include('answers.answers')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" action="{!! route('answers.submit') !!}">
                                {!! csrf_field() !!}

                                <h4>Your Answer</h4>

                                <input type="hidden" name="question_id" value="{!! $question->id !!}">
                                <div class="form-group @if($errors->has('answer')) has-error @endif">
                                    <textarea rows="7" class="form-control" name="answer"></textarea>
                                    {!! $errors->first('answer', '<span class="help-block">:message</span>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary">Post Your Answer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop