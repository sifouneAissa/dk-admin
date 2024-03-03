<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'is_default' => $this->is_active,
            'id' => $this->id
        ];
    }
}
