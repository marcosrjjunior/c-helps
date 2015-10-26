@extends('default')

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">

                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{!! $user->avatar !!}" class="img-thumbnail">
                            <h5 class="text-center">Points <span class="label label-default">{!! $user->points !!}</span></h5>
                            <div class="row">
                                <div class="text-center info">
                                    <div class="col-md-6">
                                        <label class="count">{!! count($user->answers) !!}</label>
                                        <label>Answers</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="count">{!! count($user->questions) !!}</label>
                                        <label>Questions</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#questions" id="questions-tab" role="tab" data-toggle="tab" aria-controls="questions" aria-expanded="true">Questions</a></li>
                                    <li role="presentation"><a href="#answers" role="tab" id="answers-tab" data-toggle="tab" aria-controls="answers" aria-expanded="false">Answers</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="questions">
                                        <table class="table">
                                            <tbody>
                                                @foreach($user->questions as $question)
                                                <tr>
                                                    <td>{!! $question->countAnswers() !!}</td>
                                                    <td>
                                                        <a href="{!! route('questions.show', $question->id) !!}">{!! $question->title !!}</a>
                                                    </td>
                                                    <td>{!! $question->created_at->diffForHumans() !!}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="answers">
                                        <table class="table">
                                            <tbody>
                                                @foreach($user->answers as $answer)
                                                <tr>
                                                    <td>{!! $answer->question->countAnswers() !!}</td>
                                                    <td>
                                                        <a href="{!! route('questions.show', $answer->question->id) !!}">{!! $answer->question->title !!}</a>
                                                    </td>
                                                    <td>{!! $answer->question->created_at->diffForHumans() !!}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/col-12-->
    </div>
</div>
@stop