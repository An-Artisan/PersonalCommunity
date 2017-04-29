  // 定义layui
  layui.use('element', function(){
  	var element = layui.element();
  	// 实例化formData
    var formData = new FormData();
    // 点击添加图片弹出选择文件
  	$("#upload").on("click",alertFile);
  	// 点击上传执行上传
  	$("#submit").on("click",uploadFiles);
  	// 弹出选择文件
  	function alertFile(){
  		$('input[id=file]').click();
  	}
  	// 选择相册
  	$("ul li").on("click",event);
  	// 把选择的相册替换给当前相册
  	function event(){
  		// console.log($(this).html());
  		$(".dropdown-toggle").html($(this).html());
  	}
  	// 当选择文件之后就显示文件
  	$("#file").change(function(){
  	  selfiles('file',"photos");
  	});
  	/**
     * 显示文件并把文件内容追加到formData中并判断文件类型是否合法
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:35:37+0800
     * @param    {[string]}                 imgId    [input file id值]
     * @param    {[string]}                 appendId [要追加到某元素的id值]
     * @return   {[boolean]}                          [照片不合法就结束函数]
     */
  	function selfiles(imgId,appendId){
  	  // 获取文件对象
      var pic = $("#file").get(0).files;
      // 循环该文件对象
      for(var i = 0;i < pic.length;i++){
      	// 获取文件名
  	    str = pic[i].name;
  	    // 获取文件类型
  	    str = str.substr(str.indexOf('.'));
  	    // 只支持图片类型
  	    if(!(str == '.jpg' || str == '.JPG' || str == '.JPEG' || str == '.png'|| str == '.PNG'|| str == '.GIF' || str == '.jpeg' || str == '.gif')){
  	      layer.confirm('暂不支持上传除jpg,jpeg,gif外其他类型的文件，请重新选择！', {
  	        btn: ['确定','取消'] //按钮
  	      });
  	        return false;
  	    }
  	  // 追加文件对象到formData的file[]数组中
      formData.append("file[]" , pic[i]);
      // 创建div元素
      var div = document.createElement('div');
      // 添加class布局
      $(div).addClass("photo");
      // 创建li元素
      var li = document.createElement('li');
      // 创建img元素
      var img = document.createElement('img');
      // 创建p元素
      var p = document.createElement('p');
      // 创建是否完成标签
      var complete = document.createElement('p');
      // 等待上传
      $(complete).append("等待上传");
      // complete元素添加class布局
      $(complete).addClass('text-center cont')
      // p元素添加class布局
      $(p).addClass("text-center cont");
      // 追加图片名到p元素下
      $(p).append(pic[i].name);
      // img元素添加calss布局
      $(img).addClass('center-block img');
        // 把img和p元素以及是否完成元素追加到li元素中
    	$(li).append(complete,img,p);
    	// 把li元素追加到div中
    	$(div).append(li);
    	// 把div元素追加到appendId中
    	$("#" + appendId).append(div);
        // 把二进制对象直接读成浏览器显示的资源
    	img.src = window.URL.createObjectURL(pic[i]);
        }
  }
   /**
    * 执行上传文件函数
    * @Author   不敢为天下
    * @DateTime 2017-04-09T16:38:34+0800
    * @return   {[boolean]}                 [结束函数]
    */
   function uploadFiles(){
    // 如果用户没选择文件上传，提醒用户选择图片
    if((!$("#file").get(0).files.length) ){
        warning("请先选择图片",5);
        return false;
    }
    // 如果用户没选择相册，提醒用户选择相册
    if($('#dropdownMenu1 img').attr('id') == 0){
        warning("情选择相册",5);
        return false;
    }
    // 把选择图片和上传按钮设置为不可用
  	$('#upload').attr('disabled','disabled'); 
  	$('#submit').attr('disabled','disabled'); 
    // 执行上传多文件Ajax
  	ajaxUploadPictures(formData,'file[]',uploadPhotosController,successFunction,id = 0);
   }
   // 执行上传多文件的回掉函数，(此函数会多次调用，调用次数就是照片的总数)
   function successFunction(json) {
     // 计算上传百分比
      percent = (parseInt(json.id)+1)/formData.getAll('file[]').length*100;
      // 渲染百分比
      element.progress('percent', percent+"%");
      // 提示单张图片上传完成
      $("#photos").find("li").eq(json.id).find('p').eq(0).text("上传完成"); 
   	  // 如果传回来的json.id 等于总数-1 表示已经传完。
      if(parseInt(json.id) == formData.getAll('file[]').length - 1){
      	 // 进度条百分之百
      	 element.progress('percent', '100%');
      	 // 提示用户
      	 alertNotice(json.message,json.ico);
      	 // 结束函数
      	 return false;
      }
   }
   /**
    * ajax递归上传多张图片
    * @Author   不敢为天下
    * @DateTime 2017-04-09T16:39:24+0800
    * @param    {[object]}                 formData        [formdata二进制对象，打包的file值]
    * @param    {[string]}                 getId           [打包fromData的键值]
    * @param    {[string]}                 url             [后台处理链接]
    * @param    {[function]}                 successFunction [执行回调函数，id]
    * @param    {int}                 id              [需要添加的id，默认从0开始上传]
    * @return   {[void]}                                 [无返回值]
    */
  function ajaxUploadPictures(formData,getId,url,successFunction,id = 0) { 
       // 实例化formData对象 
       var Data = new FormData(); 
       // 追加图片到file 
       Data.append('file',formData.getAll(getId)[id]);
       // 追加图片id到post
       Data.append('id',id);
       // 追加a_id到post提交
       Data.append('a_id',$('#dropdownMenu1 img').attr('id'));
       $.ajax({  
            url: url,  
            type: 'POST',  
            data: Data,
            // 异步 
            async: true,  
            // 不缓存此页面
            cache: false,  
            /*
              默认为true，传输类型不为application/x-www-form-urlencoded 
              设置true表示接受类型是默认值，这里不能用字符串的形式传输文
              件上传，所以设置false
            */
            contentType: false,  
            /*
              这里表示传输类型，默认是true，会把传输的数据转成字符串。上
              传文件这里要设置false，不要转换
            */
            processData: false,  
            success: function (json) {
                // 如果返回的json.id小于图片总数-1的话，那就继续调用自身
                if(parseInt(json.id) < formData.getAll(getId).length -1 ){
                    ajaxUploadPictures(formData,getId,url,successFunction,parseInt(json.id)+1);
                }
                // 执行回调函数
                successFunction(json);
            }
       });  
  } 
  });
 