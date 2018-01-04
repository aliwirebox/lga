@extends('app.master')

@section('title', 'Upload CV')

@section('css')
    <link rel="stylesheet" href="{{asset('bower_components/dropzone/dist/min/dropzone.min.css')}}">
    @parent
@endsection

@section('content')
    <script>
        var existingCv = {!! $existingCv ? json_encode($existingCv) : 'false' !!};
    </script>
    <div class="row-fluid m-top-50">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="display-inline">Create a Profile</h4>
                    <a href="{{ url('candidate-faqs')}}" class="pull-right"><strong>Questions&#63;</strong></a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 m-top-20">
                    <div class="row">
                        <div class="col-xs-12">
                            @include('app.candidate.profile.partials.menu')

                            <div class="well-30 text-center">
                                @include('partials.errors')

                                <form enctype="multipart/form-data" action="{{ $submitUrl }}" method="post" id="cv-dropzone"
                                      class="dropzone dropzone-container dz-clickable well-30-yellow">
                                    {{csrf_field()}}
                                    <h4 class="fs-18 f-strong">Drag your CV below or click on the upload button to search for a file</h4>
                                    <p class="fs-16 text-danger">
                                    Your CV is hidden and is never made available to employers without your express consent.
                                    Your privacy is our priority.
                                    </p>
                                    <div class="brand-sprite brand-cloud m-top-20"></div>
                                    <button id="cv-select-button" class="btn btn-dark m-top-20">Select File</button>
                                    <div class="fallback m-top-20">
                                        <input name="cv" type="file" />
                                        <button type="submit" class="m-top-20 btn btn-primary fs-12 btn-lg">Submit</button>
                                    </div>
                                    <p class="m-top-20">Files must be .pdf or .doc</p>
                                </form>

                                @include('app.candidate.profile.partials.buttons')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script src="{{asset('bower_components/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{ elixir('js/candidate-cv.js') }}" type="text/javascript"></script>
@endsection
