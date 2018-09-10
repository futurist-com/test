@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <formtransfer-component></formtransfer-component>
                    <gettransfer-component></gettransfer-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
