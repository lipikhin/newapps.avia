@extends('layouts.app_old')

@section('content')
    <style>
        /* Скрываем колонки Phone и Stamp при ширине экрана < 1100px */
        @media (max-width: 1100px) {
            .table th:nth-child(7),
            .table td:nth-child(7), /* Phone */
            .table th:nth-child(8),
            .table td:nth-child(8)  /* Stamp */ {
                display: none;
            }
        }

        /* Скрываем Email, Admin, Role, Team, Phone, Stamp при ширине экрана < 770px */
        @media (max-width: 770px) {
            .table th:nth-child(3),
            .table td:nth-child(3), /* Email */
            .table th:nth-child(4),
            .table td:nth-child(4), /* Admin */
            .table th:nth-child(5),
            .table td:nth-child(5), /* Role */
            .table th:nth-child(6),
            .table td:nth-child(6), /* Team */
            .table th:nth-child(7),
            .table td:nth-child(7), /* Phone */
            .table th:nth-child(8),
            .table td:nth-child(8)  /* Stamp */ {
                display: none;
            }
        }

        /* Скрываем колонку Avatar при ширине экрана < 412px */
        @media (max-width: 412px) {
            .table th:nth-child(1),
            .table td:nth-child(1)  /* Avatar */ {
                display: none;
            }

            /* Скрываем таблицу и отображаем сообщение о доступности только для десктопов */
            .table {
                display: none;
            }
            #mobile-message {
                display: block;
            }
        }
    </style>

    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>{{__('Users')}}</h3>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
                        {{ __('Create User') }}
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table
                    data-toggle="table"
                    data-search="true"
                    data-pagination="true"
                    data-page-size="10"
                    class="table table-bordered"
                >
                    <thead>
                    <tr>
                        <th data-field="avatar" data-visible="true" data-priority="1">Аватар</th>
                        <th data-field="name" data-visible="true" data-priority="2">Имя</th>
                        <th data-field="email" data-visible="false" data-priority="4">Email</th>
                        <th data-field="is_admin" data-visible="false" data-priority="5">Admin</th>
                        <th data-field="roles_id" data-visible="false" data-priority="6">Role</th>
                        <th data-field="teams_id" data-visible="false" data-priority="7">Team</th>
                        <th data-field="phone" data-visible="false" data-priority="8">Phone</th>
                        <th data-field="stamp" data-visible="false" data-priority="9">Stamp</th>
                        <th data-field="action" data-visible="true" data-priority="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" style="height: 50px; cursor: pointer;" onclick="openModal('{{ asset('storage/avatars/' . $user->avatar) }}')" />

                            </td>


                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                            <td>{{ $user->role->name ?? 'No Role' }}</td> <!-- Используйте роль -->
                            <td>{{ $user->team->name ?? 'No Team' }}</td> <!-- Используйте команду -->
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->stamp }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div id="mobile-message" style="display: none; text-align: center;">
        <p>Only desktop version available.</p>
    </div>

    <!-- Модальное окно для показа аватара -->
    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="avatarModalImage" src="" alt="Avatar" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function openModal(imageUrl) {
            // Устанавливаем путь к изображению в модальное окно
            document.getElementById('avatarModalImage').src = imageUrl;
            // Открываем модальное окно
            var modal = new bootstrap.Modal(document.getElementById('avatarModal'));
            modal.show();
        }

        // Проверка ширины экрана и управление отображением таблицы и сообщения
        function checkScreenWidth() {
            const screenWidth = window.innerWidth;
            const table = document.querySelector('.table');
            const mobileMessage = document.getElementById('mobile-message');

            if (screenWidth < 412) {
                table.style.display = 'none';
                mobileMessage.style.display = 'block';
            } else {
                table.style.display = 'table';
                mobileMessage.style.display = 'none';
            }
        }

        window.onload = checkScreenWidth;
        window.onresize = checkScreenWidth;
    </script>
@endpush
