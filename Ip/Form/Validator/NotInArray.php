<?php
/**
 * @package ImpressPages
 *
 */

namespace Ip\Form\Validator;


class NotInArray extends \Ip\Form\Validator {

    public function __construct($data, $errorMessage = null)
    {
        if (!is_array($data)) {
            throw \Ip\Exception("InArray validator expect array of strings");
        }
        parent::__construct($data, $errorMessage);
    }

    public function getError($values, $valueKey, $environment) {
        if (empty($values[$valueKey])) {
            return FALSE;
        }

        if (in_array($values[$valueKey], $this->data)) {
            if ($this->errorMessage !== null) {
                return $this->errorMessage;
            }
            if ($environment == \Ip\Form::ENVIRONMENT_ADMIN) {
                $errorText = __('The value can\'t to be one of:', 'ipAdmin');
            } else {
                $errorText = __('The value can\'t be one of:', 'ipPublic');
            }
            $errorText .= ' ' . implode(', ', $this->data);
            return $errorText;
        }

        return FALSE;
    }

}
