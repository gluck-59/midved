# Заявки (Request)

## Назначение
- **Цель** Управлять жизненным циклом заявок на обслуживание оборудования и учитывать их финансовые показатели.

## Архитектура
- **Контроллер** `application/controllers/Request.php` обслуживает `/request`, `/request/index`, `/request/edit/{id}`, `/request/payment`, `/request/create`, `/request/setNotes`, `/request/setStatus`.
- **Модель** `application/models/RequestModel.php` реализует выборку, создание и обновление заявок, фильтрацию по пользователю, набор статусов.
- **Представления**
  - `application/views/request.php` — список заявок и быстрые действия.
  - `application/views/requestEdit.php` — детальная карточка с платежами, статусом и заметками.
- **JavaScript** `application/js/script.js` (`#addRequest`, `.paymentEdit`, `.selectStatus`, `#requestNotes`) инициирует создание, платежи, статусы.
- **Модальные окна** `application/views/modals.php` (`#modal-request`, `#modalPrihodRashod`) собирают ввод для новых заявок и платежей.

## Структура данных
- **Таблица `request`** хранит базовые атрибуты заявки:
  - `id` — первичный ключ.
  - `equipment_id` — FK на `equipment.id`.
  - `name` — краткое описание заявки.
  - `status` — числовой статус (`RequestModel::STATUSES`).
  - `notes` — произвольные заметки.
  - `created`, `updated` — временные метки.
- **Связанные сущности**
  - `equipment` определяет объект обслуживания.
  - `payment` учитывает движения средств, фильтр по `request_id`.

## UI-потоки
- **Список** `request.php` показывает сводку по каждой заявке (статус, баланс, даты). При отсутствии данных отображаются подсказки.
- **Создание** кнопка «Новая заявка» открывает `#modal-request`. При отправке `#addRequest` вызывает `/request/create`.
- **Редактирование** ссылка на номер заявки ведёт в `requestEdit.php`, где отображаются детали и история платежей.
- **Платежи** кнопки `.paymentEdit` вызывают `#modalPrihodRashod`. При отправке данные уходят на `/request/payment`.
- **Статус** при выборе `.selectStatus` отправляется `/request/setStatus`.
- **Заметки** поле `#requestNotes` вызывает `/request/setNotes` при сохранении.

## API и обработчики
- **GET `/request`** — список заявок.
- **GET `/request/index/1`** — JSON (`RequestModel::getRequests()`), используется для AJAX.
- **GET `/request/edit/{id}`** — детальная страница с платежами.
- **POST `/request/create`** — создание заявки.
- **POST `/request/payment`** — добавление платежа или авторазноска (см. `PaymentModel::set()` и `PaymentModel::autoDistribution()`).
- **POST `/request/setNotes`** и **`/request/setStatus`** — обновление текстовых и статусных полей.

## Бизнес-правила
- **Привязка к пользователю** `RequestModel::getRequests()` фильтрует по `c.creator`, ограничивая видимость.
- **Статусы** перечислены в `RequestModel::STATUSES`: `Новая`, `В работе`, `Готово`.
- **Баланс** вычисляется из сумм платежей (`SELECT SUM(p.sum)`), отображается в рублях.
- **Авторазноска** (`PaymentModel::autoDistribution()`) разносит сумму по открытым заявкам клиента.
- **Валидация** на фронтенде обязательны выбор оборудования и описание; статусы и заметки сохраняются по запросу.

## Требования к базе данных
- **Связи**
  - `request.equipment_id` → `equipment.id` (CASCADE обновление/удаление).
  - `payment.request_id` → `request.id`.
- **Индексы** `req-eqip` ускоряет связь с оборудованием.

## Расширение функциональности
- **Теги/статусы** можно расширить `RequestModel::STATUSES` и UI.
- **История** добавить аудит изменений статуса/заметок.
- **Назначение ответственных** потребует новых полей и логики в модели.

## Диагностика и отладка
- **AJAX** запросы наблюдаются в консоли; ошибки от `setNotes`/`setStatus` возвращаются через `toToastr::send()`.
- **Ответы** `/request/create` и `/request/payment` возвращают числовые/JSON результаты; проверяй `data.result` и `toastr`.
- **Платежи** в `requestEdit.php` отображаются с суммами и типами; изменения проверяются через соответствующие POST-операции.
