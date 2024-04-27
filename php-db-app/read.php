<?php
//DBの接続
$dsn = 'mysql:dbname=php-db-app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';


try{
  $pdo = new PDO($dsn, $user, $password);
  //orderパラメータの値が存在すれば（並び替えボタンを押したとき）、
  // その値を変数$orderに代入する
  if(isset($_GET['order'])){
    $order = $_GET['order'];
  }else{
    $order = NULL;//orderパラメータの値が存在しない場合は、変数$orderにNULLを代入する
  }
  // 変数$orderの値が'desc'のとき：更新日時順（降順）で並び替える
  // 変数$orderの値がそれ以外のとき：更新日時順（昇順）で並び替える
  if($order === 'asc'){
    $sql_select = 'SELECT * FROM products WHERE product_name LIKE :keyword ORDER BY updated_at ASC';
  }else{
    $sql_select = 'SELECT * FROM products WHERE product_name LIKE :keyword ORDER BY updated_at DESC';
  }

  if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
  }else{
    $keyword = NULL;
  }
  //SQL文を実行する
  $stmt_select = $pdo -> prepare($sql_select);

  //SQL文の曖昧検索
  $partial_match="%{$keyword}%";
  //bindValue()メソッドを使ってプレースホルダにバインドする
  $stmt_select ->bindValue(':keyword',$partial_match, PDO::PARAM_STR);
  //SQL文の実行
  $stmt_select->execute();
  //SQL文の実行結果を配列で取得する
  $products = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
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
  <title>商品一覧</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <nav>
      <a href="index.php">商品管理アプリ</a>
    </nav>
  </header>
  <main>
    <article class="products">
      <h1>商品一覧</h1>
      <?php 
      if(isset($_GET['message'])){
        echo "<p class='success'>{$_GET['message']}</p>";
      }
      ?>
      <div class="products-ui">
        <div>
          <a href="read.php?order=desc&keyword=<?= $keyword ?>">
            <img src="images/desc.png" alt="降順に並べ替え"class="sort-img">
          </a>
          <a href="read.php?order=asc$keyword=<?= $keyword ?>">
            <img src="images/asc.png" alt="昇順に並べ替え"class="sort-img">
          </a>
          <form action="read.php"method="get"class="search-form">
            <input type="hidden"name="order" value="<?= $order ?>">
            <input type="text"name="keyword"placeholder="商品名で検索"class="serch-box" value="<?= $keyword?>">
          </form>
          

        </div>
        <a href="create.php" class="btn">商品登録</a>
      </div>
      <table class="products-table">
        <tr>
          <th>商品コード</th>
          <th>商品名</th>
          <th>単価</th>
          <th>在庫数</th>
          <th>仕入れ先コード</th>
          <th>編集</th>
        </tr>
        <?php
        //  配列の中身を順番に取り出し、表形式で出力する
        foreach($products as $product){
          $table_row="
            <tr>
              <td>{$product['product_code']}</td>
              <td>{$product['product_name']}</td>
              <td>{$product['price']}</td>
              <td>{$product['stock_quantity']}</td>
              <td>{$product['vendor_code']}</td>
              <td><a href='update.php?id={$product['id']}'></a><img src='images/edit.png' alt='編集' class='edit-icon' width='20'height='20'</a></td>
            </tr>
          ";
          echo $table_row;
        }
        
        ?>
      </table>
      
      
    </article>
  </main>
  <footer>
    <p class="copyright">&copy;商品管理アプリAll rights reserved.</p>
  </footer>
    
</body>
</html>






