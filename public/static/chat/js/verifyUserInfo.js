// 失去焦点判断字符是否过短或过长
$("#username").blur(username_verify);
// 验证用户名是否已经注册，过长等
function username_verify(){
  $("#username_ico").removeClass();
  // 发起ajax请求，验证用户名是否已经存在
  $.post(registerVerifyUserName,{"username":$("#username").val()},function(json){
    if(json.flag == 0){
        alertNotice(json.message,5);
        return false;
    }
  },'json');
  var length = strlen($("#username").val());
  if(length > 19){
     $("#username").val('');
     $("#username_ico").addClass("icon into");
     warning("用户名英文字符长度不超过18，中文字符不超过6个汉字",5);
  }
  $("#username_ico").addClass("icon ticker");
}
// 失去焦点判断字符是否过短或过长
$("#nickname").blur(function(){
  $("#nickname_ico").removeClass();
  var length = strlen(this.value);
  if(length > 19 ){
  	 $(this).val('');
  	 $("#nickname_ico").addClass("icon into");
  	 warning("昵称英文字符长度不超过18，中文字符不超过6个汉字",5);
  }
  $("#nickname_ico").addClass("icon ticker");
});
// 失去焦点判断字符是否过短或过长
$("#password").blur(function(){
 $("#password_ico").removeClass();
 var length = strlen(this.value);
 if(length > 19 || length < 5){
  	 $(this).val('');
  	 $("#password_ico").addClass("icon into");
  	 warning("密码长度最低5位，最高16位",5);
  }
 $("#password_ico").addClass("icon ticker");
});
// 失去焦点判断字符是否过短或过长
$("#repeat").blur(function(){
  $("#repeat_ico").removeClass();
  if($("#password").val()!=this.value){
  	$(this).val('');
  	$("#repeat_ico").addClass("icon into");
  	warning("两次密码不匹配",5);
  }
  $("#repeat_ico").addClass("icon ticker");
});
// 点击选择头像按钮
$("#select").on("click",alertFile);
// file域改变
$("#file").change(function(){
	  show_image('head');
	});
// 弹出选择文件
function alertFile(){
	$('input[id=file]').click();
}
function show_image(appendId){
	// 获取文件对象
	var pic = $("#file").get(0).files[0];
	// 获取文件名
	str = pic.name;
	// 获取文件类型
	str = str.substr(str.indexOf('.'));
	// 只支持图片类型
	if(!(str == '.jpg' || str == '.JPG' || str == '.JPEG' || str == '.png'|| str == '.PNG'|| str == '.GIF' || str == '.jpeg' || str == '.gif')){
	  layer.confirm('暂不支持上传除jpg,jpeg,gif外其他类型的文件，请重新选择！', {
	    btn: ['确定','取消'] //按钮
		});
	  return false;
		}
		// 创建img节点
		var img = document.createElement('img');
		// 添加至appendId节点中
		$("#" + appendId).append(img);
		// 显示图片
		img.src = window.URL.createObjectURL(pic);
    // 禁止再次选择图片
    $('#select').val("已选择");
    $('#select').attr('disabled','disabled');
}
	
