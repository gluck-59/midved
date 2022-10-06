<?php

    class ToToastr
    {
        /**
         * отправляет мессагу в тоастр
         * $typeType: 0 error, 1 success, 2 info, 3 warning
         *
         * @param int $type
         * @param string $message
         * @param string $header
         * @return array
         */
        public static function send(int $type, string $message = null, string $header = null) : array {
            switch ($type) {
                case 0:
                    if (is_null($message)) $message = 'Ошибка';
                    break;

                case 1:
                    if (is_null($message)) $message = 'Успешно';
                    break;

                case 2:
                    break;

                case 3:
                    break;

                default: $type = 'info';
            }
            return ['type' => $type, 'message' => $message, 'header' => $header];
        }

        public function index() { return __FUNCTION__; }

    }