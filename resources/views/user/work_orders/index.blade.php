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
                            <td class="test-center">{{$wo->number}}</td>
                            <td
                                class="test-center">{{$wo->units->manuals->title}}</td>
                            <td class="test-center">{{$wo->number}}</td>
                            <td class="test-center">{{$wo->number}}</td>
                            <td class="test-center">{{$wo->number}}</td>
                            <td class="test-center">{{$wo->number}}</td>
                            <td class="test-center">{{$wo->number}}</td>
                            <td class="test-center">{{$wo->number}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
