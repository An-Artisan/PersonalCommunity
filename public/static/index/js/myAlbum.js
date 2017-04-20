    // 执行a元素name=album 的click事件
    commonNameEvent('a',"album",'click',nameSuccessFunction);
    /**
     * 执行click回调函数，检测是否有加密
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:45:24+0800
     * @param    {[object]}                 e [当前点击对象]
     * @return   {[void]}                   [无返回值]
     */
    function nameSuccessFunction(e){
        // 如果当前a标记id为1，表示当前相册加密
        if(e.id == '1'){
            showQuestion(e);
        }
        // 当前id补位1，表示没有加密，可以直接点击访问
        else{
            openAlbum($(e).attr('a_id'));
        }
    }
    /**
     * 显示相册问题
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:45:24+0800
     * @param    {[object]}                 e [当前点击对象]
     * @return   {[void]}                   [无返回值]
     */
    function showQuestion(e){
        // 答案输入层
        layer.prompt({title: $(e).attr('question'), formType: 1}, function(pass, index){
            layer.close(index);
            // 这里只能用jquery方式来获取a_id，因为a_id属性是自己添加的属性
            encryption($(e).attr('a_id'),pass);
        });
    }
    /**
     * 打包json数据，发起ajax请求
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:45:24+0800
     * @param    {[string]}                 id [元素id]
     * @param    {[string]}                 pass [用户输入密码]
     * @return   {[void]}                   [无返回值]
     */
    function encryption(id,pass){
        // 打包json数据格式
        var date_json = {a_id:id,password:pass,__token__:$("input:hidden").attr("value")};
        // 调用ajax请求
        commonAjax('POST',albumEncryptionController,encryptionAjaxSuccessFunction,date_json,'json',id);
    }
    /**
     * 执行ajax回调函数，返回数据中没有flag代表验证失败，给用户提示，有数据打开相册
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:47:49+0800
     * @param    {[json]}                 json [message/ico，提示信息和图标]
     * @param    {[int]}                 id   [该相册id]
     * @return   {[boolean]}                      [没有数据结束函数]
     */
    function encryptionAjaxSuccessFunction(json,id){
        // 如果标记为0的话，代表token验证失败或者答案错误
        if (json.flag == "0") {
            alertNotice(json.message,5);
            // 结束回调函数
            return false;
        }
        //  打开相册
        openAlbum(id);
    }
    /**
     * 发起ajax请求
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:49:21+0800
     * @param    {[int]}                 a_id [相册id]
     * @return   {[void]}                      [无返回值]
     */
    function openAlbum(a_id){
        // 打包json数据格式
        var date_json = {a_id:a_id};
        // 调用ajax请求
        commonAjax('POST',photosController,openAlbumAjaxSuccessFunction,date_json,'json',a_id);
       
    }
    /**
     * 执行打开相册Ajax的回调函数
     * @Author   不敢为天下
     * @DateTime 2017-04-09T16:50:08+0800
     * @param    {[json]}                 json [message/ico，提示信息和图标]
     * @param    {[int]}                 id   [默认为0，用于扩展]
     * @return   {[boolean]}                      [如果没有数据就结束函数，有数据就打开相册]
     */
    function openAlbumAjaxSuccessFunction(json,id){
            // 判断当前json是否存在key值为flag，如果有表示没有数据
            if (json.hasOwnProperty("flag")) {
                layer.msg(json.message, {icon: 5});
                // 结束回调函数
                return false;
            }
            // 如果有数据就显示相册层
            layer.photos({
                photos: json
                ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
            });
    }
    
