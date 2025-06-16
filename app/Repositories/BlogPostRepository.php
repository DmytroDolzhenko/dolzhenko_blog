<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection; // Цей use може бути не використаний прямо, але нехай буде для прикладу.

/**
 * Class BlogPostRepository.
 */
class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class; // Абстрагування моделі BlogPost, для легшого створення іншого репозиторія
    }

    /**
     * Отримати список статей з пагінацією
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        // Вказуємо тільки необхідні колонки для оптимізації запиту
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                //'category:id,title',
                'user:id,name',
            ])// Сортуємо за ID в зворотньому порядку (новіші перші)
            ->paginate(25); // Встановлюємо 25 записів на сторінку

        return $result;
    }

    /**
     * Отримати модель для редагування в адмінці
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
