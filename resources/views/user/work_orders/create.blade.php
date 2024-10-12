@extends('layouts.main_dlb')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{__('New Work Order')}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.work_orders.store')}}"
                      enctype="multipart/form-data"
                      id="createWOForm">
                    @csrf
                    <div class="form-group d-flex">

                        <div class="mt-2 border p-2">
                            <label for="wo_number">{{'Work Order Number'}}</label>
                            <input type="text" id="wo_number" class="form-control" name="number" required>
                            @error('number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="unitDataList" class="form-label">{{__('Description')}}</label>

                            <input type="text" list="datalistOptions" class="form-control" id="unitDataList"
                                   placeholder="Unit description ...">
                            <datalist id="dataListOptions">
                                @foreach($units as $unit)
                                    <option value="{{$unit->manuals->title}}"></option>
                                @endforeach
                            </datalist>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
