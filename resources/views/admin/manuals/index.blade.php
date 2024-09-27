@extends('layouts.base')

@section('content')
    <style>
        @media (max-width: 1100px) {
            .table th:nth-child(5),
            .table td:nth-child(5) {
                display: none;
            }
        }
        @media (max-width: 770px) {
            .table th:nth-child(3),
            .table td:nth-child(3),/* Revision Date */
            .table th:nth-child(5),
            .table td:nth-child(5),/* Revision Date */
            .table th:nth-child(6),
            .table td:nth-child(6)  {
                display: none;
            }
        }
        @media (max-width: 490px) {
            .table th:nth-child(3), /* Image */
            .table td:nth-child(3),

            .table th:nth-child(4), /* Revision Date */
            .table td:nth-child(4),
            .table th:nth-child(5), /* Revision Date */
            .table td:nth-child(5),
            .table th:nth-child(6),
            .table td:nth-child(6) {
                display: none;
            }
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">


    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>{{__('Manage CMMs')}}</h3>
                    <a href="{{ route('admin.cmms.create') }}" class="btn
                    btn-primary mb-3">{{ __('Add CMM') }}</a>
                </div>
            </div>
            <div class="card-body">
                <table id="cmmTable"
                    data-toggle="table"
                    data-search="true"
                    data-pagination="false"
                    data-page-size="5"
                    class="table table-bordered">
                    <thead>
                    <tr>
                        <th data-field="number" data-visible="true"
                            data-priority="1" class="text-center">{{__
                            ('Number')}} </th>
                        <th data-field="title" data-visible="true" data-priority="2" class="text-center">{{__
                        ('Title')}}</th>
                        <th data-field="units_pn" data-visible="true" data-priority="3" class="text-center">{{__
                        ('Units PN')}}</th>
                        <th data-field="img" data-visible="true" data-priority="4" class="text-center">{{__
                        ('Unit Image')}}</th>

                        <th data-field="revision_date" data-visible="true" data-priority="5"
                            class="text-center">{{__('Revision Date')}}</th>
                        <th data-field="lib" data-visible="true" data-priority="6"
                            class="text-center">{{__('Library')}}</th>

                        <th data-field="action" data-visible="true" data-priority="7" class="text-center">{{__
                        ('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cmms as $cmm)
                        <tr>
                            <td class="text-center">{{$cmm->number}} </td>
                            <td class="text-center">{{$cmm->title}}</td>
                            <td class="text-center">{{$cmm->units_pn}}</td>

                            <td class="text-center">
                                <img src="{{ asset('storage/image/cmm/' . $cmm->img) }}" style="width: 36px"
                                     alt="Image" data-bs-toggle="modal" data-bs-target="#imageModal"
                                     data-image-url="{{ asset('storage/image/cmm/' . $cmm->img) }}"
                                     data-title="{{ $cmm->title }}">
                            </td>
                            <td class="text-center">{{$cmm->revision_date}}</td>
                            <td class="text-center">{{$cmm->lib}}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.cmms.edit', $cmm->id) }}" class="btn btn-primary btn-sm">{{__('Edit')}}</a>
                                <form action="{{ route('admin.cmms.destroy', $cmm->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">{{__('Delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="mobile-message" style="display: none; text-align: center;">
            <p>Only desktop version available.</p>
        </div>

        <!-- Image Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" alt="Image" style="max-width: 100%; max-height: 80vh;">
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{--        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>--}}
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>



@endsection
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const imageModal = document.getElementById('imageModal');
                    const modalImage = document.getElementById('modalImage');
                    const modalTitle = document.getElementById('imageModalLabel');

                    imageModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget; // Button that triggered the modal
                        const imageUrl = button.getAttribute('data-image-url'); // Extract image URL from data-* attributes
                        const title = button.getAttribute('data-title'); // Extract title from data-* attributes

                        modalImage.src = imageUrl; // Update the modal's image
                        modalTitle.textContent = title; // Update the modal's title
                    });

                    imageModal.addEventListener('hidden.bs.modal', function () {
                        modalImage.src = ''; // Clear the image when the modal is closed
                    });
                });

                // Проверка ширины экрана и управление отображением таблицы и сообщения
                function checkScreenWidth() {
                    const screenWidth = window.innerWidth;
                    const table = document.querySelector('.table');
                    const mobileMessage = document.getElementById('mobile-message'); // Если хотите использовать это сообщение, добавьте его в HTML.

                    if (screenWidth < 312) {
                        table.style.display = 'none';
                        if (mobileMessage) mobileMessage.style.display = 'block';
                    } else {
                        table.style.display = 'table';
                        if (mobileMessage) mobileMessage.style.display = 'none';
                    }
                }

                window.onload = checkScreenWidth;
                window.onresize = checkScreenWidth;
            </script>
        @endpush
