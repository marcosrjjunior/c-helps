@extends('default')

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3>Question: {!! $answer->question->title !!}</h3>
                        <div class="row">
                            <div class="col-md-9">
                                {!! $answer->question->text !!}
                                <hr>
                            </div>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" action="{!! route('answers.update', $answer->id) !!}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="put" />
                                <h4>Your Answer</h4>

                                <input type="hidden" name="question_id" value="{{-- $question->id --}}">
                                <div class="form-group @if($errors->has('answer')) has-error @endif">
                                    <textarea rows="7" class="form-control" name="answer">{!! $answer->answer !!}</textarea>
                                    {!! $errors->first('answer', '<span class="help-block">:message</span>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary">Edit Your Answer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/col-12-->
    </div>
</div>
@stop