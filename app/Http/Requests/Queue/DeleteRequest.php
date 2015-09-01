<?php

namespace App\Http\Requests\Queue;

use App\Http\Requests\Request;
use Gate;

class DeleteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $queue = $this->route('queue');

        return Gate::allows('delete', $queue);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
