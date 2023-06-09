<?php

namespace App\Http\Requests\Setting;

use App\Classes\Helpers\PermissionHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingOverallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(PermissionHelper::MANAGE_USERS);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_complete_allowed' => 'required',
            'task_assign_allowed'   => 'required',
            'lead_complete_allowed' => 'required',
            'lead_assign_allowed'   => 'required'
        ];
    }
}
