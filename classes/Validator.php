<?php

namespace classes;

class Validator
{

    protected $errors = [];
    protected $data_items;
    protected $rules_list = ['required', 'min', 'max', 'email', 'match', 'unique', 'ext', 'size'];

    protected $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be a minimun :rulevalue: characters',
        'max' => 'The :fieldname: field must be a maximum :rulevalue: characters',
        'email' => 'Not valid email',
        'match' => 'The :fieldname: field must match :rulevalue: field',
        'unique' => 'The :fieldname: is already taken',
        'ext' => 'File :fieldname: extension does not match. Allowed :rulevalue:',
        'size' => 'File :fieldname: is too big. Allowed :rulevalue: bytes',
    ];

    public function validate($data = [], $rules = [])
    {
        foreach ($data as $field => $value) {
            if (isset($rules[$field])) {
                $field_data = [
                    'field' => $field,
                    'value' => $value,
                    'rules' => $rules[$field],
                ];
                $this->check($field_data);
            }
        }
        return $this;
    }

    protected function check($field_data)
    {
        foreach ($field_data['rules'] as $rule => $rule_value) {
            if (in_array($rule, $this->rules_list)) {
                if (!call_user_func_array([$this, $rule], [$field_data['value'], $rule_value])) {
                    $this->addError(
                        $field_data['field'],
                        str_replace(
                            [':fieldname:', ':rulevalue:'],
                            [$field_data['field'], $rule_value],
                            $this->messages[$rule]
                        )
                    );
                }
            }
        }
    }


    protected function check2($field)
    {
        foreach ($field['rules'] as $rule => $rule_value) {
            if (method_exists($this, $rule) && !call_user_func([$this, $rule], $field['value'], $rule_value)) {
                $this->addError(
                    $field['fieldname'],
                    strtr($this->messages[$rule], [':fieldname:' => $field['fieldname'], ':rulevalue:' => $rule_value])
                );
            }
        }
    }


    public function load($fillable = [], $post = true)
    {
        $load_data = $post ? $_POST : $_GET;
        $data = [];
        foreach ($fillable as $name) {
            if (isset($load_data[$name])) {
                $data[$name] = trim($load_data[$name]);
            } else {
                $data[$name] = '';
            }
        }
        return $data;
    }


    public function listErrors($fieldname)
    {
        $output = '';
        if (isset($this->errors[$fieldname])) {
            $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
            foreach ($this->errors[$fieldname] as $error) {
                $output .= "<li>{$error}</li>";
            }
            $output .= "</ul></div>";
        }
        return $output;
    }

    protected function addError($fieldname, $error)
    {
        $this->errors[$fieldname][] = $error;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    protected function required($value, $rule_value)
    {
        return !empty($value);
    }

    protected function max($value, $rule_value)
    {
        return mb_strlen($value, 'UTF-8') <= $rule_value;
    }

    protected function min($value, $rule_value)
    {
        return mb_strlen($value, 'UTF-8') >= $rule_value;
    }

    protected function email($value, $rule_value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function unique($value, $rule_value)
    {
        $data = explode(':', $rule_value);
        return (!db()->query("SELECT {$data[1]} FROM {$data[0]} WHERE {$data[1]} = ?", [$value])->getColumn());
    }


}