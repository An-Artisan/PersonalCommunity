layui.use('layedit', function(){
	// 获取编辑器
	var layedit = layui.layedit;
	 //建立编辑器
	var index = layedit.build('demo', {
	  tool: [
		  'strong' //加粗
		  ,'italic' //斜体
		  ,'underline' //下划线
		  ,'del' //删除线
		  ,'|' //分割线
		  ,'left' //左对齐
		  ,'center' //居中对齐
		  ,'right' //右对齐
		  ,'link' //超链接
		  ,'unlink' //清除链接
		  ,'face' //表情
		]
	});  
	// 点击提交事件 
	commonIdEvent('submit','click',submitSuccessFunction);
	/**
	 * 检测文本框内容是否为空，不为空追加数据到formdata对象中，发起ajax请求
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:43:06+0800
	 * @param    {[object]}                 e [当前点击对象]
	 * @return   {[void]}                   [无返回值]
	 */
	function submitSuccessFunction(e){
		// 打包json数据
		var data = {"name":$('#your-name').val(),"email":$('#email').val(),"content":layedit.getContent(index)};
		// 验证是否为空
		if(!isNull(data)){
			// 为空提示
			warning("昵称、邮箱、内容不能为空",5);
			// 结束函数
			return false;
		}
		// 验证邮箱是否合法
		if(!checkEmail($('#email').val())){
			// 不合法提示
			warning("你的邮箱格式不正确，请重新输入",5);
			// 结束函数
			return false;
		}
		// 实例化formData对象
		var formData = new FormData();
		// 追加数据到formData中
		formData.append('name',$('#your-name').val());
		formData.append('email',$('#email').val());
		formData.append('content',layedit.getContent(index));
		// 发起ajax请求
		formDataAjax('post',message,ajaxSuccessFunction,formData,'json');
	}
	/**
	 * 执行ajax回调函数，提示用户
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:44:07+0800
	 * @param    {[json]}                 json [message/ico,提示信息和图标]
	 * @param    {[int]}                 id   [默认为0，用于扩展]
	 * @return   {[void]}                      [无返回值]
	 */
	function ajaxSuccessFunction(json,id){
		// 提示用户
		alertNotice(json.message,json.ico);
	}
});
