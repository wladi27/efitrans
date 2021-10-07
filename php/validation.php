<?php
class Validation {
    protected $rules;
    protected $fields;

    public function __construct() {
        $args = func_get_args();
        $nargs = func_num_args();

        if ($nargs == 1) {
            $this->fields = $args[0];
        } else {
            $this->fields = array();
        }

        $rules = array();
    }

    function addRule($field, $rule, $params, $title = "") {
        $this->rules[$field][] = array("rule" => $rule, "params" => $params, "title" => $title);
    }

    function addRules($field, $title, $rules) {
        $args = func_get_args();
        $nargs = func_num_args();

        for ($i = 2; $i < $nargs; $i++) { //Analizar reglas del tercer argumento en adelante
            foreach ($args[$i] as $rule => $params) {
                $this->addRule($field, $rule, $params, $title);
            }
        }
    }

    function validate() {
        $errors = array();
        $msg = "";
        $bad_fields = array();
        if (is_array($this->rules)) {
            foreach ($this->rules as $field => $rules) {

                foreach ($rules as $rule) {
                    $rule_name = $rule['rule'];
                    if (method_exists($this, $rule_name)) {
                        $rs = call_user_func(array($this, $rule_name), $field, $this->fields[$field], $rule['params']);
                        if ($rs['result'] == false) {
                            $rs['msg'] = ($rule['title'] == "") ? $rs['msg'] : str_replace("{{$field}}", $rule['title'], $rs['msg']);
                            $errors[$field][$rule_name] = $rs['msg'];

                            $msg .= $rs['msg'] . "\n";
                            $bad_fields[] = $field;
                        }
                    } else {
                        $t = "$rule_name no implementada, para '$field'";
                        $errors[$field][$rule_name] = $t;
                        $msg .= $t . "\n";
                        $bad_fields[] = $field;
                    }
                }
            }
        }
        $bad_fields = array_unique($bad_fields);
        return array("messages" => $msg, "errors" => $errors, "bad_fields" => $bad_fields); // $result;
    }

    function required($field, $value, $params) {
        if ($params == true) {
            if ($value == "" || $value == "NULL") {
                return array("result" => false, "msg" => "El campo '{{$field}}' es obligatorio");
            } else {
                return array("result" => true, "msg" => "");
            }
        }
    }

    function mail($field, $value, $params) {
        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }

        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") {
            return array("result" => true, "msg" => "");
        }

        //Validar
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe ser un correo electronico");
        }
    }

    function integer($field, $value, $params) {
        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }

        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") {
            return array("result" => true, "msg" => "");
        }

        //Validar
        if (filter_var($value, FILTER_VALIDATE_INT)) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe ser un numero entero");
        }
    }

    function decimal($field, $value, $params) {
        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }

        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") {
            return array("result" => true, "msg" => "");
        }

        //Validar
        if (filter_var($value, FILTER_VALIDATE_FLOAT)) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe ser un numero entero");
        }
    }

    function url($field, $value, $params) {

        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }

        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") {
            return array("result" => true, "msg" => "");
        }

        //Validar
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe ser una URL");
        }
    }

    function date($field, $value, $params) {
        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }
        
        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") { 
            return array("result" => true, "msg" => "");
        }

        if ($this->validateDate($value)) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe ser una fecha");
        }
    }

    function minLength($field, $value, $params) {
        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") { 
            return array("result" => true, "msg" => "");
        }
        
        //Validar
        if (strlen($value) >= $params) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe tener una longitud mínima de $params caracter(es) ");
        }
    }

    function maxLength($field, $value, $params) {
        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") { 
            return array("result" => true, "msg" => "");
        }
        
        //Validar
        if (strlen($value) <= $params) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe tener una longitud máxima de $params caracter(es) ");
        }
    }

    function length($field, $value, $params) {
        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") { 
            return array("result" => true, "msg" => "");
        }
        
        //Validar
        if (strlen($value) >= $params[0] && strlen($value) <= $params[1]) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' debe tener una longitud entre $params[0] y $params[1] caracter(es) ");
        }
    }

    function letters($field, $value, $params) {
        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }
        
        //Dejar la validacion a la funcion regExp
        $valids = '/^[a-zA-Z\s]*$/'; //Expresión regular de caracteres permitidos
        return $this->regExp($field, $value, $valids);
    }

    function digits($field, $value, $params) {
        // No validar si no es true
        if ($params != true) {
            return array("result" => true, "msg" => "");
        }
        
        //Dejar la validacion a la funcion regExp
        $valids = '/^[1-9]*$/'; //Expresión regular de caracteres permitidos
        return $this->regExp($field, $value, $valids);
    }

    function regExp($field, $value, $params) {
        //Si el campo esta vacio, no se valida
        if ($value == "" || $value == "NULL") { 
            return array("result" => true, "msg" => "");
        }

        //Validar
        $valids = $params; //Expresión regular de caracteres permitidos
        $ops = array("options" => array("regexp" => $valids));

        if (filter_var($value, FILTER_VALIDATE_REGEXP, $ops)) {
            return array("result" => true, "msg" => "");
        } else {
            return array("result" => false, "msg" => "El campo '{{$field}}' contiene carácter(es) no valido(s)");
        }
    }

    // http://us2.php.net/manual/es/function.checkdate.php
    protected function validateDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}

?>