<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'photo' => $this->photo,
            'phone' => $this->phone,
            'position' => $this->position,
            'passport_seriya' => $this->passport_seriya,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'tr_lang' => $this->tr_lang,
            'eng_lang' => $this->eng_lang,
            'ru_lang' => $this->ru_lang,
            //'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
