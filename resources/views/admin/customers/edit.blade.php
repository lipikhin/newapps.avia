@extends('layouts.main_dlb')

@section('content')

    <div class="container" style="max-width: 450px;">
        <div class="card push-top">
            <div class="card-header">{{ __('Edit Customer') }}</div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif

                <form method="post" action="{{ route('admin.customers.update', $customer->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $customer->name }}"/>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">{{ __('Update Customer') }}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

