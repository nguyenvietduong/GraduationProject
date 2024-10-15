<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\AccountRepositoryInterface;

class AccountRepositoryEloquent extends BaseRepository implements AccountRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a paginated list of accounts with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllAccount(array $filters = [], $perPage = 5, $role = 'user')
    {
        $query = $this->model->query();

        $query->where('role_id', $role);
    
        // Apply search filters
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('full_name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('address', 'like', '%' . $filters['search'] . '%');
            });
        }
    
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }
    
        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }
    
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
    
        // Order by created date (newest first)
        $query->orderBy('id', 'desc');
    
        // Paginate results
        return $query->paginate($perPage);
    }    

    /**
     * Count users with a specific role.
     *
     * @param string $role
     * @return int
     */
    public function countAccountsByRole(string $role)
    {
        $query = $this->model->where('role_id', $role); // Spatie's role scope for filtering by role

        return $query->count();
    }

    /**
     * Get friends of an account by user ID.
     *
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public function getFriendsByUserId(int $id)
    {
        $user = $this->find($id);
        if (!$user) {
            return collect(); // Return an empty collection if user not found
        }

        return $user->friends; // Return the user's friends list
    }

    /**
     * Get account details by user ID.
     *
     * @param int $id
     * @return \App\Models\User|null
     */
    public function getAccountDetail(int $id)
    {
        return $this->find($id);
    }

    /**
     * Update an account by user ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateAccount(int $id, array $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new account.
     *
     * @param array $params
     * @return \App\Models\User
     */
    public function createAccount(array $params)
    {
        return $this->create($params);
    }

    /**
     * Delete an account by user ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteAccount(int $id)
    {
        return $this->delete($id);
    }
}
