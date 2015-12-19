@extends('app')

@section('title', str_plural(Auth::user()->name). ' jobs')

@section('content')
    <div id="jobs">
        <div class="row">
            <div class="span6">
                <bq-job-list name="Available" type="available"></bq-job-list>
            </div>
            <div class="span6">
                <bq-job-list name="Working" type="working"></bq-job-list>
            </div>
        </div>
        <div class="row">
            <div class="span6">
                <bq-job-list name="Completed" type="completed"></bq-job-list>
            </div>
            <div class="span6">
                <bq-job-list name="Failed" type="failed"></bq-job-list>
            </div>
        </div>
    </div>
@stop

@section('end-js')
    <script src="/js/vue/job_list.js"></script>
@stop