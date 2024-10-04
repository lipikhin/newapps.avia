@extends('layouts.main_dlb')

@section('content')
    <style>
        .custom-sort-icon {
            position: relative;
            padding-right: 20px;
        }

        /*!* Добавляем иконку сортировки *!*/
        /*.custom-sort-icon:after {*/
        /*    content: '⇅'; !* можно изменить на любую другую иконку *!*/
        /*    position: absolute;*/
        /*    right: 5px;*/
        /*}*/
    </style>

    <div class="container" style="max-width: 550px;">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>{{__('Customers')}}</h3>
                    <a href="{{route('admin.customers.create')}}" class="btn btn-primary">{{__('New Customer')}}</a>
                </div>
            </div>

            <div class="card-body">
                <table id="customersTable"
                       data-toggle="table"
                       data-search="true"
                       data-pagination="true"
                       data-page-size="10"
                       data-page-list="[5, 10, 25, 50]"
                       data-pagination-parts='["pageList", "pageSize", "pageInfo"]'

                       data-search-highlight="true"
                       data-sortable="true"
                       class="table table-bordered">
                    <thead>
                    <tr>
                        <th data-field="name" data-align="center" data-sortable="true"
                            class="text-center custom-sort-icon">{{__('Name')}}</th>
                        <th data-field="action" data-align="center" class="text-center">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($custs as $cust)
                        <tr>
                            <td>{{$cust->name}}</td>
                            <td>
                                <a href="{{ route('admin.customers.edit', $cust->id) }}" class="btn btn-primary btn-sm">
{{--                                    {{__('Edit')}}--}}
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.customers.destroy', $cust->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?');">
                                        <i class="bi bi-trash"></i>
{{--                                        {{__('Delete')}}--}}
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
