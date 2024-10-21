@extends('layouts.main_dlb')

@section('content')
    <div class="container" style="width: 650px">
        <div class="card">
            <div class="card-header">
                {{ __('Edit Work Order') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.work_orders.update', $wo->id) }}"
                      enctype="multipart/form-data"
                      id="editWOForm">
                    @csrf
                    @method('PUT') <!-- Добавляем метод PUT -->
                    <div class="m-auto" style="width: 650px">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label id="number_wo_label" for="number_wo">{{ 'Work Order Number' }}</label>
                                    <input id="number_wo" class="form-control" style="width: 250px"
                                           name="number_wo" min="100000"
                                           value="{{ $wo->number_wo }}"
                                           type="number" data-maxlength="6" readonly> <!-- Поле только для чтения -->
                                </div>
                                <div class="form-group mb-2">
                                    <label for="open_at">{{ 'Open' }}</label>
                                    <input id="open_at" type="date" class="form-control" name="open_at"
                                           value="{{ $wo->open_at }}"
                                           style="width: 250px" readonly> <!-- Поле только для чтения -->
                                </div>
                                <div class="form-group">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="unit_id" class="form-label">{{ __('Unit PN') }}</label>
                                            <select id="unit_id" name="unit_id"
                                                    class="form-select" style="width: 160px" required>
                                                <option value="">{{ __('Select unit') }}</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                        {{ $unit->id == $wo->unit_id ? 'selected' : '' }}>
                                                        {{ $unit->part_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="amdt" class="mb-2">{{ 'Amdt' }}</label>
                                            <input id="amdt" class="form-control"
                                                   style="width: 70px; height: 30px"
                                                   name="amdt"
                                                   type="text" value="{{ $wo->amdt }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="serial_number">{{ 'Serial Number' }}</label>
                                    <input id="serial_number" class="form-control" style="width: 250px"
                                           name="serial_number" type="text"
                                           value="{{ $wo->serial_number }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label for="instruction_id">{{ __('Instruction') }}</label>
                                    <select id="instruction_id" name="instruction_id" class="form-control" style="width: 250px" required>
                                        <option value="">{{ __('Select Instruction') }}</option>
                                        @foreach ($instructions as $instruction)
                                            <option value="{{ $instruction->id }}"
                                                {{ $instruction->id == $wo->instruction_id ? 'selected' : '' }}>
                                                {{ $instruction->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                            data-bs-target="#addInstructionModal">{{ __('Add Instruction') }}</button>
                                </div>
                                <div class="form-group">
                                    <label for="customer_id">{{ __('Customer') }}</label>
                                    <select id="customer_id" name="customer_id" class="form-control" style="width: 250px" required>
                                        <option value="">{{ __('Select Customer') }}</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $wo->customer_id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                            data-bs-target="#addCustomerModal">{{ __('Add Customer') }}</button>
                                </div>
                                <div class="form-group">
                                    <label for="user_id">{{ __('Technician') }}</label>
                                    <select id="user_id" name="user_id" class="form-control" style="width: 250px" required>
                                        <option value="">{{ __('Select Technician') }}</option>
                                        @foreach ($users as $user)
                                            @if($user->role->name !== 'Shop Certifying Authority (SCA)')
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $wo->user_id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">{{ __('Note') }}</label>
                            <textarea class="form-control" id="note" rows="3" name="notes" style="width: 580px">{{ $wo->notes }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('Update Work Order') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#unit_id, #user_id, #customer_id').select2({
                width: 'resolve'
            });
        });


    </script>
@endsection
