<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public static $wrap = '';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $response = [
            'meta' =>[
                'message' => $data['message'],
                'status' => $data['status'],
                'pagination' => null,
            ],
            'data' => $data['data']
        ];

        if (count($data['data']) && array_key_exists('current_page', $data['data']->toArray())) {
            $meta = $data['data']->toArray();
            $response['data'] = $meta['data'];
            
            unset($meta['data']);
            unset($meta['links']);
            
            $response['meta']['pagination'] = $meta;
            
        }
        
        return $response;
    }
}
