<?php

namespace App\Http\Requests\Bot;

use App\Http\Requests\Request;

class QueueRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'queues'  => [
                'array',
                'access:App\Models\Queue,mine'
            ],
            'ignored' => 'array'
        ];
    }
}
