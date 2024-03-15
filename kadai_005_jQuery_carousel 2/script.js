$(function(){
  $('.button-more').on('mouseover',function(){
    $(this).animate({
      opacity:0.5,
      marginLeft:20,
    },100);
  });
  
  $('.button-more').on('mouseout',function(){
    $(this).animate({
      marginLeft:0,
      opacity:1.0,
    },100);
  })
});

// カルーセル
$('.carousel').slick({
  autoplay:true,
  dots:true,
  indinite:true,
  autoplaySpeed:5000,
  arrows:false,
});

// AjaxでStatic formsにデータ送信
$('#submit').on('click',function(event){
  // formタグによる送信拒否
  event.preventDefault();
  // 入力チェックをした後、エラーがあるかないか判定
  let result = inputCheck();
});

// フォーカスが外れた時(=blurイベント)にフォームの入力をチェックする
$('#name').blur(function(){
  // console.log('blur');
  inputCheck();
});
$('#furigana').blur(function(){
  inputCheck();
});
$('#email').blur(function(){
  inputCheck();
});
$('#tel').blur(function(){
  inputCheck();
});
$('#message').blur(function(){
  inputCheck();
});
// 同意クリックイベント
$('#agree').click(function(){
  inputCheck();
});

// お問い合わせフォームの入力チェック
function inputCheck(){
  console.log('inputCheck関数の呼び出し');

  // エラーチェックの結果
  let result;

  // エラーメッセージテキスト
  let message = '';

  // エラーがない＝false, ある＝true
  let error = false;

  // 名前欄が空欄の時
  if($('#name').val()=''){
    // エラーがある時
    error=true;
    //エラーが発生している宣言
    $('#name').css('background-color','#f79999');
    //フォームを赤にする
    
    message+='お名前を入力してください。\n';
    //エラーメッセージを出力する
    } else {
    // エラーがない時
    $('#name').css('background-color','#fafafa');
  }
  

  if($('#furigana').val()==''){
    $('#furigana').css('background-color','#f79999');
    error=true;
    message+='フリガナを入力してください\n';
  } else {
    $('#furigana').css('background-color','#fafafa');
  }

  if($('#message').val()==''){
    $('#message').css('background-color','#f79999');
    error=true;
    message+='お問い合わせ内容を入力してください\n';
    } else {
    $('#message').css('background-color','#fafafa');
  }

  if($('#email').val()='' || $('#email').val().indexOf('@')== -1 || $('#email').val().indexOf('.')==-1) {
    $('#email').css('background-color','#f79999');
    error=true;
    message+='メールアドレスが未記入、または@.が含まれていません。\n';
    } else {
    $('#email').css('background-color','#fafafa');
  }
  }
};