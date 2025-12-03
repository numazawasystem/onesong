//canvas用フラグ
var array = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

// ドラッグ＆ドロップイベント発生時に実行する関数
function setListeners(event){
	// ブラウザ標準の動作をキャンセル
	event.preventDefault();
	
	// --------------------
	//	引数チェック
	// --------------------
	var file = event.dataTransfer.files[0];
	var eid = event.target.id.slice(-2);
		
	if(array[Number(eid)-1] == 0){
		// ファイルタイプ(MIME)で対応しているファイルか判定
		if (!file.type.match(/image\/\w+/)) {
			const id = String(eid).padStart(2, '0');
			const canvasId = "canvas" + id;

			// 初期画像でない（=すでに画像あり）なら拒否
			if (!isCanvasInInitialState(canvasId)) {
				return;
			}

			// 初期状態なら file input に非対応画像を代入
			const input = document.getElementById("photo2-" + id);
			if (input) {
				const dt = new DataTransfer();
				dt.items.add(file);
				input.files = dt.files;
				input.dispatchEvent(new Event("change"));
			}
			return;
		}

		// --------------------
		//	ファイル読み込み
		// --------------------
		var cve01 = event.target;
		if (cve01.getContext) {
			var ctx01 = cve01.getContext('2d');

			var img = new Image();
			var fr  = new FileReader();
			
			// 画像ファイル読み込み完了後に実行する処理
			fr.onload = function(evt) {
				// 画像読み込み完了後に実行する処理
				img.onload = function () {
					// canvasサイズを画像サイズに合わせて描画
					//横２００、縦自動計算でスタイルシートで強制縮小
					var wh = 200;
					var ht = (200 * img.naturalHeight)/img.naturalWidth;
					cve01.setAttribute('width',  img.naturalWidth);
					cve01.setAttribute('height', img.naturalHeight);
					// 描画
					ctx01.drawImage(img, 0, 0, img.naturalWidth, img.naturalHeight);
					cve01.style.width = wh + "px";
					cve01.style.height = ht + "px";
					
					var listX;
					var listY;
					var stx;
					var sty;
					// リスト用画像に転記
					//縦横200pxに変換縮小
					if(img.naturalWidth > img.naturalHeight){
						listX = 200;
						listY = (img.naturalHeight * 200)/img.naturalWidth;
						stx = 0;
						sty = (200/2) - (((img.naturalHeight * 200)/img.naturalWidth)/2);
					}else{
						listX = (img.naturalWidth * 200)/img.naturalHeight;
						listY = 200;
						stx = (200/2) - (((img.naturalWidth * 200)/img.naturalHeight)/2);
						sty = 0;
					}
					
					//アップロードしましたフラグ
					//document.getElementById('cs-ck').value = "1";

				}
				// Base64エンコードされた文字を画像のurlとしてsrcプロパティに渡す
				// すると、画像として表示される。
				img.src = evt.target.result;
				
				//その他の要素を使えなくする
				if (Number(eid) <= 21) {
					document.getElementById("photo2-" + eid + "S").style.background = "#808080";
					document.getElementById("photo2-" + eid.slice(-2)).style.visibility="hidden";
				}
				
			}
			
			// fileを読み込む データはBase64エンコードされる
			fr.readAsDataURL(file);
		}
	}
};
function setFile(event){
	//IDの抜き出し
	var eid = event.target.id.slice(-2);
	
	if(document.getElementById("photo2-" + eid).value)
	{
		//取り込んだことをわかりやすく背景を変更
		document.getElementById("photo2-" + eid + "S").style.background = "#ffd700 ";
		
		//canvasの差し替え
		var canvas = document.getElementById("canvas" + eid);
		var ctx  = canvas.getContext('2d');
		//画像の配置01
		 /* Imageオブジェクトを生成 */
		  var img = new Image();
		  img.src = "../images/upload/upload23.jpg";
		/* 画像が読み込まれるのを待ってから処理を続行 */
		img.onload = function() {
			 /* 画像を描画 */
	    	ctx.drawImage(img, 0, 0);
		}
		array.splice( Number(eid)-1, 1, '1');
	}else{
		//取り込んだことをわかりやすく背景を変更
		document.getElementById("photo2-" + eid + "S").style.background = "#e6e6fa";
		
		//canvasの差し替え
		var canvas = document.getElementById("canvas" + eid);
		var ctx  = canvas.getContext('2d');
		//画像の配置01
		 /* Imageオブジェクトを生成 */
		  var img = new Image();
		  img.src = "../images/upload/upload" + eid + ".jpg";
		/* 画像が読み込まれるのを待ってから処理を続行 */
		img.onload = function() {
			 /* 画像を描画 */
	    	ctx.drawImage(img, 0, 0);
		}
		array.splice( Number(eid)-1, 1, '0');
	}
}
function deletephoto(event){
	const eid = event.target.id.slice(-2);

	// -----------------------------
	// 対応画像（canvasに描画済）の削除
	// -----------------------------
	if(array[Number(eid)-1] == 0){
		const canvas = document.getElementById("canvas" + eid);
		const ctx  = canvas.getContext('2d');
		const img = new Image();
		img.src = "../images/upload/upload" + eid + ".jpg";
		img.onload = function() {
			canvas.setAttribute('width', 200);
			canvas.setAttribute('height', 200);
			ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.drawImage(img, 0, 0);
			canvas.style.width = "200px";
			canvas.style.height = "200px";
		};

		if (Number(eid) <= 21) {
			document.getElementById("photo2-" + eid + "S").style.background = "#e6e6fa";
			document.getElementById("photo2-" + eid.slice(-2)).style.visibility = "visible";
		}
	}

	// -----------------------------
	// 非対応画像（fileに入ってるだけ）の削除（どちらにしても実行）
	// -----------------------------
	const fileInput = document.getElementById("photo2-" + eid);
	if (fileInput && fileInput.files.length > 0) {
		const dt = new DataTransfer(); // 空にするためのDataTransfer
		fileInput.files = dt.files;

		// 手動で setFile を再実行（キャンバス初期化処理なども呼ばれる）
		fileInput.dispatchEvent(new Event("change"));

		// 念のため背景色も戻す（対応画像が消えたときと揃える）
		const fileArea = document.getElementById("photo2-" + eid + "S");
		if (fileArea) {
			fileArea.style.background = "#e6e6fa";
		}

		// フラグも未使用に戻す
		array.splice(Number(eid) - 1, 1, '0');
	}
}

function isCanvasInInitialState(canvasId) {
	const canvas = document.getElementById(canvasId);
	if (!canvas) return true;

	// 初期画像は常に 200x200 サイズで描画されている前提
	return canvas.width === 200 && canvas.height === 200;
}
// --------------------
//	イベントのリスナーを登録
// --------------------
document.getElementById("dragcs").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("dragcs").addEventListener('drop', function(event) { event.preventDefault();}, false);

document.getElementById("canvas01").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas01").addEventListener('drop',setListeners, false);
document.getElementById("canvas02").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas02").addEventListener('drop',setListeners, false);
document.getElementById("canvas03").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas03").addEventListener('drop',setListeners, false);
document.getElementById("canvas04").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas04").addEventListener('drop',setListeners, false);
document.getElementById("canvas05").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas05").addEventListener('drop',setListeners, false);
document.getElementById("canvas06").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas06").addEventListener('drop',setListeners, false);
document.getElementById("canvas07").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas07").addEventListener('drop',setListeners, false);
document.getElementById("canvas08").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas08").addEventListener('drop',setListeners, false);
document.getElementById("canvas09").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas09").addEventListener('drop',setListeners, false);
document.getElementById("canvas10").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas10").addEventListener('drop',setListeners, false);
document.getElementById("canvas11").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas11").addEventListener('drop',setListeners, false);
document.getElementById("canvas12").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas12").addEventListener('drop',setListeners, false);
document.getElementById("canvas13").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas13").addEventListener('drop',setListeners, false);
document.getElementById("canvas14").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas14").addEventListener('drop',setListeners, false);
document.getElementById("canvas15").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas15").addEventListener('drop',setListeners, false);
document.getElementById("canvas16").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas16").addEventListener('drop',setListeners, false);
document.getElementById("canvas17").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas17").addEventListener('drop',setListeners, false);
document.getElementById("canvas18").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas18").addEventListener('drop',setListeners, false);
document.getElementById("canvas19").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas19").addEventListener('drop',setListeners, false);
document.getElementById("canvas20").addEventListener('dragover', function(event) { event.preventDefault();}, false);
document.getElementById("canvas20").addEventListener('drop',setListeners, false);

document.getElementById("photo2-01").addEventListener("change", setFile, false);
document.getElementById("photo2-02").addEventListener("change", setFile, false);
document.getElementById("photo2-03").addEventListener("change", setFile, false);
document.getElementById("photo2-04").addEventListener("change", setFile, false);
document.getElementById("photo2-05").addEventListener("change", setFile, false);
document.getElementById("photo2-06").addEventListener("change", setFile, false);
document.getElementById("photo2-07").addEventListener("change", setFile, false);
document.getElementById("photo2-08").addEventListener("change", setFile, false);
document.getElementById("photo2-09").addEventListener("change", setFile, false);
document.getElementById("photo2-10").addEventListener("change", setFile, false);
document.getElementById("photo2-11").addEventListener("change", setFile, false);
document.getElementById("photo2-12").addEventListener("change", setFile, false);
document.getElementById("photo2-13").addEventListener("change", setFile, false);
document.getElementById("photo2-14").addEventListener("change", setFile, false);
document.getElementById("photo2-15").addEventListener("change", setFile, false);
document.getElementById("photo2-16").addEventListener("change", setFile, false);
document.getElementById("photo2-17").addEventListener("change", setFile, false);
document.getElementById("photo2-18").addEventListener("change", setFile, false);
document.getElementById("photo2-19").addEventListener("change", setFile, false);
document.getElementById("photo2-20").addEventListener("change", setFile, false);

//取り込んだ写真の削除のボタン
document.getElementById("delete01").addEventListener("click", deletephoto, false);
document.getElementById("delete02").addEventListener("click", deletephoto, false);
document.getElementById("delete03").addEventListener("click", deletephoto, false);
document.getElementById("delete04").addEventListener("click", deletephoto, false);
document.getElementById("delete05").addEventListener("click", deletephoto, false);
document.getElementById("delete06").addEventListener("click", deletephoto, false);
document.getElementById("delete07").addEventListener("click", deletephoto, false);
document.getElementById("delete08").addEventListener("click", deletephoto, false);
document.getElementById("delete09").addEventListener("click", deletephoto, false);
document.getElementById("delete10").addEventListener("click", deletephoto, false);
document.getElementById("delete11").addEventListener("click", deletephoto, false);
document.getElementById("delete12").addEventListener("click", deletephoto, false);
document.getElementById("delete13").addEventListener("click", deletephoto, false);
document.getElementById("delete14").addEventListener("click", deletephoto, false);
document.getElementById("delete15").addEventListener("click", deletephoto, false);
document.getElementById("delete16").addEventListener("click", deletephoto, false);
document.getElementById("delete17").addEventListener("click", deletephoto, false);
document.getElementById("delete18").addEventListener("click", deletephoto, false);
document.getElementById("delete19").addEventListener("click", deletephoto, false);
document.getElementById("delete20").addEventListener("click", deletephoto, false);
// --------------------
