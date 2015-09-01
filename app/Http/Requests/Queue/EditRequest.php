<?php

namespace App\Http\Requests\Queue;

use Gate;

class EditRequest extends CreateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $queue = $this->route('queue');

        return Gate::allows('edit', $queue);
    }
}
