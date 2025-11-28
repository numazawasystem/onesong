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
		console.log("6");
		let string = this.response;
		console.log(string);
		
		console.log("変換スタート");
		document.getElementById("canvas01-h").value = cvs01.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas02-h").value = cvs02.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas03-h").value = cvs03.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas04-h").value = cvs04.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas05-h").value = cvs05.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas06-h").value = cvs06.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas07-h").value = cvs07.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas08-h").value = cvs08.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas09-h").value = cvs09.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas10-h").value = cvs10.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas11-h").value = cvs11.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas12-h").value = cvs12.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas13-h").value = cvs13.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas14-h").value = cvs14.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas15-h").value = cvs15.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas16-h").value = cvs16.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas17-h").value = cvs17.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas18-h").value = cvs18.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas19-h").value = cvs19.toDataURL("image/jpeg", 1.0);
		document.getElementById("canvas20-h").value = cvs20.toDataURL("image/jpeg", 1.0);
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
				
				let xhr03 = new XMLHttpRequest();
				const fd03 = new FormData();
				xhr03.open('POST', '../upload/upload3.php', true);
				fd03.append('id', string);
				fd03.append('no', '3');
				fd03.append('canvas03-h', document.getElementById("canvas03-h").value);
				xhr03.send(fd03);
				xhr03.addEventListener('load', function () {
					console.log(this.response);
					
					let xhr04 = new XMLHttpRequest();
					const fd04 = new FormData();
					xhr04.open('POST', '../upload/upload3.php', true);
					fd04.append('id', string);
					fd04.append('no', '4');
					fd04.append('canvas04-h', document.getElementById("canvas04-h").value);
					xhr04.send(fd04);
					xhr04.addEventListener('load', function () {
						console.log(this.response);
						
						let xhr05 = new XMLHttpRequest();
						const fd05 = new FormData();
						xhr05.open('POST', '../upload/upload3.php', true);
						fd05.append('id', string);
						fd05.append('no', '5');
						fd05.append('canvas05-h', document.getElementById("canvas05-h").value);
						xhr05.send(fd05);
						xhr05.addEventListener('load', function () {
							console.log(this.response);
							
							let xhr06 = new XMLHttpRequest();
							const fd06 = new FormData();
							xhr06.open('POST', '../upload/upload3.php', true);
							fd06.append('id', string);
							fd06.append('no', '6');
							fd06.append('canvas06-h', document.getElementById("canvas06-h").value);
							xhr06.send(fd06);
							xhr06.addEventListener('load', function () {
								console.log(this.response);
								
								let xhr07 = new XMLHttpRequest();
								const fd07 = new FormData();
								xhr07.open('POST', '../upload/upload3.php', true);
								fd07.append('id', string);
								fd07.append('no', '7');
								fd07.append('canvas07-h', document.getElementById("canvas07-h").value);
								xhr07.send(fd07);
								xhr07.addEventListener('load', function () {
									console.log(this.response);
									
									let xhr08 = new XMLHttpRequest();
									const fd08 = new FormData();
									xhr08.open('POST', '../upload/upload3.php', true);
									fd08.append('id', string);
									fd08.append('no', '8');
									fd08.append('canvas08-h', document.getElementById("canvas08-h").value);
									xhr08.send(fd08);
									xhr08.addEventListener('load', function () {
										console.log(this.response);
											
										let xhr09 = new XMLHttpRequest();
										const fd09 = new FormData();
										xhr09.open('POST', '../upload/upload3.php', true);
										fd09.append('id', string);
										fd09.append('no', '9');
										fd09.append('canvas09-h', document.getElementById("canvas09-h").value);
										xhr09.send(fd09);
										xhr09.addEventListener('load', function () {
												console.log(this.response);
												
												let xhr10 = new XMLHttpRequest();
												const fd10 = new FormData();
												xhr10.open('POST', '../upload/upload3.php', true);
												fd10.append('id', string);
												fd10.append('no', '10');
												fd10.append('canvas10-h', document.getElementById("canvas10-h").value);
												xhr10.send(fd10);
												xhr10.addEventListener('load', function () {
													console.log(this.response);
													
													let xhr11 = new XMLHttpRequest();
													const fd11 = new FormData();
													xhr11.open('POST', '../upload/upload3.php', true);
													fd11.append('id', string);
													fd11.append('no', '11');
													fd11.append('canvas11-h', document.getElementById("canvas11-h").value);
													xhr11.send(fd11);
													xhr11.addEventListener('load', function () {
														console.log(this.response);
														
														let xhr12 = new XMLHttpRequest();
														const fd12 = new FormData();
														xhr12.open('POST', '../upload/upload3.php', true);
														fd12.append('id', string);
														fd12.append('no', '12');
														fd12.append('canvas12-h', document.getElementById("canvas12-h").value);
														xhr12.send(fd12);
														xhr12.addEventListener('load', function () {
															console.log(this.response);
															
															let xhr13 = new XMLHttpRequest();
															const fd13 = new FormData();
															xhr13.open('POST', '../upload/upload3.php', true);
															fd13.append('id', string);
															fd13.append('no', '13');
															fd13.append('canvas13-h', document.getElementById("canvas13-h").value);
															xhr13.send(fd13);
															xhr13.addEventListener('load', function () {
																console.log(this.response);
																
																let xhr14 = new XMLHttpRequest();
																const fd14 = new FormData();
																xhr14.open('POST', '../upload/upload3.php', true);
																fd14.append('id', string);
																fd14.append('no', '14');
																fd14.append('canvas14-h', document.getElementById("canvas14-h").value);
																xhr14.send(fd14);
																xhr14.addEventListener('load', function () {
																	console.log(this.response);
																	
																	let xhr15 = new XMLHttpRequest();
																	const fd15 = new FormData();
																	xhr15.open('POST', '../upload/upload3.php', true);
																	fd15.append('id', string);
																	fd15.append('no', '15');
																	fd15.append('canvas15-h', document.getElementById("canvas15-h").value);
																	xhr15.send(fd15);
																	xhr15.addEventListener('load', function () {
																		console.log(this.response);
																		
																		let xhr16 = new XMLHttpRequest();
																		const fd16 = new FormData();
																		xhr16.open('POST', '../upload/upload3.php', true);
																		fd16.append('id', string);
																		fd16.append('no', '16');
																		fd16.append('canvas16-h', document.getElementById("canvas16-h").value);
																		xhr16.send(fd16);
																		xhr16.addEventListener('load', function () {
																			console.log(this.response);
																			
																			let xhr17 = new XMLHttpRequest();
																			const fd17 = new FormData();
																			xhr17.open('POST', '../upload/upload3.php', true);
																			fd17.append('id', string);
																			fd17.append('no', '17');
																			fd17.append('canvas17-h', document.getElementById("canvas17-h").value);
																			xhr17.send(fd17);
																			xhr17.addEventListener('load', function () {
																				console.log(this.response);
																				
																				let xhr18 = new XMLHttpRequest();
																				const fd18 = new FormData();
																				xhr18.open('POST', '../upload/upload3.php', true);
																				fd18.append('id', string);
																				fd18.append('no', '18');
																				fd18.append('canvas18-h', document.getElementById("canvas18-h").value);
																				xhr18.send(fd18);
																				xhr18.addEventListener('load', function () {
																					console.log(this.response);
																					
																					let xhr19 = new XMLHttpRequest();
																					const fd19 = new FormData();
																					xhr19.open('POST', '../upload/upload3.php', true);
																					fd19.append('id', string);
																					fd19.append('no', '19');
																					fd19.append('canvas19-h', document.getElementById("canvas19-h").value);
																					xhr19.send(fd19);
																					xhr19.addEventListener('load', function () {
																						console.log(this.response);
																						
																						let xhr20 = new XMLHttpRequest();
																						const fd20 = new FormData();
																						xhr20.open('POST', '../upload/upload3.php', true);
																						fd20.append('id', string);
																						fd20.append('no', '20');
																						fd20.append('canvas20-h', document.getElementById("canvas20-h").value);
																						xhr20.send(fd20);
																						xhr20.addEventListener('load', function () {
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
																											
																											let xhr03d = new XMLHttpRequest();
																											const fd03d = new FormData();
																											xhr03d.open('POST', '../upload/upload4.php', true);
																											fd03d.append('id', string);
																											fd03d.append('no', '3');
																											fd03d.append('photo2-03' , data03.files[0]);
																											xhr03d.send(fd03d);
																											xhr03d.addEventListener('load', function () {
																												console.log(this.response);
																												
																												let xhr04d = new XMLHttpRequest();
																												const fd04d = new FormData();
																												xhr04d.open('POST', '../upload/upload4.php', true);
																												fd04d.append('id', string);
																												fd04d.append('no', '4');
																												fd04d.append('photo2-04' , data04.files[0]);
																												xhr04d.send(fd04d);
																												xhr04d.addEventListener('load', function () {
																													console.log(this.response);
																													
																													let xhr05d = new XMLHttpRequest();
																													const fd05d = new FormData();
																													xhr05d.open('POST', '../upload/upload4.php', true);
																													fd05d.append('id', string);
																													fd05d.append('no', '5');
																													fd05d.append('photo2-05' , data05.files[0]);
																													xhr05d.send(fd05d);
																													xhr05d.addEventListener('load', function () {
																														console.log(this.response);
																														
																														let xhr06d = new XMLHttpRequest();
																														const fd06d = new FormData();
																														xhr06d.open('POST', '../upload/upload4.php', true);
																														fd06d.append('id', string);
																														fd06d.append('no', '6');
																														fd06d.append('photo2-06' , data06.files[0]);
																														xhr06d.send(fd06d);
																														xhr06d.addEventListener('load', function () {
																															console.log(this.response);
																															
																															let xhr07d = new XMLHttpRequest();
																															const fd07d = new FormData();
																															xhr07d.open('POST', '../upload/upload4.php', true);
																															fd07d.append('id', string);
																															fd07d.append('no', '7');
																															fd07d.append('photo2-07' , data07.files[0]);
																															xhr07d.send(fd07d);
																															xhr07d.addEventListener('load', function () {
																																console.log(this.response);
																																
																																let xhr08d = new XMLHttpRequest();
																																const fd08d = new FormData();
																																xhr08d.open('POST', '../upload/upload4.php', true);
																																fd08d.append('id', string);
																																fd08d.append('no', '8');
																																fd08d.append('photo2-08' , data08.files[0]);
																																xhr08d.send(fd08d);
																																xhr08d.addEventListener('load', function () {
																																	console.log(this.response);
																																	
																																	let xhr09d = new XMLHttpRequest();
																																	const fd09d = new FormData();
																																	xhr09d.open('POST', '../upload/upload4.php', true);
																																	fd09d.append('id', string);
																																	fd09d.append('no', '9');
																																	fd09d.append('photo2-09' , data09.files[0]);
																																	xhr09d.send(fd09d);
																																	xhr09d.addEventListener('load', function () {
																																		console.log(this.response);
																																		
																																		let xhr10d = new XMLHttpRequest();
																																		const fd10d = new FormData();
																																		xhr10d.open('POST', '../upload/upload4.php', true);
																																		fd10d.append('id', string);
																																		fd10d.append('no', '10');
																																		fd10d.append('photo2-10' , data10.files[0]);
																																		xhr10d.send(fd10d);
																																		xhr10d.addEventListener('load', function () {
																																			console.log(this.response);
																																			
																																			let xhr11d = new XMLHttpRequest();
																																			const fd11d = new FormData();
																																			xhr11d.open('POST', '../upload/upload4.php', true);
																																			fd11d.append('id', string);
																																			fd11d.append('no', '11');
																																			fd11d.append('photo2-11' , data11.files[0]);
																																			xhr11d.send(fd11d);
																																			xhr11d.addEventListener('load', function () {
																																				console.log(this.response);
																																				
																																				let xhr12d = new XMLHttpRequest();
																																				const fd12d = new FormData();
																																				xhr12d.open('POST', '../upload/upload4.php', true);
																																				fd12d.append('id', string);
																																				fd12d.append('no', '12');
																																				fd12d.append('photo2-12' , data12.files[0]);
																																				xhr12d.send(fd12d);
																																				xhr12d.addEventListener('load', function () {
																																					console.log(this.response);
																																					
																																					let xhr13d = new XMLHttpRequest();
																																					const fd13d = new FormData();
																																					xhr13d.open('POST', '../upload/upload4.php', true);
																																					fd13d.append('id', string);
																																					fd13d.append('no', '13');
																																					fd13d.append('photo2-13' , data13.files[0]);
																																					xhr13d.send(fd13d);
																																					xhr13d.addEventListener('load', function () {
																																						console.log(this.response);
																																						
																																						let xhr14d = new XMLHttpRequest();
																																						const fd14d = new FormData();
																																						xhr14d.open('POST', '../upload/upload4.php', true);
																																						fd14d.append('id', string);
																																						fd14d.append('no', '14');
																																						fd14d.append('photo2-14' , data14.files[0]);
																																						xhr14d.send(fd14d);
																																						xhr14d.addEventListener('load', function () {
																																							console.log(this.response);
																																							
																																							let xhr15d = new XMLHttpRequest();
																																							const fd15d = new FormData();
																																							xhr15d.open('POST', '../upload/upload4.php', true);
																																							fd15d.append('id', string);
																																							fd15d.append('no', '15');
																																							fd15d.append('photo2-15' , data15.files[0]);
																																							xhr15d.send(fd15d);
																																							xhr15d.addEventListener('load', function () {
																																								console.log(this.response);
																																								
																																								let xhr16d = new XMLHttpRequest();
																																								const fd16d = new FormData();
																																								xhr16d.open('POST', '../upload/upload4.php', true);
																																								fd16d.append('id', string);
																																								fd16d.append('no', '16');
																																								fd16d.append('photo2-16' , data16.files[0]);
																																								xhr16d.send(fd16d);
																																								xhr16d.addEventListener('load', function () {
																																									console.log(this.response);
																																									
																																									let xhr17d = new XMLHttpRequest();
																																									const fd17d = new FormData();
																																									xhr17d.open('POST', '../upload/upload4.php', true);
																																									fd17d.append('id', string);
																																									fd17d.append('no', '17');
																																									fd17d.append('photo2-17' , data17.files[0]);
																																									xhr17d.send(fd17d);
																																									xhr17d.addEventListener('load', function () {
																																										console.log(this.response);
																																										
																																										let xhr18d = new XMLHttpRequest();
																																										const fd18d = new FormData();
																																										xhr18d.open('POST', '../upload/upload4.php', true);
																																										fd18d.append('id', string);
																																										fd18d.append('no', '18');
																																										fd18d.append('photo2-18' , data18.files[0]);
																																										xhr18d.send(fd18d);
																																										xhr18d.addEventListener('load', function () {
																																											console.log(this.response);
																																											
																																											let xhr19d = new XMLHttpRequest();
																																											const fd19d = new FormData();
																																											xhr19d.open('POST', '../upload/upload4.php', true);
																																											fd19d.append('id', string);
																																											fd19d.append('no', '19');
																																											fd19d.append('photo2-19' , data19.files[0]);
																																											xhr19d.send(fd19d);
																																											xhr19d.addEventListener('load', function () {
																																												console.log(this.response);
																																												
																																												let xhr20d = new XMLHttpRequest();
																																												const fd20d = new FormData();
																																												xhr20d.open('POST', '../upload/upload4.php', true);
																																												fd20d.append('id', string);
																																												fd20d.append('no', '20');
																																												fd20d.append('photo2-20' , data20.files[0]);
																																												xhr20d.send(fd20d);
																																												xhr20d.addEventListener('load', function () {
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
																																							});
																																						});
																																					});
																																				});
																																			});
																																		});
																																	});
																																});
																															});
																														});
																													});
																												});
																											});
																										});
																									});
																						});
																					});
																				});
																			});
																		});
																	});
																});
															});
														});
													});
												});
										});
									});
								});
							});
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
		document.getElementById("errtest").innerText = "※画面比率が入力されていません。";
	}else{
		run_process();
	}
		
});