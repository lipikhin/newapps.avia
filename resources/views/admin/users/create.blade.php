@extends('layouts.app_old')

@section('content')
    <style>
        .container {
            max-width: 450px;
        }
        .push-top {
            margin-top: 50px;
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Create User') }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}"
                      enctype="multipart/form-data" id="createUsersForm">
                    @csrf

                    <!-- Поле для имени -->
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                    </div>

                    <!-- Поле для email -->
                    <div class="form-group mt-2">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" id="email" class="form-control" name="email" required>
                    </div>

                    <!-- Поле для временного пароля -->
                    <div class="form-group mt-2">
                        <label for="password">{{ __('Temporary Password') }}</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>

                    <!-- Поле для аватара -->
                    <div class="form-group mt-2">
                        <label for="avatar">{{ __('Avatar') }}</label>
                        <input type="file" name="avatar" class="form-control" placeholder=" Avatar">
                    </div>

                    <!-- Поле для роли -->
                    <div class="form-group mt-2">
                        <label for="roles_id">{{ __('Role') }}</label>
                        <select id="roles_id" name="roles_id" class="form-control" required>
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            {{ __('Add Role') }}
                        </button>
                    </div>

                    <!-- Поле для команды -->
                    <div class="form-group mt-2">
                        <label for="teams_id">{{ __('Team') }}</label>
                        <select id="teams_id" name="teams_id" class="form-control" required>
                            <option value="">{{ __('Select Team') }}</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#addTeamModal">
                            {{ __('Add Team') }}
                        </button>
                    </div>

                    <!-- Остальные поля -->
                    <div class="mt-2">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input id="phone" type="text" class="form-control" name="phone" >
                    </div>

                    <div class="mt-2">
                        <label for="stamp">{{ __('Stamp') }}</label>
                        <input id="stamp" type="text" class="form-control" name="stamp" >
                    </div>

                    <!-- Кнопка для создания пользователя -->
                    <button type="submit" class="btn btn-primary mt-3">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Модальное окно для добавления роли -->
    <div class="modal fade" id="addRoleModal" tabindex="-1"  aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">{{ __('Add
                     Role') }}</h5>
                    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                </div>
                <form  method="POST" id="addRoleForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="roleName">{{ __('Role Name')
                                }}</label>
                            <input type="text" class="form-control"
                                   id="roleName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{--                            <button type="button" class="btn-close" data-bs-dismiss="modal">{{ __('Close') }}</button>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Save Role') }}</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Модальное окно для добавления команды -->
    <div class="modal fade" id="addTeamModal" tabindex="-1"  aria-labelledby="addTeamLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeamModalLabel">{{ __('Add Team') }}</h5>
                    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}

                </div>
                <form method="POST" id="addTeamForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="teamName">{{ __('Team Name') }}</label>
                            <input type="text" class="form-control"
                                   id="teamName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Save Team') }}</button>
                    </div>
            </div>
            </form>
        </div>
    </div>


    <script>
        function handleFormSubmission(formId, modalId, route, selectId,
                                      dataKey,
                                      dataValue) {
            document.getElementById(formId).addEventListener('submit', function (event) {
                event.preventDefault(); // Предотвращаем стандартную отправку формы
                if (this.submitted) {
                    return;
                }
                let formData = new FormData(this);
                fetch(route, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        // 1. Добавляем новую опцию в select
                        let select = document.getElementById(selectId);
                        let option = document.createElement('option');
                        option.value = data[dataKey]; // ID новой роли
                        option.text = data[dataValue]; // Имя новой роли
                        select.add(option);

                        // 2. Закрываем модальное окно вручную
                        let modalElement = document.getElementById(modalId);

                        if (modalElement) {
                            let modal = bootstrap.Modal.getInstance(modalElement);
                            if (modal) {
                                modal.hide();
                            } else {
                                // Если нет экземпляра, создайте новый и закройте его
                                let newModal = new bootstrap.Modal(modalElement);
                                newModal.hide();
                            }
                        }
                        // 3. Очистка формы
                        // document.getElementById(formId).reset();
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                        alert('Произошла ошибка при добавлении.');
                    });
            });
        }

        // Пример использования для ролей
        handleFormSubmission('addRoleForm', 'addRoleModal','{{ route('admin.roles.store')
        }}', 'roles_id', 'id', 'name');

        // Пример использования для команд
        handleFormSubmission('addTeamForm', 'addTeamModal','{{ route('admin.teams.store')
        }}', 'teams_id', 'id', 'name');
    </script>


@endsection


