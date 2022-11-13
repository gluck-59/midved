<?php

    /**
     * @var PaymentModel
     */
	class PaymentModel extends CI_Model
	{
		private $id;
		private $sum;
        private $note;
        private $created;
        const TYPES = ['payment_type_work' => 0, 'payment_type_extra' => 1, 'payment_type_autowork' => 2, 'payment_type_autoextra' => 3];

        public function __construct()
        {
        }

        /**
		 * тянет историю затрат/платежей по номеру заявки
         *
		 * @param int $reqestId
		 * @return array
		 */
		public function get(int $reqestId = null) : array {
			if (is_null($reqestId)) throw new Exception('Отсутствует номер заявки в '.__CLASS__.': '.__LINE__);
			$sql = "select  p.id, p.request_id, p.type, p.note, p.sum/100 as sum, /*DATE_FORMAT(p.created, '%m.%d.%Y') created*/p.created FROM  payment p WHERE p.request_id = $reqestId ORDER BY p.created ASC";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


		/**
		 * платежи: создает приход-расход
         *
		 * @param array $paymentData
		 * @return mixed
		 */
		public function set(array $paymentData) {
			if ($paymentData['direction'] == 0) $sum = -$paymentData['sum']; 	// расход
			elseif ($paymentData['direction'] == 1) $sum = $paymentData['sum'];	// приход

			// из-за необходимости записи NULL в p.note
			// в этом месте будем использовать билдер
			$data = array(
				'request_id' => $paymentData['requestId'],
				'type' => $paymentData['type'],
				'sum' => $sum*100,
			);
			if (!empty($paymentData['note'])) {
				$data['note'] = $this->db->escape_str($paymentData['note']);
			}
			return $this->db->insert('payment', $data);
		}

/**
 * авторазноска платежей
 * при авторазноске с фронта прилетает ID клиента и сумма платежа, которая затем разносится этим методом по незакрытым заявкам прилетевшего клеиента, начиная с самой старой заявки
 * цель авторазноски — взять незакрытые заявки с отрицательным балансом, довести баланс до 0 и /*@TODO затем закрыть заявку
 * алгоритм:
 * 1. берем самую старую заявку этого клиента
 * 2. компенсируем накладные (Extra) расходы, проверяем остаток $totalSum. Если осталось, то:
 * 3. компенсируем работу (Work) проверяем остаток $totalSum. Если осталось, переходим к след заявке
 * 4. пишем в payments признак авторазноски: type (TINYINT) 2 — работа; 3 — накладные
 * 5. /*@TODO устанавливаем request->status = 2
 * Если денег не хватает, компенсирем сколько есть, помечаем payment->note "недостача"
 * Если после всего деньги остались, берем самую новую заявку из скопа и кладем в нее, помечая payment->note "излишек"
 *
 * @param array $paymentData
 * @return array
 */
public function autoDistribution(array $paymentData) : array {
    $debug = true;
    $resultNorm = []; // результат нормальной разноски
    $resultOver = []; // результат разноски остатка после нормальной
    $totalSum = (int) $paymentData['sum'];
//    $requestModel = new RequestModel();
    $toPay = [];

    $sql = 'SELECT #"=p=", p.*, "=r=", r.*, "=e=", e.*, "=c=", c.*,
#(SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id) as balance, 
p.sum paymentSum, p.type paymentType, r.id requestId, r.name requestName, r.status requestStatus, r.created requestDate, UNIX_TIMESTAMP(r.created) requestDateUnix, e.name equipmentName, c.id customerId, c.name customerName
FROM payment p
JOIN request r ON r.id = p.request_id
JOIN equipment e ON e.id = r.equipment_id
JOIN customer c ON c.id = e.customer_id
WHERE c.id = '.$this->db->escape($paymentData['customerId']).' AND r.status < 2 
ORDER BY requestDateUnix';
    $stmt = $this->db->query($sql);
    $payments = $stmt->result_array();


    if (empty($payments)) {
        return ['resultNorm' => ['У этого клиента нет подходящих заявок']];
    }


    // подготовим заявки:
    // просуммируем платежи которые нужно компенсировать авторазноской
    $requestBalance = []; // фактический баланс перед авторазноской
    foreach ($payments as $payment) {
        $requestBalance[$payment['requestId']]['requestName'] = $payment['requestName'];
        if ($payment['paymentType'] == self::TYPES['payment_type_work'] OR $payment['paymentType'] == self::TYPES['payment_type_autowork']) {
            $requestBalance[$payment['requestId']]['work'] += $payment['paymentSum']/100;
        } elseif ($payment['paymentType'] == self::TYPES['payment_type_extra'] OR $payment['paymentType'] == self::TYPES['payment_type_autoextra']) {
            $requestBalance[$payment['requestId']]['extra'] += $payment['paymentSum']/100;
        }
    }

    // получим последовательности автоплатежей в разрезе заявок из подготовленного ранее массива
    foreach ($requestBalance as $requestId => $request) {
        foreach ($request as $key => $paymant) {
            if (is_int($paymant) AND $paymant < 0) {
                $temp['requestId'] = $requestId;
                $temp['requestName'] = $request['requestName'];
                $temp['type'] = self::TYPES['payment_type_auto'.$key];
                $temp['typeText'] = $key;
                $temp['sum'] = abs($paymant);
                $temp['direction'] = 1;
            } else continue;
            // в массиве $toPay собирается информация о нуждающихся в компенсации заявках
            $toPay[] = $temp;
        }
    }

    if ($debug) {
        print_r('$payments:');
        print_r($payments);

//
//        print_r('$paymentData:');
//        print_r($paymentData);

//        print_r('$requestBalance:');
//        print_r($requestBalance);

//        echo PHP_EOL.'==========================================='.PHP_EOL;
        print_r('$toPay:');
        print_r($toPay);

        echo PHP_EOL.'$totalSum остаток до цикла: '.$totalSum.PHP_EOL;
//die();
    }

     $result = [];
     $break = false;

     foreach ($toPay as $payment) {
         $result['requestName'] = $payment['requestName'];
        $result['paymentSum'] = $totalSum;
        $result['needSum'] = $payment['sum'];

        // недостача денег
        if ($totalSum < $payment['sum']) {
            $payment['sum'] = $totalSum;
            $payment['note'] = 'Недостача';
            $result['notEnough'] = true;
            $break = true;
        }

         // оплата
         // успешная оплата
         if (self::set($payment)) {
             $totalSum -= $payment['sum'];
             $result['requestId'] = $payment['requestId'];
             $result['result'] = 1;
         }
         // неуспешная оплата
         else {
             $result['остаток_после'] -= $payment['sum'];
             $result['requestId'] = $payment['requestId'];
             $result['result'] = 0;
             return new Exception('ошибка платежа в '.__LINE__);
         }

         $result['остаток_после'] = $totalSum;
         $resultNorm[] = $result;

        if ($break) break;
     } // foreach to pay


    if ($debug) {
        echo PHP_EOL.'$totalSum остаток после цикла: '.$totalSum.PHP_EOL;
    }

    // излишек денег
    if ($totalSum > 0) {
        $result1['over'] = true;

        $payment['sum'] = $totalSum;
        $payment['note'] = 'Излишек';
        if (self::set($payment)) {
            $result1['oversum'] = $totalSum;
            $result1['oversumRequestId'] = $payment['requestId'];
            $result1['oversumRequestName'] = $payment['requestName'];
        } else {
            $result1['result'] = 0;
            return new Exception('ошибка платежа в '.__LINE__);
        }
        $resultOver[] = $result1;
    }

     if ($debug) {
         echo '========================================='.PHP_EOL.'финал'.PHP_EOL;
         print_r($resultNorm);
         print_r($resultOver);
     }

     return ['resultNorm' => $resultNorm, 'resultOver' => $resultOver];
}

		/**
		 * редактирует приход-расход по ID
         *
		 * @param int $paymentId
		 * @return int
		 */
		public function edit(array $paymentData) : int {
			$entity = $this->db->escape_str($paymentData['entity']);
			if ($entity == 'sum') {
				$value = $this->db->escape_str($paymentData['value']);
				$value = (int) $value*100;
			} else {
				$value = $this->db->escape($paymentData['value']);
			}
			$set = $entity.' = '.$value;

			$sql = 'UPDATE payment SET '.$set.' WHERE id = '.$paymentData['paymentId'];
			return  $this->db->query($sql);
		}


		/**
		 * удаляет приход-расход по ID
         *
		 * @param int $paymentId
		 * @return bool
		 */
		public function delete(int $paymentId) : bool {
			$sql = 'DELETE FROM payment WHERE id = '.$this->db->escape($paymentId);
			return  $this->db->query($sql);
		}


        private function _makePayment() {

        }

	}
