@extends('layouts.main_dlb')

@section('content')
    <div class="container" style="width: 650px">
        <div class="card">
            <div class="card-header">
                {{__('New Work Order')}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.work_orders.store')}}"
                      enctype="multipart/form-data"
                      id="createWOForm">
                    @csrf
                    <div class="m-auto " style="width: 650px"  >
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label id="number_wo_label" for="number_wo">{{ 'Work Order Number' }}</label>
                                    <input id="number_wo" class="form-control" style="width: 250px;height: 30px"
                                           name="number_wo" min="100000"
                                           oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
                                           type="number" data-maxlength="6">
                                    <div id="number_wo_error" class="m-1 text-danger" style="font-size: 12px"></div> <!-- Ошибка -->
                                </div>
                                <div class="form-group mb-2">
                                    <label  for="open_at">{{'Open'}}</label>
                                    <input id='open_at' type="date" class="form-control" name="open_at"
                                           style="width: 250px; height: 30px" required>
                                </div>
                                <div class="form-group ">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="">
                                                <label for="unit_id" class="form-label">{{__('Unit PN')}}</label>
                                                <select id="unit_id" name="unit_id"
                                                        class="form-select"
                                                        style="width:160px" required>
                                                    <option value="">{{ __('Select unit')}}</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->part_number }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-primary mt-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addUnitModal">
                                                    {{__('Add Unit')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" ">
                                                <label
                                                    for="amdt" class="mb-2 ">{{'Amdt'}}</label>
                                                <input  id="amdt"
                                                        class="form-control"
                                                        style="width: 70px; height: 30px"
                                                        name="amdt"
                                                        type = "text">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mb-2">
                                    <label  for="serial_number">{{'Serial Number'}}</label>
                                    <input  id="serial_number" class="form-control" style="width: 250px; height: 30px"
                                            name="serial_number"
                                            type = "text">
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group mb-2">
                                    <label for="instruction_id">{{__('Instruction')}}</label>
                                    <select id="instruction_id" name="instruction_id" class="form-control"
                                            style="width:250px; height: 32px" required>
                                        <option value="">{{ __('Select Instruction')
                                }}</option>
                                        @foreach ($instructions as $instruction)
                                            <option value="{{ $instruction->id }}">{{ $instruction->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary mt-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addInstructionModal">
                                        {{ __('Add Instruction') }}
                                    </button>
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
                                    <button type="button" class="btn btn-primary mt-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addCustomerModal">
                                        {{ __('Add Customer') }}
                                    </button>
                                </div>
                                <div class="form-group">
                                    <label for="user_id">{{__('Technician')}} </label>
                                    <select id="user_id" name="user_id" class="form-control"  style="width:
                            250px" required>
                                        <option value="">{{ __('Select Technician')}}</option>
                                        @foreach ($users as $user)
{{--                                            @if($user->role->name !== 'Shop Certifying Authority (SCA)' )--}}
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
{{--                                            @endif--}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="note">{{__('Note')}} </label>
                            <textarea class="form-control" id="note" rows="3" name="notes" style="width:
                            580px" ></textarea>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('Add Work Order') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Instruction Modal -->
    <div class="modal fade" id="addInstructionModal" tabindex="-1" aria-labelledby="addInstructionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInstructionLabel">Add New Instruction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addInstructionForm">
                        <div class="mb-3">
                            <label for="instructionName" class="form-label">Instruction Name</label>
                            <input type="text" class="form-control" id="instructionName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Unit Modal -->
    <div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUnitLabel">Add New Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUnitForm">
                        <div class="mb-3">
                            <label for="unitPartNumber" class="form-label">Unit Part Number</label>
                            <input type="text" class="form-control" id="unitPartNumber" name="part_number" required>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCustomerForm">
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script>





        $(document).ready(function() {
            $('#unit_id, #user_id, #customer_id').select2({
                width: 'resolve' // можно использовать 'resolve' или конкретное значение, например, '150px'
            });
        });


        $(document).ready(function() {
            $('#number_wo').on('input', function() {
                var numberWo = $(this).val();
                var $label = $('#number_wo_label');

                if (numberWo.length === 6) {
                    $.ajax({
                        url: '{{ route('user.work_orders.checkNumber') }}',
                        method: 'POST',
                        data: {
                            number_wo: numberWo,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.exists) {
                                // Показать ошибку в метке и изменить стиль
                                $label.text('Work Order Number is already taken.');
                                $label.addClass('text-danger');
                            } else {
                                // Вернуть исходный текст метки, если нет ошибок
                                $label.text('Work Order Number');
                                $label.removeClass('text-danger');
                            }
                        }
                    });
                } else {
                    // Если количество символов меньше 6, вернуть исходный текст метки
                    $label.text('Work Order Number');
                    $label.removeClass('text-danger');
                }
            });
        });

        document.getElementById('addInstructionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('instructionName').value;

            fetch('user/instructions/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ name: name })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Добавляем новую опцию в выпадающий список
                        const instructionSelect = document.getElementById('instruction');
                        const newOption = new Option(data.instruction.name, data.instruction.id);
                        instructionSelect.add(newOption);
                        // Закрываем модальное окно
                        $('#addInstructionModal').modal('hide');
                    } else {
                        alert('Failed to add instruction');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        {{--handleFormSubmission('addInstructionForm', '{{ route('user.instruction.store') }}', 'instruction_id', 'id', 'name', 'addInstructionModal');--}}



    </script>



@endsection
