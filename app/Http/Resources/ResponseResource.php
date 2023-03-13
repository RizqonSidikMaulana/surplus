<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
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
        
        if (gettype($data['data']) != 'array') {
            $data['data'] = $data['data']->toArray();
        }
        
        if (array_key_exists('current_page', $data['data'])) {
            $dataArray = $data['data'];
                $response['data'] = $dataArray['data'];
                
                unset($dataArray['data']);
                unset($dataArray['links']);
                
                $response['meta']['pagination'] = $dataArray;
        }

        
        return $response;
    }
}
