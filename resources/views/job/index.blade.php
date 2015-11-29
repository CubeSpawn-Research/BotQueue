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

    <template id="jobs-template">
        <h1>@{{ name  }} :: @{{ range }} :: <a :href="allLink">See All</a></h1>
        <table v-if="count > 0" class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="job in jobs">
                <td>@{{ job.id }}</td>
                <td>@{{ job.name }}</td>
            </tr>
            </tbody>
        </table>
        <div v-if="count == 0">
            No jobs to see here
        </div>
    </template>

@stop

@section('end-js')
    <script src="/js/vue/job_list.js"></script>
@stop