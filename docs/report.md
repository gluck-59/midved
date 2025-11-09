# Отчеты (Report)

## Назначение
- **Цель** Предоставить пользователю сводные данные по клиентам, заявкам и платежам в форме HTML и XLSX.

## Архитектура
- **Контроллер** `application/controllers/Report.php` управляет основными маршрутами `/report`, `/report/debitorka`, `/report/totalPayed`, `/report/salaryByMonth`, а также генерацией файлов.
- **Модель** `application/models/ReportModel.php` содержит SQL-запросы, фильтрующие данные по текущему пользователю.
- **Представления**
  - `application/views/reports/debitorka.php`, `totalPayed.php`, `salaryByMonth.php` отображают отчеты.
  - `application/views/reports/samplesInc.php` и `sampleSql.php` предоставляют образцы SQL.
- **JavaScript** (в шаблоне `application/views/main.php` и других) обрабатывает действия пользователя по запуску отчетов и выводу результатов.

## Структура данных
- **SQL-зависимости**
  - `report.debitorka()` агрегирует заявки с отрицательным балансом (`PaymentModel`, `RequestModel`, `EquipmentModel`, `CustomerModel`).
  - `report.totalPayed()` суммирует положительные платежи по клиентам.
  - `report.salaryByMonth()` агрегирует суммы по месяцам.
- **Формат XLSX**: `Report` контроллер содержит генератор XLSX (служебные массивы `template`, `F`, `XF`, `SI`).

## UI-потоки
- **Главная страница отчетов** `/report` позволяет вводить SQL или запускать готовые отчеты.
- **Ссылки** в UI вызывают маршруты `/report/debitorka`, `/report/totalPayed`, `/report/salaryByMonth` с HTML-выводом.
- **Экспорт** при передаче параметра `toFile` файл формируется и скачивается.

## API и обработчики
- **GET `/report`** — форма для SQL и ссылки на примеры.
- **POST `/report`** — выполнение пользовательского SQL (с фильтрацией запрещенных операций).
- **GET `/report/debitorka`**, `/report/totalPayed`, `/report/salaryByMonth` — HTML-версии отчетов.
- **GET `/report/*?toFile=1`** — экспорт в XLSX (метод `Report::toFile()`).

## Бизнес-правила
- **Фильтрация по пользователю** все запросы в `ReportModel` фильтруют по `c.creator`.
- **Защита SQL** контроллер проверяет строку на запрещенные слова (`delete`, `drop`, `alter` и т.д.).
- **Отчеты** зависят от актуальности полей `payment.sum`, `request.status`, `customer.creator`.

## Требования к базе данных
- **Доступ** требуется корректная настройка FK: `payment` → `request` → `equipment` → `customer`.
- **Локаль** `salaryByMonth()` устанавливает `SET lc_time_names='ru_RU'` для русских названий месяцев.
- **Индексы** ускоряют агрегации (`paym-req`, `req-eqip`, `equip-cust`).

## Расширение функциональности
- **Новые отчеты** можно добавить в `ReportModel` и соответствующие представления.
- **Расширенный XLSX** — модифицировать массив `template`, поддержать несколько листов.
- **Фильтры** добавить параметры в URL и учитывать в SQL.

## Диагностика и отладка
- **SQL** вывод результатов можно проверять через `prettyDump()` или `var_dump`.
- **Ошибки** при экспорте XLSX смотри в логах PHP; генератор чувствителен к структуре `template`.
- **Проверка запросов** выполняй SQL напрямую в СУБД при несоответствиях.
