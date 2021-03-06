Лог изменений putptp:
================================
**Дата:** 2015-06-11

-Готовы 3 формы настройки книги. Оставшиеся 3 формы - добавить вместе с остальной функциональностью.

-Необходимо реализовать "переключатель статуса"

-Реализована основная функциональность главной панели редактирования содержимого книги: создание глав, изменение настроек, их содержимого и просмотр в гипертекстовом виде.

-Внедрён враппер для работы со сторонним модулем CKEditor, позволяющим редакировать гипертекст. 

-Необходимо: подключить загрузчик файлов с сервера для включения в гипертекст внутренних файлов сервера (иллюстрации). На данный момент возможно использовать лишь внешние ссылки. 

-В качестве представления содержимого книг на данный момент решено использовать гипертекст.  

-Доступ ко всем методам создания и редактирования закрыт для сторонних пользователей.

-Необходимо: реализовать методы удаления (книги, главы, иллюстрации в порядке приоритета)

-Замечание: дублирование методов выборки из БД в WriteController желательно устранить.
-Замечание: в файлах представлений внести $this->title там, где это необходимо.

**Дата:** 2015-29-10

-Готовы 2 формы настройки книги.

-Способ создания книги: по прежнему 6 этапов, но статус 'ожидает' используется до публикации - сразу после написания книги она становится опубликованной. Также автор её может свободно настраивать в любое время (возможно, будет задано ограничение по интервалу времени)  .

-При наличии незаполненных полей книга опубликована быть не может.

-admin, frontend: Найдено и исправлено: несоответствие жанров и типов книг реальным id в БД при поиске и отображении.

-!!!Необходимо запретить доступ к панели настройки книги всем, кроме автора!!! (после завершения работы над ней)  

**Дата:** 2015-23-10

-Создана форма создания книги (начальный этап перед конфигрурированием) - любой пользователь имеет возможность создать книгу.

-admin: добавлены блоки управления контентом: типы книг и жанры. Необходимо ограничить доступ модераторов к ним.

-db: снято ограничение NotNull с уникального свойства book_title: можно создать книгу без названия (но не опубликовать). Подобные объекты отображаются в CP как "No Name".

-Замечание: дополнить меткой "No Name" все безымянные книги в других разделах CP.

**Дата:** 2015-22-10

-Одна из основных функций пользовательского интерфейса (настройка профиля) реализована. Расширение функциональности будет проводиться позже.

-Появилсь возможность загружать собственное фото для страницы.

-Способ хранения загружаемого контента изменён: теперь на каждый загружаемый элемент выделяется собственный идентификатор-ключ.

-Необходимо реализовать механизм создания книги в приложении, приблизительная модель такова: пока книга не опубликована, её содержимое может быть любым. Чтобы её опубликовать, необходимо подтвердить все настройки (6 этапов), сформировать весь предполагаемый контент и отправить заявку модератору. После прохождения верификации модератором произведению выставляется статус 'опубликовано', 'ожидает' или 'заблокировано'. Блокированные книги возвращаться модерацией не могут.

-admin: Ссылки на авторов книг в списке Users Control работают. Фильтрация книг на странице пользователя выполняется.

-admin: Необходимо доработать интерфейс модератора: ограничить произвольную смену статуса до 'заблокирован' и 'активен'. 

**Дата:** 2015-16-10

-Начата работа над пользовательской частью приложения.

-Проведена небольшая реорганизация в 'frontend': модуль 'user', отвечающий за регистрацию и смену паролей, переименован в 'svc'. Новый модуль 'user' предназначен для работы с данными пользователя, обеспечения необходимого представления данных.

-Исправлен баг: не фильтруются книги на странице просмотра пользователя.

-Необходимо произвести доработку отображения ссылок на авторов книг в общем списке Books Control.

-Необходимо изменить способ хранения загружаемого контента.

-Необходимо реализовать возможность смены статусов книг (верификации).

-Планируется реализация управлением правами доступа, настроек пользовательских профилей.

**Дата:** 2015-14-10

-Внедрён RBAC. Утверждены роли по умолчанию. Разграничены разрешения модераторов контента и администраторов. Реализованы операции для консольного режима (присвоение особых прав доступа пользователям). Планируется реализация и внедрение модуля rbac для управления системой ролевого доступа непосредствнно из администраторской панели.

-Изменён внешний вид панели. Планируется реализация модуля настроек системы.

**Дата:** 2015-11-10 (23:11)

-Внесены функции модерирования контента - массовая смена статусов + удаление заблокированных пользователей. Последнее доработать, перенести в консоль.

-Исправлен баг: в методе signup() не соблюдались правила валидации вследствие неправильного порядка вызова методов save() зависимых моделей User и UserSettings. По-прежнему требуется доработка алгоритма сохранения данных при регистрации пользователя.

-Обнаружен баг: не фильтруются книги на странице просмотра пользователя.

**Дата:** 2015-11-10

-Созданы и настроены некоторые CRUD - операции для Users и Books. Созданы взаимодействия между моделями Users и Books.
-Сгенерирована первая модель настроек (Settings) для Users.

**Дата:** 2015-01-10

-Восстановлено функционирование некоторых действий, связанных с регистрацией пользователей в базе данных.
-Полностью реорганизована структура приложения.
-Добавлена индексация некоторых полей таблицы User для последующих улучшений.