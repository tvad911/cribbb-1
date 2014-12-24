<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

class Magniloquent extends Model {

    protected $validationErrors;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        $this->validationErrors = new MessageBag();
    }

    public function performSave(array $options = [])
    {
        return parent::save($options);
    }

    public function save(array $options = [])
    {
        // Merge the validation rules
        static::$rules = $this->mergeRules();

        // Validate all fields
        if(!$this->validate($this->attributes)) return false;

        // Purge redundant fields
        $this->attributes = $this->purgeRedundant($this->attributes);

        // Auto hash passwords
        $this->attributes = $this->autoHash();

        return parent::save($options);
    }

    private function mergeRules()
    {
        if($this->exists)
        {
            $merged = array_merge_recursive(static::$rules['save'], static::$rules['update']);
        } else {
            $merged = array_merge_recursive(static::$rules['save'], static::$rules['create']);
        }

        foreach($merged as $field => $rules)
        {
            if(is_array($rules))
            {
                $output[$field] = implode("|", $rules);
            } else {
                $output[$field] = $rules;
            }
        }

        return $output;
    }

    private function validate($attributes)
    {
        $validation = Validator::make($attributes, static::$rules);
        if($validation->passes()) return true;
        $this->validationErrors = $validation->messages();
        return false;
    }

    private function purgeRedundant($attributes)
    {
        foreach($attributes as $key => $value)
        {
            if(!Str::endsWith( $key , '_confirmation' ))
            {
                $clean[$key] = $value;
            }
        }
        return $clean;
    }

    private function autoHash()
    {
        if(isset($this->attributes['password']))
        {
            if($this->attributes['password'] != $this->getOriginal('password')){
                $this->attributes['password'] = Hash::make($this->attributes['password']);
            }
        }
        return $this->attributes;
    }

}