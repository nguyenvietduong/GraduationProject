<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

if (!function_exists('set_active')) {
    /**
     * Check if the current request segment matches the given routes.
     *
     * @param array|string $routes The routes to check against.
     * @param string $activeClass The class to return if there is a match.
     * @param string $defaultClass The class to return if there is no match.
     * @return string
     */
    function set_active($routes, $activeClass = 'active', $layout = 'admin', $segmentIndex = '')
    {
        // Determine the segment index based on layout
        if ($segmentIndex == '') {
            $segmentIndex = ($layout === 'admin') ? 2 : 1;
        } else {
            $segmentIndex = $segmentIndex;
        }
        $segment = request()->segment($segmentIndex); // Get the segment based on layout

        // Check if the current segment matches any of the routes
        return in_array($segment, (array) $routes) ? $activeClass : '';
    }
}

if (!function_exists('set_selected')) {
    /**
     * Helper function to set the 'selected' attribute for a select option (supports single and multiple selections).
     *
     * @param string $name The name of the input (used for old() retrieval).
     * @param mixed $value The current value of the option being checked.
     * @param mixed $selectedValues The actual stored value(s) (e.g., from the database), can be a single value or an array.
     * @param string $selected The attribute to apply if the value matches.
     * @return string Returns 'selected' if the value matches old input or the stored value(s).
     */
    function set_selected($name, $value, $selectedValues = null, $selected = 'selected')
    {
        // Get old input value, which might be an array if it's a multiple select
        $oldValues = old($name, $selectedValues);

        // Ensure $oldValues is always an array for consistency
        $oldValues = is_array($oldValues) ? $oldValues : [$oldValues];

        // Return 'selected' if the $value exists in the array of $oldValues
        return in_array($value, $oldValues) ? $selected : '';
    }

    // Select thuong
    // <select class="form-select" name="role">
    //     <option value="admin" {{ set_selected('role', 'admin', $user->role) }}>Admin</option>
    //     <option value="user" {{ set_selected('role', 'user', $user->role) }}>User</option>
    // </select>

    // Select 2
    // <select class="form-select select2" name="roles[]" multiple>
    //     @foreach($roles as $role)
    //         <option value="{{ $role->id }}" {{ set_selected('roles', $role->id, $user->roles->pluck('id')->toArray()) }}>
    //             {{ $role->name }}
    //         </option>
    //     @endforeach
    // </select>
}

// Check if the 'set_checked' function does not already exist to avoid redeclaration.
if (!function_exists('set_checked')) {
    /**
     * Helper function to set the 'checked' attribute for radio buttons or checkboxes.
     *
     * @param mixed $value The value to compare against the current request's old input or existing data.
     * @param mixed $currentValue The value of the option being checked.
     * @param string $checked The attribute to apply if the value matches the current request's old input or existing data.
     * @return string Returns 'checked' if the value matches the old input or existing data, otherwise returns an empty string.
     */
    function set_checked($value, $currentValue, $checked = 'checked')
    {
        // Get the old input value or current value for the update scenario.
        $oldValue = old('value', $currentValue); // Fetch the old input value

        // Return the 'checked' attribute if the values match
        return $value == $oldValue ? $checked : '';
    }
}

// Check if the 'set_disabled' function does not already exist to avoid redeclaration.
if (!function_exists('set_disabled')) {
    /**
     * Helper function to set the 'disabled' attribute for form elements.
     *
     * @param bool $condition The condition to check for disabling the element.
     * @param string $disabled The attribute to apply if the condition is true.
     * @return string Returns 'disabled' if the condition is true, otherwise returns an empty string.
     */
    function set_disabled($condition, $disabled = 'disabled')
    {
        // Return the 'disabled' attribute if the condition is true
        return $condition ? $disabled : '';
    }
}

// Check if the 'set_readonly' function does not already exist to avoid redeclaration.
if (!function_exists('set_readonly')) {
    /**
     * Helper function to set the 'readonly' attribute for form fields.
     *
     * @param bool $condition The condition to check for setting the readonly attribute.
     * @param string $readonly The attribute to apply if the condition is true.
     * @return string Returns 'readonly' if the condition is true, otherwise returns an empty string.
     */
    function set_readonly($condition, $readonly = 'readonly')
    {
        // Return the 'readonly' attribute if the condition is true
        return $condition ? $readonly : '';
    }
}

// Check if the 'set_class' function does not already exist to avoid redeclaration.
if (!function_exists('set_class')) {
    /**
     * Helper function to set custom classes based on conditions.
     *
     * @param bool $condition The condition to check for adding a class.
     * @param string $class The class to add if the condition is true.
     * @return string Returns the class if the condition is true, otherwise returns an empty string.
     */
    function set_class($condition, $class = '')
    {
        // Return the class if the condition is true
        return $condition ? $class : '';
    }
}

if (!function_exists('checkFile')) {
    /**
     * Check the existence of an image in local storage.
     *
     * @param string $path The path of the image in local storage.
     * @return string|null Returns the URL of the image if it exists, otherwise returns null.
     */
    function checkFile($path)
    {
        try {
            // Ensure the provided path is a valid non-empty string
            if (is_string($path) && !empty($path) && Storage::exists($path)) {
                // Return the URL of the image
                return asset('storage/' . $path);
            }
        } catch (Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error checking local storage file: ' . $e->getMessage());
        }

        // Return null if the file doesn't exist or an error occurs
        return null;
    }
}

if (!function_exists('checkMinioImage')) {
    /**
     * Check the existence of an image on Minio (S3).
     *
     * @param string $path The path of the image file on Minio (S3).
     * @return string|null Returns the URL of the image if it exists, otherwise returns null.
     */
    function checkMinioImage($path)
    {
        try {
            $disk = Storage::disk('s3');

            // Check if $path is a valid string
            if (is_string($path) && !empty($path) && $disk->exists($path)) {
                // Return the URL of the image
                return $disk->url($path);
            }
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Error checking Minio image: ' . $e->getMessage());
        }

        // Return null if no image is found or an error occurs
        return null;
    }
}

if (!function_exists('getGreeting')) {
    function getGreeting()
    {
        $hour = date('H'); // Get the current hour in 24-hour format

        if ($hour >= 5 && $hour < 12) {
            $time = 'morning';
        } elseif ($hour >= 12 && $hour < 17) {
            $time = 'afternoon';
        } elseif ($hour >= 17 && $hour < 21) {
            $time = 'evening';
        } else {
            $time = 'night';
        }

        // Correctly access the translation key
        return __('messages.time.' . $time . '.greeting'); // Concatenation
    }
}

if (!function_exists('getRandomQuote')) {
    function getRandomQuote()
    {
        $quotes = [
            __('messages.quotes.1'),
            __('messages.quotes.2'),
            __('messages.quotes.3'),
            __('messages.quotes.4'),
            __('messages.quotes.5'),
        ];

        return $quotes[array_rand($quotes)];
    }
}

if (!function_exists('forgetSessionImageTemp')) {
    function forgetSessionImageTemp($image_temp)
    {
        if (session()->has($image_temp)) {
            // Xóa session sau khi xử lý thành công
            session()->forget($image_temp);
        }
    }
}

if (!function_exists('convertCurrency')) {
    /**
     * Convert an amount from VND to USD based on the app's locale.
     *
     * @param float $amount The amount in VND to convert.
     * @return float The converted amount in either VND or USD based on locale.
     * @throws Exception If the currency conversion is unsupported.
     */
    function convertCurrency($amount)
    {
        // Define the exchange rates
        $exchangeRate = [
            'USD' => 24845, // 1 USD = 24.845 VND
            'VND' => 1 // 1 VND = 1 VND
        ];

        // Determine the current locale
        $locale = App::getLocale();

        // Adjust the conversion based on the locale
        if ($locale === 'vi') { // Nếu ngôn ngữ là tiếng Việt
            formatCurrency($amount); // Trả về số tiền VND đã convert
        } elseif ($locale === 'en') { // Nếu ngôn ngữ là tiếng Anh
            return $amount / $exchangeRate['USD']; // Chuyển từ VND sang USD
        }

        // Nếu unsupported currency, throw an error
        throw new Exception('Unsupported currency conversion');
    }
}

if (!function_exists('formatCurrency')) {
    /**
     * Format an amount in VND to a string with commas and currency symbol.
     *
     * @param float $amount The amount in VND.
     * @return string The formatted amount as a string.
     */
    function formatCurrency($amount)
    {
        // Định dạng số với dấu phẩy và thêm ký hiệu "đ"
        return number_format($amount, 0, ',', '.');
    }
}


if (!function_exists('formatDate')) {
    function formatDate($amount)
    {
        if ($amount == null || $amount == '') {
            return '';
        }
        return Carbon::parse($amount)->format('d-m-Y H:i');
    }
}

if (!function_exists('formatCreateDate')) {
    function formatCreateDate($amount)
    {
        if ($amount == null || $amount == '') {
            return '';
        }

        return Carbon::parse($amount)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('formatDiscount')) {
    function formatDiscount($value)
    {
        return str_replace('.', replace: '', subject: $value);
    }
}

if (!function_exists('checkBladeAdmin')) {
    function checkBladeAdmin($role = null)
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return '';
        } else if (Auth::check() && Auth::user()->role_id == 2) {
            if ($role == 2) {
                return '';
            } else {
                return 'none';
            }
        } else if (Auth::check() && Auth::user()->role_id == 3) {
            if ($role == 3) {
                return '';
            } else {
                return 'none';
            }
        }
    }
}
