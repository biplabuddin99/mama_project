@extends('layout.app')

@section('pageTitle', trans('Create credit'))
@section('pageSubTitle', trans('Create'))

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{ route(currentUser() . '.credits.store') }}">
                                @csrf
                                <div class="row">
                                    {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="brandName">{{__('Name')}}</label>
                                        <input type="text" id="brandName" class="form-control"
                                            placeholder="Brand Name" value="{{ old('brandName')}}" name="brandName">
                                    </div>
                                    @if ($errors->has('brandName'))
                                    <span class="text-danger"> {{ $errors->first('brandName') }}</span>
                                    @endif
                                </div> --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="Select Type">{{ __('Select Type') }}<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control form-select"
                                                name="status" id="">
                                                <option value="">Select Type</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Company">Company</option>
                                                <option value="Visa">Visa</option>
                                                <option value="Credit">Credit</option>
                                                <option value="NetSell">Net.Sell</option>
                                                <option value="Extra">Extra</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger"> {{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="amount">{{ __('Amount') }}</label>
                                            <input type="number" step="0.0001" class="form-control" placeholder="Amount"
                                                value="{{ old('amount') }}" name="amount">
                                        </div>
                                        @if ($errors->has('amount'))
                                            <span class="text-danger"> {{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="remarks">{{ __('Remarks') }}</label>
                                            <textarea class="form-control" id="remarks" placeholder="Remarks" name="remarks">{{ old('remarks') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
