<?php
//DBの接続
$dsn = 'mysql:dbname=php-db-app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

if(isset($_POST['submit'])){
  try{
      $pdo = new PDO($dsn, $user, $password);
      
      // prepare()メソッドや変数$_POSTの値を使ってINSERT文を実行する
      $sql_insert = 'INSERT INTO products(product_code,product_name, price, stock_quantity,vendor_code)
      VALUES(:product_code,:product_name, :price, :stock_quantity,:vendor_code)';
      
      //SQL文を実行する
      $stmt_insert = $pdo -> prepare($sql_insert);
      //bindValue()メソッドを使って実際の値をプレースホルダにバインドする
      $stmt_insert->bindValue(':product_name',$_POST['product_name'],PDO::PARAM_STR);
      $stmt_insert->bindValue(':product_code',$_POST['product_code'],PDO::PARAM_INT);
      $stmt_insert->bindValue(':price',$_POST['price'],PDO::PARAM_INT);
      $stmt_insert->bindValue(':stock_quantity',$_POST['stock_quantity'],PDO::PARAM_INT);
      $stmt_insert->bindValue(':vendor_code',$_POST['vendor_code'],PDO::PARAM_INT);

      //SQL文の実行
      $stmt_insert->execute();

      //追加した件数を取得する
      $count = $stmt_insert->rowCount();
      $message = "商品を{$count}件登録しました";

      //商品一覧ページにリダイレクト
      header("Location:read.php?message={$message}");
    }catch(PDOException $e){
      exit($e->getMessage());
    }
}
//セレクトボックスの選択肢として
// 設定するため、仕入れ先コードの配列を取得する
try{
  $pdo = new PDO($dsn, $user, $password);
  $sql_select = 'SELECT vendor_code FROM vendors';
  $stmt_select = $pdo->query($sql_select);
  //SQL文の実行結果を配列で取得する
  $vendor_codes = $stmt_select->fetchAll(PDO::FETCH_COLUMN);
}catch(PDOException $e){
  exit($e->getMessage());
}  
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
      <h1>商品登録</h1>
      <div class="back">
        <a href="read.php"class="btn">戻る</a>
      </div>
      <form action="create.php"class="registration-form"method="post">
          <div>
            <label for="product_code">商品コード</label>
            <input type="number"id="product_code"name="product_code"min="0" max="100000000" required >

            <label for="product_name">商品名</label>
            <input type="text"id="product_name"name="product_name" maxlength="50"required>

            <label for="price">単価</label>
            <input type="number"id="price"name="price" max="100000000" min="0"required>

            <label for="stock_quantity">在庫数</label>
            <input type="number"id="stock_quantity"name="stock_quantity" max="100000000" min="0"required>

            <label for="vendor_code">仕入れ先コード</label>
            <select id="vendor_code"name="vendor_code" required>
              <option value="">選択してください</option>
              <?php 
                foreach ($vendor_codes as $vendor_code){
                  echo "<option value ='{$vendor_code}'>{$vendor_code}</option>";
                }
              ?>
            </select>
          </div>
          
          <button type ="submit"class="submit-btn"name="submit"value="create">登録</button>
          
        
      </form>
    </article>
    
  </main>
  

  <footer>
    <p class="copyright">&copy;商品管理アプリAll rights reserved.</p>
  </footer>
</body>
</html>