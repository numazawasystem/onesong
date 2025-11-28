//canvas.js
// ｃａｎｖａｓの初期状態


function canvas(){
	//キャンバスの宣言
	var canvas01 = document.getElementById('canvas01');
	var canvas02 = document.getElementById('canvas02');
	var canvas03 = document.getElementById('canvas03');
	var canvas04 = document.getElementById('canvas04');
	var canvas05 = document.getElementById('canvas05');
	var canvas06 = document.getElementById('canvas06');
	var canvas07 = document.getElementById('canvas07');
	var canvas08 = document.getElementById('canvas08');
	var canvas09 = document.getElementById('canvas09');
	var canvas10 = document.getElementById('canvas10');
	var canvas11 = document.getElementById('canvas11');
	var canvas12 = document.getElementById('canvas12');
	var canvas13 = document.getElementById('canvas13');
	var canvas14 = document.getElementById('canvas14');
	var canvas15 = document.getElementById('canvas15');
	var canvas16 = document.getElementById('canvas16');
	var canvas17 = document.getElementById('canvas17');
	var canvas18 = document.getElementById('canvas18');
	var canvas19 = document.getElementById('canvas19');
	var canvas20 = document.getElementById('canvas20');
	
	// 先に述べたビットマップ上に描くために 2d context を取得する
	var ctx01  = canvas01.getContext('2d');
	var ctx02  = canvas02.getContext('2d');
	var ctx03  = canvas03.getContext('2d');
	var ctx04  = canvas04.getContext('2d');
	var ctx05  = canvas05.getContext('2d');
	var ctx06  = canvas06.getContext('2d');
	var ctx07  = canvas07.getContext('2d');
	var ctx08  = canvas08.getContext('2d');
	var ctx09  = canvas09.getContext('2d');
	var ctx10  = canvas10.getContext('2d');
	var ctx11  = canvas11.getContext('2d');
	var ctx12  = canvas12.getContext('2d');
	var ctx13  = canvas13.getContext('2d');
	var ctx14  = canvas14.getContext('2d');
	var ctx15  = canvas15.getContext('2d');
	var ctx16  = canvas16.getContext('2d');
	var ctx17  = canvas17.getContext('2d');
	var ctx18  = canvas18.getContext('2d');
	var ctx19  = canvas19.getContext('2d');
	var ctx20  = canvas20.getContext('2d');
	
	//画像の配置01
	 /* Imageオブジェクトを生成 */
	  var img01 = new Image();
	  img01.src = "../images/upload/upload01.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img01.onload = function() {
		 /* 画像を描画 */
    	ctx01.drawImage(img01, 0, 0);
	}
	//画像の配置02
	 /* Imageオブジェクトを生成 */
	  var img02 = new Image();
	  img02.src = "../images/upload/upload02.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img02.onload = function() {
		 /* 画像を描画 */
    	ctx02.drawImage(img02, 0, 0);
	}
	//画像の配置03
	 /* Imageオブジェクトを生成 */
	  var img03 = new Image();
	  img03.src = "../images/upload/upload03.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img03.onload = function() {
		 /* 画像を描画 */
    	ctx03.drawImage(img03, 0, 0);
	}
	//画像の配置04
	 /* Imageオブジェクトを生成 */
	  var img04 = new Image();
	  img04.src = "../images/upload/upload04.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img04.onload = function() {
		 /* 画像を描画 */
    	ctx04.drawImage(img04, 0, 0);
	}
	//画像の配置05
	 /* Imageオブジェクトを生成 */
	  var img05 = new Image();
	  img05.src = "../images/upload/upload05.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img05.onload = function() {
		 /* 画像を描画 */
    	ctx05.drawImage(img05, 0, 0);
	}
	//画像の配置06
	 /* Imageオブジェクトを生成 */
	  var img06 = new Image();
	  img06.src = "../images/upload/upload06.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img06.onload = function() {
		 /* 画像を描画 */
    	ctx06.drawImage(img06, 0, 0);
	}
	//画像の配置07
	 /* Imageオブジェクトを生成 */
	  var img07 = new Image();
	  img07.src = "../images/upload/upload07.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img07.onload = function() {
		 /* 画像を描画 */
    	ctx07.drawImage(img07, 0, 0);
	}
	//画像の配置08
	 /* Imageオブジェクトを生成 */
	  var img08 = new Image();
	  img08.src = "../images/upload/upload08.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img08.onload = function() {
		 /* 画像を描画 */
    	ctx08.drawImage(img08, 0, 0);
	}
	//画像の配置09
	 /* Imageオブジェクトを生成 */
	  var img09 = new Image();
	  img09.src = "../images/upload/upload09.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img09.onload = function() {
		 /* 画像を描画 */
    	ctx09.drawImage(img09, 0, 0);
	}
	//画像の配置10
	 /* Imageオブジェクトを生成 */
	  var img10 = new Image();
	  img10.src = "../images/upload/upload10.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img10.onload = function() {
		 /* 画像を描画 */
    	ctx10.drawImage(img10, 0, 0);
	}
	//画像の配置11
	 /* Imageオブジェクトを生成 */
	  var img11 = new Image();
	  img11.src = "../images/upload/upload11.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img11.onload = function() {
		 /* 画像を描画 */
    	ctx11.drawImage(img11, 0, 0);
	}
	//画像の配置12
	 /* Imageオブジェクトを生成 */
	  var img12 = new Image();
	  img12.src = "../images/upload/upload12.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img12.onload = function() {
		 /* 画像を描画 */
    	ctx12.drawImage(img12, 0, 0);
	}
	//画像の配置13
	 /* Imageオブジェクトを生成 */
	  var img13 = new Image();
	  img13.src = "../images/upload/upload13.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img13.onload = function() {
		 /* 画像を描画 */
    	ctx13.drawImage(img13, 0, 0);
	}
	//画像の配置14
	 /* Imageオブジェクトを生成 */
	  var img14 = new Image();
	  img14.src = "../images/upload/upload14.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img14.onload = function() {
		 /* 画像を描画 */
    	ctx14.drawImage(img14, 0, 0);
	}
	//画像の配置15
	 /* Imageオブジェクトを生成 */
	  var img15 = new Image();
	  img15.src = "../images/upload/upload15.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img15.onload = function() {
		 /* 画像を描画 */
    	ctx15.drawImage(img15, 0, 0);
	}
	//画像の配置16
	 /* Imageオブジェクトを生成 */
	  var img16 = new Image();
	  img16.src = "../images/upload/upload16.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img16.onload = function() {
		 /* 画像を描画 */
    	ctx16.drawImage(img16, 0, 0);
	}
	//画像の配置17
	 /* Imageオブジェクトを生成 */
	  var img17 = new Image();
	  img17.src = "../images/upload/upload17.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img17.onload = function() {
		 /* 画像を描画 */
    	ctx17.drawImage(img17, 0, 0);
	}
	//画像の配置18
	 /* Imageオブジェクトを生成 */
	  var img18 = new Image();
	  img18.src = "../images/upload/upload18.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img18.onload = function() {
		 /* 画像を描画 */
    	ctx18.drawImage(img18, 0, 0);
	}
	//画像の配置19
	 /* Imageオブジェクトを生成 */
	  var img19 = new Image();
	  img19.src = "../images/upload/upload19.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img19.onload = function() {
		 /* 画像を描画 */
    	ctx19.drawImage(img19, 0, 0);
	}
	//画像の配置20
	 /* Imageオブジェクトを生成 */
	  var img20 = new Image();
	  img20.src = "../images/upload/upload20.jpg";
	/* 画像が読み込まれるのを待ってから処理を続行 */
	img20.onload = function() {
		 /* 画像を描画 */
    	ctx20.drawImage(img20, 0, 0);
	}
};
