$("#clear").on("click",function(){
	layer.confirm('是否清除冗余图片信息？', {
		  btn: ['确定','取消'] //按钮
		}, function(){
			// 显示加载层
		    index = layer.load(1, {
		       shade: [0.1,'#fff'] //0.1透明度的白色背景
		    });
		   // 发起ajax请求
		   formDataAjax('post',chearPhotos,clearSuccessFunction,new FormData(),'json');
		});
		// 结束函数
		return false;
});
function clearSuccessFunction(json,id){
	// 关闭层提示层
    layer.close(index); 
    // 提示用户
	warning(json.message,json.ico);
}

