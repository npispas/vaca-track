<?php

namespace App\Core;

use DateTime;
use Illuminate\Database\Capsule\Manager as Capsule;

class Request
{
    /**
     * Retrieve all request data (filtered).
     *
     * @return array
     */
    public static function all(): array
    {
        return filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS) ?? [];
    }

    /**
     * Retrieve a specific request value.
     *
     * @param string $key The input field name
     * @param mixed|null $default Default value if key is missing
     * @return mixed
     */
    public static function input(string $key, mixed $default = null): mixed
    {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS) ?? $default;
    }

    /**
     * Validate request fields.
     *
     * @param array $rules Validation rules (e.g. ['name' => 'required', 'email' => 'email'])
     * @return array|null Returns errors array or null if validation passes
     */
    public static function validate(array $rules): ?array
    {
        $errors = [];
        $data = self::all();

        foreach ($rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;

            foreach ($ruleSet as $ruleKey => $ruleValue) {
                if (is_int($ruleKey)) {
                    $ruleName = $ruleValue;
                    $ruleParam = null;
                } else {
                    $ruleName = $ruleKey;
                    $ruleParam = $ruleValue;
                }

                if ($ruleName === 'nullable' && empty($value)) {
                    continue 2;
                }

                if ($ruleName === 'required' && empty($value)) {
                    $errors[$field][] = ucfirst($field) . ' is required.';

                    continue;
                }

                if ($ruleName === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = ucfirst($field) . ' must be a valid email.';

                    continue;
                }

                if ($ruleName === 'unique' && !empty($value)) {
                    $params = explode(',', $ruleParam);
                    $table = $params[0] ?? null;
                    $column = $params[1] ?? null;
                    $ignoreId = $params[2] ?? null;

                    if ($table && $column) {
                        $query = Capsule::table($table)->where($column, $value);
                        if (!empty($ignoreId)) {
                            $query->where('id', '!=', $ignoreId);
                        }
                        if ($query->exists()) {
                            $errors[$field][] = ucfirst($field) . ' is already taken.';
                        }
                    }
                }

                if ($ruleName === 'min' && strlen($value) < $ruleParam) {
                    $errors[$field][] = ucfirst($field) . " must be at least $ruleParam characters.";

                    continue;
                }

                if ($ruleName === 'max' && strlen($value) > $ruleParam) {
                    $errors[$field][] = ucfirst($field) . " must be at $ruleParam characters max.";

                    continue;
                }

                if ($ruleName === 'exact' && strlen($value) != $ruleParam) {
                    $errors[$field][] = ucfirst($field) . " must be exactly $ruleParam characters.";

                    continue;
                }

                if ($ruleName === 'date') {
                    $format = 'Y-m-d';
                    $dateTime = DateTime::createFromFormat($format, $value);

                    if (!$dateTime || $dateTime->format($format) !== $value) {
                        $errors[$field][] = ucfirst($field) . " must be a valid date in format $format.";
                    }
                }
            }
        }

        if (!empty($data['password']) && !empty($data['password_confirmation']) && $data['password'] !== $data['password_confirmation']) {
            $errors['password'][] = 'Passwords do not match.';
        }

        return empty($errors) ? null : $errors;
    }
}
