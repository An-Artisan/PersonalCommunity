    // input文件控件发生改变执行显示图片
    $("#doc-form-file").change(function(){
        // 追加上传图片到id=append下
        selfile(this.id,'append');
     });
    // 新增相册提交
    commonIdEvent("submit",'click',idSuccessFunction);
    /**
     * [Ajax成功回调函数]
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:10:05+0800
     * @param    [object]                 e [当前点击对象]
     * @return   [boolean]                   [结束回调返回false]
     */
    function idSuccessFunction(e){
        // 获取所有input框的值
        var title = $('#album_title').val();
        var desc = $('#album_desc').val();
        var img = $('#append').html();
        // 获取是否加密
        var encryption = $("input[type='checkbox']").is(':checked');
        // 加密就多判断问题和回答两个input框是否为空
        if(encryption){

            // 获取问题和回答的值
            var question = $('#album_question').val();
            var answer = $('#album_answer').val();
            // 打包json
            var json = {"title":title,"desc":desc,"img":img,"question":question,"answer":answer};
            // 如果为空,提示用户
            if(!isNull(json)){
                // 调用layer弹出层提示框
                warning("信息请填写完整！",5);
                // 结束函数
                return false;
            }
            ajaxUploadPicture("submitForm",albumController,uploadFunction);
        }else{

            // 打包json
            var json = {"title":title,"desc":desc,"img":img};
            // 如果为空，提示用户
            if(!isNull(json)){
                // 调用layer弹出层提示框
                warning("信息请填写完整！",5);
                // 结束函数
                return false;
            }
            ajaxUploadPicture("submitForm",albumController,uploadFunction);
        }

    }
    /**
     * [ajax上传文件的回调函数]
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:13:21+0800
     * @param    {[json]}                 json [json串]
     * @return   {[boolean]}                      [结束该函数]
     */
    function uploadFunction(json){
        alertNotice(json.message,json.ico);
        return false;
    }


