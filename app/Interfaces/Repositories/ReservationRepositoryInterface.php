<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ReservationRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a paginated list of Reviews with optional search functionality.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllReservations(array $filters = [], $perPage = 5);


    public function getAllReservationsArrived(array $filters = [], $perPage = 5);

    /**
     * Get details of a Reservation by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getReservationDetail(int $id);

    /**
     * Update a Reservation by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateReservation(int $id, array $params);

    /**
     * Create a new Reservation with data.
     *
     * @param array $params
     * @return mixed
     */
    public function createReservation(array $params);

    /**
     * Get details of a Reservation by ID. (Possibly duplicates the `getReservationDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailReservation(int $id);

    /**
     * Delete a Reservation by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteReservation(int $id);
}
