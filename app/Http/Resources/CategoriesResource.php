<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return [
           "id"=>$this->id,
           "title"=>$this->title,
           "children"=>$this->collection($this->children),
           "created_at"=>\Morilog\Jalali\CalendarUtils::strftime('Y/m/d ساعت H:i', strtotime($this->created_at))
       ];
    }
}
