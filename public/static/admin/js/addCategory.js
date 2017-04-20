    // 新增相册提交
    commonIdEvent("submit",'click',idSuccessFunction);
    /**
     * 检测文本框是否为空，不为空执行ajax
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:24:42+0800
     * @param    {[object]}                 e [当前点击对象]
     * @return   {[void/boolean]}                   [如果文本框有空则结束函数]
     */
    function idSuccessFunction(e){
        // 获取所有input框的值
        var title = $('#category_title').val();
        var desc = $('#category_desc').val();
        var tag = $('#category_tag').val();
        var json = {"title":title,"desc":desc,"tag":tag};
        // 如果为空，提示用户
        if(!isNull(json)){
            // 调用layer弹出层提示框
            warning("信息请填写完整！",5);
            // 结束函数
            return false;
        }

        ajaxUploadPicture("submitForm",blogController,uploadFunction);
   

    }
    /**
     * [ajax回调函数，只要用于提醒用户]
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:25:52+0800
     * @param    {[json]}                 json [message/ico 提示信息和图标]
     * @return   {[boolean]}                      [结束函数返回false]
     */
    function uploadFunction(json){
        alertNotice(json.message,json.ico);
        return false;
    }


