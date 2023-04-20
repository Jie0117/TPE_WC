**系統目標**

這個app是幫助一些去台北觀光臨時要上廁所，但是卻對當地環境不熟悉，無法找到最近的廁所，或是外送人員在工作期間突然想上廁所，都可以使用本app找到離自己最近的廁所距離，甚至可以連到google map導航，還可以看到廁所評價，或是是否故障，使用完畢後可以對廁所進行評分，以及發現廁所故障，可以協助報修。

1\.獲取使用者定位，並可以連到google map導航

2\.能夠看到廁所平均分數

3\.可以看到廁所分類

4\.有完善的報修系統

5\.下拉式選單，方便使用者跟管理者挑選

6\.可以輕鬆找尋附近廁所

7\.可以按照關鍵字搜尋相關廁所

**採用的開放資料表**

綠網之臺北市建檔公廁明細資料(政府資料開放平台)

**使用的程式語言與開發工具**

程式語言:Java,PHP,xml

開發工具:Android Studio,MySQL, AWS








**ERD的說明**

![](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.001.jpeg)

在最一開始的資料中Administration type type2  section Village 都是合併在Toilet的資料項目，由於Administration type type2 section village grade的資料項目有很多重複且皆完全相依於toilet的主鍵（To\_ID），固將這些欄位拉出來做第二正規化，而section資料的重複是完全相依於Village，跟主鍵是屬於遞移相依的關係（一個Village會對應到一個section)，故做第三正規化








**使用者介面**

![](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.002.jpeg)

開始畫面:點擊中間的logo便可以進到下個畫面囉!

![](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.003.jpeg)

註冊頁面:沒有帳號密碼，就可以直接在這裡註冊喔!如果已經有了就按下面you have account click here to login page進到登入頁面。

![](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.004.jpeg)

登入頁面:直接輸入帳號密碼便可以直接進去應用程式囉!若是還沒有帳號密碼就按下面的No account? Sign up here進入註冊頁面重新註冊。

![一張含有 地圖 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.005.jpeg)

主頁面:可以篩選廁所的類別，而且可以離自己有多遠(單位:m)，有定位知道自己目前得位置，可以點擊下方任一廁所入到廁所資訊。


![一張含有 桌 的圖自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.006.jpeg)

廁所資訊:可以看到廁所的基本資料，可以知道廁所評分多少並且可以按「評分」到評分頁面，還可以看到目前是否可以使用有無故障或是按「報修」到報修頁面，按「去這裡」連結google map進行廁所導航。

![一張含有 地圖 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.007.jpeg)

Google map:從廁所資訊會跳到google map，這裡可以直接幫使用者定位並且導航至使用者想去的廁所。

![一張含有 文字 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.008.jpeg)

評分頁面:在這裡可以對廁所進行評分，0.5分為一個單位，分數會傳到資料庫，並且平均後會重新傳到廁所資訊，給使用者參考。

![](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.009.jpeg)

報修頁面:可以在這裡簡述廁所哪裡故障，會傳給管理者看到，而當成工發送報修，這間廁所的報修數量就會加一，並顯示在廁所資訊頁面。



**管理者介面**

![一張含有 文字 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.010.jpeg)

廁所資訊:可以看到一間廁所所有的資訊，下面三個按鈕都可以做使用。

![一張含有 文字 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.011.jpeg)

篩選頁面:可以使用下拉式選單選出想要的里和區，然後也可以使用關鍵字搜尋廁所，按「新增」可以跳到新增頁面，按「報修」可以看到報修頁面。



![一張含有 文字 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.012.jpeg)

報修頁面(2):這裡是一間廁所的所有報修資訊，可以在這裡一次選一個或是一次選多個刪除，比如說修好了，或是使用者亂按報修，我們都能從這裏把報修資訊做刪除。

![一張含有 文字, 桌 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.013.jpeg)

新增頁面:動態的下拉式選單，可以簡單的選種哪個區哪個里，方便管理者做新增廁所。

![一張含有 文字 的圖片自動產生的描述](https://github.com/Jie0117/TPE_WC/blob/main/img/Aspose.Words.d64ce0d0-2000-4d29-b308-4597e9a21725.014.jpeg)

報修頁面(1):會跳出所有報修的訊息，可以讓管理者一次看到所有報修資訊。

