	// 执行span元素name=delete 的click事件
	commonNameEvent('span',"delete",'click',nameSuccessFunction);
	/**
	 * 执行click时间回调函数，提醒用户是否删除，并且执行ajax请求
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:30:26+0800
	 * @param    {[object]}                 e [当前点击对象]
	 * @return   {[boolean]}                   [执行ajax之后结束函数]
	 */
	function nameSuccessFunction(e){
		layer.confirm('删除相册，该相册下所有图片将自动移动到“关于回忆”该相册下。删除照片，会彻底删除数据。你确定删除该操作？', {
		  btn: ['确定','取消'] //按钮
		}, function(){
			// 打包json数据格式
			var date_json = {a_id:$(e).attr('a_id')};
		    // 调用ajax请求
		    commonAjax('POST',deleteAlbumController,openAlbumAjaxSuccessFunction,date_json,'json');
		});
		// 结束函数
		return false;
	    
	}
	/**
	 * 执行ajax回调函数，提示用户
	 * @Author   不敢为天下
	 * @DateTime 2017-04-09T16:31:02+0800
	 * @param    {[json]}                 json [message/ico，提示信息和图标]
	 * @param    {[int]}                 id   [默认为0，用于扩展]
	 * @return   {[boolean]}                      [提示用户，结束函数]
	 */
	function openAlbumAjaxSuccessFunction(json,id){
		// 提示用户
		alertNotice(json.message,json.ico);
	    // 结束回调函数
	    return false;
	}
