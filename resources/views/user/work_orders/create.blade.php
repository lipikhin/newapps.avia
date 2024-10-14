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
                            <label  for="wo_number">{{'Work Order Number'}}</label>
                            <input  id="wo_number" class="form-control" style="width: 250px"
                                    name="number" min="100000"
                                    oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
                                    type = "number"
                                    data-maxlength="6">
                            @error('number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="unitDataList" class="form-label">{{__('Unit Part Number')}}</label>
                            <input type="text" list="dataListOptions" class="form-control" id="unitDataList"
                                   placeholder="Unit Part Number ..." style="width: 250px" name="unit_id">
                            <datalist id="dataListOptions">
                                @foreach($units as $unit)
                                    <option value="{{$unit->part_number}}">
                                @endforeach
                            </datalist>
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
                            <label for="instruction_id">{{__('Instruction')}}</label>
                            <select id="instruction_id" name="instruction_id" class="form-control"  style="width:
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
                            <label for="customer_id">{{__('Customer')}}</label>
                            <select id="customer_id" name="customer_id" class="form-control"  style="width:
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
                            <label for="user_id">{{__('Technician')}}</label>
                            <select id="user_id" name="customer_id" class="form-control"  style="width:
                            250px" required>
                                <option value="">{{ __('Select Technician')
                                }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#adduserModal">{{ __('Add Technician') }}</button>
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
