<?php
//DBの接続
$dsn = 'mysql:dbname=php-db-app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

//idパラメータの値があれば処理を行う
if(isset($_GET['id'])){
  try{    
      $pdo = new PDO($dsn, $user, $password);
      //idカラムの値をプレースホルダ(:id)に置き換えたSQL文をあらかじめ用意する
      //ProductsテーブルのどのID
      $sql_select_product='SELECT * FROM products WHERE id =:id';

      $stmt_select_product = $pdo->prepare($sql_select_product);

      // bindValue()メソッドを使い、受け取った商品のid（$_GET['id']）をプレースホルダ（:id）にバインドする
      $stmt_select_product->bindValue(':id',$_GET['id'],PDO::PARAM_INT);

      //SQL文を実行する
      $stmt_select_product->execute();
      //SQL実行結果をfetch()メソッドで取得する
      $product = $stmt_select_product->fetchAll(PDO::FETCH_ASSOC);

      if($product === FALSE){
        exit('idパラメータの値が不正です');
      }
      //vendorテーブルからVendor_codeカラムのデータを取得するために
      // SQL文を変数$sql_select_vendor_codesに代入する
      $sql_select_vendor_codes='SELECT vendor_code FROM vendors';
      $stmt_select_vendor_codes=$pdo->query($sql_select_vendor_codes);
      $vendor_codes = $stmt_select_vendor_codes->fetchAll(PDO::FETCH_COLUMN);
  }catch(PDOException $e){
    exit($e->getMessage());
  }
}else{
  exit('idパラメータの値が存在しません');
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>商品編集</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <nav>
      <a href="index.php">商品管理アプリ</a>
    </nav>
  </header>
  <main>
    <article class="registration">
      <h1>商品編集</h1>
      <div class="back">
        <a href="read.php"class="btn">戻る</a>
      </div>
      <form action="update.php?id=<?= $_GET['id']?>"class="registration-form"method="post">
          <div>
            <label for="product_code">商品コード</label>
            <input type="value"id="product_code"name="product_code"value="<?= $product['product_code']?>"min="0" max="100000000" required >

            <label for="product_name">商品名</label>
            <input type="value"id="product_name"name="product_name"value="<?= $product['product_name']?>"maxlength="50"required>

            <label for="price">単価</label>
            <input type="value"id="price"name="price"value="<?= $product['price']?>" max="100000000" min="0"required>

            <label for="stock_quantity">在庫数</label>
            <input type="value"id="stock_quantity"name="stock_quantity"value="<?= $product['stock_quantity']?>"max="100000000" min="0"required>

            <label for="vendor_code">仕入れ先コード</label>
            <select id="vendor_code"name="vendor_code"required>
              <option value="">選択してください</option>
              <?php 
                foreach ($vendor_codes as $vendor_code){
                  if($vendor_code === $product['vendor_code']){
                    echo "<option value = '{$vendor_code}'selected>{$vendor_code}</option>";
                  }else{
                    echo "<option value = '{$vendor_code}'>{$vendor_code}</option>";
                  }
                  
                }
              ?>
            </select>
          </div>
          
          <button type ="submit"class="submit-btn"name="submit"value="update">更新</button>
          
        
      </form>
    </article>
    
  </main>
  

  <footer>
    <p class="copyright">&copy;商品管理アプリAll rights reserved.</p>
  </footer>
</body>
</html>