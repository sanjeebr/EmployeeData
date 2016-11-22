@extends ('layout.employee')

@section('content')
<div class="container">
    @include('common.errors')
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="header-info">
            <h1>Sanjeeb's Website</h1>
            {{ Form::open(array('url' => '/upload', 'method' => 'post', 'enctype' => 'multipart/form-data')) }}
            <div class="center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="btn btn-default btn-file col-md-4 col-lg-4 col-lg-offset-3 col-md-offset-3">{{ Form::file('files') }}</div>
                    <div class="fileinput-filename col-md-2 col-lg-2"></span><span>{!! Form::submit('upload',array('class' => 'btn btn-primary')) !!}</div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection