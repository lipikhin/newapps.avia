<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {

        $users = User::all(); // или использовать пагинацию: User::paginate(10);
        return view('admin.users.index', compact('users'));



    }

    public function create()
    {
        $roles = Role::all();
        $teams = Team::all();

        return view('admin.users.create', compact('roles', 'teams'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Находим пользователя по его ID
        $roles = Role::all();          // Получаем все роли
        $teams = Team::all();          // Получаем все команды

        return view('admin.users.edit', compact('user', 'roles', 'teams'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'is_admin' => 'nullable|boolean', // Убедитесь, что 'is_admin' не обязателен
            'roles_id' => 'nullable',
            'teams_id' => 'nullable',
            'phone' => 'nullable|string|max:20',
            'stamp' => 'nullable|string|max:255',
        ]);

        // Обновление основных полей
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->has('is_admin') ? 1 : 0; // Обновление is_admin

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->roles_id = $request->roles_id;
        $user->teams_id = $request->teams_id;
        $user->phone = $request->phone;
        $user->stamp = $request->stamp;

        // Обработка изображения, если оно загружено
        if ($request->hasFile('avatar')) {
            // Удаляем старый аватар, если он существует
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars/', $avatarName, 'public');
            $user->avatar = $avatarName;
        }

        // Сохраняем изменения
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлен.');
    }




    public function store(Request $request)
    {
        // Валидация входных данных
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'avatar' => 'image',
            'roles_id' => 'nullable|exists:roles,id',
            'teams_id' => 'nullable|exists:teams,id',
            'phone' => 'nullable',
            'stamp' => 'nullable',
        ]);

        // Обработка изображения, если оно загружено
        if ($request->hasFile('avatar')) {

            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars/', $avatarName,'public');
            $validatedData['avatar'] = $avatarName;
        }

        // Хэширование пароля перед сохранением
        $validatedData['password'] = Hash::make($request->password);

        try {
            \Log::info('Создание пользователя с данными: ', $validatedData);

            User::create($validatedData);
            return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно создан.');
        } catch (\Exception $e) {
            \Log::error('Ошибка при создании пользователя: ', [
                'message' => $e->getMessage(),
                'data' => $validatedData,
                'trace' => $e->getTrace(),
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Не удалось создать пользователя: ' . $e->getMessage()]);
        }


    }

    public function destroy($id)
    {
        // Находим пользователя по ID
        $user = User::findOrFail($id);

        // Получаем путь к аватару
        $avatarPath = $user->avatar; // Убедитесь, что 'avatar' — это поле в вашей модели пользователя

        // Проверяем путь к аватару
        \Log::info('Avatar path: ' . $avatarPath);

        // Удаляем аватар, если он существует
        if ($avatarPath && Storage::disk('public')->exists('avatars/' . $avatarPath)) {
            Storage::disk('public')->delete('avatars/' . $avatarPath);
            \Log::info('Avatar deleted: ' . $avatarPath);
        } else {
            \Log::warning('Avatar not found or path is empty: ' . 'avatars/' . $avatarPath);
        }

        // Удаляем пользователя
        $user->delete();

        // Перенаправляем с сообщением об успехе
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
