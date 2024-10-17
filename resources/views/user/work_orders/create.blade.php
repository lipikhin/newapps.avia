@extends('layouts.main_dlb')

@section('content')
    <div class="container" style="width: 350px">
        <div class="card">
            <div class="card-header">
                {{__('New Work Order')}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.work_orders.store')}}"
                      enctype="multipart/form-data"
                      id="createWOForm">
                    @csrf
                    <div class="m-auto " style="width: 350px"  >
                        <div class="form-group mb-2">
                            <label  for="number_wo">{{'Work Order Number'}}</label>
                            <input  id="number_wo" class="form-control" style="width: 250px"
                                    name="number_wo"
{{--                                    oninput="this.value=this.value.slice(0,this.dataset.maxlength)"--}}
                                    type = "number"
{{--                                    data-maxlength="6"--}}
                            >
                            @error('number_wo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label  for="open_at">{{'Open'}}</label>
                            <input id='open_at' type="date" class="form-control" name="open_at"
                                   style="width: 250px" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="units_id">{{__('unit')}}</label>
                            <select id="units_id" name="units_id" class="form-control"  style="width:
                            250px" required>
                                <option value="">{{ __('Select unit')
                                }}</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->part_number }}</option>
                                @endforeach
                            </select>


{{--                            <label for="unitDataList" class="form-label">{{__('Unit Part Number')}}</label>--}}
{{--                            <input type="text" list="dataListOptions" class="form-control" id="unitDataList"--}}
{{--                                   placeholder="Unit Part Number ..." style="width: 250px" name="unit_id">--}}
{{--                            <datalist id="dataListOptions">--}}
{{--                                @foreach($units as $unit)--}}
{{--                                    <option value="{{$unit->part_number}}">--}}
{{--                                @endforeach--}}
{{--                            </datalist>--}}

                        </div>
                        <div class="form-group mb-2">
                            <label  for="serial_number">{{'Serial Number'}}</label>
                            <input  id="serial_number" class="form-control" style="width: 250px"
                                    name="serial_number"
                                    type = "text">
                            @error('number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="instructions_id">{{__('Instruction')}}</label>
                            <select id="instructions_id" name="instructions_id" class="form-control"  style="width:
                            250px" required>
                                <option value="">{{ __('Select Instruction')
                                }}</option>
                                @foreach ($instructions as $instruction)
                                    <option value="{{ $instruction->id }}">{{ $instruction->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#addInstructionModal">{{ __('Add Instruction') }}</button>
                        </div>
                        <div class="form-group">
                            <label for="customers_id">{{__('Customer')}}</label>
                            <select id="customers_id" name="customers_id" class="form-control"  style="width:
                            250px" required>
                                <option value="">{{ __('Select Customer')
                                }}</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#addCustomerModal">{{ __('Add Customer') }}</button>
                        </div>
                        <div class="form-group">
                            <label for="users_id">{{__('Technician')}} </label>
                            <select id="users_id" name="users_id" class="form-control"  style="width:
                            250px" required>
                                <option value="">{{ __('Select Technician')}}</option>
                                @foreach ($users as $user)
{{--                                    @if($user->role->name !== 'Shop Certifying Authority (SCA)' )--}}
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
{{--                                    @endif--}}
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="note">{{__('Note')}} </label>
                            <textarea class="form-control" id="note" rows="3" name="notes" style="width:
                            250px" ></textarea>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('Add Work Order') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>

        function isNumericKey(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
                && (charCode < 48 || charCode > 57))
                return true;
            return false;
        }

    </script>


@endsection
