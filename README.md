## Init
1. git clone https://github.com/nrnwest/symfony_test_task.git
2. cd symfony_test_task
3. make init
4. [symfony_test_task](http://localhost:4444)
5. mnake php_cli
6. php ./bin/console app:stt Tomas

## Requirements 
Ubuntu system or similar. 
The system must have: docker, docker-compose, make installed.


Test Task
1. Развернуть проект на symfony.
2. Сделать минимальное CRUD-приложение:
   ● GET/POST/UPDATE/DELETE
   ● Должна быть возможность сделать вывод текста из базы, создать,
   обновить, удалить. Стилизации делать не нужно, можно дефолтной
   формой от фреймворка.
3. Создать symfony command которая по запуску каждую секунду будет
   выводить Hello {variable} где, {variable} значение которое можно
   передать команде при запуске.
4. Всё проделанное залить на git и скинуть ссылку (каждый шаг делать
   коммит в гите чтобы было видна история работы)
