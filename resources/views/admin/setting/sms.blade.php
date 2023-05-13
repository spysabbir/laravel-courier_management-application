@extends('admin.layouts.admin_master')

@section('title', 'Sms Setting')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sms Setting</h4>
                <p class="card-text">Body</p>
            </div>
            <div class="card-body">
                <form action="{{route('sms.setting.update', $sms_setting->id)}}" method="POST">
                    @csrf
                    <div class="m-3">
                        <label>Api Key</label>
                        <input type="text" class="form-control" name="api_key" value="{{$sms_setting->api_key}}">
                        @error('api_key')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="m-3">
                        <label>Sender Id</label>
                        <input type="text" class="form-control" name="sender_id" value="{{$sms_setting->sender_id}}">
                        @error('sender_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="m-3">
                        <button class="btn btn-info" type="submit">Update Sms Setting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
