@extends('default')

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vuejs/js/vue.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/marked/js/marked.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/editor.js') }}"></script>
<script>
    $(function() {
        $('select').select2({
            tags: true
        });
    });
</script>
@stop

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@stop

@section('page')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-body">
                    @if ($errors->has())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" action="{{ route('questions.submit') }}">
                                {{ csrf_field() }}

                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="What's your question? Be specific." value="{{ old('title') }}">
                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                </div>

                                <div class="form-group @if($errors->has('text')) has-error @endif">
                                    <label for="title">Text</label>
                                    <div id="editor">
                                        <textarea rows="8" v-model="text" debounce="100" name="text">{{ old('text') }}</textarea>
                                        <div v-html="text | marked"></div>
                                    </div>
                                    {!! $errors->first('text', '<span class="help-block">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select type="text" class="form-control" name="tags[]" multiple>
                                        @foreach($tags as $tag)
                                        <option>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary">Post Your Question</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div><!--/col-12-->
    </div>
</div>
@stop