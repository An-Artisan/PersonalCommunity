  layui.use('layedit', function(){
    // 获取编辑器
    var layedit = layui.layedit;
    // 设置图片接口
    layedit.set({
      uploadImage: {
        url: blogUploadPhoto //接口url
        ,type: 'post' //默认post
      }
    });
    var load;
    //建立编辑器
    var index = layedit.build('demo', {
      height:500,
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
          ,'image'
        ]
    });  
    // 点击提交事件 
    commonIdEvent('submit','click',submitSuccessFunction);
    /**
     * [执行提交回调函数，用于检测文本框是否为空，同时追加内容到formdata中，执行ajax]
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:18:26+0800
     * @param    {[object]}                 e [点击对象]
     * @return   {[void/boolean]}                   [验证文本框失败返回false/执行ajax无返回值]
     */
    function submitSuccessFunction(e){
      // 打包json数据
      var data = {"name":$('#user-title').val(),"desc":$('#user-desc').val(),"content":layedit.getContent(index)};
      // 验证是否为空
      if(!isNull(data)){
        // 为空提示
        warning("请填写完整！",5);
        // 结束函数
        return false;
      }
      // 实例化formData对象
      var formData = new FormData();
      // 追加数据到formData中
      formData.append('title',$('#user-title').val());
      formData.append('desc',$('#user-desc').val());
      formData.append('content',layedit.getContent(index));
      formData.append('category',$('#category').children('option:selected').val());
      formData.append('author',$('#author').children('option:selected').val());
      // 显示加载层
      load = layer.load(1, {
        shade: [0.1,'#fff'] //0.1透明度的白色背景
      });
      // 发起ajax请求
      formDataAjax('post',blogAddArticle,ajaxSuccessFunction,formData,'json');
    }
    /**
     * [执行ajax回调函数]
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:21:31+0800
     * @param    {[json]}                 json [message/ico，提示信息和图标]
     * @param    {[int]}                 id   [默认为0，用于扩展]
     * @return   {[void]}                      [无返回值]
     */
    function ajaxSuccessFunction(json,id){
      // 关闭层提示层
      layer.close(load); 
      // 提示用户
      alertNotice(json.message,json.ico);
    } 
});