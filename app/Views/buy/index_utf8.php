<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<script language="javascript">
// opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
//document.domain = "abc.go.kr";

function jusoCallBack(roadFullAddr, zipNo){
	document.getElementById('roadFullAddr').value = roadFullAddr;
	document.getElementById('zipNo').value = zipNo;
}

function goPopup(){
	// 주소검색을 수행할 팝업 페이지를 호출합니다.
	// 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(https://www.juso.go.kr/addrlink/addrLinkUrl.do)를 호출하게 됩니다.
	var pop = window.open("addressPopup","pop","width=570,height=420, scrollbars=yes, resizable=yes");
}
</script>
<body onload="jusoCallBack('roadFullAddr', 'zipNo');">
<input type="button" value="주소검색" onclick="goPopup();"> 
	<form name="rdnAddr">
		<input id ="roadFullAddr">
		<input id ="zipNo">
	</form>
</body>
</html>