// アニメーション（１）
// $(function(){
//   // // #fedaOutボタンを押したら
//   $('#fadeOut').on('click',function(){
//     // .boxがfadeOutする
//     $('.box').fadeOut();

//   // fadeOutするスピードを設定:3000ミリ秒
//   // fadeOutしたら、コールバック関数でアラートに表示させる
//         $('.box').fadeOut(3000,function(){
//           alert('fadeOut完了');
//         });

//   });
  
  
// });

// $(function(){
//   // #fadeInボタンを押したら
//   $('#fadeIn').on('click',function(){
//     // .box要素がfadeInする（時間設定なし）
//     $('.box').fadeIn();
//   });
// });

// $(function(){
//   // #fadeToggleボタンを押したら
//   $('#fadeToggle').on('click',function(){
//     // .box要素がfadeIn/fadeOut(時間設定：3000ミリ秒=3秒）を繰り返す
//     $('.box').fadeToggle(3000);
//   });
// });

// アニメーション(2):slideUp/slideDown/slideToggle
$(function(){
  $('#fadeIn').on('click',function(){
    $('.box').css('opacity',0);
  });

  $('#fadeOut').on('click',function(){
    $('.box').css('opacity',1);
  });

  $('#slideUp').on('click',function(){
   $('.box').css('height',0);
  });

  $('#slideDown').on('click',function(){
    $('.box').css('height',200);
  });

});

$(function(){
  
});


$(function(){
  
});

$(function(){
  
});

$(function(){
  $('#slideToggle').on('click',function(){

  });
});

