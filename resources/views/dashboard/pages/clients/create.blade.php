@extends('layouts.dashboard')
@section('title')
{{trans('client.client_page_title')}}
@endsection
@section('content')
<div class="layout-px-spacing">
    <br>
    <div class="col-sm-12">
        <h4 class="mb-0">
            {{trans('client.add_new_client')}}
        </h4>
    </div>
    <br>
    <!-- Start BreadCrumbs -->
    <nav class="breadcrumb-two" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{trans('dashboard.dashboard_page_title')}}</a></li>
            <li class="breadcrumb-item">
                <a href="{{route('client.index')}}">
                {{trans('client.clients')}}
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{route('client.create')}}">
                {{trans('client.add_new_client')}}
                </a>
            </li>
        </ol>
    </nav>
    <!-- End BreadCrumbs -->
    <br>
    @include('dashboard.includes.alerts._errors')
    <!-- Start Create Client Form -->
    <form action="{{ route('client.store') }}" method="post">
        @csrf
        <!-- Start Statbox -->
        <div class="statbox widget box box-shadow">
            <!-- Start Client Name & Phone Number -->
            <div class="form-row mb-4">
                <div class="form-group col-md-4">
                    <label>{{trans('client.client_name')}}</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="{{trans('client.enter_client_name')}}">
                </div>
                <div class="form-group col-md-4">
                    <label>{{trans('client.client_phone_one')}}</label>
                    <input type="text" name="phone[]" class="form-control" placeholder="{{trans('client.enter_first_client_phone')}}">
                </div>
                <div class="form-group col-md-4">
                    <label>{{trans('client.client_phone_two')}}</label>
                    <input type="text" name="phone[]" class="form-control" placeholder="{{trans('client.enter_second_client_phone')}}">
                </div>
            </div>
            <!-- End Client Name & Phone Number -->
            <!-- Start Address -->
            <div class="form-row mb-4">
                <div class="form-group col-md-12">
                    <textarea class="form-control" name="address">{{old('address')}}</textarea>
                </div>
            </div>
            <!-- End Address -->
            <button type="submit" class="btn btn-outline-primary btn-rounded mb-2">{{ trans('general.save') }}</button>
        </div>
        <!-- End Statbox -->
    </form>
    <!-- End Create Client Form -->
</div>
@endsection