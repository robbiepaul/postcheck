@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            @include('helpers.back_to', ['page' => 'dashboard'])
            <div class="panel panel-default">
                <div class="panel-heading">Add a feed</div>
                <div class="panel-body">
                    {!! BootForm::openHorizontal([ 'sm' => [4, 8],'lg' => [4, 6]])->post()->action('/feeds') !!}
                    {!! BootForm::text('Link', 'link')->placeholder('eg. http://twitter.com/robbiepaulco') !!}
                    {!! BootForm::select('Notify by', 'notify_by')->options(\PostCheck\Core\FeedService::notifyOptions()) !!}
                    {!! BootForm::token() !!}
                    <div class="form-group"><div class="col-sm-offset-4 col-sm-8 col-lg-offset-4 col-lg-6"><button type="submit" class="btn btn-lg btn-default">Add</button></div></div>
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
