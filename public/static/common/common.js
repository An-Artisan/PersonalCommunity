  /**
   * 发起ajax请求
   * @Author   不敢为天下
   * @DateTime 2017-04-09T16:52:40+0800
   * @param    {[string]}                 type                [type表示请求类型(GET/POST)]
   * @param    {[string]}                 url                 [url表示请求地址]
   * @param    {[function]}               ajaxSuccessFunction [ajaxSuccessFunction表示回调函数]
   * @param    {[json]}                   data_json           [data_json表示需要传给后台的json数据串]
   * @param    {[string]}                 dataType            [dataType表示返回值的类型]
   * @param    {id}                       id                  [id表示可选(备用)]
   * @return   {[void]}                                       [无返回值]
   */
  function commonAjax(type,url,ajaxSuccessFunction,data_json,dataType,id = 0){
   	  // 定义一个数据变量，用来ajax传值
      var data = '';
      // 循环json数据，并且用字符串连接成ajax能够识别的数据格式
      for(i in data_json){
         data += '"' + i + '"' + ":" + '"' + data_json[i] + '"' + ",";
      }
      // 减掉最后一个逗号
      ajaxData=data.substring(0,data.length-1);
      // 加上{}，拼接json数据
      ajaxData = "{" + ajaxData + "}";
      // 执行ajax
      $.ajax({
          type: type,
          url: url,
          // 这里的成功回调函数在调用函数里面自己定义
          success: function(json){
          	ajaxSuccessFunction(json,id);
          },
          // 这里传的只是一个参数，键为ajaxData，值为ajaxData的值
          data:{ajaxData},
          dataType: dataType
       });
  }
  /**
   * 发起ajax请求，数据用formdata打包
   * @Author   不敢为天下
   * @DateTime 2017-04-09T16:55:57+0800
   * @param    {[string]}                 type                [type表示请求类型(GET/POST)]
   * @param    {[string]}                 url                 [url表示请求地址]
   * @param    {[function]}               ajaxSuccessFunction [ajaxSuccessFunction表示回调函数]
   * @param    {[object]}                 formData            [提前打包好的formdata对象]
   * @param    {[string]}                 dataType            [dataType表示返回值的类型]
   * @param    {id}                       id                  [id表示可选(备用)]
   * @return   {[void]}                                       [无返回值]
   */
  function formDataAjax(type,url,ajaxSuccessFunction,formData,dataType,id = 0){
      $.ajax({
          type: type,
          url: url,
          // 这里的成功回调函数在调用函数里面自己定义
          success: function(json){
            ajaxSuccessFunction(json,id);
          },
          // 这里传的只是一个参数，键为ajaxData，值为ajaxData的值
          data:formData,
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
          dataType: dataType
       });
  }
  /**
   * 把form表单打包执行ajax
   * @Author   不敢为天下
   * @DateTime 2017-04-09T16:57:18+0800
   * @param    {[string]}                 id              [表单元素id值]
   * @param    {[string]}                 url             [url表示请求地址]
   * @param    {[function]}               successFunction [successFunction表示调用成功回调函数]
   * @return   {[void]}                                   [无返回值]
   */
  function ajaxUploadPicture(id,url,successFunction) {  
       var formData = new FormData($( "#" + id )[0]);  
       $.ajax({  
            url: url,  
            type: 'POST',  
            data: formData,  
            async: false,  
            cache: false,  
            contentType: false,  
            processData: false,  
            success: function (json) {  
               successFunction(json);
            }
       });  
  }
  /**
   * 执行元素element=name的事件
   * @Author   不敢为天下
   * @DateTime 2017-04-09T16:59:13+0800
   * @param    {[element]}                 element             [元素名]
   * @param    {[string]}                  name                [属性name值]
   * @param    {[string]}                  event               [事件]
   * @param    {[function]}                nameSuccessFunction [执行的回掉函数]
   * @return   {[void]}                                        [无返回值]
   */
  function commonNameEvent(element,name,event,nameSuccessFunction){
      $(element + "[name=" + name + "]").on(event, function(){nameSuccessFunction(this)});
  }
  /*
      
      id(唯一的id属性)，event(事件)，nameSuccessFunction(执行的回调函数)
  */
  /**
   * 执行属性id的事件
   * @Author   不敢为天下
   * @DateTime 2017-04-09T17:15:59+0800
   * @param    {[string]}                 id                [唯一的id属性]
   * @param    {[string]}                 event             [事件]
   * @param    {[function]}               idSuccessFunction [执行的回调函数]
   * @return   {[void]}                                     [无返回值]
   */
  function commonIdEvent(id,event,idSuccessFunction){
      $("#"+id).on(event, function(){idSuccessFunction(this)});
  }
  /**
   * js上传图片显示到当前界面
   * @Author   不敢为天下
   * @DateTime 2017-04-09T17:16:49+0800
   * @param    {[string]}                 imgId    [input上传控件id]
   * @param    {[string]}                 appendId [图片追加到当前id下]
   * @return   {[boolean]}                         [无返回值]
   */
  function selfile(imgId,appendId){
      var imgs = document.getElementsByTagName("img");
      // 先看页面有没有img图片(有可能用户选择一次图片，然后反悔，重新选择)
      for(i=0; i<imgs.length; i++)
      imgs[i].parentNode.removeChild(imgs[i]);
      // 然后先删除用户之前上传的图片 
      var pic = document.getElementById(imgId).files;
      // 二进制对象
      for(var i = 0;i < pic.length;i++){
      str = pic[i].name;
      // 获取文件名
      str = str.substr(str.indexOf('.'));
      // 获取文件类型
      if(!(str == '.jpg' || str == '.JPG' || str == '.JPEG' || str == '.png'|| str == '.PNG'|| str == '.GIF' || str == '.jpeg' || str == '.gif')){
        layer.confirm('暂不支持上传除jpg,jpeg,gif外其他类型的文件，请重新选择！', {
          btn: ['确定','取消'] //按钮
        }, function(){
        location.reload(true);
        });
          return false;
      }
      // 只支持图片类型
      var img = document.createElement('img');
      // 创建img对象
       document.getElementById(appendId).appendChild(img);
      // 设置图片的高度
      img.src = window.URL.createObjectURL(pic[i]);
      // 把二进制对象直接读成浏览器显示的资源
      }
      
  }
  //  参数 (json数据)
  /**
   * 判断json数据是否有为空的key
   * @Author   不敢为天下
   * @DateTime 2017-04-09T17:17:46+0800
   * @param    {[json]}                 json [json数据]
   * @return   {Boolean}                     [都不为空返回true，否则返回false]
   */
  function isNull(json){
      // 循环json数据
      for (i in json) {
          // 如果该key为Null,"",undefined,就返回false
          if(!(json[i] && true)){
              return false;
          }
      }
      // 都不为空返回ture
      return true;
  }
  /**
   * alert弹出层提示框
   * @Author   不敢为天下
   * @DateTime 2017-04-09T17:18:33+0800
   * @param    {[string]}                 message [提示信息]
   * @param    {[int]}                 ico     [ico(1,5) 1笑脸，5哭脸]
   * @return   {[void]}                         [强制刷新]
   */
  function alertNotice(message,ico){
      layer.confirm(message, {
          btn: ['确定'], //按钮
          icon: ico
      }, function(){
          // 强制刷新
          location.reload(true);
      });
      // 结束回调函数
      return false;
  }
  /**
   * alert弹出层提示框(不刷新)
   * @Author   不敢为天下
   * @DateTime 2017-04-09T17:20:12+0800
   * @param    {[type]}                 message [提示信息]
   * @param    {[type]}                 ico     [1笑脸，5哭脸]
   * @return   {[boolean]}                      [提示之后结束函数]
   */
  function warning(message,ico){
      layer.confirm(message, {
          btn: ['确定'], //按钮
          icon: ico
      });
      // 结束回调函数
      return false;
  }
  /**
   * 正则匹配邮箱
   * @Author   不敢为天下
   * @DateTime 2017-04-09T17:21:03+0800
   * @param    {[string]}                 email_address [邮箱地址]
   * @return   {[boolean]}                              [匹配成功返回true，失败返回false]
   */
  function checkEmail( email_address ){
    // 验证邮箱正则表达式
    var regex = /^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/g;
    // 开始验证
    if ( regex.test( email_address ) ){
         // 验证通过返回true 
         return true;
    }
    else{
         // 验证失败返回false 
         return false;
    }
  }
  /**
   * 获取当前时间
   * @Author   不敢为天下
   * @DateTime 2017-04-17T20:17:44+0800
   * @return   {[string]}                 [返回当前时间]
   */
function getNowFormatDate() {
    var date = new Date();
    // 实例化js事件对象
    var seperator1 = "-";
    // 年份和月份分隔符以及月份和小时分隔符
    var seperator2 = ":";
    // 小时和分钟分隔符，分钟和秒数分隔符
    var year = date.getFullYear();
    // 获取当前年月
    var month = date.getMonth() + 1;
    /* 
        获取当前月份
        PS：这里为什么要+1？因为js是老外发明的
        而外国人的月份从0开始的，0代表1月。11
        代表12月。就像外国人星期日作为一个星
        期的第一天一样。所以这里要+1
    */
    var strDate = date.getDate();
    // 获取当前日
    var hour = date.getHours();
    // 获取当前时
    var minutes = date.getMinutes();
    // 获取当前分
    var seconds = date.getSeconds();
    // 获取当前秒
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    // 如果当前月是个位，就给他前面加一个0
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    // 如果当前日是个位，就给他前面加一个0
    if (hour >= 0 && hour <= 9) {
        hour = "0" + hour;
    }
    // 如果当前时是个位，就给他前面加一个0
    if (minutes >= 0 && minutes <= 9) {
        minutes = "0" + minutes;
    }
    // 如果当前分是个位，就给他前面加一个0
    if (seconds >= 0 && seconds <= 9) {
        seconds = "0" + seconds;
    }
    // 如果当前分是个位，就给他前面加一个0
    var currentdate = year + seperator1 + month + seperator1 + strDate
        + " " + hour + seperator2 + minutes
        + seperator2 + seconds;
    // 拼接时间字符串
    return currentdate;
    // 返回给调用函数
}