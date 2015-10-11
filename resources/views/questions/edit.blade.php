@extends('default')

@section('scripts')
<script type="text/javascript" src="{!! asset('assets/vuejs/js/vue.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/marked/js/marked.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/editor.js') !!}"></script>
@stop

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3>Question: {!! $question->title !!}</h3>
                        <div class="row">
                            <div class="col-md-9">
                                <p>{!! \Michelf\MarkdownExtra::defaultTransform($question->text) !!}</p>
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

                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                    <label for="title">Text</label>
                                    <input type="text" class="form-control" name="title" value="{!! $question->title !!}">
                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                </div>

                                <div class="form-group @if($errors->has('text')) has-error @endif">
                                    <label for="title">Text</label>
                                    <div id="editor">
                                        <textarea rows="8" v-model="text" debounce="100" name="text">{!! $question->text !!}</textarea>
                                        <div v-html="text | marked"></div>
                                    </div>
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