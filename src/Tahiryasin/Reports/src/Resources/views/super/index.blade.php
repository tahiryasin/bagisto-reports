@extends('admin::layouts.content')

@section('page_title')
    {{ __('reports::app.reports.sales-report') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.reports.generate') }}" @submit.prevent="onSubmit"
              enctype="multipart/form-data">
            @csrf

            <div class="page-header">
                <div class="page-title">
                    <h1>{{ __('reports::app.reports.sales-report') }}</h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('reports::app.reports.generate') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-6">
                            <input type="hidden" name="gridName" value="Tahiryasin\Reports\DataGrids\SalesReport">

                            <div class="control-group" :class="[errors.has('report_from') ? 'has-error' : '']">
                                <label for="report_from" class="required">{{ __('reports::app.reports.from') }}</label>
                                <date>
                                    <input autocomplete="off" type="text" name="report_from" class="control"
                                           value="{{ old('report_from') }}"
                                           data-vv-as="&quot;{{ __('reports::app.reports.from') }}&quot;"
                                           class="control flatpickr-input" aria-required="true"
                                           v-validate="'required|date_format:yyyy-MM-dd'"/>
                                    <span class="control-error" v-if="errors.has('report_to')">@{{ errors.first('report_to') }}</span>
                                </date>
                            </div>

                            <div class="control-group" :class="[errors.has('report_to') ? 'has-error' : '']">
                                <label for="report_to" class="required">{{ __('reports::app.reports.to') }}</label>
                                <date>
                                    <input autocomplete="off" type="text" name="report_to" class="control"
                                           value="{{ old('report_to') }}"
                                           data-vv-as="&quot;{{ __('reports::app.reports.to') }}&quot;"
                                           class="control flatpickr-input" aria-required="true"
                                           v-validate="'required|date_format:yyyy-MM-dd'"/>
                                    <span class="control-error" v-if="errors.has('report_to')">@{{ errors.first('report_to') }}</span>
                                </date>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@stop

@push('scripts')
    <script>
        window.addEventListener("load", function (event) {
            $('button.btn').click(function () {
                setTimeout(function () {
                    $('button.btn').removeAttr('disabled');
                }, 500)
            })
        });
    </script>
@endpush