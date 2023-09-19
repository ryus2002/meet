### 手機項目表(phone_items)

| 欄位名          | 資料型態        | 說明                                     |
|------------------|-----------------|----------------------------------------|
| phone_item_id    | INT             | 手機項目ID，唯一識別手機項目的主鍵           |
| brand            | VARCHAR(50)     | 品牌，例如蘋果（Apple）、三星（Samsung）等     |
| mobile_model     | VARCHAR(100)    | 手機型號，描述手機的型號，例如 iPhone 12、Samsung Galaxy S21 等 |
| product_colors   | JSON            | 手機顏色，以JSON格式表示的產品顏色中文名稱、色碼、圖片選項，例如：`[{"name":"黑色","code":"#000000","pic":"file1.png"},{"name":"白色","code":"#FFFFFF","pic":"file2.png"}]` |
| created_at       | TIMESTAMP       | 建立時間                                   |
| updated_at       | TIMESTAMP       | 更新時間                                   |
| deleted_at       | TIMESTAMP       | 刪除時間（可選）                              |

### 產品表(products)

| 欄位名             | 資料型態          | 說明                                     |
|-------------------|------------------|----------------------------------------|
| product_id        | INT              | 產品ID，唯一識別產品的主鍵                   |
| product_group_id  | INT              | 產品群組ID，唯一產品群組的主鍵                   |
| phone_item_id     | INT              | 手機項目ID，與手機項目表關聯的外鍵，指示該產品適用的手機型號    |
| product_type_id   | INT              | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型     |
| product_name      | VARCHAR(100)     | 產品名稱，描述產品的名稱                     |
| subtitle          | VARCHAR(100)     | 副標題，表示產品的副標題，例如 "經典防摔手機殼"           |
| product_type      | VARCHAR(100)     | 產品類型名稱，描述產品類型的名稱，例如 "MagSafe兼容" 或 "標準" |
| price             | DECIMAL(10, 2)   | 價格，產品的價格                             |
| currency_unit     | VARCHAR(3)       | 貨幣單位，表示產品的貨幣單位，例如 "TWD"         |
| category_id       | INT              | 分類ID，與分類表關聯的外鍵，用於將產品分類到不同的分類中 |
| accessory_id      | INT              | 配件ID，與產品表ID關聯的外鍵，用於指示產品的配件（如果有的話） |
| online_status     | INT              | 上線狀態，表示促銷是否目前上線中的欄位，1表示上線中，0表示下線 |
| created_at        | TIMESTAMP        | 建立時間                                   |
| updated_at        | TIMESTAMP        | 更新時間                                   |
| deleted_at        | TIMESTAMP        | 刪除時間（可選）                              |

##### 備註：1.原本思考"MagSafe兼容" 或 "標準"是否需要再切一個表，後來覺得可能會過於複雜，故設計成"MagSafe兼容" 或 "標準"在產品表中將以兩筆表示這是不同的產品，並增加product_group_id表示這兩個產品是同一個群組，會在同一個商品頁顯示
##### 2.產品主頁可以用SELECT * FROM products WHERE group_id = 1;撈取JSON資料，並從該JSON中判斷product_type是否包含了"MagSafe兼容" 或 "標準"，若有則出現該按鈕
##### 3.在網頁中按下"MagSafe兼容"再撈取撈取單一產品SELECT * FROM products WHERE product_id = 1;的資料
##### 4.上述資料撈取方式也可以用JSON暫存方式處理，而該產品有可能臨時會下架，若用JSON只在Client端處理的話會無法即時反應狀況

### 產品支援手機項目關聯表(products_relation_phone_items_models)

| 欄位名             | 資料型態          | 說明                                     |
|-------------------|------------------|----------------------------------------|
| relation_id       | INT              | 關聯ID，唯一識別支援關聯的主鍵                  |
| product_id        | INT              | 手機殼ID，關聯到手機殼表                  |
| phone_item_id     | INT              | 手機項目ID，關聯到手機項目表                |
| created_at        | TIMESTAMP        | 建立時間                                   |
| updated_at        | TIMESTAMP        | 更新時間                                   |
| deleted_at        | TIMESTAMP        | 刪除時間（可選）                              |

##### 備註：手機項目表(phone_items)和產品表(products)設計成多對多的關係，表示一個手機型號可以找到多個不同產品，一個產品也可以支援多個不同的手機型號，若需求不同時可以改成一對多的關係

### 分類表(categories)

| 欄位名             | 資料型態          | 說明                                     |
|-------------------|------------------|----------------------------------------|
| category_id       | INT              | 分類ID，唯一識別分類的主鍵                   |
| parent_category_id| INT              | 父分類ID，關聯到父分類的主鍵，用於建立分類之間的層次結構 |
| category_name     | VARCHAR(100)     | 分類名稱，描述分類的名稱，例如手機殼、磁吸水壺                     |
| created_at        | TIMESTAMP        | 建立時間                                   |
| updated_at        | TIMESTAMP        | 更新時間                                   |
| deleted_at        | TIMESTAMP        | 刪除時間（可選）                              |

### 產品顏色表(product_color)

| 欄位名         | 資料型態      | 說明                                     |
|-----------------|---------------|----------------------------------------|
| color_id        | INT           | 顏色ID，唯一識別圖片的主鍵                    |
| product_id      | INT           | 產品ID，與產品表關聯的外鍵，識別圖片所屬的產品       |
| phone_item_id   | INT           | 手機項目ID，與手機項目表關聯的外鍵，指示該產品適用的手機型號 |
| product_type_id | INT           | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| image_code      | VARCHAR(10)   | 顏色色碼，例如#000000，用於顯示在商品頁面上             |
| image_name      | VARCHAR(30)   | 顏色中文名稱，用於顯示在商品頁面上             |
| image_url       | VARCHAR(255)  | 圖片URL，圖片的網址，用於顯示在商品頁面上             |
| created_at      | TIMESTAMP     | 建立時間                                   |
| updated_at      | TIMESTAMP     | 更新時間                                   |
| deleted_at      | TIMESTAMP     | 刪除時間（可選）                              |

##### 備註：1.產品有分很多顏色，目前我設計成一個產品可以有多個顏色，但皆只會有一個價格，若需要標上不同的價需再新增一個產品，並在產品表的product_group_id表示這是同一個群組

### 產品特色表(product_features)

| 欄位名             | 資料型態          | 說明                                     |
|-------------------|------------------|----------------------------------------|
| feature_id        | INT              | 特色ID，唯一識別特色的主鍵                   |
| product_id        | INT              | 產品ID，與產品表關聯的外鍵，識別特色所屬的產品     |
| product_type_id   | INT              | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| feature_name      | VARCHAR(100)     | 特色名稱，描述特色的名稱，例如防撞、防刮等          |
| created_at        | TIMESTAMP        | 建立時間                                   |
| updated_at        | TIMESTAMP        | 更新時間                                   |
| deleted_at        | TIMESTAMP        | 刪除時間（可選）                              |

### 產品規格表(product_specifications)

| 欄位名                 | 資料型態      | 說明                                     |
|-----------------------|---------------|----------------------------------------|
| specification_id       | INT           | 規格ID，唯一識別規格的主鍵                    |
| product_id            | INT           | 產品ID，與產品表關聯的外鍵，識別規格所屬的產品     |
| product_type_id       | INT           | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| specification_name    | VARCHAR(100)  | 規格名稱，描述規格的名稱，例如尺寸、重量等          |
| specification_value   | VARCHAR(255)  | 規格值，描述規格的具體值，例如尺寸為5英寸、重量為200克等 |
| created_at            | TIMESTAMP     | 建立時間                                   |
| updated_at            | TIMESTAMP     | 更新時間                                   |
| deleted_at            | TIMESTAMP     | 刪除時間（可選）                              |

### 保固與退換貨表(warranty_and_return)

| 欄位名              | 資料型態      | 說明                                     |
|---------------------|---------------|----------------------------------------|
| warranty_id         | INT           | 保固ID，唯一識別保固條款的主鍵                 |
| product_id          | INT           | 產品ID，與產品表關聯的外鍵，識別保固信息所屬的產品   |
| product_type_id     | INT           | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| warranty_description| TEXT          | 保固描述，包含有關保固的詳細描述，例如保固期限、覆蓋範圍等 |
| return_policy       | TEXT          | 退換貨政策，包含有關退換貨政策的詳細描述，例如退貨期限、手續、規定等 |
| created_at          | TIMESTAMP     | 建立時間                                   |
| updated_at          | TIMESTAMP     | 更新時間                                   |
| deleted_at          | TIMESTAMP     | 刪除時間（可選）                              |

### 產品常見問題表(product_faqs)

| 欄位名             | 資料型態          | 說明                                     |
|-------------------|------------------|----------------------------------------|
| faq_id            | INT              | 問題ID，唯一識別問題的主鍵                   |
| product_id        | INT              | 產品ID，與產品表關聯的外鍵，識別問題所屬的產品     |
| product_type_id   | INT              | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| question          | TEXT             | 問題，描述常見問題的文本                      |
| answer            | TEXT             | 答案，描述問題的答案                         |
| created_at        | TIMESTAMP        | 建立時間                                   |
| updated_at        | TIMESTAMP        | 更新時間                                   |
| deleted_at        | TIMESTAMP        | 刪除時間（可選）                              |

### 產品促銷表(product_promotions)

| 欄位名               | 資料型態      | 說明                                     |
|---------------------|---------------|----------------------------------------|
| promotion_id        | INT           | 促銷ID，唯一識別促銷的主鍵                    |
| product_id          | INT           | 產品ID，與產品表關聯的外鍵，識別促銷適用於哪些產品   |
| product_type_id     | INT           | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| promotion_name      | VARCHAR(100)  | 促銷名稱，描述促銷的名稱，例如“夏季特賣”          |
| start_date          | DATE          | 開始日期，促銷開始的日期                      |
| end_date            | DATE          | 結束日期，促銷結束的日期                      |
| discount_rate       | DECIMAL(5, 2) | 折扣率，產品的折扣率，例如10%折扣                |
| discount_amount     | DECIMAL(10, 2)| 折扣金額，產品的折扣金額，例如500               |
| discount_currency_unit| VARCHAR(3)   | 折扣貨幣單位，表示產品的貨幣單位，例如 "TWD"   |
| promotion_description| TEXT          | 促銷描述，包含有關促銷的詳細描述，例如促銷規則、條款等 |
| online_status       | INT           | 上線狀態，表示促銷是否目前上線中的欄位，1表示上線中，0表示下線 |
| created_at          | TIMESTAMP     | 建立時間                                   |
| updated_at          | TIMESTAMP     | 更新時間                                   |
| deleted_at          | TIMESTAMP     | 刪除時間（可選）                              |

### 產品庫存表(product_inventory)

| 欄位名                | 資料型態      | 說明                                     |
|----------------------|---------------|----------------------------------------|
| inventory_id         | INT           | 庫存ID，唯一識別庫存的主鍵                    |
| product_id           | INT           | 產品ID，與產品表關聯的外鍵，識別庫存所屬的產品      |
| product_type_id      | INT           | 產品類型ID，與產品類型表關聯的外鍵，用於指示產品的類型  |
| color_id             | INT           | 顏色ID，與產品顏色表關聯的外鍵，用於指示產品的顏色                    |
| available_quantity   | INT           | 可用數量，表示產品的可用庫存數量                |
| sold_quantity        | INT           | 已銷售數量，表示已經銷售出去的產品數量           |
| remaining_quantity   | INT           | 剩餘數量，表示剩餘的產品庫存數量                |
| created_at           | TIMESTAMP     | 建立時間                                   |
| updated_at           | TIMESTAMP     | 更新時間                                   |
| deleted_at           | TIMESTAMP     | 刪除時間（可選）                              |

##### 備註：產品頁面上無顯示庫存，這是我增加的需求，每個產品有多個顏色，每個顏色都對應產品庫存表
