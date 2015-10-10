@extends('default')

@section('styles')
<style>
    .question h3 {
        margin: 0px;
    }

    .question .info {
        margin-top: 20px;
    }

    .question .answered {
        /*padding: 7px;*/
        /*background-color: #3C3C77;*/
        color: #3C3C77;
    }

    .question .info .count {
        display: block;
    }

    .tags a:focus {
        text-decoration: none;
    }
</style>
@stop

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-body">

                    @foreach ($questions as $question)
                    <!--/stories-->
                    <div class="row question">
                        <div class="col-md-2 col-sm-3 text-center info">
                            <div class="col-md-6">
                                <label class="count">{!! $question->countPoints() !!}</label>
                                <label>Votes</label>
                            </div>
                            <div class="col-md-6 {!! $question->countAnswers() > 1 ? 'answered' : '' !!}">
                                <label class="count">{!! $question->countAnswers() !!}</label>
                                <label>Answers</label>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-9">
                            <a href="{!! route('questions.show', $question->id) !!}">
                                <h3>{!! $question->title !!}</h3>
                            </a>
                            <div class="row">
                            <div class="col-xs-9">
                                <h4 class="tags">
                                    @foreach($question->tags as $tag)
                                        <a href="{!! route('questions.tagged', $tag->id) !!}">
                                            <span class="label label-default">{!! $tag->name !!}</span>
                                        </a>
                                    @endforeach
                                </h4>
                                <h4>
                                    <small style="font-family:courier,'new courier';" class="text-muted">
                                        {!! $question->created_at->diffForHumans() !!}  •
                                        <a href="">{!! isset($question->user->exists) ? $question->user->name : 'Deleted user' !!}</a>
                                    </small>
                                </h4>
                            </div>
                            <div class="col-xs-3"></div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    @endforeach
                    <!--/stories-->

                </div>
            </div>

        </div><!--/col-12-->
    </div>
</div>
@stop