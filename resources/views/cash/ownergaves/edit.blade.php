@extends('layout.app')

@section('pageTitle', trans('Update Owner Gave'))
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
                                action="{{ route(currentUser() . '.owner_gave.update', encryptor('encrypt', $ownergave->id)) }}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{ encryptor('encrypt', $ownergave->id) }}">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="amount">{{ __('Amount') }}</label>
                                            <input type="number" step="0.0001" class="form-control" placeholder="Amount"
                                                value="{{ old('amount', $ownergave->name) }}" name="amount">
                                        </div>
                                        @if ($errors->has('amount'))
                                            <span class="text-danger"> {{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="remarks">{{ __('Remarks') }}</label>
                                            <textarea class="form-control" id="remarks" placeholder="Remarks" name="remarks">{{ old('remarks', $ownergave->remarks) }}</textarea>
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
