<?php

namespace App\Services;

use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class AccountService extends BaseService implements AccountServiceInterface
{
    protected $accountRepository; // Repository for account-related database operations
    protected $imageService; // Service for handling image storage and management

    /**
     * Create a new instance of AccountService.
     *
     * @param AccountRepositoryInterface $accountRepository
     * @param ImageServiceInterface $imageService
     */
    public function __construct(
        AccountRepositoryInterface $accountRepository,
        ImageServiceInterface $imageService
    ) {
        $this->accountRepository = $accountRepository; // Initialize the account repository
        $this->imageService = $imageService; // Initialize the image service
    }

    /**
     * Get a paginated list of accounts with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllAccount(array $filters = [], int $perPage = 5, $role = [])
    {
        try {
            // Retrieve accounts from the repository using filters and pagination
            return $this->accountRepository->getAllAccount($filters, $perPage, $role);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving accounts
            throw new Exception('Unable to retrieve account list: ' . $e->getMessage());
        }
    }

    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getAccountDetail(int $id)
    {
        try {
            // Retrieve account details from the repository by ID
            return $this->accountRepository->getAccountDetail($id);
        } catch (ModelNotFoundException $e) {
            // Handle case where the account is not found
            throw new ModelNotFoundException('Account not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle any other exceptions that occur while retrieving account details
            throw new Exception('Unable to retrieve account details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new account.
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function createAccount(array $data)
    {
        try {
            // Hash the password before storing it
            $data['password'] = Hash::make($data['password']);
            $image = null;

            // Handle image upload from the request if present
            if (isset($data['image'])) {
                $data['image'] = $this->imageService->storeImage('account_files', $data['image']);
            } elseif (session('image_temp')) {
                // Handle temporary image if session data exists
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName;

                // Check if the temporary image exists in storage
                if (Storage::exists($tempImagePath)) {
                    $fullTempImagePath = Storage::path($tempImagePath);
                    $image = new UploadedFile(
                        $fullTempImagePath,
                        $tempImageName,
                        null,
                        null,
                        true
                    );

                    // Store the image in S3 and delete the temporary image
                    $data['image'] = $this->imageService->storeImage('account_files', $image);
                    $this->imageService->deleteImage($tempImagePath);
                } else {
                    dd('Temp file does not exist in local storage.'); // Debugging statement for missing temp file
                }
            }

            // Create a new account using the repository
            $account = $this->accountRepository->createAccount($data); // Store the created account in $account

        } catch (Exception $e) {
            // If an error occurs, delete the newly created account if it exists
            if (isset($account)) {
                $account->delete(); // Delete the account
            }

            // Handle image storage exceptions
            $this->imageService->handleImageException($e, $data);
            throw new Exception('Unable to create account: ' . $e->getMessage());
        }
    }

    /**
     * Update an account by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateAccount(int $id, array $data)
    {
        // Store old data to restore in case of an error
        $oldAccount = $this->accountRepository->getAccountDetail($id);
        $oldImagePath = $oldAccount->image; // Store the old image path
        $image = null;

        // Start transaction to ensure all changes are atomic
        DB::beginTransaction();

        try {
            // Handle image upload if present
            if (isset($data['image'])) {
                // Update image in S3
                $data['image'] = $this->imageService->updateImage('account_files', $data['image'], $oldImagePath);
            } elseif (session('image_temp')) {
                // Handle temporary image if present in session
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName;

                // Check if the temporary image exists in storage
                if (Storage::exists($tempImagePath)) {
                    $fullTempImagePath = Storage::path($tempImagePath);
                    $image = new UploadedFile(
                        $fullTempImagePath,
                        $tempImageName,
                        null,
                        null,
                        true
                    );

                    // Update image in S3 and delete temporary image
                    $data['image'] = $this->imageService->updateImage('account_files', $image, $oldImagePath);
                    $this->imageService->deleteImage($tempImagePath); // Delete temporary image
                } else {
                    dd('Temp file does not exist in local storage.'); // Error message if temporary image does not exist
                }
            }

            // Update account with new data
            $this->accountRepository->updateAccount($id, $data);

            // Commit transaction after successful update
            DB::commit();

        } catch (Exception $e) {
            // Rollback transaction in case of failure
            DB::rollBack();

            // Restore old data in case of an error
            $this->accountRepository->updateAccount($id, $oldAccount->toArray());

            // Handle image restoration if it was changed
            if (isset($data['image']) && $data['image'] !== $oldImagePath) {
                $this->imageService->updateImageS3('account_files', $oldImagePath, $data['image']);
            }

            // Handle exceptions when an error occurs
            $this->imageService->handleImageException($e, $data);
            throw new Exception('Unable to update account: ' . $e->getMessage());
        }
    }

    /**
     * Delete an account by ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteAccount(int $id)
    {
        try {
            // Attempt to delete the account using the repository
            return $this->accountRepository->deleteAccount($id);
        } catch (ModelNotFoundException $e) {
            // Handle case where the account is not found
            throw new ModelNotFoundException('Account not found with ID: ' . $id);
        } catch (Exception $e) {
            // Handle any other exceptions that occur during deletion
            throw new Exception('Unable to delete account: ' . $e->getMessage());
        }
    }
}
