<?php

    class ToToastr
    {
        /**
         * отправляет мессагу в тоастр
         * в JS на фронте нужно встретить и раскидать по типам
         * $type: 0 error, 1 success, 2 info, 3 warning
         *
         * @param int $type
         * @param string|null $message
         * @param string|null $header
         * @return array
         */
        public static function send(int $type, string|null $message = null, string|null $header = null) : array {
            switch ($type) {
                case 0:
                    if (is_null($message)) $message = 'Ошибка';
                    break;

                case 1:
                    if (is_null($message)) $message = 'Успешно';
                    break;

                case 2:
                    if (is_null($message)) $message = 'Инфо';
                    break;

                case 3:
                    if (is_null($message)) $message = 'Предупреждение';
                    break;

                default: $type = 'info';
            }
            return ['type' => $type, 'message' => $message, 'header' => $header];
        }

        public function index() { return __FUNCTION__; }

    }