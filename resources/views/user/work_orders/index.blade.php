@extends('layouts.main_dlb')

@section('content')


    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>{{__('Work Orders')}}</h3>
                    <a href="{{ route('user.work_orders.create') }}"
                       class="btn
                    btn-primary mb-3">{{ __('Add WorkOrder') }}</a>
                </div>
            </div>
            <div class="card-body">
                <table id="woTable"
                       data-toggle="table"
                       data-search="true"
                       data-pagination="false"
                       data-show-columns="false"
                       data-show-export="false"
                       data-show-refresh="true"
                       data-filter-control="true"
                       data-filter-show-clear="true"
                       class="table table-bordered">
                    <thead>
                    <tr>
                        <th data-field="number_wo" data-visible="true" data-priority="1" class="text-center align-middle">
                            {{__('Number')}}
                        </th>
                        <th data-field="unit_id" data-visible="true"
                            data-priority="2" class="text-center align-middle">
                            {{__('Description')}}
                        </th>
                        <th data-field="unit_id" data-visible="true"
                            data-priority="3" class="text-center align-middle">
                            {{__('Part Number')}}
                        </th>
                        <th data-field="serial_number" data-visible="true" data-priority="4" class="text-center align-middle">
                            {{__('Serial Number')}}
                        </th>
                        <th data-field="customer_id" data-visible="true"
                            data-priority="5" class="text-center align-middle">
                            {{__('Customer')}}
                        </th>
                        <th data-field="instruction_id" data-visible="true"
                            data-priority="6" class="text-center align-middle">
                            {{__('Instruction')}}
                        </th>
                        <th data-field="open_at" data-visible="true" data-priority="7" class="text-center align-middle">
                            {{__('Open')}}
                        </th>
                        <th data-field="technician_id" data-visible="true"
                            data-priority="8" class="text-center align-middle">
                            {{__('Technician')}}
                        </th>
                        <th data-field="approve" data-visible="true" data-priority="9" class="text-center align-middle">
                            {{__('Approved')}}
                        </th>
                        <th data-field="action" data-visible="true" data-priority="10" class="text-center align-middle">
                            {{__('Action')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wos as $wo)
                        <tr>
                            <td class="text-center align-middle" style="font-size: 12px"> {{$wo->number_wo}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->unit->manuals->title}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->unit->part_number}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->serial_number}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->customer->name}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->instruction->name}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->open_at}}</td>
                            <td class="text-center align-middle" style="font-size: 12px">{{$wo->user->name}}</td>
                            <td class="text-center align-middle" style="font-size: 16px">
                                @if($wo->approve === true)
                                    <i class="bi bi-check2 success"></i>
                                @else
                                    <i class="bi bi-x"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.work_orders.edit', $wo->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('user.work_orders.destroy', $wo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
