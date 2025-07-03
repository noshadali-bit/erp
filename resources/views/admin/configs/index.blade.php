@extends('admin.layouts.simple.master')
@section('title', 'Configurations')

@section('css')
@endsection

@section('style')
<style>
    div .action {
        display: flex;
    }

    div .action i {
        font-size: 16px;
    }

    .modal {
        z-index: 10;
    }

    .modal-backdrop {
        z-index: 9;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Site Configuration</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Configurations</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>Configuration Settings</h5>
                    <div class="d-flex gap-3">
                        <a href="{{ route('configs.edit') }}" class="btn btn-primary">Edit Settings</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <div class="mb-6">
                            <h3 class="card-title mb-4">Site Logo</h3>
                            <img src="{{  \App\Models\Config::where('flag_key','site_logo')->first()->getFirstMediaUrl('site_logo') }}" 
                                 alt="Site Logo" 
                                 class="max-w-xs">
                        </div>

                        <div class="mb-6">
                            <h3 class="card-title mb-4">Office Timings</h3>
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>Setting</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Start Time</td>
                                        <td>{{ \App\Models\Config::getConfig('office_start_time') }}</td>
                                    </tr>
                                    <tr>
                                        <td>End Time</td>
                                        <td>{{ \App\Models\Config::getConfig('office_end_time') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection