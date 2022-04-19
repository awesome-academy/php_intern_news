<?php

namespace App\Rules;

use App\Models\Article;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class UniqueSlug implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return Article::where('slug', Str::slug($value))->count() == 0;
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
