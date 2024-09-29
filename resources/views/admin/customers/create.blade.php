@extends('layouts.app_old')

@section('content')


    <style>
        .container {
            max-width: 450px;
        }
        .push-top {
            margin-top: 50px;
        }
    </style>


    <div class='container'>
        <div class="card push-top">
                <div class="row">
                    <div class="col-12 ">
                        <div class='card-header'>

                                {{__('Add Customer')}}

                        </div>

                        <div class='card-body'>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                                <form method="POST" action="{{ route('admin.customers.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" required/>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">{{ __('Create Customer') }}</button>
                                </form>

                        </div>

                    </div>

                </div>

        </div>
    </div>


@endsection
