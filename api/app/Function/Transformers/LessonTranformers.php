<?php

namespace Funciton\Transformers;


class LessonTranformers extends Transformer
{
    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'body'  => $lesson['body'],
            'confirmed' => (boolean)$lesson['confirmed'],
            'Added_on' => $lesson['Added_on']
        ];
    }
}