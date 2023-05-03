<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientReasource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id" => $this->id,
            'MRN'=>$this->MRN,
            'fname'=>$this->fname,
            'lname'=>$this->lname,
            'protocol'=>$this->protocol,
            'medical_history'=>$this->medical_history,
            'age'=>$this->age,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            
        ];
    }
}
