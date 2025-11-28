const cvs01 = document.getElementById("canvas01");
const cvs02 = document.getElementById("canvas02");

const data01 = document.getElementById("photo2-01");
const data02 = document.getElementById("photo2-02");


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
async function dtup(){
	console.log("基礎情報のアップロード");
	let xhr = new XMLHttpRequest();
	const fd = new FormData();
	xhr.open('POST', '../upload/upload2.php', true);
	fd.append('day', document.querySelector('input[name=day]').value);
	fd.append('title', document.querySelector('input[name=title]').value);
	fd.append('category', document.querySelector('select[name=category]').value);
	fd.append('situation', document.querySelector('select[name=situation]').value);
	
	xhr.send(fd);
	console.log("5");
	xhr.addEventListener('load', function () {
		let string = this.response;
		console.log(string);
		
		console.log("変換スタート");
		document.getElementById("canvas01-h").value = cvs01.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas02-h").value = cvs02.toDataURL("image/jpeg", 1.0);
		console.log("アップロードを始めます");
		
		let xhr01 = new XMLHttpRequest();
		const fd01 = new FormData();
		xhr01.open('POST', '../upload/upload3.php', true);
		fd01.append('id', string);
		fd01.append('no', '1');
		fd01.append('canvas01-h', document.getElementById("canvas01-h").value);
		xhr01.send(fd01);
		xhr01.addEventListener('load', function () {
			console.log(this.response);
			
			let xhr02 = new XMLHttpRequest();
			const fd02 = new FormData();
			xhr02.open('POST', '../upload/upload3.php', true);
			fd02.append('id', string);
			fd02.append('no', '2');
			fd02.append('canvas02-h', document.getElementById("canvas02-h").value);
			xhr02.send(fd02);
			xhr02.addEventListener('load', function () {
				console.log(this.response);
				
				let xhr01d = new XMLHttpRequest();
				const fd01d = new FormData();
				xhr01d.open('POST', '../upload/upload4.php', true);
				fd01d.append('id', string);
				fd01d.append('no', '1');
				fd01d.append('photo2-01' , data01.files[0]);
				xhr01d.send(fd01d);
				xhr01d.addEventListener('load', function () {
					console.log(this.response);
					
					let xhr02d = new XMLHttpRequest();
					const fd02d = new FormData();
					xhr02d.open('POST', '../upload/upload4.php', true);
					fd02d.append('id', string);
					fd02d.append('no', '2');
					fd02d.append('photo2-02' , data02.files[0]);
					xhr02d.send(fd02d);
					xhr02d.addEventListener('load', function () {
						console.log(this.response);
						
						let xhrmail = new XMLHttpRequest();
						const fdmail = new FormData();
						xhrmail.open('POST', `../upload/mail.php`, true);
						fdmail.append('id', string);
						xhrmail.send(fdmail);
						xhrmail.addEventListener('load', function () {
							console.log(this.response);
							sub();
						});
					});
				});
			});
		});
	});
	
	return true;
}
function sub(){
	console.log("ページを移転します");
	location.reload();
	return true;
}
async function run_process(){
	const m = await modalup();
	const d = await dtup();
	
}

document.form_main.btn.addEventListener('click', async function() {
	let text = document.getElementById("title").value;
	if(document.getElementById("title").value == ""){
		document.getElementById("errtest").innerText = "※タイトルが入力されていません。";
	}else if(text.length > 24){
		document.getElementById("errtest").innerText = "※タイトルは２４文字以内となります。";
	}else if(document.getElementById("category").value == "0"){
		document.getElementById("errtest").innerText = "※カテゴリーが入力されていません。";
	}else if(document.getElementById("situation").value == "0"){
		document.getElementById("errtest").innerText = "※内容指定が入力されていません。";
	}else{
		run_process();
	}
		
});