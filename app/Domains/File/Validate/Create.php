<?php declare(strict_types=1);

namespace App\Domains\File\Validate;

use App\Domains\Core\Validate\ValidateAbstract;

class Create extends ValidateAbstract
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => ['bail', 'required', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
            'related_table' => ['bail', 'required', 'string'],
            'related_id' => ['bail', 'required', 'integer'],
        ];
    }
}
