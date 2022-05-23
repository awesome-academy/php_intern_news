<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'active_url' => 'URL của :attribute không hợp lệ.',
    'after' => 'Giá trị :attribute phải lớn hơn :date.',
    'after_or_equal' => 'Giá trị :attribute phải lớn hơn hoặc bằng :date.',
    'alpha' => ':attribute chỉ được bao gồm các ký tự chữ cái.',
    'alpha_dash' => ':attribute chỉ được bao gồm chữ cái, số, dấu gạch ngang và gạch chân.',
    'alpha_num' => ':attribute chỉ được bao gồm chữ cái và số ',
    'array' => ':attribute phải là 1 mảng.',
    'before' => 'Giá trị :attribute phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Giá trị :attribute phải trước hoặc bằng ngày :date.',
    'between' => [
        'numeric' => ':attribute phải ở giữa khoảng :min và :max.',
        'file' => 'Kích thước của :attribute phải ở giữa khoảng :min và :max kilobytes.',
        'string' => 'Độ dài của :attribute phải ở giữa khoảng :min và :max ký tự.',
        'array' => 'Độ dài mảng :attribute phải ở giữa khoảng :min và :max phần tử.',
    ],
    'boolean' => 'Giá trị :attribute chỉ được phép là true hoặc false.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'date' => 'Giá trị :attribute không hợp lệ.',
    'date_equals' => ':attribute phải là ngày :date.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'different' => 'Giá trị :attribute phải khác với :other.',
    'digits' => 'Giá trị :attribute phải :digits số.',
    'digits_between' => 'Giá trị :attribute phải từ :min đến :max số.',
    'dimensions' => 'Giá trị :attribute không hợp lệ.',
    'distinct' => ':attribute đã tồn tại.',
    'email' => 'Giá trị :attribute không hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng 1 trong các giá trị sau: :values.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => ':attribute phải là 1 file.',
    'filled' => ':attribute phải chứa 1 giá trị.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => 'Kích thước :attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải nhiều hơn :value ký tự.',
        'array' => ':attribute phải nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => 'Kích thước :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => 'Độ dài :attribute tối thiểu phải :value ký tự.',
        'array' => ':attribute phải có tối thiểu :value phần tử.',
    ],
    'image' => ':attribute phải là hình ảnh.',
    'in' => ':attribute không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => 'Kích thước :attribute phải nhỏ hơn :value kilobytes.',
        'string' => 'Độ dài :attribute phải ngắn hơn :value ký tự.',
        'array' => ':attribute phải chứa ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => 'Kích thước :attribute tối đa :value kilobytes.',
        'string' => 'Độ dài :attribute tối đa :value ký tự.',
        'array' => ':attribute chỉ được tối đa :value phần tử.',
    ],
    'max' => [
        'numeric' => ':attribute tối đa :max.',
        'file' => 'Kích thước :attribute tối đa :max kilobytes.',
        'string' => 'Độ dài :attribute tối đa :max ký tự.',
        'array' => ':attribute chỉ được tối đa :max phần tử.',
    ],
    'mimes' => ':attribute phải có kiểu file: :values.',
    'mimetypes' => ':attribute phải có kiểu file: :values.',
    'min' => [
        'numeric' => 'Giá trị :attribute tối thiểu :min.',
        'file' => 'Kích thước :attribute tối thiểu :min kilobytes.',
        'string' => 'Độ dài :attribute tối thiểu :min ký tự.',
        'array' => ':attribute phải chứa tối thiểu :min phần tử.',
    ],
    'not_in' => 'Giá trị :attribute không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => 'Mật khẩu không chính xác.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => ':Attribute bắt buộc phải nhập.',
    'required_if' => ':attribute bắt buộc phải nhập nếu :other là :value.',
    'required_unless' => ':attribute bắt buộc phải nhập trừ khi :other là :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => ':Attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải :size.',
        'file' => ':attribute phải :size kilobytes.',
        'string' => ':attribute phải :size ký tự.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],
    'starts_with' => ':attribute phải bắt đầu với: :values.',
    'string' => ':attribute phải là 1 chuỗi ký tự.',
    'timezone' => ':attribute phải là 1 time zone hợp lệ.',
    'unique' => ':Attribute đã được sử dụng, vui lòng chọn :attribute khác.',
    'uploaded' => ':attribute upload không thành công.',
    'url' => ':attribute không hợp lệ.',
    'uuid' => ':attribute không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [

        'password' => 'mật khẩu',
        'first_name' => 'tên',
        'last_name' => 'họ đệm',
        'username' => 'tên người dùng',
        'password_confirm' => 'xác nhận',
    ],

];
