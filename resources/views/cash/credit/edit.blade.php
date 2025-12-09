@extends('layout.app')

@section('pageTitle', trans('Update Credit'))
@section('pageSubTitle', trans('Update'))

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post"
                                action="{{ route(currentUser() . '.credits.update', encryptor('encrypt', $credit->id)) }}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{ encryptor('encrypt', $credit->id) }}">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="Select Type">{{ __('Select Type') }}<span
                                                    class="text-danger">*</span></label>
<select class="form-control form-select" name="status" id="">
    <option value="">Select Type</option>
    <option value="Cash" {{ $credit->status == 'Cash' ? 'selected' : '' }}>Cash</option>
    <option value="Company" {{ $credit->status == 'Company' ? 'selected' : '' }}>Company</option>
    <option value="Visa" {{ $credit->status == 'Visa' ? 'selected' : '' }}>Visa</option>
    <option value="Credit" {{ $credit->status == 'Credit' ? 'selected' : '' }}>Credit</option>
    <option value="NetSell" {{ $credit->status == 'NetSell' ? 'selected' : '' }}>Net.Sell</option>
    <option value="Extra" {{ $credit->status == 'Extra' ? 'selected' : '' }}>Extra</option>
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
                                                value="{{ old('amount', $credit->amount) }}" name="amount">
                                        </div>
                                        @if ($errors->has('amount'))
                                            <span class="text-danger"> {{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="remarks">{{ __('Remarks') }}</label>
                                            <textarea class="form-control" id="remarks" placeholder="Remarks" name="remarks">{{ old('remarks', $credit->remarks) }}</textarea>
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
