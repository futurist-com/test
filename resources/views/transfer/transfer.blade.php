@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Личный кабинет</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Перевод средств!
                    <bill-component></bill-component>
                    <div class="row">
                        <div class="col-md-5">
                        <formtransfer-component></formtransfer-component>
                        </div>
                        <div class="col-md-7">
                        <gettransfer-component></gettransfer-component>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
