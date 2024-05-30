<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Mail\NewRecipeNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recipes = Recipe::all()->toArray();

        $sortKey = $request->input('sort', 'title');
        $sortDirection = $request->input('direction', 'asc');

        // Сортировка массива с помощью алгоритма быстрой сортировки
        $sortedRecipes = $this->quickSort($recipes, $sortKey, $sortDirection);

        $recipeCount = count($sortedRecipes);

        return view('recipes', compact('sortedRecipes', 'recipeCount', 'sortKey', 'sortDirection'));
    }

    private function quickSort(array $array, $key, $direction)
    {
        if (count($array) < 2) {
            return $array;
        }

        $left = [];
        $right = [];
        reset($array);
        $pivotKey = key($array);
        $pivot = array_shift($array);

        foreach ($array as $k => $v) {
            if ($direction == 'asc') {
                if ($v[$key] < $pivot[$key]) {
                    $left[$k] = $v;
                } else {
                    $right[$k] = $v;
                }
            } else {
                if ($v[$key] > $pivot[$key]) {
                    $left[$k] = $v;
                } else {
                    $right[$k] = $v;
                }
            }
        }

        $left = $this->quickSort($left, $key, $direction);
        $right = $this->quickSort($right, $key, $direction);

        // Объединяем и возвращаем отсортированный массив
        return array_merge($left, [$pivotKey => $pivot], $right);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Проверка входных данных
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        // Создание нового рецепта
        $recipe = new Recipe();
        $recipe->title = $validatedData['title'];
        $recipe->author_name = $validatedData['author_name'];
        $recipe->description = $validatedData['description'];
        $recipe->ingredients = $validatedData['ingredients'];
        $recipe->category = $validatedData['category'];


        // Проверка аутентификации пользователя
        $user = auth()->user();
        if ($user) {
            // Если пользователь аутентифицирован, устанавливаем user_id
            $recipe->user_id = $user->id;
        } else {
            // Если пользователь не аутентифицирован, перенаправляем его на страницу входа
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему, чтобы добавить рецепт.');
        }

        // Сохраняем рецепт
        $recipe->save();

        // Получение всех пользователей
        $users = User::all();

        // Отправка уведомления всем пользователям
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewRecipeNotification($recipe, $user));
        }

        // Перенаправляем с сообщением об успехе
        return redirect()->route('recipes.create')->with('success', 'Рецепт успешно добавлен!');
    }



    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category'); // Получаем значение параметра category

        // Используем условие для фильтрации по категории и по запросу
        $recipes = Recipe::query();

        if ($category) {
            $recipes->where('category', $category);
        }

        if ($query) {
            $recipes->where(function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->orWhere('ingredients', 'like', "%$query%");
            });
        }

        $recipes = $recipes->get();

        return view('search', compact('recipes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $user = auth()->user();

        if ($recipe->user_id !== $user->id && $user->usertype !== 'admin'){
            return redirect()->route('recipes.index')->with('error', 'У вас нет прав для редактирования этого рецепта.');
        }

        return view('edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $user = auth()->user();

        if ($recipe->user_id !== $user->id && $user->usertype !== 'admin'){
            return redirect()->route('recipes.index')->with('error', 'У вас нет прав для редактирования этого рецепта.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $recipe->update($validatedData);

        return redirect()->route('recipes.index')->with('success', 'Рецепт успешно обновлен!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $user = auth()->user();

        if ($recipe->user_id !== $user->id && $user->usertype !== 'admin'){
            return redirect()->route('recipes.index')->with('error', 'У вас нет прав для удаления этого рецепта.');
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Рецепт успешно удален!');
    }

}
