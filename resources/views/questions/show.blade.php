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
                        alert('You already voted!');
                    }
                });
            });
        });
    </script>
@stop

@section('styles')
<style>
.point {
    cursor: pointer;
    color: #8E8E8E;
}
.points {
    display: block;
    margin: -8px 8px;
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
                            <p>{!! $question->created_at->diffForHumans() !!}</p>
                            <p>{!! $question->user->name !!}</p>
                            <p>{!! $question->user->points !!}</p>
                        </div>
                    </div>

                    @include('answers.answers')

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

        </div><!--/col-12-->
    </div>
</div>
@stop