環境介紹
===

請先建立以下環境或是可以執行 laravel 8 的環境

* php: 8.0
* mysql: 5.7
* laravel: 8
* vue:2
* nginx: 1.16
* composer
* npm

1. git clone 本專案
2. composer install
3. npm install
4. 複製 .env.example 命名為 .env
5. 修改 .env 檔內的 mysql 設定
6. php artisan key:generate
7. php artisan migrate
8. 打開設定好的網址，首頁即為本次的前端服務

swagger URL
===

/api/documentation
---

Api 介接方法
===

取得所有 Announce  資料
---
#### Api Url: /api/announce
#### Api 呼叫方式: GET

|Header 參數|格式|必填|說明
|---|---|---|---|
|Content-Type|string|Required|application/json 傳送 json|
|Accept|string|Required|application/json 回傳 json|

|Query 參數|格式|必填|說明
|---|---|---|---|
|page|number||分頁參數|

Response
```
{
    "status": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 4,
                "title": "tes",
                "content": "test1",
                "created_at": "2022-06-08T07:07:04.000000Z",
                "updated_at": "2022-06-08T07:07:48.000000Z"
            },
            {
                "id": 5,
                "title": "aaa",
                "content": "aaa",
                "created_at": "2022-06-08T07:33:04.000000Z",
                "updated_at": "2022-06-08T07:33:24.000000Z"
            },
            {
                "id": 6,
                "title": "test",
                "content": "test",
                "created_at": "2022-06-08T07:57:13.000000Z",
                "updated_at": "2022-06-08T07:57:13.000000Z"
            }
        ],
        "first_page_url": "http://laravel-crud.local/api/announce?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://laravel-crud.local/api/announce?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://laravel-crud.local/api/announce?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://laravel-crud.local/api/announce",
        "per_page": 15,
        "prev_page_url": null,
        "to": 3,
        "total": 3
    }
}
```

取得 Announce  資料
---
#### Api Url: /api/announce/{id}
#### Api 呼叫方式: GET

|Header 參數|格式|必填|說明
|---|---|---|---|
|Content-Type|string|Required|application/json 傳送 json|
|Accept|string|Required|application/json 回傳 json|

|Path 參數|格式|必填|說明
|---|---|---|---|
|{id}|number|Required|要編輯的id|

Response
```
{
    "status": true,
    "data": {
        "title": "test",
        "content": "test",
        "updated_at": "2022-06-08T08:15:44.000000Z",
        "created_at": "2022-06-08T08:15:44.000000Z",
        "id": 7
    }
}
```

新增 Announce  資料
---
#### Api Url: /api/announce
#### Api 呼叫方式: POST

|Header 參數|格式|必填|說明
|---|---|---|---|
|Content-Type|string|Required|application/json 傳送 json|
|Accept|string|Required|application/json 回傳 json|

|Body 參數|格式|必填|說明
|---|---|---|---|
|title|string|Required|Announce標題|
|content|string|Required|Announce 內容|

Response
```
{
    "status": true,
    "data": {
        "title": "test",
        "content": "test",
        "updated_at": "2022-06-08T08:15:44.000000Z",
        "created_at": "2022-06-08T08:15:44.000000Z",
        "id": 7
    }
}
```

編輯 Announce  資料
---
#### Api Url: /api/announce/{id}
#### Api 呼叫方式: PUT

|Header 參數|格式|必填|說明
|---|---|---|---|
|Content-Type|string|Required|application/json 傳送 json|
|Accept|string|Required|application/json 回傳 json|

|Path 參數|格式|必填|說明
|---|---|---|---|
|{id}|number|Required|要編輯的id|

|Body 參數|格式|必填|說明
|---|---|---|---|
|title|string|Required|Announce標題|
|content|string|Required|Announce 內容|

Response
```
{
    "status": true,
    "data": {
        "title": "test",
        "content": "test",
        "updated_at": "2022-06-08T08:15:44.000000Z",
        "created_at": "2022-06-08T08:15:44.000000Z",
        "id": 7
    }
}
```

刪除 Announce 資料
---
#### Api Url: /api/announce/{id}
#### Api 呼叫方式: DELETE

|Header 參數|格式|必填|說明
|---|---|---|---|
|Content-Type|string|Required|application/json 傳送 json|
|Accept|string|Required|application/json 回傳 json|

|Path 參數|格式|必填|說明
|---|---|---|---|
|{id}|number|Required|要刪除的id|

Response
```
{
    "status": true
}
```
