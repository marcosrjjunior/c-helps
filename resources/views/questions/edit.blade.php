@extends('default')

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3>Question: {!! $question->title !!}</h3>
                        (old)
                        <div class="row">
                            <div class="col-md-9">
                                {!! $question->text !!}
                                <hr>
                            </div>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" action="{!! route('questions.update', $question->id) !!}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="put" />
                                <h4>Your Question</h4>

                                <input type="hidden" name="question_id" value="{{-- $question->id --}}">
                                <div class="form-group @if($errors->has('text')) has-error @endif">
                                    <textarea rows="7" class="form-control" name="text">{!! $question->text !!}</textarea>
                                    {!! $errors->first('text', '<span class="help-block">:message</span>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary">Edit Your Question</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/col-12-->
    </div>
</div>
@stop