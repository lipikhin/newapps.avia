@extends('layouts.main_dlb')

@section('content')

    <div class="container">
        <div class="card shadow">

            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div style="width: 450px">
                        <h3>{{__('Manage Units')}}</h3>
                    </div>
                    <!-- Кнопка Добавить юнит -->
                    <button class="btn btn-primary mb-1"
                            data-bs-toggle="modal"
                            data-bs-target="#addUnitModal">{{__('Add Unit')
                            }}</button>
                </div>
            </div>
            <div class="card-body">
                @if($groupedUnits->isEmpty())
                    <div class="alert alert-info text-center">
                        {{ __('No units available.') }}
                    </div>
                @else
                <table id="cmmTable" data-toggle="table"
                       data-search="true"
                       data-pagination="false"
                       data-page-size="5"
                       class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th data-field="#" data-visible="true" data-priority="1"
                            class="text-center">{{__('#')}}</th>
                        <th data-field="part_title" data-visible="true"
                            data-priority="2" class="text-center">{{__('Unit
                            Description')
                            }}</th>
                        <th data-field="part_number" data-visible="true"
                            data-priority="2" class="text-center">{{__('Unit
                            PN')
                            }}</th>
                        <th data-field="number" data-visible="true"
                            data-priority="3" class="text-center">{{__('CMM
                            Unit')}}</th>
                        <th data-field="img" data-visible="true"
                            data-priority="4" class="text-center">{{__('Image')
                            }}</th>
                        <th data-field="action" data-visible="true" data-priority="5"
                            class="text-center">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $pp = 1; @endphp
                    @foreach($groupedUnits as $manualNumber => $units)
                        <tr>
                            <td class="text-center">{{ $pp++ }}</td>

                            <td class="text-center">
                                @if ($units->isNotEmpty() && $units->first()->manuals)

                                    {{ $units->first()->manuals->title }}
                                @else
                                    <span>No data on CMM</span>
                                @endif
                            </td>
                            <td>
                                <select class="form-select">
                                    @foreach($units as $unit)
                                        <!-- Проверяем наличие manuals -->
                                        @if ($unit->manuals)
                                            <!-- Проверяем verified и добавляем класс text-danger для красного текста -->
                                            <option value="{{ $unit->part_number }}" @if(!$unit->verified) class="text-danger" @endif>
                                                {{ $unit->part_number }}
                                            </option>
                                        @else
                                            <option value="" disabled>No data on CMM</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>

                            {{--                            <td>--}}
{{--                                <select class="forms-select">--}}
{{--                                    @foreach($units as $unit)--}}
{{--                                        <!-- Итерируем по $units, а не $groupedUnits -->--}}
{{--                                        @if ($unit->manuals)--}}
{{--                                            <option value="{{ $unit->part_number }}">{{ $unit->part_number }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="" disabled>No data--}}
{{--                                                on CMM</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </td>--}}

                            <td class="text-center">
                                @if ($units->isNotEmpty() && $units->first()->manuals)
                                    <a href="#"
{{--                                       class="view-cmm-btn" --}}
{{--                                       data-cmm-id="{{ $units->first()->manuals->id }}">--}}
                                        data-bs-toggle="modal"
                                       data-bs-target="#cmmModal{{
                                       $units->first()->manuals->id }}">
                                        {{ $manualNumber }}
                                    </a>
                                @else
                                    <span>No data on CMM</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($units->isNotEmpty() && $units->first()->manuals)
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#imageModal{{ $units->first()->manuals->id }}">
                                        <img src="{{ asset('storage/image/cmm/' . $units->first()->manuals->img) }}"
                                             style="max-width: 50px;
                                             border:1px" alt="Image">
                                    </a>
                                @else
                                    <img src="{{ asset
                                    ('storage/image/No_image.svg') }}"
                                         style="max-width: 50px; border:1px"
                                         alt="Image">
                                @endif
                            </td>

                            <td class="text-center">
                                @foreach($units as $unit)
                                    @php
                                        $partNumbers = is_array($unit->part_numbers) ? $unit->part_numbers : explode(',', $unit->part_numbers);
                                    @endphp
                                @endforeach
                                <div class="d-inline-block mb-2">

                                    <button class="edit-unit-btn btn btn-primary btn-sm"
                                            data-id="{{ $unit->id }}"
                                            data-manuals-id="{{ $unit->manuals_id }}"
                                            data-manual="{{ $unit->manuals->title }}"
                                            data-manual-number="{{ $unit->manuals->number }}"
                                            data-manual-image="{{
                                           $units->first()->manuals->img}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUnitModal">

                                        <i class="bi bi-pencil-square"></i>
                                    </button>
{{--                                    <button id="testButton" class="edit-unit-btn btn btn-primary btn-sm">--}}
{{--                                        <i class="bi bi-pencil"></i>--}}
{{--                                    </button>--}}

                                    <form action="{{ route('admin.units.destroy', $manualNumber) }}" method="post"
                                          style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Are you sure you want to delete all units in this group?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                                <br>

                            </td>
                        </tr>

                        @if ($units->first()->manuals && $units->first()->manuals->img)
                            <!-- Модальное окно для показа большого изображения -->
                            <div class="modal fade" id="imageModal{{ $units->first()->manuals->id }}" tabindex="-1"
                                 role="dialog" aria-labelledby="imageModalLabel{{ $units->first()->manuals->id }}"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="imageModalLabel{{ $units->first()->manuals->id }}">{{ $units->first()->manuals->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/image/cmm/' . $units->first()->manuals->img) }}"
                                                 style="max-width: 100%; max-height: 100%;"
                                                 alt="{{ $units->first()->manuals->title }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--    <!-- Модальное окно для просмотра деталей CMM -->--}}

                            <div class="modal fade" id="cmmModal{{
                            $units->first()->manuals->id }}" tabindex="-1"
                                 role="dialog" aria-labelledby="cmmModalLabel{{
                                  $units->first()->manuals->id }}"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <div>
                                            <h5 class="modal-title"
                                                id="imageModalLabel{{ $units->first()->manuals->id }}">
                                                {{ $units->first()->manuals->title }}{{__(': ')}}
                                            </h5 >
                                            <h6>{{ $units->first()->manuals->units_pn }}</h6>
                                        </div>
                                            <button type="button"
                                                    class="btn-close pb-2"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <img src="{{ asset('storage/image/cmm/' . $units->first()->manuals->img) }}"
                                                         style="max-width: 200px;"
                                                         alt="{{ $units->first()->manuals->title }}">
                                                </div>
                                                <div>
                                                    <p><strong>{{ __('CMM:') }}</strong> {{ $units->first()->manuals->number }}</p>
                                                    <p><strong>{{ __('Description:') }}</strong>
                                                        {{ $units->first()->manuals->title }}</p>
                                                    <p><strong>{{ __('Revision Date:')}}</strong> {{ $units->first()->manuals->revision_date }}</p>
                                                    <p><strong>{{ __('AirCraft Type:')}}</strong>
                                                        {{ $planes[$units->first()->manuals->planes_id] ?? 'N/A' }}</p>
                                                    <p><strong>{{ __('MFR:') }}</strong> {{$builders[$units->first()->manuals->builders_id] ?? 'N/A' }}</p>
                                                    <p><strong>{{ __('Scope:') }}</strong> {{$scopes[$units->first()->manuals->scopes_id] ?? 'N/A' }}</p>
                                                    <p><strong>{{ __('Library:') }}</strong> {{$units->first()->manuals->lib }}</p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endif
                    @endforeach

                    </tbody>
                </table>
                @endif
            </div>
        </div>

    </div>


    <!-- Модальное окно add Unit -->
    <div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUnitLabel">Add Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <!-- Выпадающий список для выбора CMM -->
                    <div class="mb-3">
                        <label for="cmmSelect" class="form-label">Select CMM</label>
                        <select class="form-select" id="cmmSelect">
{{--                            @foreach($restManuals as $restManual)--}}
{{--                                <option value="{{ $restManual->id }}">{{ $restManual->title }}--}}
{{--                                    ({{ $restManual->number }})--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
                            @foreach($manuals as $manual)
                                <option value="{{ $manual->id }}">{{ $manual->title }}
                                    ({{ $manual->number }})
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Поле для ввода PN -->
                    <div id="pnInputs">
                        <div class="input-group mb-2 pn-field">
                            <input type="text" class="form-control"
                                   placeholder="Enter PN" style="width: 200px;"
                                   name="pn[]">
                            <button class="btn btn-secondary" type="button"
                                    id="addPnField">Add PN
                            </button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close
                    </button>
                    <button type="button" id="createUnitBtn" class="btn
                    btn-primary"> Add Unit
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- Модальное окно Edit Unit -->
    <div class="modal fade" id="editUnitModal" tabindex="-1" role="dialog" aria-labelledby="editUnitModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="editUnitModalLabel"></h5>
                    <button type="button" class="btn btn-primary" id="addUnitButton">
                        {{ __('Add PN') }}
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="modal-body text-center">
                                <img id="cmmImage" src="" style="max-width: 150px;" alt="Image CMM">
                            </div>
                        </div>
                        <div class="col">
                            @if(isset($units) && $units->isNotEmpty())
                                <p id="editUnitModalNumber"></p>
                                <div id="partNumbersList">
                                    @foreach($units as $unit)
                                        <div class="d-flex align-items-center mb-2">
                                            <!-- Проверяем verified и устанавливаем стиль для текста -->
                                            <span class="@if(!$unit->verified) text-danger @endif">
                                            {{ $unit->part_number }}
                                        </span>

                                            <!-- Кнопка для изменения статуса verified -->
                                            <button type="button" class="btn btn-sm btn-link ms-2 changeVerifiedButton"
                                                    data-unit-id="{{ $unit->id }}" data-verified="{{ $unit->verified }}">
                                                @if($unit->verified)
                                                    Mark as Unverified
                                                @else
                                                    Verify
                                                @endif
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No part numbers found for this manual.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateUnitButton">Update</button>
                </div>
            </div>
        </div>
    </div>



   с
@endsection
