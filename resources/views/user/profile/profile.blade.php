@extends('layouts.main_dlb')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <form id="profile-form" method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Профильная информация -->
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    @if(auth()->user()->avatar)
                                        <img id="avatar-preview"
                                             src="{{ asset
                                             ('/storage/avatars/' . auth()->user()->avatar) }}"
                                             style="width:120px; margin-top: 10px; cursor: pointer;">

                                    @else
                                        <img id="avatar-preview"
                                             src="{{ asset
                                             ('public/image/noimage.png' .
                                             auth()->user()->avatar) }}"
                                             style="width:120px; margin-top: 10px; cursor: pointer;">

                                    @endif
                                        <input id="avatar" type="file" class="d-none @error('avatar') is-invalid @enderror" name="avatar" accept="image/*">
                                        @error('avatar')
                                        <span role="alert" class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name: </label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus="">
                                    @error('name')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email: </label>
                                    <input class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}" autofocus="">
                                    @error('email')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Signature file-->

                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                <div class="form-group">
                                    {{__('Signature:')}}

                                    <input type="file" name="sign"
                                           class="form-control"
                                           placeholder="image">
                                </div>
                                <h6 style="font-size: 0.75rem;">{{__
                                    ('(Image with resolution 200px : 100px)')
                                    }}</h6>
                            </div>

                            <!-- Остальные поля профиля -->
                            <div class="row ">
                                <div class="mb-3 col-md-6 mt-2">
                                    <label for="phone" class="form-label">Phone: </label>
                                    <input class="form-control" type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}" autofocus="">
                                    @error('phone')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6 mt-2">
                                    <label for="stamp" class="form-label">Stamp: </label>
                                    <input class="form-control" type="text" id="stamp" name="stamp" value="{{ auth()->user()->stamp }}" autofocus="">
                                    @error('stamp')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Добавляем кнопку изменения пароля -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        Change Password
                                    </button>
                                </div>
                            </div>

                            <!-- Кнопки обновления профиля -->
                            <div class="row mb-0">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                                    <button type="button" id="cancel-button" class="btn btn-secondary ms-2">
                                        <a href="/home" style="color: white">{{ __('Cancel') }}</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для изменения пароля -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.profile.changePassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password:</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Сохранить начальное состояние формы
        const initialAvatarSrc = document.getElementById('avatar-preview').src; // Исправлено здесь
        const initialFormState = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            stamp: document.getElementById('stamp').value,
        };

        // Нажатие на аватар для выбора файла
        document.getElementById('avatar-preview').addEventListener('click', function() {
            document.getElementById('avatar').click(); // Открытие диалогового окна для выбора файла
        });

        // Предпросмотр нового аватара после выбора файла
        document.getElementById('avatar').addEventListener('change', function() {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result; // Обновление изображения
            };
            if (this.files && this.files[0]) {
                reader.readAsDataURL(this.files[0]); // Чтение выбранного файла
            }
        });

        // Сброс полей формы в начальное состояние
        document.getElementById('cancel-button').addEventListener('click', function() {
            document.getElementById('avatar-preview').src = initialAvatarSrc; // Исправлено здесь
            document.getElementById('avatar').value = ''; // Очистка значения ввода
            document.getElementById('name').value = initialFormState.name;
            document.getElementById('email').value = initialFormState.email;
            document.getElementById('phone').value = initialFormState.phone;
            document.getElementById('stamp').value = initialFormState.stamp;
        });
    </script>
@endsection
