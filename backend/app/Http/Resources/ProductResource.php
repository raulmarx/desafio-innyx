<?php

namespace App\Http\Resources;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $categoryName = $this->category ? $this->category->name_category : null;

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category_name' => $categoryName,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'validate_date' => $this->validate_date,
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
