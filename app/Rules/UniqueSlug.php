<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniqueSlug implements Rule
{
    protected $table;
    protected $ignoreId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $ignoreId = 0)
    {
        $this->table = $table;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return DB::table($this->table)
            ->where('slug', Str::slug($value))
            ->where('id', '!=', $this->ignoreId)
            ->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The slug of :attribute has been taken.');
    }
}
