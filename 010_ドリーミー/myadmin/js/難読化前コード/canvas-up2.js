//canvas-up2.js
const cvs01 = document.getElementById("canvas01");
const cvs02 = document.getElementById("canvas02");
const cvs03 = document.getElementById("canvas03");
const cvs04 = document.getElementById("canvas04");
const cvs05 = document.getElementById("canvas05");
const cvs06 = document.getElementById("canvas06");
const cvs07 = document.getElementById("canvas07");
const cvs08 = document.getElementById("canvas08");
const cvs09 = document.getElementById("canvas09");
const cvs10 = document.getElementById("canvas10");
const cvs11 = document.getElementById("canvas11");
const cvs12 = document.getElementById("canvas12");
const cvs13 = document.getElementById("canvas13");
const cvs14 = document.getElementById("canvas14");
const cvs15 = document.getElementById("canvas15");
const cvs16 = document.getElementById("canvas16");
const cvs17 = document.getElementById("canvas17");
const cvs18 = document.getElementById("canvas18");
const cvs19 = document.getElementById("canvas19");
const cvs20 = document.getElementById("canvas20");

const data01 = document.getElementById("photo2-01");
const data02 = document.getElementById("photo2-02");
const data03 = document.getElementById("photo2-03");
const data04 = document.getElementById("photo2-04");
const data05 = document.getElementById("photo2-05");
const data06 = document.getElementById("photo2-06");
const data07 = document.getElementById("photo2-07");
const data08 = document.getElementById("photo2-08");
const data09 = document.getElementById("photo2-09");
const data10 = document.getElementById("photo2-10");
const data11 = document.getElementById("photo2-11");
const data12 = document.getElementById("photo2-12");
const data13 = document.getElementById("photo2-13");
const data14 = document.getElementById("photo2-14");
const data15 = document.getElementById("photo2-15");
const data16 = document.getElementById("photo2-16");
const data17 = document.getElementById("photo2-17");
const data18 = document.getElementById("photo2-18");
const data19 = document.getElementById("photo2-19");
const data20 = document.getElementById("photo2-20");

const pad2 = (n) => String(n).padStart(2, "0");
let __uploading = false;

async function postForm(url, fd, timeoutMs = 180000) {
  const controller = new AbortController();
  const t = setTimeout(() => controller.abort(), timeoutMs);

  try {
    const res = await fetch(url, { method: "POST", body: fd, signal: controller.signal });
    const text = await res.text();
    if (!res.ok) throw new Error(`HTTP ${res.status}: ${text}`);
    return text;
  } finally {
    clearTimeout(t);
  }
}

async function modalup(){
	var elem = document.getElementById("modal-text");
	const mask = document.getElementById('mask');
	const modal = document.getElementById('modal');
	mask.classList.remove('hidden');
	modal.classList.remove('hidden');
	console.log(modal.offsetWidth);
	elem.innerHTML = "画像を変換して送信中";
	console.log(elem.innerHTML);
	console.log(modal.offsetWidth);
	return true;
}

async function dtup() {
  const elem = document.getElementById("modal-text");

  // 1) 基礎情報 → id取得
  const fdBase = new FormData();
  fdBase.append("day", document.querySelector('input[name=day]').value);
  fdBase.append("title", document.querySelector('input[name=title]').value);
  fdBase.append("category", document.querySelector('select[name=category]').value);
  fdBase.append("situation", document.querySelector('select[name=situation]').value);

  elem.textContent = "基礎情報を送信中...";
  const idRaw = await postForm("../upload/upload2.php", fdBase, 60000);
  const id = String(idRaw).trim();
  if (!id) throw new Error("upload2.php の戻り値(id)が空です");

  // 2) canvas 20枚（1枚ずつ生成して送る）
  for (let no = 1; no <= 20; no++) {
    const canvas = document.getElementById(`canvas${pad2(no)}`);
    if (!canvas) throw new Error(`canvas${pad2(no)} が見つかりません`);

    // 品質 1.0 → 0.92（まずここから）
    const dataUrl = canvas.toDataURL("image/jpeg", 0.92);

    const fd = new FormData();
    fd.append("id", id);
    fd.append("no", String(no));

    // 旧キー（現行PHP互換）
    fd.append(`canvas${pad2(no)}-h`, dataUrl);
    // 新キー（堅牢版PHP互換：読めるなら読む）
    fd.append("canvas", dataUrl);

    elem.textContent = `縮小画像アップロード中 (${no}/20)`;
    await postForm("../upload/upload3.php", fd, 180000);
  }

  // 3) 元ファイル 20個
  for (let no = 1; no <= 20; no++) {
    const id2 = String(no).padStart(2, "0");
    const input = document.getElementById(`photo2-${id2}`);
    const file = input?.files?.[0];

    // ★重要：file が無い（=canvasに描いただけ）なら upload4 はスキップ
    if (!file) {
      console.log(`upload4 skip: photo2-${id2} (no file)`);
      continue;
    }

    const fd = new FormData();
    fd.append("id", id);
    fd.append("no", String(no));
    fd.append(`photo2-${id2}`, file);

    if (elem) elem.textContent = `元画像アップロード中 (${no}/20)`;
    await postForm("../upload/upload4.php", fd, 300000);
  }

  // 4) mail
  elem.textContent = "最終処理中...";
  const fdMail = new FormData();
  fdMail.append("id", id);
  await postForm("../upload/mail.php", fdMail, 60000);

  return true;
}


function sub(){
	console.log("ページを移転します");
	location.reload();
	return true;
}
async function run_process() {
  if (__uploading) return;
  __uploading = true;

  try {
    await modalup();
    await dtup();
    sub(); // 完了後にリロード
  } catch (e) {
    console.error(e);
    const elem = document.getElementById("modal-text");
    if (elem) elem.textContent = "送信エラー: " + (e?.message ?? e);
  } finally {
    __uploading = false;
  }
}

document.form_main.btn.addEventListener('click', async function (e) {
	e.preventDefault();
	let text = document.getElementById("title").value;
	if(document.getElementById("title").value == ""){
		document.getElementById("errtest").innerText = "※タイトルが入力されていません。";
	}else if(text.length > 24){
		document.getElementById("errtest").innerText = "※タイトルは２４文字以内となります。";
	}else if(document.getElementById("category").value == "0"){
		document.getElementById("errtest").innerText = "※カテゴリーが入力されていません。";
	}else if(document.getElementById("situation").value == "0"){
		document.getElementById("errtest").innerText = "※画面比率が入力されていません。";
	}else{
		run_process();
	}
		
});