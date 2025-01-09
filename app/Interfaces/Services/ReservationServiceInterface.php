<?php

namespace App\Interfaces\Services;

interface ReservationServiceInterface
{
    /**
     * Get a paginated list of Reviews with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @param string $reservation
     * @return mixed
     */
    public function getAllReservations(array $filters = [], int $perPage = 15);

    public function getAllReservationsArrived(array $filters = [], int $perPage = 5);

    /**
     * Get details of a Reservation by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getReservationDetail(int $id);

    /**
     * Create a new Reservation.
     *
     * @param array $data
     * @return mixed
     */
    public function createReservation(array $data);

    /**
     * Update a Reservation by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateReservation(int $id, array $data);

    /**
     * Delete a Reservation by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteReservation(int $id);

    public function isOrderAwaitingConfirmation(int $phone, string $email);
    public function isIpAwaitingConfirmation(string $ipAddress);
}
