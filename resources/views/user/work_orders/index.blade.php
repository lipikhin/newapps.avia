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
                       class="table table-bordered">
                    <thead>
                    <tr>
                        <th data-field="number" data-visible="true"
                            data-priority="1" class="text-center">
                            {{__('Number')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="2" class="text-center">
                            {{__('Description')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="3" class="text-center">
                            {{__('Part Number')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="4" class="text-center">
                            {{__('Serial Number')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="5" class="text-center">
                            {{__('Customer')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="6" class="text-center">
                            {{__('Instruction')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="7" class="text-center">
                            {{__('Open')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="8" class="text-center">
                            {{__('Technician')}} </th>
                        <th data-field="number" data-visible="true"
                            data-priority="9" class="text-center">
                            {{__('Approved')}} </th>
                        <th data-field="action" data-visible="true"
                            data-priority="10" class="text-center">
                            {{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wos as $wo)
                        <tr>
                            <td class="test-center">{{$wo->number_wo}}</td>
                            <td class="test-center">{{$wo->unit->manuals->title}}</td>
                            <td class="test-center">{{$wo->unit->part_number}}</td>
                            <td class="test-center">{{$wo->serial_number}}</td>
                            <td class="test-center">{{$wo->customer->name}}</td>
                            <td class="test-center">{{$wo->instruction->name}}</td>
                            <td class="test-center">{{$wo->open_at}}</td>
                            <td class="test-center">{{$wo->user->name}}</td>
                            <td class="test-center">{{$wo->approve}}</td>
                            <td class="text-center">
                                <a href="{{ route('user.work_orders.edit', $wo->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                    {{--                                    {{__('Edit')}}--}}
                                </a>
                                <form action="{{ route('user.work_orders.destroy', $wo->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?');">
                                        {{--                                        {{__('Delete')}}--}}
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
