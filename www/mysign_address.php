<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet" />
	<link href="a_css/common.css" rel="stylesheet" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
	


<script>
<!--
function gosave(){
	f = document.Frm;
	if(!f.address1.value){
		alert("기본주소를 입력해 주세요");
		f.address1.focus();
		return;
	}
	if(!f.address2.value){
		alert("상세주소를 입력해 주세요");
		f.address2.focus();
		return;
	}
	f.submit();
}
function findad() {
	new daum.Postcode({
		oncomplete: function(data) {
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
            fullAddr = data.roadAddress;

        } else { // 사용자가 지번 주소를 선택했을 경우(J)
            fullAddr = data.jibunAddress;
        }
		   // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				extraAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}
			document.Frm.mb_zip.value = data.zonecode;
			document.Frm.address1.value = fullAddr;
			document.Frm.address3.value = extraAddr;
			document.Frm.mb_addr_jibeon.value = data.userSelectedType;
			document.Frm.address2.focus();		
		}
	}).open();
}
//-->
</script>

</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>주소 변경</p>
		</div>
	</header>
<?
include_once('./_common.php');

?>

	<section class="member_wrap">
<form name="Frm" method="post" action="modify_address_db.php">
<input type="hidden" name="mb_addr_jibeon">
		<ul class="input_wrap">
			<li>
				<div class="input">
					<p><input type="text" name="mb_zip" placeholder="" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="mb_zip" readonly></p>
					<a onclick="javascript:findad();">주소검색</a>
				</div>
				<div class="input">
					<input type="text" name="address1" placeholder="기본주소" value="<?=$member[mb_addr1]?>">
				</div>
				<div class="input">
					<input type="text" name="address2" placeholder="상세주소" value="<?=$member[mb_addr2]?>">
				</div>
	<div class="input">
					<input type="text" name="address3" placeholder="참고항목" value="<?=$member[mb_addr3]?>">
				</div>			</li>
		</ul>
		
		<div class="btn1">
			<a href="javascript:gosave();">주소 변경</a>
		</div>
</form>
	</section>
</body>
</html>
