//canvas.js
// ｃａｎｖａｓの初期状態


function canvas(){
	//キャンバスの宣言
	var canvas01 = document.getElementById('canvas01');
	var canvas02 = document.getElementById('canvas02');

	
	// 先に述べたビットマップ上に描くために 2d context を取得する
	var ctx01  = canvas01.getContext('2d');
	var ctx02  = canvas02.getContext('2d');

	
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
};
