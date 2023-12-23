<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AtmWithdrawResource extends JsonResource
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
            'success'=>$this['success'],
            'money'=>$this['money'],
            'data'=>$this['data'],
        ];
    }
}
