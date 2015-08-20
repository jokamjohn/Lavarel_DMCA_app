<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    /**
     * Fields for mass assignment
     * @var array
     */
    protected $fillable = [
        'infringing_title',
        'infringing_link',
        'original_link',
        'description',
        'template',
        'content_removed',
        'provider_id'
    ];
    /**
     * Open/create a new notice
     * @param array $attributes
     * @return static
     */
    public static function open (array $attributes)
    {
        return new static($attributes); //same as new Notice

    }

    /**
     * set email notice for the template
     * @param $template
     * setter
     * @return $this
     */
    public function useTemplate ($template)
    {
        $this->template = $template;
        return $this;
    }

}
