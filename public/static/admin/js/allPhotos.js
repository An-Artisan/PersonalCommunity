    $("#plus_album").on("click",function(){
            layer.open({
                type: 2,
                title: '添加照片----上传过程中请勿关闭窗口',
                shadeClose: true,
                shade: 0.8,
                area: ['90%', '90%'],
                content: addPhotosController //iframe的url
                }); 
          });
    $('#album').change(function(){
        var date_json =  {"a_id":$(this).children('option:selected').val()};
        commonAjax('POST',selectAlbumController,ajaxSuccessFunction,date_json,'json');

    
    });
    /**
     * [执行ajax改变当前相册，获取点击相册所有图片]
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:27:59+0800
     * @param    {[json]}                 json [message/ico，提示信息和图标]
     * @param    {[int]}                 id   [默认为0，用于扩展]
     * @return   {[boolean/void]}                      [没有数据结束函数，有数据写入界面]
     */
    function ajaxSuccessFunction(json,id){
        // 判断是否有message键值，如果有代表没有数据
        if(json.hasOwnProperty("message")){
            // 提示用户没有数据
            warning(json.message,json.ico);
            // 退出函数执行
            return false;
        }

        // 有数据先把所有照片清空
        $('#photos').empty();
        // 定义变量用来存储照片信息
        var allPhotos = '';
        // 循环所有的数据并且存储在allPhotos变量中
        for(var i=0,l=json.length;i<l;i++){
             allPhotos += '<div  class="am-u-sm-12 am-u-md-6 am-u-lg-4"><div class="tpl-table-images-content"><span class="tpl-i-title">上传时间</span><div class="tpl-table-images-content-i-time">'+json[i]['p_time']+'</div><div class="tpl-i-title cont ">'+json[i]['p_title']+'</div><a href="javascript:;" class="tpl-table-images-content-i"><img height="250" layer-pid="'+json[i]['p_id']+'" layer-src="'+json[i]['p_address']+'" src="'+json[i]['p_thum']+'" alt="'+json[i]['p_title']+'"></a><div class="tpl-table-images-content-block"><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs tpl-edit-content-btn"><button type="button" class="am-btn am-btn-default am-btn-danger"><span a_id="'+json[i]['p_id']+'" name="delete" class="am-icon-trash-o">删除</span></button></div></div></div></div></div>';
             
            // for(var key in json[i]){
                
            //     // alert(key+':'+json[i][key]);
            // }
         }
         // 追加到该div下，做到无刷新显示
         $('#photos').append(allPhotos);
         /*
            动态生成的元素添加点击事件
            如果元素是用click事件append进来的
            那功能函数必须放在这个click事件里面。
            同理，在这里的动作是change动作，所以
            这里添加内容里面的点击事件要放在change中
            这里因为内容是动态追加到div中，所以
            该div中的所有点击动作必须要在该change
            动作中，才能实现动态添加元素实现点击事件
         */
         commonNameEvent('span',"delete",'click',nameSuccessFunction);
    }
    //  显示照片查看层 
    var index = layer.photos({
      photos: '#photos'
      ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
    });
