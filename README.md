# SitemapGenerator
Генератор файла sitemap.xml. 
Необходимо сгенерировать файл Sitemap (http://www.sitemaps.org/ru/protocol.html, настройки времени и приоритет для каждого элемента
можно выставить произвольно) на основе структуры данных, получаемой с удаленного веб-ресурса (http://example.com/sitemap-data/) в формате JSON.
Удаленный сайт (http://example.com/sitemap-data/) имеет базовую HTTP авторизацию (например, user=demo и password=123).


Пример ответа на GET-запрос по адресуhttp://example.com/sitemap-data/

{
    "first": [
        "a1",
        "a2",
        "a3"
    ],
    "second": {
        "b1": [
            "c1",
            "c2",
            "c3"
        ],
        "b2": [
            "d1",
            "d2",
            "d3"
        ]
    }
}

Указанная выше структура представляет собой следующий список URL:

site.ru/ /n
site.ru/first/
site.ru/first/a1.html
site.ru/first/a2.html
site.ru/first/a3.html
site.ru/second/
site.ru/second/b1/
site.ru/second/b1/c1.html
   ...
и т.д.

Решение требуется оформить в стиле ООП без использования фреймворков.
Необходимо учесть возможные ошибки при получении исходных данных с удаленного сайта.
